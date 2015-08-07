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
		$this->user = '';
		$this->pass = '';
		
		$this->from = '';
		$this->fromname = '';
		$this->SMTPSecure = 'ssl';//ssl
		$this->html = true;
	}
}