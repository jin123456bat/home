<?php
namespace application\config;
use system\core\inter\config;
/**
 * 微信配置文档
 * @author jin12
 *
 */
class weixinConfig extends config
{
	function __construct()
	{
		$this->MCHID = '1226923702';
		$this->APPID = 'wx426b3015555a46be';
		$this->KEY = 'e10adc3949ba59abbe56e057f20f883e';
		$this->APPSECRET = '01c6d59a3f9024db6336662ac95c8e74';
	}
}