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
	 * 复制一个优惠卷给用户
	 * @param unknown $uid
	 * @param array $coupon
	 */
	function copyForUser($uid,$couponno,array $coupon)
	{
		$total = $coupon['total'];
		$starttime = $coupon['starttime'];
		$endtime = $coupon['endtime'];
		$max = $coupon['max'];
		$display = 0;
		$type = $coupon['type'];
		$value = $coupon['value'];
		
		return $this->create($couponno, $uid, $total, $starttime, $endtime, $max, $display, $type, $value);
	}
	
	/**
	 * 获取公开可以使用的优惠券
	 */
	function publicCoupon($price = NULL)
	{
		$this->where('display=? and (starttime<? or starttime=0)',array(1,$_SERVER['REQUEST_TIME']));
		$this->where('(endtime=0 or endtime>?)',array($_SERVER['REQUEST_TIME']));
		if($price !== NULL)
		{
			$this->where('max<=?',array($price));
		}
		$this->where('times>?',array(0));
		return $this->select();
	}
	
	/**
	 * 获取用户的优惠券
	 * @param unknown $uid
	 * @param bool $past 结果集中是否包含无法使用的优惠券 默认包含
	 */
	function mycoupon($uid,$past = true,$filter = array())
	{
		$this->where('display=?',array(0));
		if(!empty($filter))
		{
			if(isset($filter['max']))
			{
				$this->where('max <= ?',array($filter['max']));
			}
		}
		if(!$past)
		{
			$this->where('starttime < ?  and (endtime > ? or endtime=0) and times>?',array($_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME'],0));
		}
		return $this->where('uid=?',array($uid))->select();
	}
	
	/**
	 * 验证商品是否可以使用折扣 并返回折扣信息
	 * @param unknown $couponno
	 * @param unknown $product
	 */
	function check($couponno,$product)
	{
		if(empty($couponno))
			return false;
		$this->where('starttime<? and (endtime>? or endtime=0)',array($_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME']));
		$this->where('times>?',array(0));
		$this->where('coupondetail.categoryid=? or coupondetail.categoryid=?',array($product['category'],0));
		$this->table('coupondetail','left join','coupondetail.couponid=coupon.id');
		$this->where('couponno=?',array($couponno));
		$result = $this->select();
		return isset($result[0])?$result[0]:NULL;
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
			if(!empty($post->couponno))
			{
				$this->where('couponno like ?',array('%'.$post->couponno.'%'));
			}
			if($post->uid != '')
			{
				$this->where('uid = ?',array($post->uid));
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
			if(!empty($post->max))
			{
				$this->where('max>?',array($post->max));
			}
			if(!empty($post->total))
			{
				$this->where('total>?',array($post->total));
			}
			if(!empty($post->times))
			{
				$this->where('times>?',array($post->times));
			}
			if($post->display != 2)
				$this->where('display=?',array($post->display));
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
		if(isset($post->start) && isset($post->length))
		{
			$this->limit($post->start,$post->length);
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
	 * 获得一张优惠券信息
	 * @param unknown $couponno
	 * @return Ambigous <boolean, multitype:>
	 */
	function get($couponno,$name = '*')
	{
		$result = $this->where('couponno=? or id=?',array($couponno,$couponno))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	/**
	 * 创建优惠
	 */
	function create($couponno,$uid,$total,$starttime,$endtime,$max,$display,$type,$value)
	{
		$couponno = strtoupper($couponno);
		$starttime = empty(strtotime($starttime))?$_SERVER['REQUEST_TIME']:strtotime($starttime);
		$endtime = empty(strtotime($endtime))?$_SERVER['REQUEST_TIME']+24*3600:strtotime($endtime);
		$total = empty($total)?100:$total;
		$value = empty($value)?1:$value;
		$times = $total;
		$max = empty($max)?0:$max;
		$display = empty($display)?0:1;
		$uid = empty($uid)?0:$uid;
		$data = array(NULL,$couponno,$uid,$total,$starttime,$endtime,$times,$max,$display,$type,$value);
		if($this->insert($data))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	/**
	 * 删除优惠券
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		$this->where('coupon.id=?',array($id));
		return $this->delete();
	}
	
	/**
	 * 减少优惠券使用次数
	 */
	function increaseTimes($couponno,$num = 1)
	{
		$this->where('couponno=?',array($couponno))->increase('times',-$num);
		$result = $this->where('couponno=?',array($couponno))->select('times');
		if(isset($result[0]['times']) && $result[0]['times']<0)
		{
			$this->where('couponno=?',array($couponno))->increase('times',$num);
			return false;
		}
		return true;
	}
}