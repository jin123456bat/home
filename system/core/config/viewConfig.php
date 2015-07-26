<?php
namespace system\core\config;

use system\core\inter\config;

/**
 *
 * @author 程晨
 *        
 */
class viewConfig extends config
{

	function __construct()
	{
		$this->template_dir = ROOT . '/system/template';
		$this->caching = false;									//是否使用缓存
		$this->compile_dir = ROOT.'/system/cache/smarty_compile';		//设置编译目录
		$this->cache_dir = ROOT.'/system/cache/template/';						//设置缓存文件夹
		$this->left_delimiter = '{%';							//设置左右标示符
		$this->right_delimiter = '%}';
	}
}