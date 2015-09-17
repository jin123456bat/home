<?php
namespace application\model;

use system\core\model;
use system\core\file;

/**
 * 订单数据模型
 * 
 * @author jin12
 *        
 */
class orderlistModel extends model
{
	/**
	 * 等待支付
	 * @var unknown
	 */
	const STATUS_PAYING = 0;

	/**
	 * 支付完成状态码，等待发货
	 * @var unknown
	 */
	const STATUS_PAYED = 1;
	
	/**
	 * 订单关闭状态
	 * @var unknown
	 */
	const STATUS_CLOSE = 2;
	
	/**
	 * 用户取消支付
	 * @var unknown
	 */
	const STATUS_QUITE = 3;
	
	/**
	 * 已经发货 等待收货
	 * @var unknown
	 */
	const STATUS_SHIPPING = 4;
	
	/**
	 * 收货完毕等待评论
	 * @var unknown
	 */
	const STATUS_SHIPPED = 5;
	
	/**
	 * 订单完成评论
	 * @var unknown
	 */
	const STATUS_COMPLETE = 6;
	
	/**
	 * 订单进入退款流程
	 * @var unknown
	 */
	const STATUS_REFUND = 7;
	
	/**
	 * 构造函数
	 * @param unknown $table
	 */
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 给订单添加备注
	 * @param unknown $id
	 * @param unknown $note
	 */
	function note($id,$note)
	{
		return $this->where('id=?',array($id))->update('note',$note);
	}

	/**
	 * 获得用户订单详情
	 * 
	 * @param unknown $uid        	
	 * @return Ambigous <unknown, boolean, multitype:>
	 */
	function fetchAll($uid,$status = NULL,$start = 0,$length = 10)
	{
		if($status !== NULL)
		{
			$this->where('status = ?',array($status));
		}
		$start = empty($start)?0:$start;
		$length = empty($length)?10:$length;
		$this->limit($start,$length);
		$this->orderby('id','desc');
		$result = $this->where('uid=?', array(
			$uid
		))->select();
		return $result;
	}


	/**
	 * 获取订单信息
	 */
	function get($id, $name = '*')
	{
		$result = $this->where('id=?', array(
			$id
		))->select($name);
		if ($name == '*')
			return isset($result[0]) ? $result[0] : NULL;
		return isset($result[0][$name]) ? $result[0][$name] : NULL;
	}

	/**
	 * 更改订单状态
	 */
	function setStatus($orderno, $status, $endtime, $money, $transaction_id)
	{
		if (! empty($endtime)) {
			$endtime = strtotime($endtime);
		}
		return $this->where('orderno=?', array(
			$orderno
		))->update(array(
			'status' => $status,
			'tradetime' => $endtime,
			'totalamount' => $money,
			'paynumber' => $transaction_id
		));
	}

	/**
	 * 获取订单商品信息
	 */
	function getOrderDetail($id)
	{
		$orderdetailModel = $this->model('orderdetail');
		$result = $orderdetailModel->where('oid=?', array(
			$id
		))->select();
		$productimgModel = $this->model('productimg');
		foreach($result as &$goods)
		{
			$img = $productimgModel->limit(1)->orderby('orderby','desc')->where('pid=?',array($goods['pid']))->select();
			if(isset($img[0]['thumbnail_path']))
			{
				$goods['img'] = file::realpathToUrl($img[0]['thumbnail_path']);
			}
		}
		return $result;
	}

	/**
	 * 自定义导出
	 * 
	 * @param unknown $parameter        	
	 * @param array $id        	
	 * @return Ambigous <boolean, multitype:>
	 */
	function export($parameter, array $id)
	{
		if (! empty($id)) {
			$this->where('id in (?)', $id);
		}
		$this->table('user', 'left join', 'user.id=orderlist.uid');
		$this->table('orderdetail', 'left join', 'orderdetail.oid=orderlist.id');
		return $this->select($parameter);
	}

	/**
	 * 删除订单
	 * 
	 * @param unknown $id        	
	 * @return boolean|\system\core\Ambigous
	 */
	function remove($id)
	{
		if (is_array($id)) {
			foreach ($id as $remove_id) {
				$this->where('id=?', array(
					$remove_id
				))->delete();
			}
			return true;
		}
		return $this->where('id=?', array(
			$id
		))->delete();
	}
	
