<?php
namespace application\control;
use system\core\control;
use system\core\view;
use system\core\filter;
use application\message\json;
use application\classes\login;
use application\model\roleModel;
/**
 * 全球热销
 * @author jin12
 *
 */
class hotorderControl extends control
{
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'hotorder',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/hot_admin.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$hotorderModel = $this->model('hotorder');
			$hotorder = $hotorderModel->fetchAll();
			foreach ($hotorder as &$product)
			{
				$img = $this->model('productimg')->getByPid($product['id']);
				if(isset($img[0]['thumbnail_path']))
				{
					$product['img'] = $img[0]['thumbnail_path'];
				}
			}
			$this->view->assign('hotorder',$hotorder);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 获取热销中的商品
	 * @return string
	 */
	function product()
	{
		$hotorderModel = $this->model('hotorder');
		
		$start = filter::int($this->get->start);
		$start = empty($start)?0:$start;
		$length = filter::int($this->get->length);
		$length = empty($length)?10:$length;
		
		$filter = array(
			'start' => $start,
			'length' => $length,
			'order' => 'orderby',
		);
		
		$hotorder = $hotorderModel->fetchAll($filter);
		
		foreach($hotorder as &$product)
		{
			//$goods['category'] = $this-->get($goods['category'],'name');
			//$goods['brand'] = $brandModel->get($goods['bid'],'name');
			//unset($product['bid']);
			$product['prototype'] = $this->model('prototype')->getByPid($product['id']);
			$product['img'] = $this->model('productimg')->getByPid($product['id']);
			switch ($product['activity'])
			{
				case 'sale':$product['activity_description'] = $this->model('sale')->getByPid($product['id']);break;
				case 'seckill':$product['activity_description'] = $this->model('seckill')->getByPid($product['id']);break;
				case 'fullcut':$product['activity_description'] = $this->model('fullcutdetail')->getByPid($product['id']);break;
				default:break;
			}
			$product['origin'] = $this->model('flag')->getOrigin($product['origin']);
		}
		return new json(json::OK,NULL,$hotorder);
	}
	
	/**
	 * 将商品添加到全球热销
	 * @return string
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$pid = filter::int($this->post->pid);
		$hotorderModel = $this->model('hotorder');
		if($hotorderModel->create($pid))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'该商品已经存在热销当中'));
	}
	
	/**
	 * 从全球热销中删除商品
	 * 
	 * @return string
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
		$pid = filter::int($this->post->pid);
		$hotorderModel = $this->model('hotorder');
		if($hotorderModel->remove($pid))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}
	
	/**
	 * 更改全球热销的排序
	 */
	function orderby()
	{
		$this->response->addHeader('Content-Type','application/json');
		$orderby = $this->post->orderby;
		$pid = filter::int($this->post->pid);
		$hotorderModel = $this->model('hotorder');
		if($hotorderModel->order($pid,$orderby))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}
}