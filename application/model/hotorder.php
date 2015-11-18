<?php
namespace application\model;
use system\core\model;
class hotorderModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 将商品添加到全球热销
	 */
	function create($pid,$orderby = 1)
	{
		$result = $this->where('pid=?',array($pid))->select();
		if(empty($result))
		{
			return $this->insert(array(NULL,$pid,$orderby));
		}
		return false;
	}
	
	/**
	 * 将商品从全球热销移除
	 */
	function remove($id)
	{
		return $this->where('pid=?',array($id))->delete();
	}
	
	function fetchAll(array $filter = array())
	{
		if(isset($filter['start']) && isset($filter['length']))
		{
			$this->limit($filter['start'],$filter['length']);
		}
		if(isset($filter['orderby']))
		{
			$this->orderby('orderby','asc');
		}
		$this->table('product','left join','hotorder.pid=product.id');
		if (isset($filter['area_lock']) && $filter['area_lock'])
		{
			$this->where('product_area.province=?',array($filter['area_lock']));
			$this->table('product_area','left join','product_area.pid=product.id');
		}
		return $this->select('product.id,product.*');
	}
	
	function order($pid,$orderby)
	{
		return $this->where('pid=?',array($pid))->update('orderby',$orderby);
	}
}