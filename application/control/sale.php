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
	 * 计划任务
	 */
	function crontab()
	{
		$sale = $this->model('sale')->where('endtime<?',array($_SERVER['REQUEST_TIME']))->select();
		foreach ($sale as $activity)
		{
			$this->model('product')->setActivity($activity['pid'],'');
		}
		$this->model('sale')->where('endtime<?',array($_SERVER['REQUEST_TIME']))->delete();
	}
	
	/**
	 * 活动详情
	 */
	function information()
	{
		
	}
	
	/**
	 * 获得限时商品的信息  商品列表
	 */
	function product()
	{
		$this->response->addHeader('Content-Type','application/json');
		$length = empty($this->get->length)?5:$this->get->length;
		$saleModel = $this->model('sale');
		$brandModel = $this->model('brand');
		
		$filter = array(
			'length' => $length
		);
		
		$result = $saleModel->getIndex($filter);
		$prototypeModel = $this->model('prototype');
		$productimgModel = $this->model('productimg');
		$categoryModel = $this->model('category');
		foreach ($result as &$product)
		{
			unset($product['pid']);
			$product['brand'] = $brandModel->get($product['bid'],'name');
			unset($product['bid']);
			$product['prototype'] = $prototypeModel->getByPid($product['id']);
			$product['img'] = $productimgModel->getByPid($product['id']);
			$product['category'] = $categoryModel->get($product['category'],'name');
			$product['origin'] = $this->model('flag')->getOrigin($product['origin']);
			$product['activity_description'] = $this->model('sale')->getByPid($product['id']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 保存限时特卖活动的信息
	 */
	function save()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'sale',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->post->id);
			$sname = $this->post->sname;
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$orderby = filter::int($this->post->orderby);
			$seckillModel = $this->model('sale');
			$seckillModel->save($id,$sname,$starttime,$endtime,$orderby,$price);
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>2,'result'=>'权限不足'));
	}
	
	/**
	 * 管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'sale',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/sale.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$saleModel = $this->model('sale');
			$result = $saleModel->fetchAll('sale.sname,product.id as pid,product.name,sale.starttime,sale.endtime,sale.price,sale.orderby,sale.id');
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
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'sale',roleModel::POWER_INSERT))
		{
			$sname = $this->post->sname;
			$pid = filter::int($this->post->pid);
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$orderby = filter::int($this->post->orderby);
			$productModel = $this->model('product');
			$result = $productModel->get($pid);
			if(!empty($pid) && !empty($result) && empty($result['activity']))
			{
				$saleModel = $this->model('sale');
				if($saleModel->create($sname,$pid,$starttime,$endtime,$price,$orderby))
				{
					$productModel->setActivity($pid,'sale');
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_encode(array('code'=>2,'result'=>'添加失败，该商品已经在限时队列'));
			}
			switch ($result['activity'])
			{
				case 'seckill':$result = '秒杀';break;
				case 'sale':$result = '满减';break;
				case 'fullcut':$result = '满减';break;
			}
			return json_encode(array('code'=>3,'result'=>'该商品已经参加了'.$result.'活动，请先移除原来的活动在推送'));
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