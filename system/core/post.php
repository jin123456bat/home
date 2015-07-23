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
		return isset($_POST[$name]) ? (new variable($_POST[$name]))->trim() : NULL;
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