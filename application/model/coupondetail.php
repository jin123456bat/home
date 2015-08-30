<?php
namespace application\model;
use system\core\model;
class coupondetailModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function create($couponid,$categoryid)
	{
		if(is_array($categoryid))
		{
			foreach ($categoryid as $category)
			{
				$array = array(NULL,$couponid,$category);
				$this->insert($array);
			}
		}
	}
	
	function getByCouponid($couponid,$name = 'name')
	{
		$array = array();
		$this->where('couponid=?',array($couponid));
		$this->table('category','left join','category.id=coupondetail.categoryid');
		$result = $this->select($name);
		foreach($result as $value)
		{
			$array[] = $value[$name];
		}
		return $array;
	}
}