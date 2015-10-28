<?php
namespace application\model;
use system\core\model;
/**
 * 配送方案
 * @author jin12
 *
 */
class shipModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function save($id,array $data)
	{
		return $this->where('id=?',array($id))->update($data);
	}
	
	/**
	 * 创建配送方案
	 * @param unknown $name
	 * @param unknown $code
	 * @param unknown $max
	 * @param unknown $price
	 */
	function create($name,$code,$max,$price)
	{
		return $this->insert(array(NULL,$name,$code,$max,$price));
	}
	
	/**
	 * 计算配送费用
	 * @param $id 配送方案id
	 * @param $price 货物价格
	 */
	function getPrice($id,$price = 0)
	{
		$result = $this->get($id);
		if($result != NULL)
		{
			if($price<=$result['max'])
				return $result['price'];
			return 0;
		}
		return 0;
	}
	
	/**
	 * 获得一个配送方案信息
	 */
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
}