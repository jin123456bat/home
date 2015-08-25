<?php
namespace application\model;
use system\core\model;
/**
 * 收藏数据模型
 * @author jin12
 *
 */
class favouriteModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 收藏的商品列表
	 */
	function fetchAll($uid)
	{
		$this->table('product','left join','product.id=favourite.pid');
		$this->orderby('favourite.time','desc');
		$product = $this->where('uid=?',array($uid))->select();
		return $product;
	}
	
	/**
	 * 添加收藏
	 */
	function create($uid,$pid)
	{
		$this->insert(array(NULL,$uid,$pid,$_SERVER['REQUEST_TIME']));
	}
	
	/**
	 * 移除收藏
	 * @param string $id 当存在id时候pid和uid可以为空 否则不可以
	 * @param string $pid
	 * @param string $uid
	 */
	function remove($id = NULL,$pid = NULL,$uid = NULL)
	{
		if(empty($id))
		{
			return $this->where('pid=? and uid=?',array($pid,$uid))->delete();
		}
		else
		{
			return $this->where('id=?',array($id))->delete();
		}
	}
}