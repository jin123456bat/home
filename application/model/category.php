<?php
namespace application\model;

use system\core\model;
class categoryModel extends model
{
	function __construct()
	{
		parent::__construct('category');
	}
	
	/**
	 * 创建分类
	 * @param unknown $name
	 * @param number $cid 上级分类ｉｄ
	 */
	function add($name,$cid = 0)
	{
		$array = array(NULL,$name,$cid);
		return $this->insert($array);
	}
	
	/**
	 * 获得一个分类下的子类  无递归
	 */
	function fetchChild($cid = 0)
	{
		$result = $this->where('cid=?',array($cid))->select();
		return $result;
	}
}