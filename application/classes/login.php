<?php
namespace application\classes;

use system\core\session;
class login
{
	/**
	 * 检测当前登录的是否是管理员
	 */
	static function admin()
	{
		$session = new session();
		return !($session->id == NULL || $session->role == NULL || $session->username == NULL);
	}
	
	/**
	 * 普通用户登陆
	 */
	static function user()
	{
		$session = new session();
		return $session->id != NULL && $session->telephone != NULL && $session->username != NULL;
	}

}