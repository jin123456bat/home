<?php
namespace application\model;
use system\core\model;
class user_login_logModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function create($uid,$client)
	{
		$client = empty($client)?'web':$client;
		return $this->insert(array(NULL,$uid,$_SERVER['REQUEST_TIME'],$client));
	}
	
}