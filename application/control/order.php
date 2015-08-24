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
/**
 * 订单控制器
 * @author jin12
 *
 */
class orderControl extends control
{
	/**
	 * 计划任务
	 * 关闭超时30分钟仍在正在支付的订单
	 */
	function crontab()
	{
		$orderModel = $this->model('orderlist');
		$weixinprepayModel = $this->model('weixinprepay');
		$weixin = new weixin_gateway(config('weixin'));
		$result = $orderModel->where('status=?',array(0))->select();
		foreach($result as $order)
		{
			if($order['status'] == 0 && $_SERVER['REQUEST_TIME']-$order['createtime']>1800)
			{
				switch ($order['paytype'])
				{
					case 'weixin':
						//删除数据库的预支付订单
						$weixinprepayModel->remove($order['orderno']);
						//关闭微信的预支付订单
						$weixin->close($order);
						break;
					default:
						break;
				}
				//设置订单状态为关闭
				$orderModel->setStatus($order['id'],2,0,0,'');
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
				$this->call('index', '__404');
			}
			
		}
		else
		{
			$this->call('index', '__404');
		}
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
				switch($order['paytype'])
				{
					case 'weixin':
						if(empty($this->get->trade_type))
							return json_encode(array('code'=>5,'result'=>'需要指定支付方式'));
						//假如是微信，则将所有参数转发给weixin由weixin来处理各种参数
						$weixin = new weixin_gateway(config('weixin'));
						$weixinprepayModel = $this->model('weixinprepay');
						$result = $weixinprepayModel->get($order['orderno']);
						if(!empty($result) && $_SERVER['REQUEST_TIME']-$result['createtime']<2*3600)
						{
							$view = new view(config('view'), 'wechatpay.html');
							$data = $weixin->output($result['prepay_id']);
							$view->assign('data', $data);
							return $view->display();
							//这里找到了预订单信息
							//return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
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
							//$this->response->addHeader('Content-Type','text/html; charset=utf-8');
							$weixinprepayModel->create($order['orderno'],$response['content']);
							$view = new view(config('view'), 'wechatpay.html');
							$data = $weixin->output($response['content']['prepay_id']);
							$view->assign('data', $data);
							return $view->display();
							//return $weixin->output($response['content']['prepay_id']);
							//这里找到了预订单信息
							//return json_encode(array('code'=>1,'result'=>'ok','body'=>$response['content']));
						}
						else if($response['action'] =='error')
						{
							//微信那边出现错误
							return json_encode(array('code'=>0,'result'=>'failed','body'=>$response['content']));
						}
						break;
					case 'alipay':
						$this->response->addHeader('Content-Type','text/html;charset=utf-8');
						$alipay = new alipay_gateway(config('alipay'));
						$result = $alipay->submit($order,$orderdetail);
						return $result;
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
	 * 异步通知控制器
	 */
	function notify()
	{
		switch ($this->get->type)
		{
			case 'weixin':
				//微信支付的异步回调页面
				$weixin = new weixin_gateway(config('weixin'));
				//$weixin->
				$content = file_get_contents('php:://input');
				$content = simplexml_load_string($content);
				$content = $weixin->xmlToArray($content);
				if($weixin->verifyResult($content))
				{
					$orderModel = $this->model('orderlist');
					$order = $orderModel->where('orderno=?',array($content['out_trade_no']))->select();
					if(empty($order))
						return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[你确定这个订单存在???]]></return_msg></xml>';
					$order = $order[0];
					if($order['status'] == 0)
					{
						//订单尚未处理
						if($content['result_code'] == 'SUCCESS')
						{
							//交易成功
							if($orderModel->setStatus($content['out_trade_no'],1,$content['time_end'],$content['cash_fee']/100,$content['transaction_id']))
							{
								//增加一下用户的消费金额
								$this->model('user')->where('id=?',array($order['uid']))->increase('cost',$content['cash_fee']/100);
								return '<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg></xml>';
							}
							else
							{
								return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[交易数据无法更改]]></return_msg></xml>';
							}
						}
						else
						{
							return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[不给钱还想通过?]]></return_msg></xml>';
						}
					}
					else
					{
						return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[我知道了！！！]]></return_msg></xml>';
					}
				}
				else
				{
					return '<xml><return_code><![CDATA[FAILED]]></return_code><return_msg><![CDATA[这回该你校验失败了吧！！哈哈！！]]></return_msg></xml>';
				}
				break;
			case 'alipay':
				break;
			default:break;
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
			$order = $this->model('orderlist');
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
			echo "没有找到账单id";
			//$this->view = new view(config('view'), 'notice.html');
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
			$telephone = $this->get->telephone;
			if($telephone !== NULL)
			{
				$this->view->assign('telephone',$telephone);
			}
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('index','__404'));
		}
	}
	
	/**
	 * 订单详情页面
	 */
	function orderview()
	{
		$this->view = new view(config('view'), 'admin/order_detail.html');
		$this->response->setBody($this->view->display());
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
			$resultObj->recordsFiltered = count($result);
			$resultObj->recordsTotal = $orderModel->count();
			$resultObj->data = array_slice($result, $this->post->start,$this->post->length);
			return json_encode($resultObj);
		}
		return false;
	}
}