	/**
	 * 订单评分
	 * @param unknown $id 订单id
	 * @param unknown $uid 用户id
	 * @param unknown $ship_score 配送评分
	 * @param unknown $service_score 服务评分
	 * @param unknown $goods_score 商品评分
	 * @param string $content 评价内容
	 */
	function score($id,$uid,$ship_score,$service_score,$goods_score,$content)
	{
		return ($this->where('id=? and uid=?',array($id,$uid))->update(array('ship_score'=>$ship_score,'service_score'=>$service_score,'goods_score'=>$goods_score,'content'=>$content,'status'=>self::STATUS_COMPLETE)));
	}

	/**
	 * 创建一个订单
	 * 
	 * @param unknown $data        	
	 * @return string|boolean
	 */
	function create($data, $orderdetail)
	{
		$data[] = 0;
		$data[] = 0;
		$data[] = 0;
		$data[] = '';
		if ($this->insert($data)) {
			$oid = $this->lastInsertId();
			$orderdetailModel = $this->model('orderdetail');
			foreach ($orderdetail as $detail) {
				$detail = array_merge(array(
					'id'=>NULL,
					'oid'=>$oid
				), $detail);
				foreach ($detail as &$array) {
					if (is_array($array)) {
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
	 * 设置订单为已经收货
	 */
	function setShipped($id)
	{
		return $this->where('id=?',array($id))->update('status',self::STATUS_SHIPPED);
	}
	
	/**
	 * 设置订单为已经发货
	 */
	function setShipping($orderno)
	{
		return $this->where('orderno=?',array($orderno))->update('status',self::STATUS_SHIPPING);
	}
	
	/**
	 * 取消支付订单
	 */
	function quit($id)
	{
		return $this->where('id=?',array($id))->update('status',self::STATUS_QUITE);
	}
	
	/**
	 * 设置订单状态为退款状态
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function refund($id)
	{
		return $this->where('id=?',array($id))->update('status',self::STATUS_REFUND);
	}

	/**
	 * ajxa搜索
	 * 
	 * @param unknown $post        	
	 * @param unknown $pid        	
	 * @return Ambigous <boolean, multitype:>
	 */
	function searchable($post, $pid = NULL)
	{
		if ($pid != NULL) {
			// 当存在商品的是偶
			$this->where('orderdetail.pid=?', array(
				$pid
			));
			$this->table('orderdetail', 'right join', 'orderlist.id=orderdetail.oid');
		}
		$array = array();
		foreach ($post->columns as $key => $value) {
			foreach ($post->order as $orderby) {
				if ($orderby['column'] + 1 == $key) {
					$this->orderby($value['data'], $orderby['dir']);
				}
			}
			if ($pid !== NULL && $value['data'] == 'id')
				$value['data'] = '`orderlist`.id';
			$array[] = $value['data'];
		}
		if (! empty($post->action) && $post->action == 'filter') {
			if (! empty($post->orderno)) {
				$this->where('orderno like ?', array(
					'%' . $post->orderno . '%'
				));
			}
			if (! empty($post->createtime_from)) {
				$this->where('createtime > ?', array(
					strtotime($post->createtime_from)
				));
			}
			if (! empty($post->createtime_to)) {
				$this->where('createtime > ?', array(
					strtotime($post->createtime_to)
				));
			}
			if (! empty($post->telephone)) {
				$this->where('uid in (select id from user where telephone like ?)', array(
					'%' . $post->telephone . '%'
				));
			}
			if (! empty($post->uid)) {
				$this->where('uid=?', array(
					$post->uid
				));
			}
			if (! empty($post->postmode)) {
				$this->where('postmode like ?', array(
					'%' . $post->postmode . '%'
				));
			}
			if (! empty($post->paytype)) {
				$this->where('paytype like ?', array(
					'%' . $post->paytype . '%'
				));
			}
			if (! empty($post->client)) {
				$this->where('client = ?', array(
					$post->client
				));
			}
			if (! empty($post->ordertotalamount_from)) {
				$this->where('ordertotalamount >?', array(
					$post->ordertotalamount_from
				));
			}
			if (! empty($post->ordertotalamount_to)) {
				$this->where('ordertotalamount <?', array(
					$post->ordertotalamount_to
				));
			}
			if (! empty($post->ordergoodsamount_from)) {
				$this->where('ordergoodsamount > ?', array(
					$post->ordergoodsamount_from
				));
			}
			if (! empty($post->ordergoodsamount_to)) {
				$this->where('ordergoodsamount < ?', array(
					$post->ordergoodsamount_to
				));
			}
			if (! empty($post->totalamount_from)) {
				$this->where('totalamount > ?', array(
					$post->totalamount_from
				));
			}
			if (! empty($post->totalamount_to)) {
				$this->where('totalamount < ?', array(
					$post->totalamount_to
				));
			}
			if ($post->status != '') {
				$this->where('status=?', array(
					$post->status
				));
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