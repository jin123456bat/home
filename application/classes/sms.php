<?php
namespace application\classes;

use application;

/**
 * 中国建网短信接口
 * 发送验证码1分钟只能点击发送1次
 * 相同IP手机号码1天最多提交20次；
 * 验证码短信单个手机号码30分钟最多提交10次；
 * 新用户用接口测试验证码时，请勿输入：测试等无关内容信息，请直接输入：验证码:xxxxxx，发送。
 * 假如没有在建网中设置签名，请在配置文件中设置签名，也可以两个都设置，建网中的签名是在短信前面，配置中的在后面
 * @author 程晨
 *
 */
class sms
{
	private $uid;
	private $key;
	private $sign;
	
	/*
	 * 发送短信接口url
	 */
	private $_url = "http://utf8.sms.webchinese.cn/";
	/*
	 * 获取短信数量url
	 */
	private $_getUrl = 'http://sms.webchinese.cn/web_api/SMS/';
	
	function __construct($uid,$key,$sign)
	{
		$this->_uid = $uid;
		$this->_key = $key;
		$this->_sign = $sign;
	}

	/**
	 * 发送短信
	 * 
	 * @param unknown $telephone        	
	 * @param unknown $content        	
	 * @return number
	 */
	function send($telephone, $content)
	{
		$sign = empty($this->_sign)?'':('【'.$this->_sign.'】');
		$content .= $sign;
		if(mb_strlen($content)>400)
			return false;
		$telephone = is_array($telephone) ? $telephone : array(
			$telephone
		);
		if(count($telephone)>100)
			return false;
		$telephone = urlencode(implode(',', $telephone));
		$url=$this->_url.'?Uid='.$this->_uid.'&KeyMD5='.strtoupper(md5($this->_key)).'&smsMob='.$telephone.'&smsText='.urlencode($content);
		return $this->get($url);
	}
	
	/**
	 * 获取短信数量
	 */
	function getNum()
	{
		$url = $this->_getUrl.'?Action=SMS_Num&Uid='.$this->_uid.'&KeyMD5='.strtoupper(md5($this->_key));
		return $this->get($url);
	}
	
	/**
	 * 发送get请求
	 */
	private function get($url)
	{
		if(function_exists('file_get_contents'))
		{
			$file_contents = file_get_contents($url);
		}
		else
		{
			$ch = curl_init();
			$timeout = 5;
			curl_setopt ($ch, CURLOPT_URL, $url);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
			$file_contents = curl_exec($ch);
			curl_close($ch);
		}
		return $file_contents;
	}
}