<?php
namespace application\config;

use system\core\inter\config;
class emailConfig extends config
{
	function __construct()
	{
		$this->relay_host = 'smtp.qq.com';
		$this->smtp_port = 25;
		$this->auth = true;
		$this->user = '326550324@qq.com';
		$this->pass = 'jcc2164389';
		
		$this->from = '326550324@qq.com';
		$this->fromname = '金程晨';
		$this->SMTPSecure = 'ssl';//ssl
		$this->html = true;
	}
}