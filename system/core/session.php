<?php
namespace system\core;

class session
{
	function __construct()
	{
		if(!session_id())
		{
			session_start();
		}
	}
	
	function __get($name)
	{
		return isset($_SESSION[$name])?$_SESSION[$name]:NULL;
	}
	
	function __set($name,$value)
	{
		$_SESSION[$name] = $value;
	}
	
	function __isset($name)
	{
		return isset($_SESSION[$name]) && !empty($_SESSION['name']);
	}
	
	function __unset($name)
	{
		unset($_SESSION[$name]);
	}
}