<?php
namespace application\model;

use system\core\model;
class o2oshopModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加o2o店铺
	 * @param unknown $name
	 * @param unknown $address
	 * @param unknown $telephone
	 * @param unknown $backrate
	 * @param unknown $logo
	 */
	function create($name,$address,$telephone,$backrate,$logo,$eqpic = '')
	{
		if($this->insert(array(NULL,$name,$address,$telephone,$backrate,$logo,$eqpic)))
		{
			return $this->lastInsertId();
		}
	}
	
	/**
	 * 更新o2o的二维码
	 */
	function updateEQ($id,$eqpic)
	{
		return $this->where('id=?',array($id))->update('eqpic',$eqpic);
	}
	
	/**
	 * 删除o2o店铺
	 * @param int $oid
	 */
	function remove($oid)
	{
		return $this->where('id=?',array($oid))->delete();
	}
	
	/**
	 * 获得所有店铺信息
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll()
	{
		return $this->select();
	}
	
	/**
	 * 判断o2o店铺是否存在
	 * @param unknown $oid
	 */
	function exist($oid)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0]);
	}
}