<?php
namespace application\control;
use system\core\control;
use application\classes\wechat;
use application\message\json;
use application\message\xml;
use system\core\file;
/**
 * 微信相关控制器
 * @author jin12
 *
 */
class wechatControl extends control
{
	private $_appid;
	private $_appsecret;
	private $_wechat;
	
	function __construct()
	{
		parent::__construct();
		$this->_appid = $this->model('system')->get('appid','weixin');
		$this->_appsecret = $this->model('system')->get('appsecret','weixin');
		$this->_wechat = new wechat($this->_appid, $this->_appsecret);
	}
	
	/**
	 * 接收微信消息
	 */
	function router()
	{
		if (!empty($this->get->signature) && !empty($this->get->echostr) && !empty($this->get->timestamp) && !empty($this->get->nonce))
		{
			$token = $this->model('system')->get('token','weixin');
			if ($this->_wechat->checkSignature($this->get->signature, $this->get->timestamp, $this->get->nonce, $token))
			{
				return $this->get->echostr;
			}
		}
		else
		{
			$data = $this->_wechat->getData();
			if (empty($data))
				return new json(json::PARAMETER_ERROR,'错误的访问');
			switch (strtolower($data->MsgType))
			{
				case 'event':
					switch (strtolower($data->Event))
					{
						case 'subscribe':
							$eventKey = $data->EventKey;
							list($qrscene,$eventKey) = explode('_', $eventKey);
							if (strtolower($qrscene) == 'qrscene')
							{
								$eventKey = ltrim($eventKey,0);
							}
							else
							{
								echo "扫码参数错误";
							}
							break;
						case 'scan':
							$eventKey = ltrim($data->EventKey,0);
							break;
						case 'click':
							switch ($data->EventKey)
							{
								case 'myeqcode':
									$openid = $data->FromUserName;
									$userModel = $this->model('user');
									$user = $userModel->getByOpenid($openid);
									if(empty($user))
									{
										$uid = $userModel->registerWeiXin($openid);
									}
									else
									{
										$uid = $user['id'];
									}
									$access_token = $this->access_token();
									$action = 'upload';
									$type = 'image';
										
									$file = ROOT.'/application/upload/'.md5($data->FromUserName).'.jpg';
									file_put_contents($file, $this->eqcode($uid));
				
									$result = $this->_wechat->file($access_token, $action, $file, $type);
									$result = json_decode($result,true);
									if (isset($result['media_id']))
									{
										return new xml(array(
											'ToUserName' => $data->FromUserName,
											'FromUserName' => $data->ToUserName,
											'CreateTime' => $_SERVER['REQUEST_TIME'],
											'MsgType' => 'image',
											'Image' => array(
												'MediaId' => $result['media_id']
											)
										),true,false);
									}
									else
									{
										return new xml(array(
											'ToUserName' => $data->FromUserName,
											'FromUserName' => $data->ToUserName,
											'CreateTime' => $_SERVER['REQUEST_TIME'],
											'MsgType' => 'text',
											'Content' => '无法获取二维码'
										));
									}
									break;
								default:return new xml(array(
									'ToUserName' => $data->FromUserName,
									'FromUserName' => $data->ToUserName,
									'CreateTime' => $_SERVER['REQUEST_TIME'],
									'MsgType' => 'text',
									'Content' => '尚未定义消息事件'
								),true,false);
							}
							break;
						default:
							return;
					}
					//扫码之后绑定oid和openid  只允许第一次
					$openid = $data->FromUserName;
					
					$user = $this->model('user')->getByOpenid($openid);
					if (!empty($user))
					{
						if (empty($user['oid']))
						{
							if ($eventKey === $user['id'])
								return new xml(array(
									'ToUserName' => $data->FromUserName,
									'FromUserName' => $data->ToUserName,
									'CreateTime' => $_SERVER['REQUEST_TIME'],
									'MsgType' => 'text',
									'Content' => 'Sorry,您不能把自己做为自己的分销商哦'
								));
							$this->model('user')->where('openid=?',array($openid))->update('oid',$eventKey);
							return new xml(array(
								'ToUserName' => $data->FromUserName,
								'FromUserName' => $data->ToUserName,
								'CreateTime' => $_SERVER['REQUEST_TIME'],
								'MsgType' => 'text',
								'Content' => '恭喜，您已经成功入住,成为TA旗下的一份子了'
							),true,false);
						}
						else
						{
							return new xml(array(
								'ToUserName' => $data->FromUserName,
								'FromUserName' => $data->ToUserName,
								'CreateTime' => $_SERVER['REQUEST_TIME'],
								'MsgType' => 'text',
								'Content' => '您已经有了上级分销商了'
							),true,false);
						}
					}
					else
					{
						return new xml(array(
							'ToUserName' => $data->FromUserName,
							'FromUserName' => $data->ToUserName,
							'CreateTime' => $_SERVER['REQUEST_TIME'],
							'MsgType' => 'text',
							//'Content'=>$openid
							'Content' => '尚未注册或绑定账号，请点此注册或登陆'.$this->http->url('mobile','login')
						),true,false);
					}
					break;
				case 'text':
					$tid = trim($data->Content);
					$themeModel = $this->model('theme');
					$theme = $themeModel->get($tid);
					if(!empty($theme))
					{
						return new xml(
							array(
								'ToUserName'=>$data->FromUserName,
								'FromUserName' => $data->ToUserName,
								'CreateTime' => $_SERVER['REQUEST_TIME'],
								'MsgType' => 'news',
								'ArticleCount'=>1,
								'Articles' => array(
									'item' => array(
										'Title' => $theme['name'],
										'Description' => $theme['description'],
										'PicUrl' => file::realpathToUrl($theme['middlepic']),
										'Url' => $this->http->url('mobile','themeDetail',array('id'=>$tid))
									)
								)
							),
							true,
							false
						);
					}
					break;
				default:
					//处理无法请求的事件
					return file_get_contents('http://www.baidu.com');
			}
			
		}
	}
	
