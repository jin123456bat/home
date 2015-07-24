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
		echo $this->where('id=?',array(55))->increase('password', 1);
		//$this->where('id = ?',array(55))->update('password', 'password + 1');
		//var_dump($this->where('id=?',array(55))->select());
		//$salt = random::word(6);
		//echo $this->insert(array(NULL,$telephone,md5($password.$salt)));
	}

	/**
	 * 用户登录
	 * 
	 * @param unknown $telephone        	
	 * @param unknown $password        	
	 */
	function login($telephone, $password)
	{
		
	}
}