<?php
namespace application\model;

use system\core\model;
class commentModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加文字评论
	 * @param unknown $uid 用户id
	 * @param unknown $pid 商品id
	 * @param unknown $content 评论内容
	 * @param unknown $score 评论分数
	 * @param array $file 图片路径数组
	 */
	function create($uid,$pid,$content,$score,$files)
	{
		$time = $_SERVER['REQUEST_TIME'];
		$array = array(NULL,$uid,$pid,$time,$content,$score);
		$this->insert($array);
		return $this->lastInsertId();
	}
	
	/**
	 * 移除文字评论
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 获取商品的所有评论
	 * @param unknown $pid
	 * @return Ambigous <boolean, multitype:>
	 */
	function getByPid($pid)
	{
		return $this->where('pid=>',array($pid))->select();
	}
}