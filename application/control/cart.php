<?php
namespace application\control;

use system\core\control;
use system\core\file;
use system\core\filter;
use application\classes\login;
use application\classes\collection;
use system\core\random;
use application\classes\prototype;
class cartControl extends control
{
	/**
	 * 将一件商品添加到购物车
	 * @param post pid 商品id
	 * @param post num 商品数量 不提交或者为空则为1
	 * @param post content 能够声明唯一商品的属性集合 字符串或数组
	 * @param session id 用户id
	 */
	function add()
	{
		if(!login::user())
			return json_encode(array('code'=>3,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		$num = filter::int($this->post->num);
		$content = $this->post->content;
		$content = (new collection())->stringToArray($content);
		$uid = $this->session->id;
		$num = empty($num)?1:$num;
		if(!empty($pid))
		{
			$productModel = $this->model('product');
			if(!$productModel->check($pid))
				return json_encode(array('code'=>4,'result'=>'该商品不可被购买'));
			$cartModel = $this->model('cart');
			$prototypeModel = $this->model('prototype');
			$radioPrototype = $prototypeModel->getByPid($pid,'radio');
			if(empty($radioPrototype))
			{
				//不存在可选属性
				if($productModel->increaseStock($pid,-$num))
				{
					$content = '';
					if($cartModel->create($uid,$pid,$content,$num))
					{
						return json_encode(array('code'=>1,'result'=>'ok'));
					}
					else
					{
						return json_encode(array('code'=>3,'result'=>'添加到购物车失败'));
					}
				}
				return json_encode(array('code'=>2,'result'=>'没有库存'));
			}
			else
			{
				
				$collectionModel = $this->model('collection');
				if(empty($collectionModel->find($pid,$content)))
				{
					return json_encode(array('code'=>5,'result'=>'可选属性值错误'));
				}
				if($collectionModel->increaseStock($pid,$content,-$num))
				{
					if($cartModel->create($uid,$pid,$content,$num))
					{
						return json_encode(array('code'=>1,'result'=>'ok'));
					}
					else
					{
						return json_encode(array('code'=>3,'result'=>'添加到购物车失败'));
					}
				}
				return json_encode(array('code'=>2,'result'=>'没有库存'));
			}
		}
		return json_encode(array('code'=>0,'result'=>'请指定商品'));
	}
	
	/**
	 * 从购物车中移除商品
	 * @param post pid 商品id
	 * @param post cid 能够声明唯一商品的属性集合
	 * @param post num 移除数量 不提交或者为空则为1
	 * @param session id 用户id
	 */
	function remove()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		$content = $this->post->content;
		$content = (new collection())->stringToArray($content);
		$num = filter::int($this->post->num);
		$uid = $this->session->id;
		$num = empty($num)?1:$num;
		$cartModel = $this->model('cart');
		if($cartModel->remove($uid,$pid,$content,$num))
		{
			$productModel = $this->model('product');
			$collection = $this->model('collection');
			if(empty($content))
			{
				//不存在可选属性
				$productModel->increaseStock($pid,$num);
			}
			else
			{
				//存在可选属性
				$collection->increaseStock($pid,$content,$num);
			}
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'购物车中不存在该物品'));
	}
	
