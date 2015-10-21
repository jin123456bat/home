<?php
namespace application\control;

use system\core\control;
use system\core\filter;
use application\classes\login;
use application\classes\collection;
use application\classes\prototype;
use application\classes\product;
use application\classes\order;
use application\message\json;
use application\classes\fullcut;
use application\classes\coupon;
class cartControl extends control
{
	/**
	 * 对于30分钟内尚未结算的购物车经行清空
	 */
	function crontab()
	{
		//清空30分钟内尚未结算的购物车商品
		$cartModel = $this->model('cart');
		//商品库存回归
		$cart = $cartModel->where('time < ?',array($_SERVER['REQUEST_TIME']-1800))->select();
		$productHelper = new product();
		foreach($cart as $product)
		{
			$productHelper->increaseNum($this->model('product'), $this->model('collection'), $product['pid'], $product['collection'],$product['num']);
		}
		$cartModel->where('time < ?',array($_SERVER['REQUEST_TIME']-1800))->delete();
	}
	
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
			return  new json(json::NOT_LOGIN);
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
				return new json(4,'该商品不可被购买');
			$cartModel = $this->model('cart');
			$prototypeModel = $this->model('prototype');
			$radioPrototype = $prototypeModel->getByPid($pid,'radio');
			if(empty($radioPrototype))
			{
				//不存在可选属性
				if($productModel->increaseStock($pid,-$num))
				{
					$content = array();
					if($cartModel->create($uid,$pid,$content,$num))
					{
						//$cal = json_decode($this->calculation($uid));
						$num = $cartModel->count($uid);
						return new json(json::OK,NULL,$num);
					}
					else
					{
						return new json(5,'添加到购物车失败');
					}
				}
				return new json(6,'么有库存');
			}
			else
			{
				$collectionModel = $this->model('collection');
				if(empty($collectionModel->find($pid,$content)))
				{
					return new json(7,'可选属性值错误');
				}
				if($collectionModel->increaseStock($pid,$content,-$num))
				{
					if($cartModel->create($uid,$pid,$content,$num))
					{
						$num = $cartModel->count($uid);
						//$cal = json_decode($this->calculation($uid));
						return new json(json::OK,NULL,$num);
					}
					else
					{
						return new json(5,'添加到购物车失败');
					}
				}
				return new json(6,'没有库存');
			}
		}
		return new json(json::PARAMETER_ERROR,'参数错误');
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
		$this->response->addHeader('Content-Type','application/json');
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
			$num = $cartModel->count($uid);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$num));
		}
		return json_encode(array('code'=>0,'result'=>'购物车中不存在该物品'));
	}
	
	/**
	 * 计算购物车中商品数量
	 * @return \application\message\json
	 */
	function count()
	{
		$num = $this->model('cart')->count($this->session->id);
		return new json(json::OK,NULL,$num);
	}
	
	/**
	 * 获取用户购物车中的所有商品
	 */
	function mycart()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$cartModel = $this->model('cart');
		$result = $cartModel->getByUid($this->session->id);
		$prototypeModel = $this->model('prototype');
		$productimgModel = $this->model('productimg');
		$categoryModel = $this->model('category');
		foreach ($result as &$product)
		{
			unset($product['bid']);
			$product['content'] = unserialize($product['content']);
			$product['prototype'] = $prototypeModel->getByPid($product['id']);
			if(!empty($product['content']))
			{
				$product['collection'] = $this->model('collection')->find($product['pid'],$product['content']);
				$product['collection_string'] = (new prototype())->format($product['prototype'], $product['content']);
			}
			$product['img'] = $productimgModel->getByPid($product['id']);
			switch ($product['activity']) {
				case 'seckill':
					$product['activity_description'] = $this->model('seckill')->getByPid($product['id']);
					break;
				case 'fullcut':
					$product['activity_description'] = $this->model('fullcutdetail')->getByPid($product['id']);
					break;
				case 'sale':
					$product['activity_description'] = $this->model('sale')->getByPid($product['id']);
					break;
				default:
					$product['activity_description'] = '';
					break;
			}
		}
		//$cal = json_decode($this->calculation($this->session->id));
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 清空购物车
	 */
	function clear()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$uid = $this->session->id;
		$cartModel = $this->model('cart');
		if($cartModel->clear($uid))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'本来就是空的好不好'));
	}
	
	/**
	 * 计算购物车中商品价格
	 * @param session id 用户id
	 */
	function calculation($uid = NULL)
	{
		$this->response->addHeader('Content-Type','application/json');
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
			$data = unserialize($value['content']);
			if(!empty($value['content']))
			{
				$collection = $collectionModel->find($value['pid'],$data);
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
				case 'sale':
					$price = $saleModel->getPrice($value['pid']);
					if($price != NULL)
						$totalPrice += $price*$value['num'];
					break;
				case 'fullcut':
					$fullcut = $fullcutdetailModel->getPrice($value['pid'],$value['price']*$value['num']);
					if($fullcut != NULL)
					{
						$totalPrice += ($value['price']*$value['num'] - $fullcut['minus']);
					}
					break;
				default:
					$totalPrice += $value['price']*$value['num'];
			}
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$totalPrice));
	}
	
	/**
	 * 将购物车中的物品生成订单
	 */
	function order()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>3,'result'=>'尚未登陆'));
		
		$preorder = $this->post->preorder;
		//优惠前的价格
		//订单货款
		$ordergoodsamount = 0;
		//购物车中的商品
		$cartModel = $this->model('cart');
		$uid = $this->session->id;
		$cart = $cartModel->getByUid($uid);
		//订单详情
		$orderdetail = array();
		$collectionModel = $this->model('collection');
		$prototypeModel = $this->model('prototype');
		//优惠金额
		$discount = 0;
		$couponModel = $this->model('coupon');
		//要使用的优惠卷信息
		$coupon = empty($this->post->coupon)?'':$this->post->coupon;
		
		//存储满减商品
		$fullcut_temp = array();
		//存储没有参加活动商品信息
		$coupon_temp = array();
		
		foreach ($cart as $product)
		{
			$pricestocksku = $collectionModel->find($product['pid'],unserialize($product['content']));
			$prototype = $prototypeModel->getByPid($product['pid']);
			$prototype = (new prototype())->format($prototype,$product['content']);
			
			if(!empty($pricestocksku))
			{
				$product['price'] = $pricestocksku['price'];
				$product['sku'] = $pricestocksku['sku'];
			}
			
			$t_orderdetail = array('sku'=>$product['sku'],'pid'=>$product['pid'],'productname'=>$product['name'],'brand'=>$this->model('brand')->get($product['bid'],'name'),'unitprice'=>$product['price'],'content'=>$product['content'],'prototype'=>$prototype,'origin'=>$product['origin'],'score'=>$product['score'],'num'=>$product['num']);
			//商品详情加入到数组
			$orderdetail[] = $t_orderdetail;
			
			switch ($product['activity'])
			{
				case 'seckill':
					$seckillModel = $this->model('seckill');
					$price = $seckillModel->getPrice($product['pid']);
					if($price !== NULL)
					{
						$discount += (($product['price'] - $price) * $product['num']);
						$ordergoodsamount += ($price*$product['num']);
					}
					else
					{
						$ordergoodsamount += ($product['price']*$product['num']);
					}
					break;
				case 'sale':
					$saleModel = $this->model('sale');
					$price = $saleModel->getPrice($product['pid']);
					if($price !== NULL)
					{
						$discount += (($product['price'] - $price) * $product['num']);
						$ordergoodsamount += ($price*$product['num']);
					}
					else
					{
						$ordergoodsamount += ($product['price']*$product['num']);
					}
					break;
				case 'fullcut':
					//取出所有满减规则的商品
					$fullcut_temp[] = $product;
					break;
				default:
					$coupon_temp[] = $product;
			}
			
			
			
			
		}
		//单独计算不同的满减规则
		$fullcutHelper = new fullcut($this->model('fullcutdetail'),$fullcut_temp);
		//最终价格
		$ordergoodsamount += $fullcutHelper->getPrice();
		//免去价格
		$discount += $fullcutHelper->getMinus();
		
		//计算优惠
		$couponHelper = new coupon($coupon, $uid, $this->model('coupon'), $coupon_temp);
		$ordergoodsamount += $couponHelper->getPrice();
		$discount += $couponHelper->getMinus();
		//是否减少优惠券使用次数
		if($couponHelper->getMinus() > 0 && !$preorder)
		{
			$couponModel->increaseTimes($coupon,-1);
		}
		
		//支付方式
		$paytype = $this->post->paytype;
		if(empty($paytype))
		{
			return json_encode(array('code'=>4,'result'=>'没有支付方式'));
		}
		
		//支付单号
		$paynumber = '';
		//运费  根据订单金额计算运费
		$shipid = filter::int($this->post->shipid);
		if(empty($shipid))
			return json_encode(array('code'=>5,'result'=>'错误的配送方案'));
		$shipModel = $this->model('ship');
		$ship = $shipModel->get($shipid);
		if(empty($ship))
		{
			return json_encode(array('code'=>5,'result'=>'错误的配送方案'));
		}
		$feeamount = $shipModel->getPrice($shipid,$ordergoodsamount);
		
		
		//订单编号
		$orderno = (new order())->swift($this->session->id);
		
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
		$addressid = filter::int($this->post->addressid);
		$address_parameter = 'city.name as city,province.name as province,address.county,address.address,address.zcode,address.name,address.telephone';	
		$address = $this->model('address')->get($addressid,$address_parameter);
		
		if(empty($address))
		{
			if(empty($preorder))
			{
				return json_encode(array('code'=>6,'result'=>'错误的配送地址'));
			}
			else
			{
				$address = array(
					'name' => '',
					'telephone' => '',
					'address' => '',
					'province' => '',
					'city' => '',
					'county' => '',
					'zcode' => ''
				);
			}
		}
		
		$consignee = $address['name'];
		$consigneetel = $address['telephone'];
		$consigneeaddress = $address['address'];
		$consigneeprovince = $address['province'];
		$consigneecity = $address['city'];
		$consigneecounty = $address['county'];
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
			NULL,
			$uid,
			$paytype,
			$paynumber,
			$ordertotalamount,
			$orderno,
			$ordertaxamount,
			$ordergoodsamount,
			$feeamount,
			$tradetime,
			$createtime,
			$totalamount,
			$consignee,
			$consigneetel,
			$consigneeaddress,
			$consigneeprovince,
			$consigneecity,
			$consigneecounty,
			$postmode,
			$waybills,
			$sendername,
			$companyname,
			$zipcode,
			$note,
			$status,
			$discount,
			$client,
			$action_type
		);
		
		if($preorder)
		{
			$order = array(
				'id'=>NULL,'uid'=>$uid,'paytype'=>$paytype,'paynumber'=>$paynumber,'ordertotalamount'=>$ordertotalamount,'orderno'=>$orderno,'ordertaxamount'=>$ordertaxamount,'ordergoodsamount'=>$ordergoodsamount
				,'feeamount'=>$feeamount,'tradetime'=>$tradetime,'createtime'=>$createtime,'totalamount'=>$totalamount,'consignee'=>$consignee,'consigneetel'=>$consigneetel,'consigneeaddress'=>$consigneeaddress
				,'consigneeprovince'=>$consigneeprovince,'consigneecity'=>$consigneecity,'consigneecounty'=>$consigneecounty,'postmode'=>$postmode,'waybills'=>$waybills,'sendername'=>$sendername,'companyname'=>$companyname,'zipcode'=>$zipcode
				,'note'=>$note,'status'=>$status,'discount'=>$discount,'client'=>$client,'action_type'=>$action_type
			);
			$order['orderdetail'] = $orderdetail;
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$order));
		}
		else
		{
			$orderModel = $this->model('orderlist');
			$oid = $orderModel->create($data,$orderdetail);
			if($oid)
			{
				$cartModel->clear($uid);
				//用户订单数量+1
				$this->model('user')->where('id=?',array($uid))->increase('ordernum',1);
				//商品订单数量+1
				foreach ($orderdetail as $ordergoods)
				{
					$this->model('product')->where('id=?',array($ordergoods['pid']))->increase('ordernum',1);
				}
				$order = $orderModel->get($oid);
				$order['orderdetail'] = $orderModel->getOrderDetail($oid);
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$order));
			}
			return json_encode(array('code'=>2,'result'=>'创建订单失败'));
		}
	}
}