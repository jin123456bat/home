<?php
namespace application\control;

use system\core\control;
use system\core\view;
class logControl extends control
{
	function index()
	{
		$this->view = new view(config('view'), 'admin/log.html');
		$logModel = $this->model('log');
		$this->view->assign('log',$logModel->select());
		$this->response->setBody($this->view->display());
	}
}