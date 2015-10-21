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
	 * 清空用户的购物车
	 * @param unknown $uid
	 */
	function clear($uid)
	{
		return $this->where('cart.uid=?',array($uid))->delete();
	}
	
	/**
	 * 计算购物车中商品总数
	 * @param unknown $uid
	 */
	function count($uid)
	{
		$result = $this->where('uid=?',array($uid))->select('sum(num)');
		return $result[0]['sum(num)'];
	}
	
	/**
	 * 获取用户购物车中的所有商品
	 */
	function getByUid($uid)
	{
		$this->where('cart.uid=?',array($uid));
		$this->table('product','left join','cart.pid=product.id');
		//$this->table('brand','left join','product.bid=brand.id');
		$result = $this->select();
		return $result;
	}
	
	/**
	 * 将商品加入到购物车
	 * @param int $uid 用户id
	 * @param int $pid 货物id
	 * @param string|array $cid 货物属性集合
	 * @param int $num 货物数量 增加的数量
	 * @return \system\core\Ambigous
	 */
	function create($uid,$pid,$content,$num)
	{
		if(is_array($content))
		{
			ksort($content);
			$content = serialize($content);
		}
		$result = $this->where('uid=? and pid=? and content=?',array($uid,$pid,$content))->select('num');
		if(isset($result[0]['num']) && !empty($result[0]['num']))
		{
			return $this->where('uid=? and pid=? and content=?',array($uid,$pid,$content))->increase('num',$num);
		}
		else
		{
			$time = $_SERVER['REQUEST_TIME'];
			$data = array(NULL,$uid,$pid,$content,$num,$time);
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
	function remove($uid,$pid,$content,$num)
	{
		if(is_array($content))
		{
			ksort($content);
			$content = serialize($content);
		}
		$result = $this->where('uid=? and pid=? and content=?',array($uid,$pid,$content))->select('num');
		if(isset($result[0]['num']) && !empty($result[0]['num']))
		{
			if($result[0]['num'] - $num > 0)
				return $this->where('uid=? and pid=? and content=?',array($uid,$pid,$content))->increase('num',-$num);
			else
				return $this->where('uid=? and pid=? and content=?',array($uid,$pid,$content))->delete();
		}
		return false;
	}
}