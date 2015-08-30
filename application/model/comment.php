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
	 * ajax搜索
	 * @param unknown $post
	 * @param unknown $pid
	 * @return Ambigous <boolean, multitype:>
	 */
	function searchable($post,$pid)
	{
		$this->where('pid=?',array($pid));
		$parameter = array();
		foreach($post->columns as $key=>$value)
		{
			foreach ($post->order as $orderby)
			{
				if($orderby['column'] == $key)
				{
					$this->orderby($value['data'],$orderby['dir']);
				}
			}
			$parameter[] = $value['data'];
		}
		if(!empty($post->action) && $post->action == 'filter')
		{
			if(!empty($post->id))
			{
				$this->where('id=?',array($post->id));
			}
			if(!empty($post->starttime))
			{
				$this->where('time>?',array(strtotime($post->starttime)));
			}
			if(!empty($post->endtime))
			{
				$this->where('time<?',array(strtotime($post->endtime)));
			}
			if(!empty($post->username))
			{
				$this->where('uid in (select id from user where telephone like ?)',array('%'.$post->username.'%'));
			}
			if(!empty($post->content))
			{
				$this->where('content like ?',array('%'.$post->content.'%'));
			}
			if(!empty($post->score))
			{
				$this->where('score>?',array($post->score));
			}
		}
		return $this->select(implode(',', $parameter));
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
		$cid = $this->lastInsertId();
		if(!empty($files))
		{
			foreach($files as $file)
			{
				$this->query('insert into comment_pic value (?,?,?)',array(NULL,$cid,$file));
			}
		}
		return true;
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
	function getByPid($pid,$start = 0,$length = 0)
	{
		if(!empty($start) && !empty($length))
		{
			$this->limit($start,$length);
		}
		else if(!empty($start))
		{
			$this->limit($start);
		}
		$this->orderby('time','desc');
		return $this->where('pid=?',array($pid))->select();
	}
}