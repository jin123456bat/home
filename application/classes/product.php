<?php
namespace application\classes;
use application\model\productModel;
use application\model\collectionModel;
use application\model\productimgModel;
use application\model\commentModel;
use application\model\orderlistModel;
use application\model\prototypeModel;
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
	
	/**
	 * 为产品附加其他信息
	 * @param unknown $product 产品数组 
	 * @param string $name 主键  也就是产品id是哪个  默认为id
	 * @param productimgModel $productImg 产品的图像模型
	 * @param commentModel $productComment 产品评论数据模型
	 * @param prototypeModel $productPrototype 产品属性数据模型
	 * @param array $productActivity 产品活动数据模型
	 * @param collectionModel $productCollection 产品的多属性映射集合数据模型
	 * @param string $collection
	 */
	function getProductInformation(&$product,$name = 'id',
		productimgModel $productImg = NULL,
		commentModel $productComment = NULL,
		prototypeModel $productPrototype,
		array $productActivity,
		collectionModel $productCollection,
		$collection
	)
	{
		if (!empty($productImg))
		{
			$product['img'] = $productImg->getByPid($product[$name]);
		}
		if(!empty($productComment))
		{
			$product['comment'] = $productComment->getByPid($product[$name]);
		}
		if(!empty($productPrototype))
		{
			$product['prototype'] = $productPrototype->getByPid($product[$name]);
		}
		if(!empty($productActivity))
		{
			switch ($product['activity'])
			{
				case 'sale':$productActivity['sale']->getByPid($product[$name]);break;
				case 'fullcut':$productActivity['fullcut']->getByPid($product[$name]);break;
				case 'seckill':$productActivity['seckill']->getByPid($product[$name]);break;
			}
		}
		if(!empty($productCollection))
		{
			if(empty($collection))
			{
				$product['collection'] = $productCollection->getByPid($product[$name]);
			}
			else
			{
				$product['collection'] = $productCollection->find($product[$name],$collection);
			}
		}
	}
}