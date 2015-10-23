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
			file_put_contents('./wechat.txt', json_encode($data),FILE_APPEND);
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
						default:
							return;
					}
					//扫码之后绑定oid和openid  只允许第一次
					$openid = $data->FromUserName;
					$user = $this->model('user')->where('openid=?',array($openid))->select();
					if (!empty($user) && empty($user[0]['oid']))
					{
						$this->model('user')->where('openid=?',array($openid))->update('oid',$eventKey);
						return new xml(array(
							'ToUserName' => $data->FromUserName,
							'FromUserName' => $data->ToUserName,
							'CreateTime' => $_SERVER['REQUEST_TIME'],
							'MsgType' => 'text',
							'Content' => '恭喜，您已经成功入住,成为'.$user[0]['username'].'旗下的一份子了'
						),true,false);	
					}
					else
					{
						return new xml(array(
							'ToUserName' => $data->FromUserName,
							'FromUserName' => $data->ToUserName,
							'CreateTime' => $_SERVER['REQUEST_TIME'],
							'MsgType' => 'text',
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
	 * @return \application\message\json
	 */
	private function access_token()
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
	
	
	/**
	 * @param int $id get
	 * 根据传入的参数 生成微信二维码
	 */
	function eqcode()
	{
		$scene_id = $this->get->id;
		
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
	 * 设置微信自定义菜单 未完成
	 */
	function menu()
	{
		$menu = new \stdClass();
		$menu->button = array(
		);
		
		$access_token = $this->access_token();
		
		$action = $this->get->action;
		switch ($action)
		{
			case 'create':
				$button = new \stdClass();
				$button->name = $this->post->name;
				$button->key = $this->post->key;
				$button->type = $this->post->type;
				$menu->button[] = $button;
				if($this->_wechat->menu($access_token, $menu,'create'))
				{
					return new json(json::OK,NULL);
				}
				return new json(json::PARAMETER_ERROR,'配置失败');
				break;
			case 'fetch':
				$result = $this->_wechat->menu($access_token);
				return new json(json::OK,NULL,$result);
			default:
				return new json(json::PARAMETER_ERROR,'type错误');
		} 
		
	}
}