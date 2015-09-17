<?php
namespace application\model;
use system\core\model;
class registerModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function get($id,$name = '*')
	{
		$result = $this->where('id=?',array($id))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:array();
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	function save($id,$name,$value)
	{
		return $this->where('id=?',array($id))->update($name,$value);
	}
}