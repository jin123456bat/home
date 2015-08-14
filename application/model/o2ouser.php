<?php
namespace application\model;
use system\core\model;
/**
 * o2o用户数据模型
 * @author jin12
 *
 */
class o2ouserModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function get($id,$name = '*')
	{
		$this->table('user','left join','o2ouser.uid=user.id');
		$result = $this->where('o2ouser.uid=?',array($id))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	function create($uid,$rate)
	{
		$result = $this->where('uid=?',array($uid))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$num = 0;
		$money = 0;
		$data = array(NULL,$uid,$_SERVER['REQUEST_TIME'],$rate,$num,$money);
		return $this->insert($data);
	}
	
	function remove($uid)
	{
		return $this->where('uid=?',array($uid))->delete();
	}
	
	/**
	 * o2o用户的手机号码获得用户id  没有返回NULL
	 * @param unknown $telephone
	 * @return NULL
	 */
	function check($telephone)
	{
		$this->table('user','left join','o2ouser.uid=user.id');
		$this->where('user.telephone=?',array($telephone));
		$result = $this->select('user.id');
		return isset($result[0]['id'])?$result[0]['id']:NULL;
	}
	
	function fetchAll()
	{
		$this->table('user','left join','o2ouser.uid=user.id');
		return $this->select('*,o2ouser.money as o_money');
	}
}