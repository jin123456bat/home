<?php
namespace application\classes;
class coupon
{
	private $_coupon;
	
	private $_uid;
	
	private $_model;
	
	private $_product;
	
	private $_beforePrice;
	
	private $_afterPrice;
	
	private $_minus;
	
	/**
	 * constructor
	 * @param unknown $coupon
	 * @param unknown $uid
	 * @param unknown $model
	 * @param unknown $product
	 */
	function __construct($coupon,$uid,$model,$product)
	{
		$this->_coupon = $coupon;
		$this->_uid = $uid;
		$this->_model = $model;
		$this->_product = $product;
		$this->calculation();
	}
	
	private function calculation()
	{
		$sum = 0;
		foreach ($this->_product as $product)
		{
			$sum += ($product['price'] * $product['num']);
		}
		$this->_beforePrice = $sum;
		$this->_afterPrice = $sum;
		$this->_minus = 0;
		if(is_string($this->_coupon) && !empty($this->_coupon))
		{
			$couponDetail = $this->_model->get($this->_coupon);
			if(!empty($couponDetail) && $couponDetail['times']>0 && $couponDetail['starttime']<$_SERVER['REQUEST_TIME'] && ($couponDetail['endtime']>$_SERVER['REQUEST_TIME'] || $couponDetail['endtime'] == 0) && ($couponDetail['uid'] == 0 || $this->_uid == $couponDetail['uid']))
			{
				if($this->_beforePrice>=$couponDetail['max'])
				{
					$this->_minus = ($couponDetail['type'] == 'discount')?$this->_beforePrice * (1-$couponDetail['value']):$couponDetail['value'];
					$this->_afterPrice = $this->_beforePrice - $this->_minus;
				}
			}
		}
		
	}
	
	function getPrice()
	{
		return $this->_afterPrice;
	}
	
	function getMinus()
	{
		return $this->_minus;
	}
}