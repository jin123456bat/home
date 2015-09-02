<?php
namespace application\control;
use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
use system\core\image;
use system\core\file;
/**
 * 结算管理控制器
 * @author jin12
 *
 */
class systemControl extends control
{
	/**
	 * 保存系统配置
	 */
	function save()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_UPDATE))
		{
			$systemModel = $this->model('system');
			foreach($_POST as $key => $value)
			{
				list($system,$type,$name) = explode('_', $key);
				if($system == 'system')
				{
					$systemModel->set($name,$type,$value);
				}
			}
			$this->model('log')->write($this->session->username,'修改了系统配置');
			if(empty($this->http->referer()))
			{
				$lastpage = $this->http->url('admin','__404');
			}
			else
			{
				$lastpage = $this->http->referer();
			}
			
			$this->response->setCode(302);
			$this->response->addHeader('Location',$lastpage);
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 用于保存app的一些配置信息
	 */
	function saveapp()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_UPDATE))
		{
			$startpage1 = $this->file->system_app_startpage1;
			$startpage2 = $this->file->system_app_startpage2;
			$startpage3 = $this->file->system_app_startpage3;
			if(is_file($startpage1))
			{
				$image = new image();
				$startpage1 = $image->resizeImage($startpage1, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage1','app',$startpage1))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage1)));
				}
			}
			if(is_file($startpage2))
			{
				$image = new image();
				$startpage2 = $image->resizeImage($startpage2, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage1','app',$startpage2))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage2)));
				}
			}
			if(is_file($startpage3))
			{
				$image = new image();
				$startpage3 = $image->resizeImage($startpage3, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage1','app',$startpage3))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage3)));
				}
			}
		}
		else
		{
			return json_encode(array('code'=>2,'result'=>'权限不足'));
		}
	}
	
	/**
	 * 结算方式控制页面
	 */
	function payment()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$systemModel = $this->model('system');
			$payment = $systemModel->fetch(array('weixin','alipay','payment'));
			$this->view = new view(config('view'), 'admin/system_payment.html');
			$system = array();
			foreach ($payment as $value)
			{
				$system['system_'.$value['type'].'_'.$value['name']] = $value['value'];
			}
			$this->view->assign('system',$system);
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 系统基础配置
	 */
	function base()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/system_base.html');
			
			$systemModel = $this->model('system');
			$config = $systemModel->fetch(array('system','image','app'));
			$system = array();
			foreach ($config as $value)
			{
				$system['system_'.$value['type'].'_'.$value['name']] = $value['value'];
			}
			$this->view->assign('system',$system);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 缓存
	 */
	function cache()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/cache.html');
			return $this->view->display();
		}
		else
		{
			$this->response->set(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
}