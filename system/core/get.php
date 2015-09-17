<?php
namespace system\core;

use \ArrayAccess;
/**
 * $_GET管理
 *
 * @author 程晨
 *        
 */
class get implements ArrayAccess
{
	static private $_instance = NULL;
	
	private function __construct()
	{
	}
	
	static public function getInstance()
	{
		if(self::$_instance === NULL)
			self::$_instance = new self();
		return self::$_instance;
	}
	
	function __get($name)
	{
		return isset($_GET[$name]) ? is_string($_GET[$name])?trim(urldecode($_GET[$name])):$_GET[$name] : NULL;
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
}