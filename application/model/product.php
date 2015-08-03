<?php
namespace application\model;

use system\core\model;

class productModel extends model
{
	function __construct()
	{
		parent::__construct('product');
	}
	
	/**
	 * 获得一条商品信息
	 * @param unknown $id
	 * @return NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 添加商品
	 * @param unknown $product
	 * @return string|boolean
	 */
	function add($product)
	{
		$product = array_merge(array('id'=>NULL),$product);
		if($this->insert($product))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	/**
	 * 保存商品数据
	 * @param unknown $post
	 */
	function save($post)
	{
		$data = array(
			'name' => $post->name,
			'sku' => '',
			'category' => $post->category,
			'cid'=> '',
			'bid'=>'',
			'starttime' => strtotime($post->starttime),
			'endtime' => strtotime($post->endtime),
			'description' => $post->description,
			'short_description' => $post->short_description,
			'time' => $_SERVER['REQUEST_TIME'],
			'price' => $post->price,
			'stock' => $post->stock,
			'origin' => $post->origin,
			'status' => $post->status,
			'label' => $post->label,
			'orderby'=>$post->orderby,
			'ship'=>'',
			'meta_title'=>$post->meta_title,
			'meta_keywords'=>$post->meta_keywords,
			'meta_description'=>$post->meta_description,
			'truth'=>''
		);
		if(empty($post->id))
		{
			return $this->add($data);
		}
		else
		{
			return $this->where('id=?',array($post->id))->update($data);
		}
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
	
	/**
	 * ajaxdatatable请求搜索
	 */
	function searchable($json)
	{
		$parameter = '';
		foreach($json['columns'] as $key => $value)
		{
			foreach($json['order'] as $orderby)
			{
				if($orderby['column'] == $key)
				{
					$this->orderby($value['data'],$orderby['dir']);
				}
			}
			switch ($value['data'])
			{
				case 'id':
					$parameter .= '`product`.`id`,';
					break;
				case 'categoryname':
					$this->table('category','left join','`category`.`id`=`product`.`category`');
					$parameter .= '`category`.`name` as categoryname,';
					break;
				case 'productname':
					$parameter .= '`product`.`name` as productname,';
					break;
				default:
					$parameter .= $value['data'].',';
			}
			if(isset($json['action']) && $json['action'] == 'filter')
			{
				//过滤器
				if(!empty($json['product_sku']))
				{
					$this->where('sku=?',array($json['product_sku']),'and');
				}
				if(!empty($json['product_name']))
				{
					$this->where('name like ?',array('%'.$json['product_name'].'%'),'and');
				}
				if(!empty($json['product_category']))
				{
					$this->where('category = ?',array($json['product_category']),'and');
				}
				if(!empty($json['product_price_from']))
				{
					$this->where('price > ?',array($json['product_price_from']),'and');
				}
				if(!empty($json['product_price_to']))
				{
					$this->where('price < ?',array($json['product_price_to']),'and');
				}
				if(!empty($json['product_stock_from']))
				{
					$this->where('stock > ?',array($json['product_stock_from']),'and');
				}
				if(!empty($json['product_stock_to']))
				{
					$this->where('stock < ?',array($json['product_stock_to']),'and');
				}
				if(!empty($json['product_time_from']))
				{
					$this->where('time > ?',array(strtotime($json['product_time_from'])),'and');
				}
				if(!empty($json['product_time_to']))
				{
					$this->where('time < ?',array(strtotime($json['product_time_to'])),'and');
				}
				if(!empty($json['product_status']))
				{
					$this->where('status = ?',array($json['product_status']),'and');
				}
			}
		}
		$parameter = rtrim($parameter,',');
		return $this->select($parameter);
	}
	
	/**
	 * 所有商品数量
	 * @return number
	 */
	function count()
	{
		$result = $this->select('count(*)');
		if(isset($result[0]['count(*)']))
			return $result[0]['count(*)'];
		return 0;
	}
}