<?php
namespace application\control;
use system\core\control;
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
	 * app首页的秒杀活动
	 */
	function product()
	{
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
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'seckill',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->post->id);
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$orderby = filter::int($this->post->orderby);
			$seckillModel = $this->model('seckill');
			if($seckillModel->save($id,$starttime,$endtime,$orderby,$price))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'修改失败'));
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
			$seckillModel = $this->model('seckill');
			$seckill = $seckillModel->fetchAll('product.id as pid,product.name,seckill.starttime,seckill.endtime,seckill.price,seckill.orderby,seckill.id');
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
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'seckill',roleModel::POWER_INSERT))
		{
			$pid = filter::int($this->post->pid);
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$price = filter::number($this->post->price);
			$orderby = filter::int($this->post->orderby);
			if(!empty($pid))
			{
				$productModel = $this->model('product');
				$product = $productModel->get($pid);
				if(empty($product) || !empty($product['activity']))
					return json_encode(array('code'=>4,'result'=>'商品不存在或者该商品已经有优惠政策了'));
				$seckillModel = $this->model('seckill');
				if($seckillModel->create($pid,$starttime,$endtime,$price,$orderby))
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