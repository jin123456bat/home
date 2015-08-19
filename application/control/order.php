<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
use application\classes\excel;
/**
 * 订单控制器
 * @author jin12
 *
 */
class orderControl extends control
{
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
			if(!empty($order))
			{
				switch($order['paytype'])
				{
					case 'weixin':
					case 'alipay':
					default:return json_encode(array('code'=>4,'result'=>'支付类型错误'));
				}
			}
			return json_encode(array('code'=>2,'result'=>'订单不存在'));
		}
		return json_encode(array('code'=>3,'result'=>'参数错误'));
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