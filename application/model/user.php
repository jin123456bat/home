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
	 * 根据json对象搜索
	 */
	function searchable($json)
	{
		$parameter = '';
		foreach ($json['columns'] as $key => $value)
		{
			foreach ($json['order'] as $order)
			{
				if($order['column'] == $key)
				{
					$this->orderby($value['data'],$order['dir']);
				}
			}
			$parameter .= $value['data'].',';
			if($value['searchable'] == 'true' && !empty($json['search']['value']))
			{
				$this->where($value['data'].' like ?',array('%'.$json['search']['value'].'%'),'or');
			}
		}
		return $this->select(rtrim($parameter,','));
	}

	/**
	 * 普通用户注册数据模型
	 */
	function register($telephone, $password,$o2o = 0)
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
		$score = 0;
		$close = 0;
		$ordernum = 0;
		$array = array(NULL,$telephone,$email,md5($password),$regtime,$logtime,$money,$score,$ordernum,$salt,$close,$o2o);
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
	function changepwd($telephone,$pwd)
	{
		$result = $this->where('telephone=?',array($telephone))->select();
		if(isset($result[0]))
		{
			$pwd = md5($pwd.$result[0]['salt']);
			return $this->where('telephone=?',array($telephone))->update('password', $pwd);
		}
		return false;
	}
	
	/**
	 * 验证账号密码
	 */
	function authpwd($id,$oldpwd,$newpwd)
	{
		$result = $this->where('id=?',array($id))->select('salt','password');
		if(isset($result[0]['salt']) && isset($result[0]['password']))
		{
			if(md5($oldpwd.$result[0]['salt']) == $result[0]['password'])
			{
				$newpwd = md5($newpwd.$result[0]['salt']);
				return $this->where('id=?',array($id))->update('password',$newpwd);
			}
			return false;
		}
		return false;
	}
}