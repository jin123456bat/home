<?php
namespace system\config;

use system\core\inter\config;
class cookieConfig extends config
{
	public $expire = 3600;
	public $path = '';
	public $domain = '';
	public $secure = false;
	public $httponly = true;
}