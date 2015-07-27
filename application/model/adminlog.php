<?php
namespace application\model;

use system\core\model;
class adminlogModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function add($username,$content)
	{
		$array = array(
			'NULL',
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