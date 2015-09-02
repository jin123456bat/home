<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
use application\classes\excel;
use application\classes\alipay_gateway;
use application\classes\tenpay_gateway;
use application\classes\weixin_gateway;
use application\classes\product;
use system\core\file;
use application\model\orderlistModel;
use application\model\refundModel;
use application\classes\time;
/**
 * 订单控制器
 * @author jin12
 *
 */
class orderControl extends control
{
	/**
	 * 计划任务
	 * 关闭超时的订单
	 */
	function crontab()
	{
		$orderModel = $this->model('orderlist');
		$weixinprepayModel = $this->model('weixinprepay');
		$weixin = new weixin_gateway(config('weixin'),$this->model('system'));
		$timeout = (new time())->format($this->model('timeout','payment'), false);
		$result = $orderModel->where('status=? and createtime < ?',array(0,$_SERVER['REQUEST_TIME']-$timeout))->select();
		foreach($result as $order)
		{
			switch ($order['paytype'])
			{
				case 'weixin':
					//删除数据缓存的预支付订单
					$weixinprepayModel->remove($order['orderno']);
					//重新检查一次订单状态
					$response = $weixin->query($order);
					if(isset($response['trade_state']) && $response['trade_state'] == 'SUCCESS')
					{
						$content = $response;
						//交易成功
						if($orderModel->setStatus($content['out_trade_no'],orderlistModel::STATUS_FINISH,$content['time_end'],$content['cash_fee']/100,$content['transaction_id']))
						{
							//增加一下用户的消费金额
							$this->model('user')->where('id=?',array($order['uid']))->increase('cost',$content['cash_fee']/100);
							//给用户一定的积分
							$orderdetail = $orderModel->getOrderDetail($order['id']);
							foreach ($orderdetail as $ordergoods)
							{
								if($ordergoods['score'] != 0)
									$this->model('user')->where('id=?',array($order['uid']))->increase('score',$ordergoods['score']);
								//增加商品的销售量
								$this->model('product')->where('id=?',array($ordergoods['pid']))->increase('complete_ordernum',$ordergoods['num']);
							}
						}
					}
					else 
					{
						//关闭微信的预支付订单
						$weixin->close($order);
					}
					break;
				default:
					break;
			}
			//设置订单状态为关闭
			$orderModel->setStatus($order['id'],orderlistModel::STATUS_CLOSE,$_SERVER['REQUEST_TIME'],0,'');
			//将商品库存回退
			$goods = $orderModel->getOrderDetail($order['id']);
			$productHelper = new product();
			foreach ($goods as $product)
			{
				$productHelper->increaseNum($this->model('product'), $this->model('collection'), $product['pid'], $product['content'],$product['num']);
			}
		}
	}
	
