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
		$session = session::getInstance();
		return !($session->id === NULL || $session->role === NULL || $session->username === NULL);
	}
	
	/**
	 * 普通用户登陆
	 */
	static function user()
	{
		$session = session::getInstance();
		return $session->id !== NULL && $session->telephone !== NULL && $session->username !== NULL;
	}
	
	/**
	 * 判断o2o用户登录
	 * @return boolean
	 */
	static function o2o()
	{
		$session = session::getInstance();
		return $session->id !== NULL && $session->telephone !== NULL && $session->o2o !== NULL;
	}
	
	/**
	 * 判断用户微信登陆
	 * @return boolean
	 */
	static function wechat()
	{
		return self::user() && $session->openid !== NULL;
	}

}