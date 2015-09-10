<?php
namespace application\control;

use system\core\control;
use system\core\file;
use system\core\filter;
use application\classes\login;
use application\classes\collection;
use system\core\random;
use application\classes\prototype;
use application\classes\product;
use application\classes\order;
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
		$this->response->addHeader('Content-Type','application/json');
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
					$content = array();
					if($cartModel->create($uid,$pid,$content,$num))
					{
						$cal = json_decode($this->calculation($uid));
						return json_encode(array('code'=>1,'result'=>'ok','body'=>$cal->body));
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
						$cal = json_decode($this->calculation($uid));
						return json_encode(array('code'=>1,'result'=>'ok','body'=>$cal->body));
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
			$cal = json_decode($this->calculation($uid));
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$cal->body));
		}
		return json_encode(array('code'=>0,'result'=>'购物车中不存在该物品'));
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
			if(!empty($product['content']))
			{
				$product['collection'] = $this->model('collection')->find($product['pid'],$product['content']);
			}
			$product['prototype'] = $prototypeModel->getByPid($product['id']);
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
		$cal = json_decode($this->calculation($this->session->id));
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result,'calculation'=>$cal->body));
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
		$response = json_decode($this->calculation($this->session->id));
		//总金额 优惠前的价格
		//$totalMoney = $response->body;
		//订单货款
		//$ordergoodsamount = $totalMoney;
		$ordergoodsamount = 0;
		//购物车中的商品
		$cartModel = $this->model('cart');
		//计算折扣
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
		//要被打折商品的总价
		$tobeCouponamount = 0;
		foreach ($cart as $product)
		{
			$pricestocksku = $collectionModel->find($product['pid'],unserialize($product['content']));
			$prototype = $prototypeModel->getByPid($product['pid']);
			$prototype = (new prototype())->format($prototype,$product['content']);
			//商品实际价格  实际上的单价
			$goodstruthprice = $product['price'];
			if(!empty($pricestocksku))
			{
				$goodstruthprice = $pricestocksku['price'];
			}
			
			switch ($product['activity'])
			{
				case 'seckill':
					$seckillModel = $this->model('seckill');
					$price = $seckillModel->getPrice($product['pid']);
					if($price != NULL)
					{
						$goodstruthprice = $price;
					}
					break;
				case 'sale':
					$saleModel = $this->model('sale');
					$price = $saleModel->getPrice($product['pid']);
					if($price != NULL)
					{
						$goodstruthprice = $price;
					}
					break;
				case 'fullcut':
					$fullcutdetailModel = $this->model('fullcutdetail');
					$fullcut = $fullcutdetailModel->getPrice($product['pid'],$goodstruthprice*$product['num']);
					if($fullcut != NULL)
					{
						$goodstruthprice = ($goodstruthprice*$product['num'] - $fullcut['minus'])/$product['num'];
					}
					break;
				default:
					$used = $couponModel->check($coupon,$product);
					if(!empty($used))
					{
						$tobeCouponamount += ($goodstruthprice*$product['num']);
						$coupon = $used;
					}
			}
			
			$t_orderdetail = array('sku'=>$product['sku'],'pid'=>$product['pid'],'productname'=>$product['name'],'unitprice'=>$goodstruthprice,'content'=>$product['content'],'prototype'=>$prototype,'origin'=>$product['origin'],'score'=>$product['score'],'num'=>$product['num']);
			if(!empty($pricestocksku))
			{
				$t_orderdetail['sku'] = $pricestocksku['sku'];
			}
			//商品详情加入到数组
			$orderdetail[] = $t_orderdetail;
			$ordergoodsamount += ($goodstruthprice*$product['num']);
		}
		
		
		
		//支付方式
		$paytype = $this->post->paytype;
		if(empty($paytype))
		{
			return json_encode(array('code'=>4,'result'=>'没有支付方式'));
		}
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
		//计算优惠价格
		if(!empty($coupon))
		{
			if($tobeCouponamount >= $coupon['max'])
			{
				$minus = ($coupon['type'] == 'fixed')?$coupon['value']:$tobeCouponamount*(1-$coupon['value']);
				$ordertotalamount -= $minus;
				$discount = $minus;
			}
		}
		
		//成交总价  已经支付的价格
		$totalamount = 0;
		//收件人
		$addressid = filter::int($this->post->addressid);
		if(empty($addressid))
			return json_encode(array('code'=>6,'result'=>'错误的配送地址'));
		$address = $this->model('address')->get($addressid);
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
			//清空购物车
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