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
	 * 从满减中移除商品
	 * @param unknown $fid
	 * @param unknown $pid
	 */
	function remove($fid,$pid)
	{
		return $this->where('fid=? and pid=?',array($fid,$pid))->delete();
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
	 * 获得符合满减优惠的最佳条件
	 * @param unknown $pid
	 * @param unknown $totalprice
	 * @return NULL
	 */
	function getPrice($pid,$totalprice)
	{
		$this->where('fullcutdetail.pid=?',array($pid));
		$this->where('fullcut.max<=?',array($totalprice));
		$this->where('(starttime=0 or starttime<?) and (endtime=0 or endtime>?)',array($_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME']));
		$this->table('fullcut','right join','fullcut.id=fullcutdetail.fid');
		$this->orderby('fullcut.max','desc');
		$this->limit(1);
		$result = $this->select();
		return isset($result[0])?$result[0]:NULL;
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
		$result = $this->select();
		return isset($result[0])?$result[0]:array();
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
}