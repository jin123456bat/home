<?php
namespace application\classes;
class fullcut
{
	private $_model;
	private $_product;
	
	private $_beforePrice;
	private $_afterPrice;
	private $_minus;
	
	function __construct($model,$product)
	{
		$this->_beforePrice = 0;
		$this->_afterPrice = 0;
		$this->_minus = 0;
		
		$this->_model = $model;
		$this->_product = $product;
		$this->calculation();
	}
	
	/**
	 * 满减规则计算
	 */
	private function calculation()
	{
		$rule =  array();
		$rule_product = array();
		foreach($this->_product as $product)
		{
			$temp = $this->_model->getByPid($product['id']);
			$rule[$temp['id']] = $temp;
			$rule_product[$temp['id']][] = $product;
		}
		
		foreach ($rule_product as $key => $item)
		{
			$sum = 0;
			foreach ($item as $value)
			{
				$sum += ($value['price'] * $product['num']);
			}
			$this->_beforePrice += $sum;
			if($rule[$key]['starttime']<$_SERVER['REQUEST_TIME'] && ($rule[$key]['endtime'] == 0 || $rule[$key]['endtime']>$_SERVER['REQUEST_TIME']) && $rule[$key]['max']<=$sum)
			{
				$sum -= $rule[$key]['minus'];
				$this->_minus += $rule[$key]['minus'];
			}
			$this->_afterPrice += $sum;	
		}
	}
	
	/**
	 * 计算最终价格
	 */
	function getPrice()
	{
		return $this->_afterPrice;
	}
	
	/**
	 * 计算减少的价格
	 */
	function getMinus()
	{
		return $this->_minus;
	}
}