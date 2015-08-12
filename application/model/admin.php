<?php
namespace application\model;

use system\core\model;
class adminModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
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
	 * 更改密码
	 * @param unknown $id
	 * @param unknown $password
	 */
	function changepwd($id,$password)
	{
		$password = md5($password);
		return $this->where('id=?',array($id))->update('password',$password);
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