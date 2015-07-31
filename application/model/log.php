<?php
namespace application\model;
use system\core\model;

class logModel extends model
{
	/**
	 * @param string $username 指定用户名
	 * @param unknown $time 最近多少天之内时间
	 */
	function fetchByUsername($username = '',$time = 30)
	{
		if(!empty($username))
		{
			$this->where('username=?',array($username));
		}
		$timestamp = ($_SERVER['REQUEST_TIME'] - 30*24*3600);
		$this->where('time > ?',$timestamp);
		return $this->select();
	}
}