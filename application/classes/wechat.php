<?php
namespace application\classes;

class wechat
{
	private $_appid;
	
	private $_appsecret;
	
	/**
	 * constructor
	 * @param unknown $access_token
	 */
	function __construct($appid,$appsecret)
	{
		$this->_appid= $appid;
		$this->_appsecret = $appsecret;
	}
	
	/**
	 * 检查微信接入
	 * @param unknown $signature
	 * @param unknown $timestamp
	 * @param unknown $nonce
	 * @return boolean
	 */
	function checkSignature($signature,$timestamp,$nonce,$token)
	{
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
	
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 捕获微信消息
	 * @return string
	 */
	function getData()
	{
		$postStr = file_get_contents('php://input');
		libxml_disable_entity_loader(true);
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		return json_decode(json_encode($postObj),false);
	}
	
	/**
	 * 获取access_token
	 */
	function access_token()
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
		$url = sprintf($url,$this->_appid,$this->_appsecret);
		return $this->get($url);
	}
	
	/**
	 * 创建二维码ticket
	 * @param $access_token
	 * @param $scene_id
	 * @param string $limit false 是否永久二维码 true是  false不是
	 * @param int $expire_seconds 有效期
	 */
	function ticket($access_token,$scene_id,$limit = false,$expire_seconds = 604800)
	{
		if($limit)
		{
			if ($scene_id> 100000 || $scene_id <1)
				return false;  
		}
		else
		{
			if(strlen($scene_id)>32)
			{
				$scene_id = substr($scene_id, 0,32);
			}
			else
			{
				$scene_id = str_pad($scene_id, 32,0,STR_PAD_LEFT);
			}
		}
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token='.$access_token;
		$data = array(
			'action_info' => array(
				'scene' => array(
					'scene_id' => $scene_id
				)
			)
		);
		if ($limit)
		{
			$data['action_name'] = 'QR_LIMIT_SCENE';
		}
		else
		{
			$data['action_name'] = 'QR_SCENE';
			$data['expire_seconds'] = $expire_seconds;
		}
		$data = json_encode($data);
		return $this->post($url, $data);
	}
	
	/**
	 * 生成微信二维码
	 */
	function eqcode($ticket)
	{
		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket='.urlencode($ticket);
		return $url;
	}
	
	/**
	 * 设置自定义菜单
	 */
	function menu($access_token,$data = array(),$action = 'fetch')
	{
		switch ($action)
		{
			case 'delete':
				$delete = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token='.$access_token;
				$result = $this->get($delete);
			break;
			case 'create':
				$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$access_token;
				$result = $this->post($url, $data);
				
			break;
			case 'fetch':
				$url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token='.$access_token;
				$result = $this->get($url);
				$result = json_decode($result);
				return $result;
			break;
			default:return false;
		}
		$result = json_decode($result,true);
		if($result['errcode'] === 0)
			return true;
		return false;
	}
	
	/**
	 * 发送get请求
	 * @param unknown $url
	 * @return string
	 */
	private function get($url)
	{
		if (function_exists('file_get_contents'))
			return file_get_contents($url);
	}
	
	/**
	 * 发送post请求
	 * @param unknown $url
	 * @param unknown $data
	 * @return string
	 */
	private function post($url,$data)
	{
		if(function_exists('file_get_contents'))
		{
			if (is_array($data))
			{
				$data = http_build_query($data);
			}
			else if (is_object($data))
			{
				$data = json_encode($data,JSON_UNESCAPED_UNICODE);
			}
			$context = array(
				'http'=>array(
					'method'=>"POST",
					'header'=>"Content-type: application/x-www-form-urlencoded\r\n".
					"Content-length:".strlen($data)."\r\n",
					'content' => $data,
				)
			);
			$context = stream_context_create($context);
			return file_get_contents($url,NULL,$context);
		}
	}
}