<?php
namespace system\core;

/**
 * $post $get基类
 *
 * @author 程晨
 */
class variable
{

	public $var;

	function __construct($var)
	{
		$this->var = str_replace(' ', '', urldecode($var));
	}

	function __toString()
	{
		return $this->var;
	}

	function trim()
	{
		if(is_string($this->var))
		{
			return new variable(trim($this->var));
		}
		return new variable($this->var);
	}

	function ltrim()
	{
		if(is_string($this->var))
		{
			return new variable(ltrim($this->var));
		}
		return new variable($this->var);
	}

	function rtrim()
	{
		if(is_string($this->var))
		{
			return new variable(rtrim($this->var));
		}
		return new variable($this->var);
	}

	function regex($pattern)
	{
		if(preg_match($pattern, $this->var, $match))
		{
			return (new variable($match[0]))->trim();
		}
		return new variable($this->var);
	}

	function replace($search, $replace, $count = 0)
	{
		if(is_string($this->var))
		{
			if(empty($count))
				return (new variable(str_replace($search, $replace, $this->var)))->trim();
			return (new variable(str_replace($search, $replace, $this->var, $count)))->trim();
		}
		return new variable($this->var);
	}

	/**
	 * 这个是只允许非负数,为什么不用is_int 是因为大数无法用is_int检测
	 *
	 * @return unknown|variable
	 */
	function int()
	{
		$pattern = '$\d+$';
		if(preg_match($pattern, $this->var, $match))
		{
			return (new variable($match[0]))->trim();
		}
		return new variable($this->var);
	}

	/**
	 * 允许各种数字
	 */
	function number()
	{
		$pattern = '$[-+]?\d+\.*\d*$';
		if(preg_match($pattern, $this->var, $match))
		{
			return (new variable($match[0]))->trim();
		}
		return new variable($this->var);
	}

	/**
	 * 只允许字母和数字 并且必须字母开头
	 */
	function word()
	{
		$pattern = '$[a-zA-Z]+[a-zA-Z0-9]+$';
		if(preg_match($pattern, $this->var, $match))
		{
			return (new variable($match[0]))->trim();
		}
		return new variable($this->var);
	}
}