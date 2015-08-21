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
	 * 获得首页显示的限时特卖商品信息
	 */
	function getIndex($length)
	{
		$a = $_SERVER['REQUEST_TIME'];
		$this->where('(sale.starttime<? or sale.starttime=0) and (sale.endtime>? or sale.endtime=0) and (product.starttime<? or product.starttime=0) and (product.endtime>? or product.endtime=0)',array($a,$a,$a,$a));
		$this->table('product','left join','product.id=sale.pid');
		$this->limit($length);
		$this->where('product.stock>?',array(0));
		$this->where('product.status=?',array(1));
		$this->orderby('sale.orderby','desc');
		$result = $this->select('*,sale.starttime as s_starttime,sale.endtime as s_endtime,sale.price as new_price');
		return $result;
	}
	
	/**
	 * 获得秒杀活动商品的价格
	 * @param unknown $pid
	 * @return NULL
	 */
	function getPrice($pid)
	{
		$this->where('pid=? and starttime<? and endtime>?',array($pid,$_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME']));
		$result = $this->select('price');
		return isset($result[0]['price'])?$result[0]['price']:NULL;
	}
	
	/**
	 * 保存对限时特卖规则的更改
	 * @param unknown $id
	 * @param unknown $starttime
	 * @param unknown $endtime
	 * @param unknown $orderby
	 * @param unknown $price
	 * @return \system\core\Ambigous
	 */
	function save($id,$sname,$starttime,$endtime,$orderby,$price)
	{
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+24*3600:strtotime($endtime);
		$orderby = empty($orderby)?1:$orderby;
		$price = empty($price)?1:$price;
		return $this->where('id=?',array($id))->update(array('sname'=>$sname,'starttime'=>$starttime,'endtime'=>$endtime,'orderby'=>$orderby,'price'=>$price));
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
	function create($sname,$pid,$starttime,$endtime,$price,$orderby)
	{
		$result = $this->where('pid=?',array($pid))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$orderby = empty($orderby)?1:$orderby;
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+3600*24:strtotime($endtime);
		$array = array(NULL,$sname,$pid,$starttime,$endtime,$price,$orderby);
		if($this->insert($array))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	function getByPid($pid)
	{
		$result = $this->where('pid=?',array($pid))->select();
		return isset($result[0])?$result[0]:array();
	}
	
	/**
	 * 取得一条限时折扣信息
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