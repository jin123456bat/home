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
	 * 创建秒杀活动
	 * @param int $pid 产品id
	 * @param string $time 时间字符串
	 * @param int $last 单位小时
	 * @param number $orderby
	 */
	function create($name,$time,$last,$orderby = 1,$rate = 1)
	{
		$time = strtotime($time);
		$last = (int)$last * 3600;
		$array = array(NULL,$name,$time,$last,$orderby,$rate);
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
		$this->where('time < ?',array($_SERVER['REQUEST_TIME']));
		$this->where('time + last > ?',array($_SERVER['REQUEST_TIME']));
		return $this->select();
	}
	
	/**
	 * 从秒杀活动中移除商品
	 * 活动id和商品id其中必须只能一个不为空值
	 * @param int $secid 默认为0 活动id
	 * @param int $pid 默认为0 商品id
	 * @return bool
	 */
	function remove($secid = 0,$pid = 0)
	{
		$this->where('id=?',array($secid));
		$this->where('pid=?',array($pid),'or');
		return $this->delete();
	}
}