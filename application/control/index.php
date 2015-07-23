<?php
namespace application\control;

use system\core\control;

class indexControl extends control
{

	function index()
	{
		$this->view->assign("index", "你好啊");
		$this->view->assign("index1", 'value1');
		$this->view->assign("index2", 'value2');
		return $this->view->display();
	}

	/**
	 * optional
	 */
	function __404()
	{
	}
}