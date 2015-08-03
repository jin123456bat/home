<?php
namespace application\model;

use system\core\model;
/**
 * 购物车数据模型
 * @author jin12
 *
 */
class cartModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 将商品加入到购物车
	 * @param unknown $uid 用户id
	 * @param unknown $pid 货物id
	 * @param unknown $cid 货物属性id
	 * @param unknown $num 货物数量 增加的数量
	 * @return \system\core\Ambigous
	 */
	function create($uid,$pid,$cid,$num)
	{
		$result = $this->where('uid=? and pid=? and cid=?',array($uid,$pid,$cid))->select('num');
		if(isset($result[0]['num']) && !empty($result[0]['num']))
		{
			return $this->where('uid=? and pid=? and cid=?',array($uid,$pid,$cid))->increase('num',$num);
		}
		else
		{
			$time = $_SERVER['REQUEST_TIME'];
			$data = array(NULL,$uid,$pid,$cid,$num,$time);
			return $this->insert($data);
		}
	}
	
	/**
	 * 减少用户购物车中的商品数量
	 * @param unknown $uid
	 * @param unknown $pid
	 * @param unknown $cid
	 * @param unknown $num
	 * @return \system\core\Ambigous|boolean
	 */
	function remove($uid,$pid,$cid,$num)
	{
		$result = $this->where('uid=? and pid=? and cid=?',array($uid,$pid,$cid))->select('num');
		if(isset($result[0]['num']) && !empty($result[0]['num']))
		{
			if($result[0]['num'] - $num > 0)
				return $this->where('uid=? and pid=? and cid=?')->increase('num',-$num);
			else
				return $this->where('uid=? and pid=? and cid=?')->delete();
		}
		return false;
	}
	
	/**
	 * 获取用户购物车中的所有商品信息
	 * @param int $uid
	 */
	function get($uid)
	{
		$this->where('uid=?',array($uid));//设定用户名
		$this->table('product','left join','cart.pid=product.id');
		$this->table('collection','left join','cart.cid=collection.id');
		return $this->select();
	}
}