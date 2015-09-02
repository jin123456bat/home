<?php
namespace application\control;

use system\core\control;
/**
 * 缓存管理控制器
 * @author jin12
 *
 */
class cacheControl extends control
{
	/**
	 * 调用线程删除所有错误的产品图像
	 */
	function productimg()
	{
		$this->thread->call('productimg');
		echo "OK";
	}
}