	/**
	 * 获取access_token
	 * @return string
	 */
	public function access_token()
	{
		$resultFlag = false;
		$access_token = $this->model('system')->get('access_token','weixin');
		if(!empty($access_token))
		{
			$access_token = json_decode($access_token,true);
			if (isset($access_token['endtime']) && $access_token['endtime']>$_SERVER['REQUEST_TIME'])
			{
				$resultFlag = true;
			}
		}
		//access_token失效或者不存在
		if(!$resultFlag)
		{
			$result = $this->_wechat->access_token();
			$result = json_decode($result,true);
			if($result === false)
				return new json(json::PARAMETER_ERROR,'微信接口错误');
			if(!isset($result['access_token']))
				return new json(json::PARAMETER_ERROR,'微信配置错误',$result);
			$result['endtime'] = $_SERVER['REQUEST_TIME'] + $result['expires_in'];
			$this->model('system')->set('access_token','weixin',json_encode($result));
			$access_token = $result;
		}
		return $access_token['access_token'];
	}
	
	function test()
	{
		$access_token = $this->access_token();
		print_r($this->_wechat->menu($access_token,NULL,'fetch'));
	}
	
	
	/**
	 * @param int $id get
	 * 根据传入的参数 生成微信二维码
	 */
	function eqcode($sid = NULL)
	{
		$scene_id = $this->get->id;
		$scene_id = ($scene_id === NULL)?$sid:$scene_id;
		
		
		$access_token = $this->access_token();
		
		$limit = filter_var($this->get->limit,FILTER_VALIDATE_BOOLEAN);
		
		$ticket = $this->_wechat->ticket($access_token, $scene_id,$limit);
		$ticket = json_decode($ticket,true);
		
		$url = $this->_wechat->eqcode($ticket['ticket']);
		$headers = get_headers($url);
		foreach ($headers as $header)
		{
			$this->response->addHeader($header);
		}
		//增加图像缓存
		$this->response->addHeader('Cache-Control','cache-directive');
		$this->response->addHeader('cache-directive','public');
		if(filter_var($this->get->download,FILTER_VALIDATE_BOOLEAN))
		{
			$this->response->addHeader('Content-Disposition','attachment; filename="eqcode.png"');
		}
		return file_get_contents($url);
	}
	
	/**
	 * 设置微信自定义菜单
	 */
	function menu()
	{
		$menuModel = $this->model('menu');
		switch ($this->get->action)
		{
			case 'create':
				$id = $this->post->id;
				if (empty($id) && $menuModel->checkMenuLength()==3)
					return new json(json::PARAMETER_ERROR,'菜单栏长度太长了');
				if (!empty($id) && $menuModel->checkMenuLength($id) == 7)
					return new json(json::PARAMETER_ERROR,'菜单栏长度太长了');
				$result = $menuModel->create($this->post->name,$this->post->type,$this->post->key,$this->post->id);
				if($result)
				{
					return new json(json::OK,NULL,$result);
				}
				return new json(json::PARAMETER_ERROR);
				break;
			case 'delete':
				$id = $this->post->id;
				if($menuModel->remove($id))
				{
					return new json(json::OK);
				}
				return new json(json::PARAMETER_ERROR);
				break;
			case 'fetch':
				$result = $menuModel->fetchAll();
				return new json(json::OK,NULL,$result);
				break;
			case 'save':
				$weixin = $menuModel->toWeiXin();
				$access_token = $this->access_token();
				if (empty($weixin))
				{
					$result = $this->_wechat->menu($access_token,NULL,'delete');
				}
				else
				{
					$menu = new \stdClass();
					$menu->button = $weixin;
					$result = $this->_wechat->menu($access_token,$menu,'create',false);
				}
				return new json(json::OK);
			default:
				return new json(json::PARAMETER_ERROR,'aciton error');
		}
	}
	
}