<?php
namespace application\model;

use system\core\model;
class roleModel extends model
{
	const POWER_INSERT = 8;
	const POWER_DELETE = 4;
	const POWER_SELECT = 2;
	const POWER_UPDATE = 1;
	const POWER_ALL = 15;
	
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 移除管理组
	 * @param unknown $id
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 
	 */
	function fetchAll()
	{
		return $this->select();
	}
	
	/**
	 * 删除权限组
	 */
	function del($id)
	{
		$this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 更改权限
	 * @param unknown $roleid
	 * @param unknown $model
	 * @param unknown $power 权限为添加后的权限
	 */
	function setPower($roleid,$model,$power)
	{
		$this->where('id=?',array($roleid))->update($model, $power);
	}
	
	/**
	 * 添加用户组
	 */
	function add($name)
	{
		$array = array(
			NULL,
			$name,
		);
		$array = array_pad($array, 24, self::POWER_ALL);
		if($this->insert($array))
		{
			return $this->lastInsertId();
		}
	}
	
	/**
	 * 权限检查
	 * @param unknown $groupId 组id
	 * @param unknown $model 模块名称
	 * @param unknown $power 权限  可以是多个权限互加
	 */
	function checkPower($groupId,$model,$power)
	{
		$result = $this->where('id=?',array($groupId))->select();
		if(isset($result[0][$model]))
		{
			return ((int)$result[0][$model] & $power) === $power;
		}
		return false;
	}
}