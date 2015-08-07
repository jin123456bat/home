<?php
namespace application\model;
use system\core\model;
/**
 * 限时折扣商品数据模型
 * @author jin12
 *
 */
class saleModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加一件限时折扣商品 对于已经在限时折扣队列中的商品返回false
	 * @param unknown $pid
	 * @param unknown $starttime
	 * @param unknown $endtime
	 * @param unknown $price
	 * @param number $orderby
	 * @return \system\core\Ambigous
	 */
	function create($pid,$starttime,$endtime,$price,$orderby)
	{
		$result = $this->where('pid=?',array($pid))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$orderby = empty($orderby)?1:$orderby;
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+3600*24:strtotime($endtime);
		$array = array(NULL,$pid,$starttime,$endtime,$price,$orderby);
		if($this->insert($array))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	/**
	 * 取得一条限时折扣信息
	 * @param unknown $id
	 * @return NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 获得所有限时商品的信息
	 */
	function fetchAll($parameter)
	{
		$this->table('product','left join','sale.pid=product.id');
		return $this->select($parameter);
	}
	
	/**
	 * 把商品从限时折扣中移除
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
}