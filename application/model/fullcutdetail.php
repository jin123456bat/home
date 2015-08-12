<?php
namespace application\model;
use system\core\model;
/**
 * 满减组合详情数据模型
 * @author jin12
 *
 */
class fullcutdetailModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加优惠商品
	 * @param unknown $fid
	 * @param unknown $pid
	 * @return string
	 */
	function create($fid,$pid)
	{
		if($this->insert(array(NULL,$fid,$pid)))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	/**
	 * 检查商品是否已经添加到了满减优惠
	 */
	function exist($pid)
	{
		$result = $this->where('pid=?',array($pid))->select('count(*)');
		return (isset($result[0]['count(*)']) && $result[0]['count(*)'] > 0);
	}
	
	/**
	 * 获得一件商品的满减优惠信息
	 * @param unknown $pid
	 * @return Ambigous <boolean, multitype:>
	 */
	function getByPid($pid)
	{
		$this->where('fullcutdetail.pid=?',array($pid));
		$this->table('fullcut','right join','fullcut.id=fullcutdetail.fid');
		return $this->select();
	}
	
	/**
	 * 获得所有满减商品信息
	 * @param unknown $parameter
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll($parameter)
	{
		$this->table('product','left join','product.id=fullcutdetail.pid');
		return $this->select($parameter);
	}
	
	/**
	 * 设置产品的activity
	 * @param int $id fullcut的id
	 * @param enum $activity 活动名称 
	 */
	function clearProductActivity($id)
	{
		$this->where('fullcutdetail.fid=?',array($id));
		$this->table('product','left join','product.id=fullcutdetail.pid');
		$this->update('activity','');
	}
}