<?php
namespace application\model;
use system\core\model;
use system\core\file;
/**
 * 国家图标数据模型
 * @author jin12
 *
 */
class flagModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function get($id,$name = '*')
	{
		$result = $this->where('id=?',array($id))->select($name);
		if($name !== '*')
			return isset($result[0][$name])?$result[0][$name]:NULL;
		return isset($result[0])?$result[0]:NULL;
	}
	
	function getOrigin($id)
	{
		$origin = $this->get($id);
		$origin['file'] = file::realpathToUrl($origin['file']);
		return $origin;
	}
	
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	function create($name,$flag)
	{
		return $this->insert(array(NULL,$name,$flag));
	}
	
	function fetchAll()
	{
		$result = $this->select();
		foreach($result as &$flag)
		{
			$flag['file'] = file::realpathToUrl($flag['file']);
		}
		return $result;
	}
}