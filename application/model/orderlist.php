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
	 * 删除订单
	 * @param unknown $id
	 * @return boolean|\system\core\Ambigous
	 */
	function remove($id)
	{
		if(is_array($id))
		{
			foreach ($id as $remove_id)
			{
				$this->where('id=?',array($remove_id))->delete();
			}
			return true;
		}
		return $this->where('id=?',array($id))->delete();
		
	}
	
	/**
	 * 创建一个订单
	 * @param unknown $data
	 * @return string|boolean
	 */
	function create($data,$orderdetail)
	{
		if($this->insert($data))
		{
			$oid = $this->lastInsertId();
			$orderdetailModel = $this->model('orderdetail');
			foreach ($orderdetail as $detail)
			{
				$detail = array_merge(array(NULL,$oid),$detail);
				foreach ($detail as &$array)
				{
					if(is_array($array))
					{
						$array = serialize($array);
					}
				}
				$orderdetailModel->insert($detail);
			}
			return $oid;
		}
		return false;
	}
	
	/**
	 * ajxa搜索
	 * @param unknown $post
	 * @param unknown $pid
	 * @return Ambigous <boolean, multitype:>
	 */
	function searchable($post,$pid = NULL)
	{
		if($pid !=NULL)
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
				if($orderby['column']+1 == $key)
				{
					$this->orderby($value['data'],$orderby['dir']);
				}
			}
			$array[] = $value['data'];
		}
		if(!empty($post->action) && $post->action == 'filter')
		{
			if(!empty($post->orderno))
			{
				$this->where('orderno like ?',array('%'.$post->orderno.'%'));
			}
			if(!empty($post->createtime_from))
			{
				$this->where('createtime > ?',array(strtotime($post->createtime_from)));
			}
			if(!empty($post->createtime_to))
			{
				$this->where('createtime > ?',array(strtotime($post->createtime_to)));
			}
			if(!empty($post->telephone))
			{
				$this->where('uid in (select id from user where telephone like ?)',array('%'.$post->telephone.'%'));
			}
			if(!empty($post->uid))
			{
				$this->where('uid=?',array($post->uid));
			}
			if(!empty($post->postmode))
			{
				$this->where('postmode like ?',array('%'.$post->postmode.'%'));
			}
			if(!empty($post->paytype))
			{
				$this->where('paytype like ?',array('%'.$post->paytype.'%'));
			}
			if(!empty($post->client))
			{
				$this->where('client = ?',array($post->client));
			}
			if(!empty($post->ordertotalamount_from))
			{
				$this->where('ordertotalamount >?',array($post->ordertotalamount_from));
			}
			if(!empty($post->ordertotalamount_to))
			{
				$this->where('ordertotalamount <?',array($post->ordertotalamount_to));
			}
			if(!empty($post->ordergoodsamount_from))
			{
				$this->where('ordergoodsamount > ?',array($post->ordergoodsamount_from));
			}
			if(!empty($post->ordergoodsamount_to))
			{
				$this->where('ordergoodsamount < ?',array($post->ordergoodsamount_to));
			}
			if(!empty($post->totalamount_from))
			{
				$this->where('totalamount > ?',array($post->totalamount_from));
			}
			if(!empty($post->totalamount_to))
			{
				$this->where('totalamount < ?',array($post->totalamount_to));
			}
			if($post->status != '')
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