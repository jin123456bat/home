<?php
namespace application\control;

use system\core\control;
use system\core\view;
class productControl extends control
{
	/**
	 * 商品列表
	 */
	function listview()
	{
		$this->view = new view(config('view'), 'admin/listview.html');
		$this->response->setBody($this->view->display());
	}
}