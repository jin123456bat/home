<?php
namespace system\core;

use \ArrayAccess;
/**
 * $_POST管理
 *
 * @author 程晨
 *        
 */
class post implements ArrayAccess
{

	function __get($name)
	{
		return isset($_POST[$name]) ? is_string($_POST[$name])?trim($_POST[$name]):$_POST[$name] : NULL;
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
	
	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}
	
	public function offsetExists($offset)
	{
		return isset($this->$offset);
	}
	
	public function offsetUnset($offset)
	{
		unset($this->$offset);
	}
	
	public function offsetGet($offset)
	{
		return isset($this->$offset) ? $this->$offset : null;
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