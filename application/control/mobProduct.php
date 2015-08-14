<?php
namespace application\control;

use system\core\control;
use system\core\view;
use system\core\filter;

class mobProductControl extends control
{
	/**
	 * 管理员登陆界面
	 */
	function index()
	{
		$this->view = new view(config('view'), 'mobile/index.html');
		
		return $this->view->display();
	}
	function category(){
		$this->view = new view(config('view'),'mobile/category.html');
		return $this->view->display();
	}
}