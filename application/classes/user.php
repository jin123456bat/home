<?php
namespace application\classes;
class user
{
	function hideName($username)
	{
		if (mb_strlen($username,"UTF-8") < 4) {
			return '****';
		}
		$start = mb_substr($username, 0,2,'UTF-8');
		$end = mb_substr($username, -3,-1,'UTF-8');
		return $start.'****'.$end;
	}
}