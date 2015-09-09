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
		$this->KEY = 'Zhy781525073AsDfGh12ZgdZxCvBnMlK';
		$this->APPSECRET = 'a9edccfb3018342657334dabd8873357';
	}
}