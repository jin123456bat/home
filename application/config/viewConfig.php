<?php
namespace application\config;

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
		$this->path = ROOT . '/application/template';
	}
}