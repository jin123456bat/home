<?php
namespace application\control;

use system\core\control;
use system\core\filter;
use application\classes\login;
use application\classes\collection;
use system\core\random;
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
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'购物车中不存在该物品'));
	}
	
	/**
	 * 获取用户购物车中的所有商品
	 */
	function mycart()
	{
		if(login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$cartModel = $this->model('cart');
		$result = $cartModel->getByUid($this->session->id);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 计算购物车中商品价格
	 * @param session id 用户id
	 */
	function calculation()
	{
		if (!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$cartModel = $this->model('cart');
		$seckillModel = $this->model('seckill');
		$saleModel = $this->model('sale');
		$collectionModel = $this->model('collection');
		$fullcutdetailModel = $this->model('fullcutdetail');
		$product = $cartModel->getByUid($this->session->id);
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
					if($value['price']*$value['num']>$fullcut['max'])
						$totalPrice += ($value['price']*$value['num']-$fullcut['minus']);
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
		$this->session->id = 3;
		//if(!login::user())
		//	return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$cartModel = $this->model('cart');
		$cart = $cartModel->getByUid($this->session->id);
		//流水号
		$swift = date('YmdHis').$this->session->id;
		$uid = $this->session->id;
		//支付方式
		$paytype = '';
		$paynumber = '';
		//运费
		$feeamount = 0;
		//订单编号
		$orderno = date('YmdHis').$this->session->id.random::number(4);
		//订单税款 免税
		$ordertaxamount = 0;
		//订单货款
		$ordergoodsamount = json_decode($this->calculation());
		$ordergoodsamount = $ordergoodsamount['body'];
		//订单生成时间
		$createtime = $_SERVER['REQUEST_TIME'];
		//交易时间
		$tradetime = 0;
		//订单总金额
		$ordertotalamount = $feeamount+$ordertaxamount+$ordergoodsamount;
		//成交总价
		$totalamount = $ordertotalamount;
		//收件人
		$address = $this->model('address')->getHost($this->session->id);
		$consignee = $address['name'];
		$consigneetel = $address['telephone'];
		$consigneeaddress = $address['province'].$address['city'].$address['address'];
		$zipcode = $address['zcode'];
		//物流方式
		$postmode = 'SF';
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
		//折扣方式
		$discount = '';
		$data = array(
			NULL,$uid,$paytype,$paynumber,$ordertotalamount,$orderno,$ordertaxamount,$ordergoodsamount
			,$feeamount,$tradetime,$createtime,$totalamount,$consignee,$consigneetel,$consigneeaddress
			,$postmode,$waybills,$sendername,$companyname,$zipcode,$note,$status,$discount
		);
		$orderModel = $this->model('order');
		if($orderModel->create($data))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>2,'result'=>'failed'));
	}
}