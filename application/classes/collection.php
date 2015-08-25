<?php
namespace application\classes;
class collection
{
	/**
	 * 将属性集合字符串转化为数组
	 * @param string $string 属性id:值下标,属性id:值下标....
	 */
	function stringToArray($string)
	{
		if(is_string($string))
		{
			if (empty($string))
				return array();
			$string = trim($string,',');
			$array = array();
			$content = explode(',', $string);
			foreach ($content as $value)
			{
				list($key,$val) = explode(':', $value);
				$array[$key] = $val;
			}
			return $array;
		}
		elseif (is_array($string))
		{
			return $string;
		}
		return false;
	}
	
	
}