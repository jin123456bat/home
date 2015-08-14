<?php
namespace application\model;
use system\core\model;
/**
 * 优惠券数据模型
 * @author jin12
 *
 */
class couponModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * ajax搜索
	 * @param unknown $post
	 */
	function searchable($post)
	{
		//var_dump($post->display);
		$parameter = array();
		foreach($post->columns as $key=>$value)
		{
			if($value['data'] == 'category')
				continue;	
			foreach($post->order as $orderby)
			{
				if($orderby['column']-1 == $key)
				{
					$this->orderby($value['data'],$orderby['dir']);
				}
			}
			$parameter[] = $value['data'];
		}
		if(!empty($post->action) && $post->action=='filter')
		{
			if(!empty($post->coupon_id))
			{
				$this->where('couponno=?',array($post->coupon_id));
			}
			if(!empty($post->starttime_from))
			{
				$this->where('starttime>?',array(strtotime($post->starttime_from)));
			}
			if(!empty($post->starttime_to))
			{
				$this->where('starttime<?',array(strtotime($post->starttime_to)));
			}
			if(!empty($post->endtime_from))
			{
				$this->where('endtime>?',array(strtotime($post->endtime_from)));
			}
			if(!empty($post->endtime_to))
			{
				$this->where('endtime<?',array(strtotime($post->endtime_to)));
			}
			if(!empty($post->total))
			{
				$this->where('total>?',array($post->total));
			}
			if(!empty($post->times))
			{
				$this->where('times>?',array($post->times));
			}
			//$this->where('display=?',array($post->display));
			if(!empty($post->value))
			{
				if((int)$post->value > 1)
				{
					$this->where('type=? and value>?',array('fixed',$post->value));
				}
				else
				{
					$this->where('type=? and value>?',array('discount',$post->value));
				}
			}
		}
		return $this->select(implode(',', $parameter));
	}
	
	/**
	 * 优惠代码数量
	 */
	function count()
	{
		$result = $this->select('count(*)');
		return $result[0]['count(*)'];
	}
	
	/**
	 * 判断优惠码是否存在
	 * @param unknown $couponno
	 */
	function exist($couponno)
	{
		$result = $this->where('couponno=?',array($couponno))->select();
		return isset($result[0]);
	}
	
	/**
	 * 创建优惠
	 */
	function create($couponno,$total,$starttime,$endtime,$display,$type,$value)
	{
		$couponno = strtoupper($couponno);
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+24*3600:strtotime($endtime);
		$total = empty($total)?100:$total;
		$value = empty($value)?1:$value;
		$times = $total;
		$display = empty($display)?0:1;
		$data = array(NULL,$couponno,$total,$starttime,$endtime,$times,$display,$type,$value);
		if($this->insert($data))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	function remove($id)
	{
		$this->where('coupon.id=?',array($id));
		$this->table('coupondetail','left join','coupon.id=coupondetail.couponid');
		return $this->delete('coupon,coupondetail');
	}
}