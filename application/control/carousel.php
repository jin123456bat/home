<?php
namespace application\control;
use system\core\control;
use system\core\view;
/**
 * 滚动图控制器
 * @author jin12
 */
class carouselControl extends control
{
	/**
	 * 滚动图管理页面
	 */
	function admin()
	{
		$this->view = new view(config('view'), 'admin/carousel_admin.html');
		return $this->view->display();
	}
}