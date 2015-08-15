<?php
namespace application\model;

use system\core\model;
class helpModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 创建一个帮助页面
	 * @param unknown $title
	 * @param unknown $content
	 */
	function create($title,$content)
	{
		if($this->insert(array(NULL,$title,$content)))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	function save($id,$title,$content)
	{
		return $this->where('id=?',array($id))->update(array('title'=>$title,'content'=>$content));
	}
	
	/**
	 * 移除帮助页面
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 获得一个帮助页面的信息
	 * @param unknown $id
	 * @return NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 更改帮助页面的信息
	 * @param unknown $id
	 * @param unknown $title
	 * @param unknown $content
	 */
	function set($id,$title,$content)
	{
		$this->where('id=?',array($id))->update(array('title'=>$title,'content'=>$content));
	}
}