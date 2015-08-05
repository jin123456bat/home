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
			try
			{
				$array = array();
				$content = explode(',', $string);
				foreach ($content as $value)
				{
					list($key,$val) = explode(':', $value);
					$array[$key] = $val;
				}
				return $array;
			}
			catch (\Exception $e)
			{
				return false;
			}
		}
		return false;
	}
}