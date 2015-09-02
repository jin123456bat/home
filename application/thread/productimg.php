<?php
namespace application\thread;

use system\core\control;
class productimgThread extends control
{
	/**
	 * 清空无效图像
	 */
	function run()
	{
		$productimgModel = $this->model('productimg');
		$productimgModel->removeByPid(0);
	}
}