	/**
	 * 获取用户购物车中的所有商品
	 */
	function mycart()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$cartModel = $this->model('cart');
		$result = $cartModel->getByUid($this->session->id);
		$prototypeModel = $this->model('prototype');
		$productimgModel = $this->model('productimg');
		$categoryModel = $this->model('category');
		foreach ($result as $product)
		{
			unset($product['bid']);
			$product['prototype'] = $prototypeModel->getByPid($product['id']);
			$product['img'] = $productimgModel->getByPid($product['id']);
			foreach ($product['img'] as &$img)
			{
				$img['thumbnail_path'] = file::realpathToUrl($img['thumbnail_path']);
				$img['small_path'] = file::realpathToUrl($img['small_path']);
				$img['base_path'] = file::realpathToUrl($img['base_path']);
			}
			$product['category'] = $categoryModel->get($product['category'],'name');
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 计算购物车中商品价格
	 * @param session id 用户id
	 */
	function calculation($uid = NULL)
	{
		if (!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$uid = empty($uid)?$this->session->id:$uid;
		$cartModel = $this->model('cart');
		$seckillModel = $this->model('seckill');
		$saleModel = $this->model('sale');
		$collectionModel = $this->model('collection');
		$prototypeModel = $this->model('prototype');
		$fullcutdetailModel = $this->model('fullcutdetail');
		$product = $cartModel->getByUid($uid);
		$totalPrice = 0;
		foreach($product as $value)
		{
			if(!empty($value['content']))
			{
				$data = unserialize($value['content']);
				$co = array();
				foreach ($data as $k=>$d)
				{
					$co[] = $k.':'.$d;
				}
				$collection = $collectionModel->find($value['pid'],implode(',', $co));
				if(!empty($collection))
					$value['price'] = $collection['price'];
			}
			switch ($value['activity'])
			{
				case 'seckill':
					$price = $seckillModel->getPrice($value['pid']);
					if($price != NULL)
						$totalPrice += $price*$value['num'];
					break;
				case 'sale':break;
					$price = $saleModel->getPrice($value['pid']);
					if($price != NULL)
						$totalPrice += $price*$value['num'];
				case 'fullcut':
					$fullcut = $fullcutdetailModel->getByPid($value['pid']);
					if($value['price']*$value['num']>$fullcut[0]['max'])
						$totalPrice += ($value['price']*$value['num']-$fullcut[0]['minus']);
					else
						$totalPrice += $value['price']*$value['num'];
					break;
				default:
					$totalPrice += $value['price']*$value['num'];
					break;
			}
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$totalPrice));
	}
	
	/**
	 * 将购物车中的物品生成订单
	 */
	function order()
	{
		/*
		$this->session->id = 3;
		$this->post->paytype = 'alipay';
		$this->post->shipid = 1;
		$this->post->addressid = 2;
		$this->post->client = 'web';
		*/
		if(!login::user())
			return json_encode(array('code'=>3,'result'=>'尚未登陆'));
		$response = json_decode($this->calculation($this->session->id));
		//总金额 优惠前的价格
		$totalMoney = $response->body;
		//订单货款
		$ordergoodsamount = $totalMoney;
		//购物车中的商品
		$cartModel = $this->model('cart');
		//计算折扣
		$uid = $this->session->id;
		$cart = $cartModel->getByUid($uid);
		//订单详情
		$orderdetail = array();
		$collectionModel = $this->model('collection');
		$prototypeModel = $this->model('prototype');
		foreach ($cart as $product)
		{
			$pricestocksku = $collectionModel->find($product['pid'],unserialize($product['content']));
			$prototype = $prototypeModel->getByPid($product['pid']);
			$prototype = (new prototype())->format($prototype,$product['content']);
			if(!empty($pricestocksku))
			{
				$orderdetail[] = array($pricestocksku['sku'],$product['pid'],$product['name'],$pricestocksku['price'],$prototype,$product['origin'],$product['score'],$product['num']);
			}
			else
			{
				$orderdetail[] = array($product['sku'],$product['pid'],$product['name'],$product['price'],$prototype,$product['origin'],$product['score'],$product['num']);
			}
		}
		
		if(empty($this->post->coupon))
		{
			//没有使用任何优惠
			$discount = '';
		}
		else
		{
			$discount = $this->post->coupon;
			$couponModel = $this->model('coupon');
			foreach($cart as $product)
			{
				//$orderdetail[] = array($product['pid'],$product['name']);
				if($product['activity'] == '')
				{
					$used = $couponModel->check($discount,$product);
					if($used)
					{
						if($product['num'] * $product['price'] >= $used['max'])
						{
							if($couponModel->increaseTimes($used['couponno'],-1))
							{
								$ordergoodsamount = $ordergoodsamount - ($product['num']*$product['price']);
								$mon = $product['num'] * $product['price'];
								$mon = ($used['type'] == 'discount')?$mon-$used['value']:$mon*$used['value'];
								$ordergoodsamount += $mon;
								break;
							}
						}
					}
				}
			}
		}
		//支付方式
		$paytype = $this->post->paytype;
		if(empty($paytype))
		{
			return json_encode(array('code'=>4,'result'=>'没有支付方式'));
		}
		$paynumber = '';
		//运费  根据订单金额计算运费
		$shipid = $this->post->shipid;
		$shipModel = $this->model('ship');
		$ship = $shipModel->get($shipid);
		if(empty($ship))
		{
			return json_encode(array('code'=>5,'result'=>'错误的配送方案'));
		}
		$feeamount = $shipModel->getPrice($shipid,$totalMoney);
		//订单编号
		$swift = $orderno = date('YmdHis').$this->session->id.random::number(4);
		//订单税款 免税
		$ordertaxamount = 0;
		
		//订单生成时间
		$createtime = $_SERVER['REQUEST_TIME'];
		//交易时间
		$tradetime = 0;
		//订单总金额
		$ordertotalamount = $feeamount+$ordertaxamount+$ordergoodsamount;
		//成交总价  已经支付的价格
		$totalamount = 0;
		//收件人
		$address = $this->model('address')->get($this->post->addressid);
		if(empty($address))
		{
			return json_encode(array('code'=>6,'result'=>'错误的配送地址'));
		}
		$consignee = $address['name'];
		$consigneetel = $address['telephone'];
		$consigneeaddress = $address['address'];
		$consigneeprovince = $address['province'];
		$consigneecity = $address['city'];
		$zipcode = $address['zcode'];
		//物流方式
		$postmode = $ship['code'];
		//运单号
		$waybills = '';
		//发件人
		$sendername = $this->model('system')->get('sendername','system');
		//公司名称
		$companyname = $this->model('system')->get('companyname','system');
		//备注信息
		$note = '';
		//订单状态
		$status = 0;
		//订单来源
		$client = $this->post->client;
		/**
		 * 财付通专用，标注是否已经报过报过接口  1没有 2已经报过
		 */
		$action_type = '1';
		
		$data = array(
			NULL,$uid,$paytype,$paynumber,$ordertotalamount,$orderno,$ordertaxamount,$ordergoodsamount
			,$feeamount,$tradetime,$createtime,$totalamount,$consignee,$consigneetel,$consigneeaddress
			,$consigneeprovince,$consigneecity,$postmode,$waybills,$sendername,$companyname,$zipcode
			,$note,$status,$discount,$client,$action_type
		);
		$orderModel = $this->model('orderlist');
		$oid = $orderModel->create($data,$orderdetail);
		if($oid)
		{
			$cartModel->clear($uid);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$oid));
		}
		return json_encode(array('code'=>2,'result'=>'创建订单失败'));
	}
}