<?php
namespace application\control;

use system\core\control;
use system\core\file;
use application\classes\login;
use system\core\view;
use application\model\roleModel;
use application\classes\category;
use system\core\filter;
use application\classes\excel;
use application\classes\collection;
use system\core\random;
use application\classes\prototype;
use application\classes\product;
use application\classes\order;
use system\core\filesystem;
use application\message\json;
/**
 * 商品控制器
 * @author jin12
 *
 */
class productControl extends control
{
	/**
	 * 对于超过时间或者不在时间之内的商品自动上下架
	 */
	function crontab()
	{
		$productModel = $this->model('product');
		$time = $_SERVER['REQUEST_TIME'];
		//更改商品自动上架
		$productModel->where('(starttime < ? or starttime = 0) and (endtime > ? or endtime=0) and status!=1',array($time,$time))->update('status',self::ONSALE);
		//商品自动下架
		$productModel->where('starttime > ? or (endtime < ? and endtime!=0) and status != 2',array($time,$time))->update('status',self::NOSALE);
	}
	
	/**
	 * 直接购买一件商品 而不通过购物车
	 */
	function order()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		//是否为预订单
		$preorder = $this->post->preorder;
		
		//商品id
		$pid = $this->post->pid;
		$uid = $this->session->id;
		if(empty($pid))
			return json_encode(array('code'=>3,'result'=>'参数错误'));
		//购买数量
		$num = filter::int($this->post->num);
		$num = empty($num)?1:$num;
		//支付方式
		$paytype = $this->post->paytype;
		if(empty($paytype))
			return json_encode(array('code'=>5,'result'=>'没有支付方式'));
		//商品属性组合
		$content = $this->post->content;
		$content = (new collection())->stringToArray($content);//:,转数组
		
		$product = $this->model('product')->get($pid);
		//订单货款
		$ordergoodsamount = $product['price']*$num;
		//订单商品详情
		$orderdetail = array();
		//商品属性  可以看到的明白的额
		$prototype = $this->model('prototype')->getByPid($pid);
		
		if(!empty($content))
		{
			//存在多选属性的话价格以多选属性中的价格为准
			$skupricestock = $this->model('collection')->find($pid,$content);
			if(empty($content))
				return json_encode(array('code'=>4,'result'=>'可选属性组合错误'));
			$prototype = (new prototype())->format($prototype,$content);
			$ordergoodsamount = $skupricestock['price']*$num;
			$orderdetail[] = array('sku'=>$skupricestock['sku'],'pid'=>$product['id'],'productname'=>$product['name'],'brand'=>$this->model('brand')->get($product['bid'],'name'),'unitprice'=>$skupricestock['price'],'content'=>serialize($content),'prototype'=>$prototype,'origin'=>$product['origin'],'score'=>$product['score'],'num'=>$num);
		}
		else
		{
			$prototype = (new prototype())->format($prototype,$content);
			$orderdetail[] = array('sku'=>$product['sku'],'pid'=>$product['id'],'productname'=>$product['name'],'brand'=>$this->model('brand')->get($product['bid'],'name'),'unitprice'=>$product['price'],'content'=>serialize($content),'prototype'=>$prototype,'origin'=>$product['origin'],'score'=>$product['score'],'num'=>$num);
		}
		//收货地址id
		$addressid = $this->post->addressid;
		if(empty($addressid))
			return json_encode(array('code'=>8,'result'=>'收货地址不能为空'));
		//优惠代码
		$coupon = $this->post->coupon;
		//优惠金额
		$discount = 0;
		
