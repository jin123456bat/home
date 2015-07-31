<?php
namespace application\thread;

use system\core\thread;
use system\core\filesystem;
class productimgThread extends thread
{
	/**
	 * 清空无效图像
	 */
	function clearimg()
	{
		$productimgModel = $this->model('productimg');
		$img = $productimgModel->getByPid(0);
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