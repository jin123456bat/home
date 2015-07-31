<?php
namespace system\core\config;

use system\core\inter\config;

/**
 * 文件上传配置
 *
 * @author 程晨
 *        
 */
class fileConfig extends config
{

	function __construct()
	{
		/**
		 * 文件保存位置
		 */
		$this->path = ROOT . '/application/upload/';
		
		/**
		 * 允许上传类型
		 */
		$this->type = array(
			'image/jpeg',
			'image/png',
			'image/gif',
			'image/jpg',
			'image/bmp'
		);
		
		/**
		 * 文件大小
		 */
		$this->size = 1024 * 1024 * 1024 * 30;
	}
}