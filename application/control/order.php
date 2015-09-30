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
use application\message\json;
use application\classes\cbti;
use application\classes\express;
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
						if($orderModel->setStatus($content['out_trade_no'],orderlistModel::STATUS_PAYED,$content['time_end'],$content['cash_fee']/100,$content['transaction_id']))
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
			$orderModel->setStatus($order['orderno'],orderlistModel::STATUS_CLOSE,$_SERVER['REQUEST_TIME'],0,'');
			//将商品库存回退
			$goods = $orderModel->getOrderDetail($order['id']);
			$productHelper = new product();
			foreach ($goods as $product)
			{
				$productHelper->increaseNum($this->model('product'), $this->model('collection'), $product['pid'], $product['content'],$product['num']);
			}
		}
	}
	
	function query()
	{
		$id = $this->get->id;
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		$weixin = new weixin_gateway(config('weixin'), $this->model('system'));
		$result = $weixin->query($order);
		var_dump($result);
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
			if($this->get->type === 'json')
			{
				$result['orderdetail'] = $goods;
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
			}
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
		$this->response->addHeader('cache-control','nocache');
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
			
			$filter = array(
				'status' => $this->get->status
			);
			
			$select_field = 'orderno,paytype,paynumber,ordertotalamount,ordertaxamount,ordergoodsamount,feeamount,tradetime,totalamount,consigneetel,consignee,zipcode,consigneeprovince,consigneecity,consigneeaddress,postmode,username,sku,productname,unitprice,num';
			$select_name = array('订单号','支付方式','支付编号','订单总金额','订单税额','订单货款','运费','成交时间','成交总价','收件人联系方式','收件人姓名','收件人邮编','收件人省','收件人市','收件人地址','物流公司编码','购买人ID','商品编码','商品名称','申报单价','申报数量');
			$filename = '订单报表 '.date('Y-m-d H:i:s');
			if($filter['status'] === '1')
			{
				$filename = '待报关订单 '.date('Y-m-d H:i:s');
				$select_field = 'orderno,paytype,paynumber,ordertotalamount,tradetime,consigneetel,consignee,zipcode,consigneeprovince,consigneecity,consigneeaddress,postmode,username,sku,unitprice,num';
				$select_name = array('订单号','支付方式','支付单号','订单总金额','成交时间','收件人联系方式','收件人姓名','收件人邮编','收件人省','收件人市','收件人地址','物流公司编码','购买人ID','商品编码','商品名称','商品单价','申报数量');
			}
			
			$orderModel = $this->model('orderlist');
			$order = $orderModel->export($select_field,$id,$filter);
			$excel = new excel();
			$excel->xls($order,$select_name,$filename);
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 导入物流订单
	 */
	function import()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'orderlist',roleModel::POWER_ALL))
		{
			if(isset($_FILES['file']['tmp_name']) && is_file($_FILES['file']['tmp_name']));
			{
				$cover = empty($this->post->cover)?true:false;
				$orderModel = $this->model('orderlist');
				$file = file($_FILES['file']['tmp_name']);
				foreach ($file as $line)
				{
					$pattern = '$\d+$';
					if(preg_match_all($pattern, $line,$match));
					{
						if(count($match[0]) == 2)
						{
							$orderno = $match[0][0];
							$waybills = array_slice($match[0], 1);
							$orderModel->updateWaybill($orderno,$waybills,$cover);
						}
					}
				}
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR,'文件上传失败');
		}
		return new json(json::NO_POWER);
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
				if($orderModel->setStatus($order['orderno'],orderlistModel::STATUS_QUITE,$_SERVER['REQUEST_TIME'],0,''))
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
									$view->assign('id', $id);
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
									$view->assign('id', $id);
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
						$refund_array = array(orderlistModel::STATUS_COMPLETE,orderlistModel::STATUS_PAYED,orderlistModel::STATUS_SHIPPED,orderlistModel::STATUS_SHIPPING);
						if(in_array($order['status'], $refund_array))
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
											return new json(json::OK,'微信正在处理退款，请稍后');
										}
										else
										{
											return new json(11,'申请退款失败'.$response['err_code_des']);
										}
									}
									else
									{
										return new json(10,'微信接口通信失败，请检查微信配置');
									}
									break;
								case 'alipay':
									$alipay = new alipay_gateway(config('alipay'), $this->model('system'), '');
									$response = $alipay->refund($refund, $order);
									if($response['is_success'] == 'F')
									{
										return new json(json::PARAMETER_ERROR,$response['error']);
									}
									return new json(json::OK);
								default:
									break;
							}
						}
						else
						{
							return new json(6,'订单无法退款');
						}
					}
					else
					{
						return new json(5,'退款对应的订单不存在');
					}
				}
				else
				{
					return new json(4,'退款申请已经关闭或已经完成');
				}
			}
			else
			{
				return new json(json::PARAMETER_ERROR);
			}
		}
		else
		{
			return new json(json::NO_POWER);
		}
	}
	
	/**
	 * 出关
	 */
	function outship()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$id = $this->post->id;
			$orderModel = $this->model('orderlist');
			$order = $orderModel->get($id);
			if(empty($order))
				return new json(json::PARAMETER_ERROR,'订单不存在');
			if($order['status'] == orderlistModel::STATUS_SHIPPING)
			{
				if($orderModel->where('id=?',array($id))->update('outship',1))
				{
					return new json(json::OK);
				}
				return new json(json::PARAMETER_ERROR,'已经出关了');
			}
			return new json(json::PARAMETER_ERROR,'订单状态不符合');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 订单报关
	 */
	function costums($id = NULL)
	{
		if(!login::admin())
			return new json(json::NOT_LOGIN);
		$id = ($id === NULL)?$this->post->id:$id;
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		
		if(empty($order))
			return new json(json::PARAMETER_ERROR,'没有找到订单');
		if($order['status'] != orderlistModel::STATUS_PAYED)
			return new json(json::PARAMETER_ERROR,'无法报关');
		switch ($order['paytype'])
		{
			case 'alipay':
				$alipay = new alipay_gateway(config('alipay'), $this->model('system'), $this->get->trade_type);
				$result = $alipay->customs($order);
				$result = xmlToArray($result);
				if($result['is_success'] == 'F')
					return new json(4,'支付宝报关接口错误');
				if($result['response']['alipay']['result_code'] == 'FAIL')
					return new json(4,$result['response']['alipay']['detail_error_des']);
				//获取到订单编号
				$orderno = $result['request']['param'][7];
				break;
			case 'weixin':
				$weixin = new weixin_gateway(config('weixin'), $this->model('system'));
				$result = $weixin->costums($order);
				if($result['retcode'] != 0)
					return new json($result['retcode'],$result['retmsg']);
				//获取订单编号
				$orderno = $result['out_trade_no'];
				break;
			default:
				return new json(json::PARAMETER_ERROR,'通过支付方式报关失败');
		}
		if($orderModel->setShipping($orderno))
		{
			return new json(json::OK);
		}
		return new json(json::PARAMETER_ERROR,'订单不存在或者已经发货');
	}
	
	/**
	 * 获取订单物流信息
	 */
	function shippment()
	{
		$id = filter::int($this->get->id);
		
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if(empty($order))
			return new json(json::PARAMETER_ERROR,'订单不存在');
		
		if(empty($order['shiptime']))
			return new json(json::PARAMETER_ERROR,'尚未发货');
		if (empty($order['waybills']))
			return new json(json::PARAMETER_ERROR,'没有物流单号');
		
		//检查缓存中的物流信息
		$waybillsModel = $this->model('waybills');
		$waybills = $waybillsModel->getByOrderno($order['orderno']);
		if($waybills !== NULL)
		{
			if($_SERVER['REQUEST_TIME'] - $waybills['time'] < 12*3600)
			{
				$data = array(
					'code' => 1,
					'result' => 'ok',
					'data' => json_decode($waybills['content']),
					'waybills' => implode(',', unserialize($waybills['waybills'])),
					'postmode'=>$waybills['postmode']
				);
				return new json($data);
			}
		}
		//查询物流信息
		$return = array();
		$express = new express();
		
		
		$wbills = unserialize($order['waybills']);
		
		$response = $express->query($order['postmode'],$wbills[0]);
		
		$response = json_decode($response);
		if($response->status == 200)
		{
			//查询到了官方的信息
			$return = (array)$response->data;
			foreach ($return as &$value)
			{
				unset($value->ftime);
				$value = (array)$value;
			}
		}
	
		//生成虚拟物流信息
		$response = $express->virtual($order['shiptime'],$order['outship']);
		$return = array_merge($return,$response);
		$waybillsModel->create($order['postmode'],$return,$wbills,$order['orderno']);
		
		$data = array(
			'code' => 1,
			'result' => 'OK',
			'body' => $return,
			'waybills' => implode(',', unserialize($order['waybills'])),
			'postmode' => $order['postmode']
		);
		return new json($data);
		//return new json(json::PARAMETER_ERROR,'尚未发货');
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
				$content = file_get_contents('php://input');
				$content = simplexml_load_string($content);
				$content = $weixin->xmlToArray($content);
				if($weixin->verifyResult($content))
				{
					$orderno = $content['out_trade_no'];
					$time = $content['time_end'];
					$paynumber = $content['transaction_id'];
					$tradetotal = $content['cash_fee']/100;
					
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
				$log = json_encode($_POST);
				file_put_contents('./alipay_notify.txt', $log);
				
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
					
					$partner = $this->post->seller_id;//商户号
					$alipay = new alipay_gateway(config('alipay'), $this->model('system'), '');
					
					if($alipay->verify_notify($notify_id,$partner))
					{
						$parameter = $alipay->filterParameter($_POST);
						ksort($parameter);
						reset($parameter);
						switch (strtoupper(trim($sign_type)))
						{
							case 'MD5':
								if($alipay->sign($parameter,$sign_type) != $this->post->sign)
									return 'sign error';
								break;
							case 'RSA':
								if(!$alipay->rsaVerify($alipay->toString($parameter), $this->model('system')->get('rsapublickey','alipay'), $sign))
								{
									return 'sign error';
								}
								break;
						}
						if ($status == 'TRADE_FINISHED')
						{
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
							$result = true;
						}
					}
				}
				break;
			default:break;
		}
		
		//获取订单信息
		$order = $orderModel->where('orderno=?',array($orderno))->select();
		
		if(empty($order))
			return "订单不存在";
		$order = $order[0];
		
		if($result)
		{
			//交易成功
			if($orderModel->setStatus($order['orderno'],orderlistModel::STATUS_PAYED,$time,$tradetotal,$paynumber))
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
						$o2oModel->where('uid=?',array($o2o['uid']))->increase('money',$money);
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
			}
			else
			{
				return "更改订单状态失败";
			}
		}
		else
		{
			//交易失败，关闭订单
			/*
			$this->model('orderlist')->setStatus($order['orderno'],orderlistModel::STATUS_CLOSE,$_SERVER['REQUEST_TIME'],0,'');
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
			else
			{
				echo "支付宝支付失败";
			}
			*/
			return "支付失败";
		}
	}
	
	/**
	 * 订单支付完毕
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
					case 0:return "尚未支付";break;
					case 1:return "支付成功";break;
					case 2:return "支付失败";break;
					case 3:return "用户取消";break;
					default:return "订单状态未知";break;
				}
			}
		}
		else
		{
			$this->call('index', '__404');
		}
	}
	
	/**
	 * 支付失败同步页面
	 */
	function failed()
	{
		
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
			$status = filter::int($this->get->status);
			$start = filter::int($this->get->start);
			$length = filter::int($this->get->length);
			$orderModel = $this->model('orderlist');
			$result = $orderModel->fetchAll($this->session->id,$status,$start,$length);
			foreach($result as &$order)
			{
				$order['orderdetail'] = $orderModel->getOrderDetail($order['id']);
			}
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
		
		if(empty($this->post->comment))
			return new json(json::PARAMETER_ERROR,'没有商品评论');
		
		$commentModel = $this->model('comment');
		
		
		
		
		foreach ($this->post->comment as $pid => $content)
		{
			
			$files = $content['pic'];
			
			$content['score'] = empty($content['score'])?0:$content['score'];
			$content['score'] = $content['score']>5?5:$content['score'];
			$content['content'] = empty($content['content'])?'':$content['content'];
			$commentModel->create($this->session->id,$pid,$content['content'],$content['score'],$files);
		}
		
		$id = filter::int($this->post->id);
		$ship_score = filter::int($this->post->ship_score);
		$service_score = filter::int($this->post->service_score);
		$goods_score = filter::int($this->post->goods_score);
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if($order['status'] == orderlistModel::STATUS_SHIPPED)
		{
			if($orderModel->score($id,$this->session->id,$ship_score,$service_score,$goods_score))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'评论失败'));
		}
		return json_encode(array('code'=>3,'result'=>'请等待发货完毕在评分吧'));
	}
	
	/**
	 * 订单确认收货
	 */
	function shipped()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$id = filter::int($this->post->id);
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if(empty($order))
			return json_encode(array('code'=>3,'result'=>'订单不存在'));
		if($order['status'] == orderlistModel::STATUS_SHIPPING)
		{
			if($orderModel->setShipped($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'订单状态已经更改过了'));
		}
		return json_encode(array('code'=>0,'result'=>'该订单状态不符合'));
	}
	
	/**
	 * 提醒发货
	 */
	function shipalert()
	{
		if(!login::user())
		{
			if(login::admin())
			{
				if($this->post->ok === '1')
				{
					$id = $this->post->id;
					$shipalertModel = $this->model('shipalert');
					if($shipalertModel->ok($id))
					{
						return new json(json::OK);
					}
					return new json(json::PARAMETER_ERROR);
				}
			}
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		}
		$id = $this->post->id;
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if(empty($order))
			return json_encode(array('code'=>3,'result'=>'订单不存在'));
		if($order['status'] == orderlistModel::STATUS_PAYED)
		{
			if($this->model('shipalert')->create($this->session->id,$id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'已经提醒过了'));
		}
		return json_encode(array('code'=>4,'result'=>'订单状态不符合'));
	}
	
	/**
	 * 取消订单接口
	 */
	function quit()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$id = filter::int($this->post->id);
		$orderModel = $this->model('orderlist');
		$order = $orderModel->get($id);
		if(empty($order))
			return json_encode(array('code'=>3,'result'=>'没有订单'));
		if($order['status'] == orderlistModel::STATUS_PAYING)
		{
			if($orderModel->quit($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
		}
		return json_encode(array('code'=>0,'result'=>'订单状态无法更改'));
	}
	
	/**
	 * 订单的商品列表
	 */
	function productlist()
	{
		$id = filter::int($this->get->id);
		$orderModel = $this->model('orderlist');
		$result = $orderModel->getOrderDetail($id);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	
	/**
	 * 获取指定用户的订单信息
	 */
	function user()
	{
		$roleModel = $this->model('role');
		if($roleModel->checkPower($this->session->role,'orderlist',roleModel::POWER_SELECT))
		{
			$this->response->addHeader('Content-Type','application/json');
			$uid = filter::int($this->get->uid);
			if(!empty($uid))
			{
				$orderModel = $this->model('orderlist');
				$result = $orderModel->fetchAll($uid);
				foreach($result as &$order)
				{
					$order['orderdetail'] = $orderModel->getOrderDetail($order['id']);
				}
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
			}
			return json_encode(array('code'=>0,'result'=>'no user'));
		}
		return json_encode(array('code'=>3,'result'=>'没有权限'));
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
					case 'costums':
						foreach ($this->post->id as $id)
						{
							$this->costums($id);
						}
						break;
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