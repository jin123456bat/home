<?php
namespace application\model;

use system\core\model;
use system\core\random;

class userModel extends model
{

	function __construct()
	{
		parent::__construct('user');
	}

	/**
	 * 普通用户注册数据模型
	 */
	function register($telephone, $password)
	{
		$result = $this->where('telephone=?',array($telephone))->select();
		if(isset($result[0]))
			return false;
		$salt = random::word(6);
		$password = md5($password.$salt);
		$regtime = $_SERVER['REQUEST_TIME'];
		$logtime = $regtime;
		$email = '';
		$money = 0;
		$close = 0;
		$ordernum = 0;
		$array = array(NULL,$telephone,$email,md5($password),$regtime,$logtime,$money,$ordernum,$salt,$close);
		return $this->insert($array);
	}

	/**
	 * 用户登录
	 *
	 * @param unknown $telephone        	
	 * @param unknown $password        	
	 */
	function login($telephone, $password)
	{
		$result = $this->where('telephone=?',array($telephone))->select();
		if(isset($result[0]))
		{
			$password = md5($password.$result[0]['salt']);
			if($password === $result[0]['password'])
				return $result[0];
		}
		return false;
	}
	
	/**
	 * 更改密码
	 */
	function changepwd($uid,$pwd)
	{
		$result = $this->where('id=?',array($uid))->select();
		if(isset($result[0]))
		{
			$pwd = md5($pwd.$result[0]['salt']);
			return $this->where('id=?',array($uid))->update('password', $pwd);
		}
		return false;
	}
}