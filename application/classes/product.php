<?php
namespace application\classes;
use application\model\productModel;
use application\model\collectionModel;
class product
{
	/**
	 * 增加商品库存  当为减少的时候可能返回false
	 * @param unknown $productModel
	 * @param unknown $collectionModel
	 * @param unknown $pid
	 * @param unknown $collection
	 * @param unknown $num
	 */
	function increaseNum(productModel $productModel,collectionModel $collectionModel,$pid,$collection,$num = 1)
	{
		if(empty($collection))
			$collection = array();
		if(is_array($collection))
		{
			$collection = serialize($collection);
		}
		if(empty($collection))
		{
			return $productModel->increaseStock($pid,$num);
		}
		else
		{
			return $collectionModel->increaseStock($pid, $collection, $num);
		}
	}
}