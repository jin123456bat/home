<?php
namespace system\core;
/**
 * 过滤器
 * @author 程晨
 *
 */
class filter
{
	static public function string($str,$length)
	{
		return substr($str, 0,$length);
	}
}