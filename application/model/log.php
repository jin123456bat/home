<?php
namespace application\model;

use system\core\model;
class logModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
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
	
	/**
	 * 记录日志
	 * @param unknown $username
	 * @param unknown $content
	 * @return \system\core\Ambigous
	 */
	function write($username,$content)
	{
		$array = array(
			NULL,
			$username,
			$_SERVER['REQUEST_TIME'],
			$content
		);
		return $this->insert($array);
	}
	
	/**
	 * 清空日志
	 */
	function clear()
	{
		return $this->query('TRUNCATE TABLE `adminlog`');
	}
}