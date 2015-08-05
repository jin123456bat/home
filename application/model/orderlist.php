<?php
namespace application\model;
use system\core\model;
/**
 * 订单数据模型
 * @author jin12
 *
 */
class orderlistModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * ajxa搜索
	 * @param unknown $post
	 * @param unknown $pid
	 * @return Ambigous <boolean, multitype:>
	 */
	function searchable($post,$pid = NULL)
	{
		if(!empty($pid))
		{
			//当存在商品的是偶
			$this->where('orderdetail.pid=?',array($pid));
			$this->table('orderdetail','right join','orderlist.id=orderdetail.oid');
		}
		$array = array();
		foreach($post->columns as $key => $value)
		{
			foreach ($post->order as $orderby)
			{
				if($orderby['column'] == $key)
				{
					$this->orderby($value['data'],$orderby['dir']);
				}
			}
			$array[] = $value['data'];
		}
		if(!empty($post->action) && $post->action == 'filter')
		{
			if(!empty($post->swift))
			{
				$this->where('swift like ?',array('%'.$post->swift.'%'));
			}
			if(!empty($post->starttime))
			{
				$this->where('createtime > ?',array(strtotime($post->starttime)));
			}
			if(!empty($post->endtime))
			{
				$this->where('createtime < ?',array(strtotime($post->endtime)));
			}
			if(!empty($post->telephone))
			{
				$this->where('uid in (select id from user where telephone like ?)',array('%'.$post->telephone.'%'));
			}
			if(!empty($post->status))
			{
				$this->where('status=?',array($post->status));
			}
		}
		return $this->select(implode(',', $array));
	}
	
	/**
	 * 所有订单数量
	 */
	function count()
	{
		$result = $this->select('count(*)');
		return $result[0]['count(*)'];
	}
}