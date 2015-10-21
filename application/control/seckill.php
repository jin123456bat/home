<?php
namespace application\control;
use system\core\control;
use system\core\file;
use system\core\filter;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
/**
 * 秒杀活动控制器
 * @author jin12
 *
 */
class seckillControl extends control
{
	
	/**
	 * 计划任务
	 */
	function crontab()
	{
		$seckillModel = $this->model('seckill');
		$seckill = $seckillModel->where('endtime<?',array($_SERVER['REQUEST_TIME']))->select();
		foreach($seckill as $activity)
		{
			$this->model('product')->setActivity($activity['pid'],'');
		}
		$seckillModel->where('endtime<?',array($_SERVER['REQUEST_TIME']))->delete();
	}
	
	/**
	 * app首页的秒杀活动
	 */
	function product()
	{
		$this->response->addHeader('Content-Type','application/json');
		$length = empty($this->get->length)?5:$this->get->length;
		$seckillModel = $this->model('seckill');
		$brandModel = $this->model('brand');
		$result = $seckillModel->getIndex($length);
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
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	function index()
	{
		
	}
	
	/**
	 * 保存对秒杀活动信息的修改
	 */
	function save()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'seckill',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->post->id);
			$sname = $this->post->sname;
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$orderby = filter::int($this->post->orderby);
			$seckillModel = $this->model('seckill');
			$seckillModel->save($id,$sname,$starttime,$endtime,$orderby,$price);
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>2,'result'=>'权限不足'));
	}
	
	/**
	 * 移除秒杀活动
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'seckill',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->get->id);
			if(!empty($id))
			{
				$seckillModel = $this->model('seckill');
				$seckillModel->remove($id);
			}
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('seckill','admin'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 秒杀管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'seckill',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/seckill.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$seckillModel = $this->model('seckill');
			$seckill = $seckillModel->fetchAll('seckill.sname,product.id as pid,product.name,seckill.starttime,seckill.endtime,seckill.price,seckill.orderby,seckill.id,seckill.logo');
			$this->view->assign('product',$seckill);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 创建秒杀活动
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'seckill',roleModel::POWER_INSERT))
		{
			$sname = $this->post->sname;
			$pid = filter::int($this->post->pid);
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$orderby = filter::int($this->post->orderby);
			$logo = $this->post->logo;
			if(!empty($pid))
			{
				$productModel = $this->model('product');
				$product = $productModel->get($pid);
				if(empty($product) || !empty($product['activity']))
				{
					switch ($product['activity'])
					{
						case 'sale':$result = '限时优惠';break;
						case 'seckill':$result = '秒杀';break;
						case 'fullcut':$result = '满减';break;
					}
					return json_encode(array('code'=>4,'result'=>'商品已经参加了'.$result.',请先移除原活动在来添加'));
				}
				$seckillModel = $this->model('seckill');
				if($seckillModel->create($sname,$pid,$starttime,$endtime,$price,$orderby,$logo))
				{
					$productModel->setActivity($pid,'seckill');
					return json_encode(array('code'=>1,'result'=>'推送成功'));
				}
				else
				{
					return json_encode(array('code'=>2,'result'=>'推送失败'));
				}
			}
			return json_encode(array('code'=>0,'result'=>'参数错误'));
		}
		return json_encode(array('code'=>3,'result'=>'权限不足'));
	}
}