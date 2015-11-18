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
	 * 获得首页显示的限时特卖商品信息
	 */
	function getIndex(array $filter = array())
	{
		
		
		$a = $_SERVER['REQUEST_TIME'];
		
		$this->where('seckill.endtime>? or seckill.endtime=0',array($a));
		$this->where('product.starttime<? or product.starttime=0',array($a));
		$this->where('product.endtime>? or product.endtime=0',array($a));
		$this->table('product','left join','product.id=seckill.pid');
		if (isset($filter['length']))
		{
			$this->limit($filter['length']);
		}
		$this->where('product.status=?',array(1));
		$this->orderby('seckill.orderby','desc');
		$result = $this->select('*,seckill.starttime as s_starttime,seckill.endtime as s_endtime,seckill.price as new_price');
		return $result;
	}
	
	/**
	 * 获得秒杀活动商品的价格
	 * @param unknown $pid
	 * @return NULL
	 */
	function getPrice($pid)
	{
		$this->where('pid=? and (starttime<? or starttime=0) and (endtime>? or endtime=0)',array($pid,$_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME']));
		$result = $this->select('price');
		return isset($result[0]['price'])?$result[0]['price']:NULL;
	}
	
	/**
	 * 保存秒杀活动的修改
	 * @param int $id
	 * @param string $starttime
	 * @param string $endtime
	 * @param int $orderby
	 * @param double $price
	 */
	function save($id,$sname,$starttime,$endtime,$orderby,$price)
	{
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+24*3600:strtotime($endtime);
		$orderby = empty($orderby)?1:$orderby;
		$price = empty($price)?0:$price;
		$this->where('id=?',array($id));
		return $this->update(array('sname'=>$sname,'starttime'=>$starttime,'endtime'=>$endtime,'orderby'=>$orderby,'price'=>$price));
	}
	
	/**
	 * 获取商品的活动信息
	 * @param unknown $pid
	 * @return multitype:
	 */
	function getByPid($pid)
	{
		$result = $this->where('pid=?',array($pid))->select();
		return isset($result[0])?$result[0]:array();
	}
	
	/**
	 * 创建秒杀活动
	 * @param int $pid 产品id
	 * @param string $time 时间字符串
	 * @param int $last 单位小时
	 * @param number $orderby
	 */
	function create($sname,$pid,$starttime,$endtime,$price,$orderby,$logo)
	{
		$result = $this->where('pid=?',array($pid))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$orderby = empty($orderby)?1:$orderby;
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+3600*24:strtotime($endtime);
		$array = array(NULL,$sname,$pid,$starttime,$endtime,$orderby,$price,$logo);
		if($this->insert($array))
			return $this->lastInsertId();
		return false;
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
		$result = $this->select('product.id');
		if(isset($result[0]['id']))
		{
			if(false !== $this->query('update product set activity = ? where id=?',array('',$result[0]['id'])))
			{
				return $this->where('id=?',array($secid))->delete();
			}
		}
		return false;
	}
}