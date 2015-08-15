<?php
namespace application\classes;
class blog
{
	/**
	 * 获得文章摘要
	 */
	function getShort($content)
	{
		$content = htmlspecialchars_decode($content);
		$content = strip_tags($content);
		return mb_substr($content, 0,200,'utf-8');
	}
	
	/**
	 * 获得文章缩略图
	 */
	function getPic($content)
	{
		$content = htmlspecialchars_decode($content);
		$pattern = '$[^_]src="([^"])*"$';
		if(preg_match($pattern, $content,$match))
		{
			return str_replace("\"", '', str_replace("src=\"", '', $match[0]));
		}
		return NULL;
	}
}