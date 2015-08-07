<?php
namespace application\control;
use system\core\control;
use system\core\view;
/**
 * 组合购买活动控制器
 * @author jin12
 *
 */
class combineControl extends control
{
	function admin()
	{
		$this->view = new view(config('view'), 'admin/combine_admin.html');
		$this->response->setBody($this->view->display());
	}
}