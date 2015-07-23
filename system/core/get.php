<?php
namespace system\core;

/**
 * $_GET管理
 *
 * @author 程晨
 *        
 */
class get
{

	function __get($name)
	{
		return isset($_GET[$name]) ? (new variable($_GET[$name]))->trim() : NULL;
	}
}