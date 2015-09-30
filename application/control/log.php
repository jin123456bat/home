<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
/**
 * 系统日志
 * @author jin12
 *
 */
class logControl extends control
{
	/**
	 * 系统日志页面
	 */
	function index()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'log',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/log.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			$logModel = $this->model('log');
			$this->view->assign('log',$logModel->select());
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
}