		//判断商品是否参加了活动
		switch ($product['activity'])
		{
			case 'fullcut':
				$fullcut = $this->model('fullcutdetail')->getPrice($pid,$ordergoodsamount);
				if($fullcut !== NULL)
				{
					$ordergoodsamount -= $fullcut['minus'];
					//计算满减的单价
					$orderdetail[0]['unitprice'] = $ordergoodsamount/$num;
				}
				break;
			case 'sale':
				$sale = $this->model('sale')->getPrice($pid);
				if($sale !== NULL)
				{
					$ordergoodsamount = $sale*$num;
					$orderdetail[0]['unitprice'] = $sale;
				}
				break;
			case 'seckill':
				$seckill = $this->model('seckill')->getPrice($pid);
				if($seckill !== NULL)
				{
					$ordergoodsamount = $seckill*$num;
					$orderdetail[0]['unitprice'] = $seckill;
				}
				break;
			default:
				if(!empty($coupon))
				{
					$couponModel = $this->model('coupon');
					$used = $couponModel->check($coupon,$product);
					if(!empty($used))
					{
						if($ordergoodsamount >= $used['max'])
						{
							if(!$preorder)
							{
								$couponModel->increaseTimes($coupon,-1);
							}
							$ordergoodsamount = ($used['type'] == 'fixed')?$ordergoodsamount-$used['value']:$ordergoodsamount*$used['value'];
							$discount = ($used['type'] == 'fixed')?$used['value']:$ordergoodsamount*(1-$used['value']);
							break;
						}
					}
				}
			break;
		}
		//计算运费
		$shipid = filter::int($this->post->shipid);
		if (empty($shipid))
			return json_encode(array('code'=>7,'result'=>'没有配送方案'));
		$shipModel = $this->model('ship');
		$ship = $shipModel->get($shipid);
		if(empty($ship))
		{
			return json_encode(array('code'=>5,'result'=>'错误的配送方案'));
		}
		//物流方式
		$postmode = $ship['code'];
		//配送费用
		$feeamount = $shipModel->getPrice($shipid,$ordergoodsamount);
		//订单税款  免税
		$ordertaxamount = 0;
		//订单总金额
		$ordertotalamount = $ordertaxamount + $ordergoodsamount + $feeamount;
		//支付单号
		$paynumber = '';
		//订单编号
		$orderno = (new order())->swift($this->session->id);
		//成交时间
		$tradetime = 0;
		//创建时间
		$createtime = $_SERVER['REQUEST_TIME'];
		//成交总价
		$totalamount = 0;
		//收件人
		$address = $this->model('address')->get($this->post->addressid);
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
					'zcode' => ''
				);
			}
		}
		$consignee = $address['name'];
		$consigneetel = $address['telephone'];
		$consigneeaddress = $address['address'];
		$consigneeprovince = $address['province'];
		$consigneecity = $address['city'];
		$zipcode = $address['zcode'];
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
		
		$order = array(
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
		
		$systemModel = $this->model('system');
		$maxvalue = $systemModel->get('maxvalue','payment');
		if(!empty($maxvalue))
		{
			if($maxvalue>$ordertotalamount)
				return new json(5,'订单总金额超过付款限制('.$maxvalue.'元)');
		}
		
		if($preorder)
		{
			$order = array(
				'id'=>NULL,'uid'=>$uid,'paytype'=>$paytype,'paynumber'=>$paynumber,'ordertotalamount'=>$ordertotalamount,'orderno'=>$orderno,'ordertaxamount'=>$ordertaxamount,'ordergoodsamount'=>$ordergoodsamount
				,'feeamount'=>$feeamount,'tradetime'=>$tradetime,'createtime'=>$createtime,'totalamount'=>$totalamount,'consignee'=>$consignee,'consigneetel'=>$consigneetel,'consigneeaddress'=>$consigneeaddress
				,'consigneeprovince'=>$consigneeprovince,'consigneecity'=>$consigneecity,'postmode'=>$postmode,'waybills'=>$waybills,'sendername'=>$sendername,'companyname'=>$companyname,'zipcode'=>$zipcode
				,'note'=>$note,'status'=>$status,'discount'=>$discount,'client'=>$client,'action_type'=>$action_type
			);
			$order['orderdetail'] = $orderdetail;
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$order));
		}
		else
		{
			$orderModel = $this->model('orderlist');
			$oid = $orderModel->create($order,$orderdetail);
			if($oid)
			{
				//用户订单数量+1
				$this->model('user')->where('id=?',array($uid))->increase('ordernum',1);
				//商品订单数量+1
				$this->model('product')->where('id=?',array($pid))->increase('ordernum',1);
				//商品库存减少
				$productHelper = new product();
				$productHelper->increaseNum($this->model('product'), $this->model('collection'), $pid, $content,-$num);
				$order = $orderModel->get($oid);
				$order['orderdetail'] = $orderModel->getOrderDetail($oid);
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$order));
			}
			return json_encode(array('code'=>2,'result'=>'订单创建失败'));
		}
	}
	
	/**
	 * 获取商品列表
	 * @return string
	 */
	function getlist()
	{
		$product = $this->model('product')->select();
		foreach($product as &$good)
		{
			$good['img'] = $this->model('productimg')->getByPid($good['id']);
			switch ($good['activity'])
			{
				case 'sale':$good['activity_description'] = $this->model('sale')->getByPid($good['id']);break;
				case 'seckill':$good['activity_description'] = $this->model('seckill')->getByPid($good['id']);break;
				case 'fullcut':$good['activity_description'] = $this->model('fullcutdetail')->getByPid($good['id']);break;
				default:break;
			}
			$goods['prototype'] = $this->model('prototype')->getByPid($good['id']);
			$goods['collection'] = $this->model('collection')->getByPid($good['id']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$product));
	}
	
	/**
	 * 导出商品数据
	 */
	function export()
	{
		$data = json_decode(htmlspecialchars_decode($this->get->data));
		$productModel = $this->model('product');
		if(!empty($data))
		{
			$productModel->where('id in (?)',array(implode(',', $data)));
		}
		$product = $productModel->select('id,sku,name,category,price,oldprice,stock,short_description,time');
		foreach($product as &$good)
		{
			$good['time'] = date('Y-m-d H:i:s',$good['time']);
			$good['category'] = $this->model('category')->get($good['id'],'name');
			unset($good['id']);
		}
		$excel = new excel();
		$excel->xls($product,array('商品货号','商品名称','分类','标价','市场价','库存','描述','添加时间'));
	}
	
	/**
	 * 获得一个商品的所有详细信息
	 */
	function information()
	{
		$this->response->addHeader('Content-Type','application/json');
		$pid = empty(filter::int($this->get->pid))?0:filter::int($this->get->pid);
		$productModel = $this->model('product');
		$product = $productModel->get($pid);
		if(!empty($product))
		{
			$prototypeModel = $this->model('prototype');
			$prototype = $prototypeModel->getByPid($pid);
			$product['prototype'] = $prototype;
			$collectionModel = $this->model('collection');
			$collection = $collectionModel->getByPid($pid);
			$product['collection'] = $collection;
			$product['category'] = $this->model('category')->get($product['category'],'name');
			$product['brand'] = $this->model('brand')->get($product['bid'],'name');
			$product['img'] = $this->model('productimg')->getByPid($pid);
			unset($product['bid']);
			switch ($product['activity'])
			{
				case 'sale':$product['activity_description'] = $this->model('sale')->getByPid($product['id']);break;
				case 'seckill':$product['activity_description'] = $this->model('seckill')->getByPid($product['id']);break;
				case 'fullcut':$product['activity_description'] = $this->model('fullcutdetail')->getByPid($product['id']);break;
				default:break;
			}
			if(login::user() && $this->model('favourite')->checkProduct($this->session->id,$product['id']))
			{
				$product['favourite'] = true;
			}
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$product));
		}
		return json_encode(array('code'=>0,'result'=>'商品不存在'));
	}
	
	/**
	 * 获得某一个分类下所有商品信息  包括子分类
	 */
	function category()
	{
		$this->response->addHeader('Content-Type','application/json');
		$cid = empty(filter::int($this->get->cid))?0:filter::int($this->get->cid);
		$start = empty(filter::int($this->get->start))?0:filter::int($this->get->start);
		$length = empty(filter::int($this->get->length))?5:filter::int($this->get->length);
		$array = array($cid);
		//获得子分类信息
		$categoryModel = $this->model('category');
		while (current($array) !== false)
		{
			$result = $categoryModel->fetchChild(current($array));
			foreach($result as $category)
			{
				if (!in_array($category['id'], $array))
				{
					//将子分类id加入数组
					$array[] = $category['id'];
				}
			}
			next($array);
		}
		//$array = implode(',', $array);
		$productModel = $this->model('product');
		$brandModel = $this->model('brand');
		$prototypeModel = $this->model('prototype');
		$productimgModel = $this->model('productimg');
		$productModel->limit($start,$length);
		$productModel->where('status=?',array(1));
		$productModel->where('stock>?',array(0));
		$productModel->where('(starttime=? or starttime<?) and (endtime=? or endtime>?)',array(0,$_SERVER['REQUEST_TIME'],0,$_SERVER['REQUEST_TIME']));
		$product = $productModel->where('category in (?)',$array)->select();
		foreach ($product as &$goods)
		{
			$goods['category'] = $categoryModel->get($goods['category'],'name');
			$goods['brand'] = $brandModel->get($goods['bid'],'name');
			unset($product['bid']);
			$goods['prototype'] = $prototypeModel->getByPid($goods['id']);
			$goods['img'] = $productimgModel->getByPid($goods['id']);
			switch ($goods['activity'])
			{
				case 'sale':$goods['activity_description'] = $this->model('sale')->getByPid($goods['id']);break;
				case 'seckill':$goods['activity_description'] = $this->model('seckill')->getByPid($goods['id']);break;
				case 'fullcut':$goods['activity_description'] = $this->model('fullcutdetail')->getByPid($goods['id']);break;
				default:break;
			}
			$goods['origin'] = $this->model('flag')->getOrigin($goods['origin']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$product));
	}
	
	/**
	 * 保存商品信息
	 * @return string
	 */
	function save()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_INSERT+$roleModel::POWER_UPDATE))
		{
			$productModel = $this->model('product');
			$id = $productModel->save($this->post);
			
			$pid = empty($this->post->id)?$id:$this->post->id;
			if(!empty($this->post->picid))
			{
				$picid = json_decode(htmlspecialchars_decode($this->post->picid));
				$productimgModel = $this->model('productimg');
				$productimgModel->updatepid($picid,$pid);
			}
			if(!empty($this->post->prototype_id))
			{
				$prototype_id = json_decode(htmlspecialchars_decode($this->post->prototype_id));
				$prototypeModel = $this->model('prototype');
				$prototypeModel->updatepid($prototype_id,$pid);
			}
			$this->model('log')->write($this->session->username,'修改了商品属性'.$id);
			return json_encode(array('code'=>1,'result'=>'ok','id'=>$id));
		}
		return json_encode(array('code'=>0,'result'=>'权限不足'));
	}
	
	/**
	 * 商品列表 页面
	 */
	function index()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/product.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$categoryModel = $this->model('category');
			$category = $categoryModel->select();
			$categoryHelper = new category();
			$category = $categoryHelper->format(0,$category);
			$this->view->assign('category',$category);
			
			$fullcutModel = $this->model('fullcut');
			$fullcut = $fullcutModel->fetchAll();
			$this->view->assign('fullcut',$fullcut);
			
			$themeModel = $this->model('theme');
			$theme = $themeModel->fetchAll();
			$this->view->assign('theme',$theme);
			
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 商品编辑页面
	 */
	function edit()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/product_edit.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			$productModel = $this->model('product');
			$result = $productModel->get($this->get->id);
			
			if($this->get->action == 'edit' && !empty($result))
			{
				$this->view->assign('product',$result);
			}
			else
			{
				$this->view->assign('new',1);
			}
			
			
			$categoryModel = $this->model('category');
			$category = $categoryModel->select();
			$category = (new category())->format(0,$category);
			$this->view->assign('category',$category);
			
			$brandModel = $this->model('brand');
			$brand = $brandModel->fetchAll();
			$this->view->assign('brand',$brand);
				
			$shipModel = $this->model('ship');
			$ship = $shipModel->select();
			$this->view->assign('ship',$ship);
			
			$flagModel = $this->model('flag');
			$flag = $flagModel->fetchAll();
			$this->view->assign('flag',$flag);
			
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 商品列表
	 * @return string
	 */
	function ajaxdatatable()
	{
		$productModel = $this->model('product');
		$resultObj = new \stdClass();
		try{
			if($this->post->customActionType == 'group_action')
			{
				$roleModel = $this->model('role');
				if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_SELECT))
				{
					if(!empty($this->post->customActionName))
					{
						$logModel = $this->model('log');
						foreach ($this->post->id as $id)
						{
							$logModel->write($this->session->username,'修改了商品('.$id.')的操作方式:'.$this->post->customActionName);
							switch ($this->post->customActionName)
							{
								case 1:
								case 2:$productModel->where('id=?',array($id))->update('status',$this->post->customActionName);break;
								case 3:$productModel->remove($id);break;
								default:break;
							}
						}
					}
				}
			}
		}
		catch (\Exception $e)
		{
			return json_encode(array('code'=>0,'result'=>'参数异常'));
		}
		
		$resultObj->draw = $this->post->draw;
		$result = $productModel->searchable($this->post);
		$resultObj->recordsTotal = $productModel->count();
		$resultObj->recordsFiltered = count($result);
		$result = array_slice($result, $this->post->start,$this->post->length);
		$brandModel = $this->model('brand');
		$prototypeModel = $this->model('prototype');
		$categoryModel = $this->model('category');
		$productimgModel = $this->model('productimg');
		foreach ($result as &$product)
		{
			if(isset($product['id']))
			{
				if(isset($product['bid']))
				{
					$product['brand'] = $brandModel->get($product['bid'],'name');
					unset($product['bid']);
				}
				$product['prototype'] = $prototypeModel->getByPid($product['id']);
				$product['img'] = $productimgModel->getByPid($product['id']);
				if(isset($product['category']))
				{
					$product['category'] = $categoryModel->get($product['category'],'name');
				}
				if(isset($product['activity']))
				{
					switch ($product['activity'])
					{
						case 'sale':$product['activity_description'] = $this->model('sale')->getByPid($product['id']);break;
						case 'seckill':$product['activity_description'] = $this->model('seckill')->getByPid($product['id']);break;
						case 'fullcut':$product['activity_description'] = $this->model('fullcutdetail')->getByPid($product['id']);break;
						default:break;
					}
				}
			}
			if(isset($product['origin']))
			{
				$product['origin'] = $this->model('flag')->getOrigin($product['origin']);
			}
		}
		$resultObj->data = $result;
		
		return json_encode($resultObj);
	}
}