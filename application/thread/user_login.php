<?php
namespace application\thread;
use system\core\control;
class user_loginThread extends control
{
	function run()
	{
		$this->model('user_login_log')->query('TRUNCATE user_login_log');
	}
}