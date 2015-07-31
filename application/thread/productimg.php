<?php
namespace application\thread;

use system\core\filesystem;
use system\core\control;
class productimgThread extends control
{
	/**
	 * 清空无效图像
	 */
	function run()
	{
		$productimgModel = $this->model('productimg');
		$img = $productimgModel->GetAndRemoveInvalidImg();
		$filesystem = new filesystem();
		foreach($img as $im)
		{
			$filesystem->remove($im['base_path']);
			$filesystem->remove($im['small_path']);
			$filesystem->remove($im['thumbnail_path']);
		}
		$productimgModel->removeByPid(0);
	}
}