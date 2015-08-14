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
	 * 获取某一个用户的信息
	 * @param unknown $id
	 * @return NULL
	 */
	function get($id,$name = '*')
	{
		$result = $this->where('id=?',array($id))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	/**
	 * 更改用户昵称和头像
	 * @param unknown $id
	 * @param unknown $name
	 * @param unknown $gravatar
	 * @return \system\core\Ambigous
	 */
	function setNameGravatar($id,$name,$gravatar)
	{
		$this->where('id=?',array($id));
		return $this->update(array('username'=>$name,'gravatar'=>$gravatar));
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
		$cost = 0;
		$gravatar = '';
		$username = '';
		$array = array(NULL,$gravatar,$username,$telephone,$email,$password,$regtime,$logtime,$money,$score,$ordernum,$cost,$salt,$close,$o2o);
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
			if($password == $result[0]['password'])
				return $result[0];
		}
		return false;
	}
	
	/**
	 * 删除用户
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 更改密码 重新生成盐值
	 */
	function changepwd($telephone,$pwd)
	{
		$result = $this->where('telephone=?',array($telephone))->select();
		if(isset($result[0]))
		{
			$salt = random::number(6);
			$pwd = md5($pwd.$salt);
			return $this->where('telephone=?',array($telephone))->update(array('password'=>$pwd,'salt'=>$salt));
		}
		return false;
	}
	
	/**
	 * 验证账号密码
	 */
	function authpwd($id,$oldpwd,$newpwd)
	{
		$result = $this->where('id=?',array($id))->select('password,salt');
		if(isset($result[0]['salt']) && isset($result[0]['password']))
		{
			if(md5($oldpwd.$result[0]['salt']) == $result[0]['password'])
			{
				$salt = random::number(6);
				$newpwd = md5($newpwd.$salt);
				return $this->where('id=?',array($id))->update(array('password'=>$newpwd,'salt'=>$salt));
			}
			return false;
		}
		return false;
	}
	
	function getByOid($id)
	{
		return $this->where('oid=?',array($id))->select();
	}
	
	function clearOid($oid)
	{
		$this->where('oid=?',array($oid))->update('oid',0);
	}
}