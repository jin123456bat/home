<?php
namespace application\model;
use system\core\model;
class systemModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function get($name,$type)
	{
		$result = $this->where('name=? and type=?',array($name,$type))->select('value');
		return isset($result[0]['value'])?$result[0]['value']:NULL;
	}
}