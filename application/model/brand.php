<?php
namespace application\model;

use system\core\model;

class brandModel extends model
{
	function __construct()
	{
		parent::__construct('brand');
	}
	
	function get($id)
	{
		$result = $this->where('id=?', array(
			$id
		))->select();
		return isset($result[0]) ? $result[0] : NULL;
	}

	function add($name, $logo, $description)
	{
		$close = 0;
		return $this->insert(array(
			NULL,
			$name,
			$logo,
			$description,
			$close
		));
	}

	function setClose($id, $value)
	{
		$this->where('id=?', array(
			$id
		))->update('close', $value);
	}

	function del($id)
	{
		$this->where('id=?', array(
			$id
		))->delete();
	}

	function fetchAll()
	{
		return $this->select();
	}
}