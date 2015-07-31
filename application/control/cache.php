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
	function productimg()
	{
		$this->thread->call('productimg');
	}
}