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
		return isset($_GET[$name]) ? urldecode(trim($_GET[$name])) : NULL;
	}

	function __set($name, $value)
	{
		$_GET[$name] = $value;
	}

	function __isset($name)
	{
		return isset($_GET[$name]) && ! empty($_GET[$name]);
	}

	function __unset($name)
	{
		unset($_GET[$name]);
	}
}