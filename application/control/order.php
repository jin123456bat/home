<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
/**
 * 订单控制器
 * @author jin12
 *
 */
class orderControl extends control
{
	
	/**
	 * 创建订单
	 * @param unknown $array
	 */
	function create($array)
	{
		return $this->insert($array);
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