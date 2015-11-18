<?php
namespace application\model;

use system\core\model;
use system\core\filesystem;

/**
 * 商品数据模型
 * @author jin12
 *
 */
class productModel extends model
{
	
	/**
	 * 商品状态在销售
	 * @var unknown
	 */
	const ONSALE = 1;
	
	/**
	 * 商品状态不在销售
	 * @var unknown
	 */
	const NOSALE = 2;
	
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 检查商品是否可以被购买
	 * @param unknown $pid
	 */
	function check($pid)
	{
		$this->where('id=? and (starttime<? or starttime=0) and (endtime>? or endtime=0) and status=? and stock>?',array($pid,$_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME'],self::ONSALE,0));
		$result = $this->select();
		return isset($result[0]);
	}
	
	/**
	 * 商品移除
	 */
	function remove($id)
	{
		$productimgModel = $this->model('productimg');
		$result = $productimgModel->where('pid=?',array($id))->select();
		foreach ($result as $img)
		{
			filesystem::unlink($img['base_path']);
			filesystem::unlink($img['small_path']);
			filesystem::unlink($img['thumbnail_path']);
		}
		$productimgModel->where('pid=?',array($id))->delete();
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 设置商品的活动类型
	 * @param unknown $pid
	 * @param unknown $activity
	 */
	function setActivity($pid,$activity = '')
	{
		$activities = array('seckill','fullcut','combine','sale','');
		if(in_array($activity, $activities))
		{
			return $this->where('id=?',array($pid))->update('activity',$activity);
		}
		return false;
	}
	
	/**
	 * 修改商品库存,只针对无可选属性商品
	 * @param unknown $pid
	 * @param unknown $num
	 */
	function increaseStock($pid,$num)
	{
		$this->where('id=?',array($pid))->increase('stock',$num);
		$result = $this->where('id=?',array($pid))->select('stock');
		if(isset($result[0]['stock']) && $result[0]['stock']<0)
		{
			$this->where('id=?',array($pid))->increase('stock',-$num);
			return false;
		}
		return true;
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
		$product = array_merge(array('id'=>NULL),$product,array('activity'=>'','ordernum'=>0,'complete_ordernum'=>0,'time'=>$_SERVER['REQUEST_TIME']));
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
			'sku' => $post->sku,
			'category' => $post->category,
			'bid'=> $post->bid,
			'starttime' => empty($post->starttime)?'0':strtotime($post->starttime),
			'endtime' => empty($post->endtime)?'0':strtotime($post->endtime),
			'description' => $post->description,
			'short_description' => $post->short_description,
			'price' => $post->price,
			'stock' => $post->stock,
			'origin' => $post->origin,
			'label' => $post->label,
			'status' => $post->status,
			'orderby'=>$post->orderby,
			'meta_title'=>$post->meta_title,
			'meta_keywords'=>$post->meta_keywords,
			'meta_description'=>$post->meta_description,
			'oldprice' => $post->oldprice,
			'shipchar' => $post->shipchar,
			'score' => $post->score
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
	
	function fetchAll(array $filter = array())
	{
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*';
		if (isset($filter['status']))
		{
			$this->where('product.status=?',array($filter['status']));
		}
		if (isset($filter['start']) && isset($filter['length']))
		{
			$this->limit($filter['start'],$filter['length']);
		}
		if (isset($filter['time']))
		{
			$this->where('product.starttime<? and (endtime=? or endtime>?)',array($filter['time'],$filter['time'],$filter['time']));		
		}
		if (isset($filter['category']))
		{
			$this->where('category in (?)',$filter['category']);
		}
		if (isset($filter['stock']))
		{
			$this->where('product.stock>?',array($filter['stock']));
		}
		if (isset($filter['sort']))
		{
			if (is_string($filter['sort']))
			{
				$this->orderby($filter['sort']);
			}
			else if(is_array($filter['sort']))
			{
				$this->orderby($filter['sort'][0],$filter['sort'][1]);
			}
		}
		return $this->select($parameter);
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
		if(!is_array($json['columns']))
			return array();
		foreach($json['columns'] as $key => $value)
		{
			if(!empty($json['order']))
			{
				if(is_array($json['order']))
				{
					foreach($json['order'] as $orderby)
					{
						if($orderby['column'] == $key)
						{
							$this->orderby($value['data'],empty($orderby['dir'])?'desc':$orderby['dir']);
						}
					}
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
					$this->where('product.name like ?',array('%'.str_replace(' ', '%', $json['product_name'].'%')),'and');
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
				if(!empty($json['product_bid']))
				{
					$this->where('bid=?',array($json['product_bid']));
				}
				if(!empty($json['product_score']))
				{
					$this->where('score>?',array($json['product_score']));
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