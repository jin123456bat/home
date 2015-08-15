<?php
namespace application\model;
use system\core\model;
/**
 * 滚动图数据模型
 * @author jin12
 *
 */
class carouselModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 创建滚动图
	 * @param unknown $title
	 * @param unknown $pic
	 * @param unknown $stop
	 * @param unknown $type
	 * @param unknown $src
	 * @return string|NULL
	 */
	function create($title,$pic,$stop,$type,$src)
	{
		if($this->insert(array(NULL,$title,$pic,$stop,$type,$src)))
		{
			return $this->lastInsertId();
		}
		return NULL;
	}
	
	/**
	 * 删除滚动图
	 * @param unknown $id
	 */
	function remove($id)
	{
		$this->where('id=?',array($id))->delete();
	}
}