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
				switch($order['paytype'])
				{
					case 'weixin':
						$weixin = new weixin_gateway(config('weixin'));
						$weixin->createPrepay($order, $orderdetail);
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
	 * 退款接口
	 */
	function refund()
	{
		
	}
	
	/**
	 * 对gateway网关接应
	 */
	function alipay()
	{
		switch ($this->get->action)
		{
			case 'return':break;
			case 'notify':break;
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