<?php
namespace application\control;
use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
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
		$systemModel = $this->model('system');
		foreach($_POST as $key => $value)
		{
			list($system,$type,$name) = explode('_', $key);
			if($system == 'system')
			{
				$systemModel->set($name,$type,$value);
			}
		}
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
	
	function base()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/system_base.html');
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
}