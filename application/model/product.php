<?php
namespace application\model;

use system\core\model;

class productModel extends model
{
	function __construct()
	{
		parent::__construct('product');
	}
	
	function add($product)
	{
		$array = array(
			$product->name,
			$product->sku,
			$product->cid,
			$product->bid,
			$product->description,
			
		);
		$this->insert($array);
	}

	/**
	 * 删除品牌下所有产品
	 * 
	 * @param unknown $brand_id        	
	 * @return \system\core\Ambigous
	 */
	function deleteByBrand($brand_id)
	{
		return $this->where('bid=?', array(
			$brand_id
		))->delete();
	}
}