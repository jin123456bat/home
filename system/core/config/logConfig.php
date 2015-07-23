<?php
namespace system\core\config;

use system\core\inter\config;

class logConfig extends config
{

	function __construct()
	{
		/**
		 * 线程日志
		 */
		$this->thread_path = ROOT . '/system/cache/log/thread.log';
	}
}