	/**
	 * 订单详情页面
	 */
	function information()
	{
		$id = filter::int($this->get->id);
		if(!empty($id))
		{
			$this->view = new view(config('view'), 'admin/order_information.html');
			$orderModel = $this->model('orderlist');
			$orderModel->table('user','left join','user.id=orderlist.uid');
			$result = $orderModel->where('orderlist.id=?',array($id))->select();
			$goods = $orderModel->getOrderDetail($id);
			if(isset($result[0]))
			{
				$result[0]['gravatar'] = file::realpathToUrl($result[0]['gravatar']);
				$this->view->assign('order',$result[0]);
				$this->view->assign('goods',$goods);
				if(!empty($_SERVER['HTTP_REFERER']))
				{
					$this->view->assign('last_page',$_SERVER['HTTP_REFERER']);
				}
				return $this->view->display();
			}
			else
			{
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('admin','__404'));
			}
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('index','__404'));
		}
	}
	
	/**
	 * 为订单添加备注
	 */
	function note()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::admin())
			return json_encode(array('code'=>2,'result'=>'权限不足'));
		$id = filter::int($this->post->id);
		$note = $this->post->note;
		if(empty($id))
		{
			return json_encode(array('code'=>0,'result'=>'参数错误'));
		}
		$orderModel = $this->model('orderlist');
		if($orderModel->note($id,$note))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>1,'result'=>'ok'));
	}
	
	/**
	 * 订单导出
	 */
	function export()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'orderlist',roleModel::POWER_SELECT))
		{
			if(!empty($this->get->id))
			{
				$id = json_decode(htmlspecialchars_decode($this->get->id));
			}
			else
			{
				$id = array();
			}
			$orderModel = $this->model('orderlist');
			$order = $orderModel->export('orderno,paytype,paynumber,ordertotalamount,ordertaxamount,ordergoodsamount,feeamount,tradetime,totalamount,consigneetel,consignee,zipcode,consigneeprovince,consigneecity,consigneeaddress,postmode,telephone,sku,productname,unitprice,num',$id);
			$excel = new excel();
			$excel->xls($order,array('订单号','支付方式','支付编号','订单总金额','订单税额','订单货款','运费','成交时间','成交总价','收件人联系方式','收件人姓名','收件人邮编','收件人省','收件人市','收件人地址','物流公司编码','购买人ID','商品编码','商品名称','申报单价','申报数量'),'order');
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 取消订单
	 */
	function cancle()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$id = filter::int($this->post->id);
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if(!empty($order))
		{
			if($order['status'] == orderlistModel::STATUS_PAYING && $order['uid'] == $this->session->id)
			{
				if($orderModel->setStatus($id,orderlistModel::STATUS_QUITE,$_SERVER['REQUEST_TIME'],0,''))
				{
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_encode(array('code'=>3,'result'=>'取消订单失败'));
			}
			return json_encode(array('code'=>0,'result'=>'订单无法取消'));
		}
		return json_encode(array('code'=>4,'result'=>'订单不存在'));
	}
	
	/**
	 * 订单结算
	 */
	function payment()
	{
		$id = filter::int($this->get->id);
		if(!empty($id))
		{
			$orderModel = $this->model('orderlist');
			$order = $orderModel->get($id);
			$orderdetail = $orderModel->getOrderDetail($id);
			if(!empty($order))
			{
				if($order['status'] != 0)
					return json_encode(array('code'=>6,'result'=>'该订单已经结算过了'));
				$trade_type = $this->get->trade_type;
				switch($order['paytype'])
				{
					case 'weixin':
						if(empty($trade_type))
							return json_encode(array('code'=>5,'result'=>'需要指定支付方式'));
						//假如是微信，则将所有参数转发给weixin_gateway由weixin_gateway来处理各种参数
						$weixin = new weixin_gateway(config('weixin'),$this->model('system'));
						$weixinprepayModel = $this->model('weixinprepay');
						$result = $weixinprepayModel->get($order['orderno']);
						if(!empty($result) && $_SERVER['REQUEST_TIME']-$result['createtime']<1800)
						{
							//假如缓存中的预支付订单存在则处理缓存中的预支付订单
							$data = $weixin->output($result['prepay_id']);
							switch ($trade_type)
							{
								case 'app':
									return json_encode($data);
								default:
									$view = new view(config('view'), 'wechatpay.html');
									$view->assign('data', $data);
									return $view->display();
							}
						}
						
						$weixin->setGetParameter($this->get);
						$weixin->setPostParameter($this->post);
						$response = $weixin->submit($order, $orderdetail);
						if($response['action'] == 'redict')
						{
							//内部跳转
							$this->response->setCode(302);
							$this->response->addHeader('Location',$response['content']);
							$this->response->send();
						}
						else if($response['action'] == 'return')
						{
							//success
							$weixinprepayModel->create($order['orderno'],$response['content']);
							$data = $weixin->output($response['content']['prepay_id']);
							switch ($trade_type)
							{
								case 'app':
									return json_encode($data);
								default:
									$view = new view(config('view'), 'wechatpay.html');
									$view->assign('data', $data);
									return $view->display();
									//break;
							}
						}
						else if($response['action'] =='error')
						{
							//订单支付过程中出现错误
							return json_encode(array('code'=>0,'result'=>'failed','body'=>$response['content']));
						}
						break;
					case 'alipay':
						$alipay = new alipay_gateway(config('alipay'),$this->model('system'),$trade_type);
						$result = $alipay->submit($order,$orderdetail);
						switch ($result['code'])
						{
							case 'success':
								$view = new view(config('view'), 'alipay.html');
								$view->assign('data',$result['content']);
								return $view->display();
								break;
							case 'error':
								return $result['content'];
							default:break;
						}
						break;
					case 'tenpay':
						$tenpay = new tenpay_gateway(config('tenpay'));
						return $tenpay->submit($order, $orderdetail);
						
					default:return json_encode(array('code'=>4,'result'=>'支付类型错误'));
				}
			}
			return json_encode(array('code'=>2,'result'=>'订单不存在'));
		}
		return json_encode(array('code'=>3,'result'=>'参数错误'));
	}
	
	/**
	 * 订单退款请求  尚未完成
	 */
	function refund()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'refund',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->get->id);
			if(!empty($id))
			{
				$refund = $this->model('refund')->get($id);
				if($refund['handle'] == refundModel::REFUND_HANDLE_NO)
				{
					$order = $this->model('orderlist')->get($refund['oid']);
					if(!empty($order))
					{
						if($order['status'] == 1)
						{
							switch ($order['paytype'])
							{
								case 'weixin':
									$weixin = new weixin_gateway(config('weixin'),$this->model('system'));
									$response = $weixin->refund($refund,$order);
									if($response)
									{
										if($response['result_code'] == 'SUCCESS')
										{
											return json_encode(array('code'=>1,'result'=>'微信正在处理退款，请稍后'));
										}
										else
										{
											return json_encode(array('code'=>11,'result'=>'申请退款失败'.$response['err_code_des']));
										}
									}
									else
									{
										return json_encode(array('code'=>10,'result'=>'微信接口通信失败，请检查微信配置'));
									}
									break;
								default:
									break;
							}
						}
						else
						{
							return json_encode(array('code'=>0,'result'=>'该订单无法退款'));
						}
					}
					else
					{
						return json_encode(array('code'=>2,'result'=>'没有找到订单'));
					}
				}
				else
				{
					return json_encode(array('code'=>5,'result'=>'退款申请已经关闭或已经完成'));
				}
			}
			else
			{
				return json_encode(array('code'=>3,'result'=>'参数错误'));
			}
		}
		else
		{
			return json_encode(array('code'=>4,'result'=>'没有权限'));
		}
	}
	
	/**
	 * 异步通知控制器
	 */
	function notify()
	{
		/**
		 * 保存订单的一些基本信息
		 */
		$orderno = ''; //订单编号
		$time = 0; //支付交易时间
		$paynumber = '';//支付单号
		$tradetotal = 0;//交易金额
		
		
		$result = false;//订单是否交易成功状态
		$orderModel = $this->model('orderlist');
		//从微信或者支付宝的响应信息中获得需要的参数
		switch ($this->get->type)
		{
			case 'weixin':
				//微信支付的异步回调页面
				$weixin = new weixin_gateway(config('weixin'),$this->model('system'));
				//$weixin->
				$content = file_get_contents('php:://input');
				$content = simplexml_load_string($content);
				$content = $weixin->xmlToArray($content);
				if($weixin->verifyResult($content))
				{
					$orderno = $content['out_trade_no'];
					$time = $content['time_end'];
					$paynumber = $content['transaction_id'];
					$tradetotal = $content['cash_fee']/100;
					
					//订单尚未处理
					if($content['result_code'] == 'SUCCESS')
					{
						//代表支付成功
						$result = true;
					}
				}
				else
				{
					return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[这回该你校验失败了吧！！哈哈！！]]></return_msg></xml>';
				}
				break;
			case 'alipay':
				if($this->post->notify_type == 'trade_status_sync')
				{
					$time = strtotime($this->post->notify_time);//交易完成时间
					$notify_id = $this->post->notify_id;//通知id
					$sign_type = $this->post->sign_type;//签名方式
					$sign = $this->post->sign;//签名
					$orderno = $this->post->out_trade_no;//订单号
					$paynumber = $this->post->trade_no;//支付单号
					$tradetotal = $this->post->total_fee;//外币总额
					
					$status = $this->post->trade_status;//状态
					
					$alipay = new alipay_gateway(config('alipay'), $this->model('system'), '');
					if($alipay->verify_notify($notify_id))
					{
						$parameter = $alipay->filterParameter($_POST);
						ksort($parameter);
						reset($parameter);
						if($alipay->sign($parameter,$sign_type) != $this->post->sign)
							return 'sign error';
						if ($status == 'TRADE_FINISHED')
						{
							//代表支付成功
							$result = true;
						}
						if($status == 'TRADE_CLOSED')
						{
							//交易关闭
						}
						if($status == 'WAIT_BUYER_PAY')
						{
							//交易创建
						}
						if($status == 'TRADE_SUCCESS')
						{
							//一般使用担保交易才会发出这个通知
						}
					}
				}
				break;
			default:break;
		}
		
		//获取订单信息
		$order = $orderModel->where('orderno=?',array($orderno))->select();
		if(empty($order))
			return false;
		$order = $order[0];
		
		if($result)
		{
			//交易成功
			if($orderModel->setStatus($orderno,orderlistModel::STATUS_FINISH,$time,$tradetotal,$paynumber))
			{
				$userModel = $this->model('user');
				//增加一下用户的消费金额
				$userModel->where('id=?',array($order['uid']))->increase('cost',$tradetotal);
				$oid = $userModel->get($order['uid'],'oid');
				//给推广员增加推广费
				if(!empty($oid))
				{
					$o2oModel = $this->model('o2ouser');
					$o2o = $o2oModel->get($oid);
					if(!empty($o2o))
					{
						$money = $o2o['rate'] * $tradetotal;
						$o2oModel->where('id=?',array($o2o['id']))->increase('money',$money);
					}
				}
				//给用户一定的积分
				$orderdetail = $orderModel->getOrderDetail($order['id']);
				foreach ($orderdetail as $ordergoods)
				{
					if($ordergoods['score'] != 0)
						$this->model('user')->where('id=?',array($order['uid']))->increase('score',$ordergoods['score']);
					//增加商品的销售量
					$this->model('product')->where('id=?',array($ordergoods['pid']))->increase('complete_ordernum',$ordergoods['num']);
				}
				if ($this->get->type == 'weixin')
				{
					//删除数据缓存的预支付订单
					$this->model('weixinprepay')->remove($order['orderno']);
					return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
				}
				else if($this->get->type == 'alipay')
				{
					return 'success';
				}
				else
				{
					return "请明确一下type";
				}
			}
			else
			{
				return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[交易数据无法更改]]></return_msg></xml>';
			}
		}
		else
		{
			//交易失败，关闭订单
			$this->model('orderlist')->setStatus($content['out_trade_no'],orderlistModel::STATUS_CLOSE,$_SERVER['REQUEST_TIME'],0,'');
			$productHelper = new product();
			//将订单中的商品回退
			$goods = $orderModel->getOrderDetail($order['id']);
			if($this->get->type == 'weixin')
			{
				//删除数据缓存的预支付订单
				$this->model('weixinprepay')->remove($order['orderno']);
				//关闭微信的订单
				$weixin->close($order);
				foreach ($goods as $product)
				{
					$productHelper->increaseNum($this->model('product'), $this->model('collection'), $product['pid'], $product['content'],$product['num']);
				}
				return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[不给钱还想通过?]]></return_msg></xml>';
			}
		}
	}
	
	/**
	 * 订单完成同步页面
	 */
	function thankyou()
	{
		$id = filter::int($this->get->id);
		if(!empty($id))
		{
			$order = $this->model('orderlist')->get($id);
			if(isset($order['status']))
			{
				switch ($order['status'])
				{
					case 0:echo "尚未支付";break;
					case 1:echo "支付成功";break;
					case 2:echo "支付失败";break;
					case 3:echo "用户取消";break;
					default:echo "订单状态未知";break;
				}
			}
		}
		else
		{
			$this->call('index', '__404');
		}
	}
	
	/**
	 * 获得某商品下的所有订单
	 */
	function product()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'orderlist',roleModel::POWER_ALL))
		{
			$pid = filter::int($this->get->pid);
			$orderModel = $this->model('orderlist');
			$result = $orderModel->searchable($this->post,$pid);
			$resultObj = new \stdClass();
			$resultObj->draw = $this->post->draw;
			$resultObj->recordsTotal = $orderModel->count();
			$resultObj->recordsFiltered = count($result);
			$resultObj->data = array_slice($result, $this->post->start,$this->post->length);
			return json_encode($resultObj);
		}
		else
		{
			$this->response->setCode(403);
		}
	}
	
	/**
	 * 订单列表页面
	 */
	function orderlist()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'orderlist',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/order_orderlist.html');
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('index','__404'));
		}
	}
	
	/**
	 * 获取用户的所有订单信息
	 */
	function myorder()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
		{
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		}
		else
		{
			$start = filter::int($this->get->start);
			$length = filter::int($this->get->length);
			$orderModel = $this->model('orderlist');
			$result = $orderModel->fetchAll($this->session->id,$start,$length);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
	}
	
	/**
	 * 订单评分
	 */
	function score()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$id = filter::int($this->post->id);
		$ship_score = filter::int($this->post->ship_score);
		$service_score = filter::int($this->post->service_score);
		$goods_score = filter::int($this->post->goods_score);
		$content = $this->post->content;
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if($order['status'] == orderlistModel::STATUS_SHIPPED)
		{
			if($orderModel->score($id,$this->session->id,$ship_score,$service_score,$goods_score,$content))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'评论失败'));
		}
		return json_encode(array('code'=>3,'result'=>'请等待发货完毕在评分吧'));
	}
	
	/**
	 * 获取指定用户的订单信息
	 */
	function user()
	{
		$this->response->addHeader('Content-Type','application/json');
		$uid = filter::int($this->get->uid);
		if(!empty($uid))
		{
			$orderModel = $this->model('orderlist');
			$result = $orderModel->fetchAll($uid);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
		return json_encode(array('code'=>0,'result'=>'no user'));
	}
	
	/**
	 * ajax请求所有订单数据
	 */
	function ajaxorderlist()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'orderlist',roleModel::POWER_ALL))
		{
			if(!empty($this->post->customActionType) && $this->post->customActionType == 'group_action')
			{
				$orderlistModel = $this->model('orderlist');
				$id = $this->post->id;
				switch ($this->post->customActionName)
				{
					case 'remove':$orderlistModel->remove($id);break;
				}
			}
			$resultObj = new \stdClass();
			$resultObj->draw = $this->post->draw;
			$orderModel = $this->model('orderlist');
			$result = $orderModel->searchable($this->post);
			foreach ($result as &$order)
			{
				$order['refund'] = $this->model('refund')->getByOid($order['id']);
			}
			$resultObj->recordsFiltered = count($result);
			$resultObj->recordsTotal = $orderModel->count();
			$resultObj->data = array_slice($result, $this->post->start,$this->post->length);
			return json_encode($resultObj);
		}
		return false;
	}
}