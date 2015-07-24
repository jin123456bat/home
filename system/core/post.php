<?php
namespace system\core;

/**
 * $_POST管理
 *
 * @author 程晨
 *        
 */
class post
{

	function __get($name)
	{
		return isset($_POST[$name]) ? trim($_POST[$name]) : NULL;
	}

	function __set($name, $value)
	{
		$_POST[$name] = $value;
	}

	function __isset($name)
	{
		return isset($_POST[$name]) && ! empty($_POST[$name]);
	}

	function __unset($name)
	{
		unset($_POST[$name]);
	}

	/**
	 * 读取post原型数据
	 *
	 * @return string
	 */
	function _input()
	{
		return file_get_contents("php://input");
	}
}