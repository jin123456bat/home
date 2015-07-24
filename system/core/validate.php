<?php
namespace system\core;

/**
 * 验证类，验证变量是否符合规则，true，不符合返回false
 * @author jcc
 */
class validate
{

	/**
	 * 验证时间是否正确
	 *
	 * @param unknown_type $y        	
	 * @param unknown_type $m        	
	 * @param unknown_type $d        	
	 * @return boolean
	 */
	public static function date($y, $m, $d)
	{
		return checkdate($m, $d, $y);
	}
	
	/**
	 * 验证是否为手机号码
	 * @param unknown $string
	 */
	public static function telephone($string)
	{
		$pattern = '$\d{11}$';
		return preg_match($pattern, $string);
	}

	/**
	 * 验证是否为纯数字+-.e都不允许
	 * @param unknown $var        	
	 * @return mixed
	 */
	public static function int($var)
	{
		return filter_var($var, FILTER_VALIDATE_INT);
	}

	/**
	 * 判断是否文件，是返回文件名，否则返回false
	 *
	 * @param unknown_type $var        	
	 * @return Ambigous <boolean, unknown>
	 */
	public static function file($var)
	{
		return is_file($var) ? $var : false;
	}

	/**
	 * 判断是否目录，假如是返回目录名，否则返回false
	 *
	 * @param unknown_type $var        	
	 * @return Ambigous <boolean, unknown>
	 */
	public static function dir($var)
	{
		return is_dir($var) ? $var : false;
	}

	public static function email($var)
	{
		return filter_var($var, FILTER_VALIDATE_EMAIL);
	}

	public static function ip($var)
	{
		return filter_var($var, FILTER_VALIDATE_IP);
	}

	public static function regexp($var, $regexp)
	{
		return filter_var($var, FILTER_VALIDATE_REGEXP, array(
			'options' => array(
				'regexp' => $regexp
			)
		));
	}

	public static function float($var)
	{
		return filter_var($var, FILTER_VALIDATE_FLOAT);
	}

	/**
	 * 如果是true,1,yes,on 返回true
	 * 如果是false,0,no,off,空字符串 返回false
	 * 否则返回NULL
	 *
	 * @param unknown_type $var        	
	 * @return mixed
	 */
	public static function bool($var)
	{
		return filter_var($var, FILTER_VALIDATE_BOOLEAN);
	}

	public static function url($var)
	{
		// 这个不允许中文，现在改成正则表达式
		// return filter_var($var,FILTER_VALIDATE_URL);
		$pattern = '$[a-zA-z]+://[^\s]*$';
		if (preg_match($pattern, $var, $match)) {
			return $match[0];
		}
		return false;
	}

	public static function string($var, $min_length = 1, $max_length = PHP_INT_MAX)
	{
		return is_string($var) && strlen($var) >= $min_length && strlen($var) <= $max_length;
	}
}