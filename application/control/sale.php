<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
/**
 * 限时折扣控制器
 * @author jin12
 *
 */
class saleControl extends control
{
	/**
	 * 管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'sale',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/sale.html');
			$saleModel = $this->model('sale');
			$result = $saleModel->fetchAll('product.id as pid,product.name,sale.starttime,sale.endtime,sale.price,sale.orderby,sale.id');
			$this->view->assign('product',$result);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('index','__404'));
		}
	}
	
	/**
	 * 把商品添加到限时折扣中
	 */
	function create()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'sale',roleModel::POWER_INSERT))
		{
			$pid = filter::int($this->post->pid);
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$productModel = $this->model('product');
			$result = $productModel->get($pid);
			if(!empty($pid) && !empty($result) && empty($result['activity']))
			{
				$saleModel = $this->model('sale');
				if($saleModel->create($pid,$starttime,$endtime,$price))
				{
					$productModel->setActivity($pid,'sale');
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_encode(array('code'=>2,'result'=>'添加失败，该商品已经在限时队列'));
			}
			var_dump($pid);
			return json_encode(array('code'=>3,'result'=>'该商品已经有活动了'));
		}
		return json_encode(array('code'=>4,'result'=>'没有权限'));
	}
	
	/**
	 * 把商品从限时折扣中移除
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'sale',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->get->id);
			if(!empty($id))
			{
				$saleModel = $this->model('sale');
				$sale = $saleModel->get($id);
				if(isset($sale['pid']))
				{
					$saleModel->remove($id);
					$productModel = $this->model('product');
					$productModel->setActivity($sale['pid']);
				}
			}
		}
		$this->response->setCode(302);
		$this->response->addHeader('Location',$this->http->url('sale','admin'));
	}
}