<?php
namespace system\core\config;

use system\core\inter\config;

class cacheConfig extends config
{

	function __construct()
	{
		/**
		 * 是否开启缓存
		 */
		$this->cache = false;
		
		/**
		 * 缓存文件保存路径
		 */
		$this->path = ROOT . '/system/cache/template';
		
		/**
		 * 缓存文件有效期
		 */
		$this->time = 5 * 60;
		
		/**
		 * 缓存文件后缀
		 */
		$this->suffix = 'html';
	}
}