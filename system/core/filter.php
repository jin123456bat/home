<?php
namespace system\core;
/**
 * 过滤器
 * @author 程晨
 *
 */
class filter
{
	/**
	 * 字符串过滤器  过滤字符串前$length个字符,允许中文
	 * @param unknown $str
	 * @param unknown $length
	 * @return string
	 */
	static public function string($str,$length)
	{
		return mb_substr($str, 0,$length);
	}
	
	/**
	 * 过滤数字 允许小数
	 * @param unknown $var
	 */
	static public function number($var)
	{
		$pattern = '$\d+(\.\d+)?$';
		if(preg_match($pattern, $var,$match))
		{
			return $match[0];
		}
		return NULL;
	}
	
	/**
	 * 过滤手机号码,失败返回NULL
	 * @param unknown $string
	 * @return unknown|NULL
	 */
	static public function telephone($string)
	{
		$pattern = '$\d{11}$';
		if(preg_match($pattern, $string,$match))
		{
			return $match[0];
		}
		return NULL;
	}
	
	/**
	 * 过滤第一个数字  + - e .等符号都不允许
	 * @param unknown $var
	 * @return unknown|NULL
	 */
	static public function int($var)
	{
		$pattern = '$\d+$';
		if(preg_match($pattern,$var,$match))
		{
			return $match[0];
		}
		return NULL;
	}
}