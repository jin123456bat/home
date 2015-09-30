<?php
namespace application\model;
use system\core\model;
use system\core\file;
class refundimgModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function create($id,$img)
	{
		return $this->insert(array(NULL,$id,$img));
	}
	
	function getByRid($id)
	{
		$array = array();
		$imgs = $this->where('rid=?',array($id))->select();
		foreach($imgs as $img)
		{
			$array[] = file::realpathToUrl($img);
		}
		return $array;
	}
}