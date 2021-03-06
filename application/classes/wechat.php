<?php
namespace application\classes;

use system\core\random;
class wechat
{

	private $_appid;

	private $_appsecret;

	/**
	 * constructor
	 *
	 * @param unknown $access_token        	
	 */
	function __construct($appid, $appsecret)
	{
		$this->_appid = $appid;
		$this->_appsecret = $appsecret;
	}

	/**
	 * 检查微信接入
	 *
	 * @param unknown $signature        	
	 * @param unknown $timestamp        	
	 * @param unknown $nonce
	 * @return boolean
	 */
	function checkSignature($signature, $timestamp, $nonce, $token)
	{
		$tmpArr = array(
			$token,
			$timestamp,
			$nonce
		);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);
		
		if ($tmpStr == $signature) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * 捕获微信消息
	 *
	 * @return string
	 */
	function getData()
	{
		$postStr = file_get_contents('php://input');
		file_put_contents('./wechat.txt', $postStr);
		libxml_disable_entity_loader(true);
		$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
		return json_decode(json_encode($postObj), false);
	}

	/**
	 * 获取access_token
	 */
	function access_token()
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';
		$url = sprintf($url, $this->_appid, $this->_appsecret);
		return $this->get($url);
	}

	/**
	 * 创建二维码ticket
	 *
	 * @param
	 *        	$access_token
	 * @param
	 *        	$scene_id
	 * @param string $limit
	 *        	false 是否永久二维码 true是 false不是
	 * @param int $expire_seconds
	 *        	有效期
	 */
	function ticket($access_token, $scene_id, $limit = false, $expire_seconds = 604800)
	{
		if ($limit) {
			if ($scene_id > 100000 || $scene_id < 1)
				return false;
		} else {
			if (strlen($scene_id) > 32) {
				$scene_id = substr($scene_id, 0, 32);
			} else {
				$scene_id = str_pad($scene_id, 32, 0, STR_PAD_LEFT);
			}
		}
		$url = 'https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=' . $access_token;
		$data = array(
			'action_info' => array(
				'scene' => array(
					'scene_id' => $scene_id
				)
			)
		);
		if ($limit) {
			$data['action_name'] = 'QR_LIMIT_SCENE';
		} else {
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
		$url = 'https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=' . urlencode($ticket);
		return $url;
	}

	/**
	 * 文件上传
	 *
	 * @param unknown $access_token        	
	 * @param unknown $action
	 *        	upload|delete|fetch
	 * @param unknown $file
	 *        	文件完整路径
	 * @param unknown $type
	 *        	文件类型 voice|image|video|thumb
	 * @return boolean
	 */
	function file($access_token, $action, $file, $type, $debug = false)
	{
		switch ($action) {
			case 'upload':
				$url = 'https://api.weixin.qq.com/cgi-bin/media/upload?access_token=%s&type=%s';
				$url = sprintf($url, $access_token, $type);
				$data = array(
					'media' => '@' . $file
				);
				$result = $this->post($url, $data, true);
				break;
			case 'delete':
				break;
			case 'fetch':
				break;
			default:
				return false;
		}
		if ($debug) {
			var_dump($result);
		}
		return $result;
	}

	/**
	 * 设置自定义菜单
	 */
	function menu($access_token, $data = array(), $action = 'fetch', $debug = false)
	{
		switch ($action) {
			case 'delete':
				$delete = 'https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=' . $access_token;
				$result = $this->get($delete);
				break;
			case 'create':
				$url = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=' . $access_token;
				$result = $this->post($url, $data);
				break;
			case 'fetch':
				$url = 'https://api.weixin.qq.com/cgi-bin/menu/get?access_token=' . $access_token;
				$result = $this->get($url);
				$result = json_decode($result);
				return $result;
				break;
			default:
				return false;
		}
		if ($debug) {
			var_dump($result);
		}
		$result = json_decode($result, true);
		if ($result['errcode'] === 0)
			return true;
		return false;
	}

	/**
	 * 获取用户授权的code 返回一个url 必须跳转到这个url
	 *
	 * @param url $redict
	 *        	获取到code之后跳转的url
	 * @param string $scope
	 *        	snsapi_base |snsapi_userinfo
	 * @param string $state
	 *        	默认值为空
	 */
	function getCode($redict, $scope, $state = '')
	{
		$redict = urlencode($redict);
		$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';
		$url = sprintf($url, $this->_appid, $redict, $scope, $state);
		return $url;
	}
	
	/**
	 * 获取用户信息
	 * @param unknown $access_token
	 * @param unknown $openid
	 * @param string $lang
	 * @return mixed
	 */
	function getUserInfo($access_token,$openid,$lang = 'zh_CN')
	{
		$url = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=%s';
		$url = sprintf($url,$access_token,$openid,$lang);
		return json_decode($this->get($url));
	}

	/**
	 *
	 * @param string $code
	 *        	通过getCode获取到的code
	 * @param string 返回值字段 默认为openid
	 */
	function getOpenid($code,$field = '')
	{
		$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
		$url = sprintf($url, $this->_appid, $this->_appsecret, $code);
		$result = $this->get($url);
		$result = json_decode($result, true);
		if (empty($field))
			return $result;
		return $result[$field];
	}
	
	/**
	 * 获取jsApiTicket
	 * @param unknown $access_token
	 * @return mixed|boolean
	 */
	function getJsApiTicket($access_token)
	{
		$url = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token='.$access_token;
		return $this->get($url);
	}

	/**
	 * 发送get请求
	 *
	 * @param unknown $url        	
	 * @return string
	 */
	private function get($url)
	{
		if (function_exists('file_get_contents'))
			return file_get_contents($url);
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$result = curl_exec($curl);
		return $result;
	}
	
	/**
	 * 微信分享和卡劵使用的签名包
	 * @param unknown $jsApiTicket
	 * @return multitype:string NULL number unknown Ambigous <boolean, string> 
	 */
	public function getSignPackage($jsApiTicket)
	{
		// 注意 URL 一定要动态获取，不能 hardcode.
		$protocol = (! empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
		$url = $protocol.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
		$timestamp = time();
		$nonceStr = random::word(16);

		// 这里参数的顺序要按照 key 值 ASCII 码升序排序
		$string = 'jsapi_ticket=%s&noncestr=%s&timestamp=%s&url=%s';
		$string = sprintf($string,$jsApiTicket,$nonceStr,$timestamp,$url);
		$signature = sha1($string);
	
		$signPackage = array(
			"appId" => $this->_appid,
			"nonceStr" => $nonceStr,
			"timestamp" => $timestamp,
			"url" => $url,
			"signature" => $signature,
			"rawString" => $string
		);
		return $signPackage;
	}

	/**
	 * 发送post请求
	 *
	 * @param unknown $url        	
	 * @param unknown $data        	
	 * @return string
	 */
	private function post($url, $data, $curl = false)
	{
		if (! $curl && function_exists('file_get_contents')) {
			if (is_array($data)) {
				$data = http_build_query($data);
			} else 
				if (is_object($data)) {
					$data = json_encode($data, JSON_UNESCAPED_UNICODE);
				}
			
			$context = array(
				'http' => array(
					'method' => "POST",
					'header' => "Content-type: application/x-www-form-urlencoded\r\n" . "Content-length:" . strlen($data) . "\r\n",
					'content' => $data
				)
			);
			$context = stream_context_create($context);
			return file_get_contents($url, NULL, $context);
		} else {
			foreach ($data as $index => &$file) {
				if ($file[0] == '@') {
					//mb php5.5不支持@
					$file = new \CURLFile(substr($file, 1));
				}
			}
			$curl = curl_init($url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($curl);
			return $result;
		}
	}
}
