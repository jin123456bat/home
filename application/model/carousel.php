<?php
namespace application\model;
use system\core\model;
use system\core\file;
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
	 * 保存对滚动图的修改
	 * @param unknown $id
	 * @param unknown $title
	 * @param unknown $pic
	 * @param unknown $stop
	 * @param unknown $type
	 * @param unknown $src
	 * @return \system\core\Ambigous
	 */
	function save($id,$title,$stop,$type,$src)
	{
		return $this->where('id=?',array($id))->update(array('title'=>$title,'stop'=>$stop,'type'=>$type,'src'=>$src));
	}
	
	/**
	 * 删除滚动图
	 * @param unknown $id
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 遍历所有数据
	 * @param string $mode 其中图片的路径
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll($mode = 'path')
	{
		$result = $this->select();
		if($mode == 'url')
		{
			foreach($result as &$carousel)
			{
				$carousel['pic'] = empty($carousel['pic'])?'':file::realpathToUrl($carousel['pic']);
			}
		}
		return $result;
	}
}