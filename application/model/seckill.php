<?php
namespace application\model;

use system\core\model;
/**
 * 秒杀活动数据模型
 * @author jin12
 *
 */
class seckillModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 保存秒杀活动的修改
	 * @param int $id
	 * @param string $starttime
	 * @param string $endtime
	 * @param int $orderby
	 * @param double $price
	 */
	function save($id,$starttime,$endtime,$orderby,$price)
	{
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+24*3600:strtotime($endtime);
		$orderby = empty($orderby)?1:$orderby;
		$price = empty($price)?0:$price;
		$this->where('id=?',array($id));
		return $this->update(array('starttime'=>$starttime,'endtime'=>$endtime,'orderby'=>$orderby,'price'=>$price));
	}
	
	/**
	 * 创建秒杀活动
	 * @param int $pid 产品id
	 * @param string $time 时间字符串
	 * @param int $last 单位小时
	 * @param number $orderby
	 */
	function create($pid,$starttime,$endtime,$price,$orderby)
	{
		$result = $this->where('pid=?',array($pid))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$orderby = empty($orderby)?1:$orderby;
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+3600*24:strtotime($endtime);
		$array = array(NULL,$pid,$starttime,$endtime,$orderby,$price);
		if($this->insert($array))
			return $this->lastInsertId();
		return false;
	}
	
	/**
	 * 获得秒杀活动商品信息
	 * 过期的活动或未开始的不会获得
	 */
	function product()
	{
		$this->table('product','join left','seckill.pid=product.id');
		$this->orderby('orderby');
		$this->orderby('id','desc');
		$this->where('starttime < ?',array($_SERVER['REQUEST_TIME']));
		$this->where('endtime > ?',array($_SERVER['REQUEST_TIME']));
		return $this->select();
	}
	
	/**
	 * 获得所有秒杀商品的信息
	 */
	function fetchAll($parameter)
	{
		$this->table('product','left join','seckill.pid=product.id');
		return $this->select($parameter);
	}
	
	/**
	 * 从秒杀活动中移除商品
	 * 活动id和商品id其中必须只能一个不为空值
	 * @param int $secid 活动id
	 * @return bool
	 */
	function remove($secid)
	{
		$this->table('product','left join','product.id=seckill.pid');
		$this->where('seckill.id=?',array($secid));
		$this->update('product.activity','');
		$this->where('id=?',array($secid));
		return $this->delete();
	}
}