<?php
namespace application\model;

use system\core\model;
class adminModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加管理员
	 */
	function register($username,$password,$roleid = 1)
	{
		$array = array(
			'NULL',
			$username,
			md5($password),
			$roleid
		);
		return $this->insert($array);
	}
	
	/**
	 * 管理员登陆
	 * @param unknown $username
	 * @param unknown $password
	 * @return Ambigous <>|boolean
	 */
	function login($username,$password)
	{
		$result = $this->where('username=?',array($username))->select();
		if(isset($result[0]))
		{
			if(md5($password) == $result[0]['password'])
			{
				return $result[0];
			}
		}
		return false;
	}
}