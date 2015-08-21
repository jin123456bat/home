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
		$this->MCHID = '1251529901';
		$this->APPID = 'wx714c70a7a6b93632';
		$this->KEY = 'b02a45a596bfb86fe2578bde75ff54440759f0c52cda38a5d280f7514f120f64';
		$this->APPSECRET = '4dd9d79acafd65972898623410b02a5b';
	}
}