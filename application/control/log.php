<?php
namespace application\control;

use system\core\control;
use system\core\view;
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
		$this->view = new view(config('view'), 'admin/log.html');
		$logModel = $this->model('log');
		$this->view->assign('log',$logModel->select());
		$this->response->setBody($this->view->display());
	}
}