<?php
namespace system\core;

/**
 * 随机
 *
 * @author 程晨
 *        
 */
class random
{

	const RANDOM_NUMBER = 1;

	const RANDOM_WORD = 2;

	const RANDOM_WORD_NUMBER = 3;

	const RANDOM_UPPER_WORD = 4;

	const RANDOM_LOWER_WORD = 5;

	/**
	 * 生成随机数字
	 */
	static function number($length, $salt = NULL)
	{
		$start = pow(10, $length - 1);
		$end = pow(10, $length);
		if (function_exists('mt_rand')) {
			$num = $salt . mt_rand($start, $end);
		} else 
			if (function_exists('rand')) {
				$num = $salt . rand($start, $end);
			}
		return $num;
	}

	/**
	 * 生成随机字符串
	 */
	static function word($length, $salt = NULL, $mode = self::RANDOM_WORD_NUMBER)
	{
		$str_upper_word = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$str_lower_word = 'abcdefghijklmnopqrstuvwxyz';
		$str_number = '1234567890';
		switch ($mode) {
			case self::RANDOM_LOWER_WORD:
				$str = $str_lower_word;
				break;
			case self::RANDOM_UPPER_WORD:
				$str = $str_upper_word;
				break;
			case self::RANDOM_NUMBER:
				$str = $str_number;
				break;
			case self::RANDOM_WORD:
				$str = $str_lower_word . $str_upper_word;
				break;
			case self::RANDOM_WORD_NUMBER:
				$str = $str_lower_word . $str_upper_word . $str_number;
				break;
			default:
				return false;
		}
		$return = '';
		$strlen = strlen($str) - 1;
		for ($i = 0; $i < $length; $i ++) {
			$return .= $str[rand(0, $strlen)];
		}
		return $salt . $return;
	}

	/**
	 * 随机中文字符,字符集utf-8
	 */
	static function chinese($length, $salt = NULL)
	{
		ch('u4e00');
	}
}