<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
/**
 * 满减活动控制器
 * @author jin12
 *
 */
class fullcutControl extends control
{
	function crontab()
	{
		$fullcut = $this->model('fullcut')->where('endtime<?',array($_SERVER['REQUEST_TIME']))->select();
		foreach($fullcut as $activity)
		{
			$pid = $this->model('fullcutdetail')->where('fid=?',array($activity['id']))->select();
			foreach ($pid as $value)
			{
				$this->model('product')->setActivity($value['pid'],'');
			}
		}
		$this->model('fullcut')->where('endtime<?',array($_SERVER['REQUEST_TIME']))->delete();
	}
	
	/**
	 * 满减活动商品信息
	 */
	function product()
	{
		$length = $this->get->length;
		$length = empty($length)?5:$length;
		$fullcutModel = $this->model('fullcut');
		$brandModel = $this->model('brand');
		$result = $fullcutModel->getIndex($length);
		$categoryModel = $this->model('category');
		$productimgModel = $this->model('productimg');
		$prototypeModel = $this->model('prototype');
		foreach($result as &$product)
		{
			$product['brand'] = $brandModel->get($product['bid'],'name');
			unset($product['bid']);
			$product['category'] = $categoryModel->get($product['category'],'name');
			unset($product['pid']);
			$product['prototype'] = $prototypeModel->getByPid($product['id']);
			$product['img'] = $productimgModel->getByPid($product['pid']);
			$product['origin'] = $this->model('flag')->getOrigin($product['origin']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 满减活动管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'fullcut',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/fullcut_admin.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$fullcutModel = $this->model('fullcut');
			$fullcut = $fullcutModel->fetchAll();
			$fullcutdetailModel = $this->model('fullcutdetail');
			$fullcutdetail = $fullcutdetailModel->fetchAll('fullcutdetail.id,fullcutdetail.pid,fullcutdetail.fid,product.name,product.price,product.stock');
			$this->view->assign('fullcut',$fullcut);
			$this->view->assign('fullcutdetail',$fullcutdetail);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 创建满减活动规则
	 */
	function create()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'fullcut',roleModel::POWER_INSERT))
		{
			$id = filter::int($this->post->id);
			$name = $this->post->name;
			$max = filter::number($this->post->max);
			$minus = filter::number($this->post->minus);
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			if(empty($name) || empty($max) || empty($minus) || empty($starttime) || empty($endtime))
			{
				return json_encode(array('code'=>0,'result'=>'参数不全'));
			}
			$fullcutModel = $this->model('fullcut');
			
			if(empty($id))
			{
				if($fullcutModel->create($name,$max,$minus,$starttime,$endtime))
				{
					return json_encode(array('code'=>1,'result'=>'创建成功'));
				}
				else
				{
					return json_encode(array('code'=>2,'result'=>'创建失败'));
				}
			}
			else
			{
				if($fullcutModel->save($id,$name,$max,$minus,$starttime,$endtime))
				{
					return json_encode(array('code'=>1,'result'=>'保存成功'));
				}
				else
				{
					return json_encode(array('code'=>2,'result'=>'保存失败'));
				}
			}
		}
		else
		{
			return json_encode(array('code'=>3,'result'=>'权限不足'));
		}
	}
	
	/**
	 * 删除满减活动规则
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'fullcut',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->get->id);
			if(!empty($id))
			{
				$fullcutModel = $this->model('fullcut');
				$fullcutModel->remove($id);
			}
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('fullcut','admin'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 获得满减规则信息
	 */
	function information()
	{
		$this->response->addHeader('Cache-Control','nocache');
		$id = filter::int($this->get->id);
		if(!empty($id))
		{
			$fullcutModel = $this->model('fullcut');
			$fullcut = $fullcutModel->get($id);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$fullcut));
		}
		return json_encode(array('code'=>0,'result'=>'参数错误'));
	}
}