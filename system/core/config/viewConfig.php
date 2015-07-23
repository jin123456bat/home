<?php
namespace system\core\config;

use system\core\inter\config;

/**
 * 模板引擎配置
 *
 * @author 程晨
 *        
 */
class viewConfig extends config
{

	function __construct()
	{
		/**
		 * 模板保存路径
		 */
		$this->path = ROOT . '/system/template/';
		
		/**
		 * 模板后缀
		 */
		$this->suffix = 'html';
		
		/**
		 * 标签左开始符
		 */
		$this->leftContainer = '{%';
		
		/**
		 * 标签右结束符号
		 */
		$this->rightContainer = '%}';
		
		/**
		 * 标签嵌套最大次数
		 */
		$this->containerTimes = 3;
	}
}