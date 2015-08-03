<?php
namespace application\model;

use system\core\model;
use system\core\file;
/**
 * 评论中的图片数据模型
 * @author jin12
 *
 */
class comment_picModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 为评论添加图片
	 * @param unknown $cid 评论id
	 * @param unknown $file 图片路径
	 * @return string|boolean 
	 */
	function create($cid,$file)
	{
		if($this->insert(array(NULL,$cid,$file)))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	/**
	 * 获得一条评论中的所有图片
	 * @param unknown $cid 评论id
	 * @param string $mode 路径模式，path本地路径，url http路径
	 * @return array 图片路径
	 */
	function getByCid($cid,$mode = 'path')
	{
		$result = $this->where('cid=?',array($cid))->select();
		if($result)
		{
			$array = array();
			foreach($result as $pic)
			{
				switch ($mode)
				{
					case 'path':$array[] = $pic['pic_path'];break;
					case 'url':$array[] = file::realpathToUrl($pic['pic_path']);break;
					default:break;
				}
			}
			return $array;
		}
		return array();
	}
}