<?php
namespace application\model;
use system\core\model;
use system\core\random;
use application\message\json;
/**
 * 退货申请数据模型
 * @author jin12
 *
 */
class refundModel extends model
{
	/**
	 * 退款类型 包括退货
	 * @var unknown
	 */
	const REFUND_TYPE_GOODS = 1;
	
	/**
	 * 退款类型 不包括退货
	 * @var unknown
	 */
	const REFUND_TYPE = 0;
	
	
	/**
	 * 退款申请尚未处理
	 * @var unknown
	 */
	const REFUND_HANDLE_NO = 0;
	
	/**
	 * 退款申请处理完成
	 * @var unknown
	 */
	const REFUND_HANDLE_FINISH = 1;
	
	/**
	 * 退款申请已经关闭
	 * @var unknown
	 */
	const REFUND_HANDLE_CLOSE = 2;
	
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 获取退款申请信息
	 * @param unknown $id
	 * @return NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 创建退货申请
	 */
	function create($uid,$oid,$type,$reason,$money,$description,$imgs)
	{
		$orderModel = $this->model('orderlist');
		$order = $orderModel->where('id=?',array($oid))->limit(1)->select('ordertotalamount,status,money');
		if (empty($order))
			return new json(json::PARAMETER_ERROR,'订单不存在');
		$money = (($order[0]['money'] + $order[0]['ordertotalamount'])>=$money)?$money:($order[0]['ordertotalamount']+$order[0]['money']);
		
		$refundno = date("YmdHis").$uid.$oid.random::number(4);
		
		$data = array(
			'id' => NULL,
			'refundno' => $refundno,
			'uid' => $uid,
			'oid' => $oid,
			'type'=> $type,
			'time'=> $_SERVER['REQUEST_TIME'],
			'reason'=>$reason,
			'money' => $money,
			'description' => $description,
			'o_status'=>$order[0]['status'],
			'handle' => self::REFUND_HANDLE_NO
		);
		$rid = $this->insert($data);
		if($rid)
		{
			foreach($imgs as $img)
			{
				$refundimg = $this->model('refundimg');
				$refundimg->insert(array(NULL,$rid,$img));
			}
		}
		return $rid;
	}
	
	/**
	 * 取消退款申请
	 * @param unknown $id
	 */
	function close($id)
	{
		$refund = $this->where('oid=? and handle=?',array($id,refundModel::REFUND_HANDLE_NO))->select();
		if(empty($refund))
			return false;
		if($refund[0]['handle'] == self::REFUND_HANDLE_NO)
		{
			$orderModel = $this->model('orderlist');
			//恢复订单状态
			$orderModel->where('id=?',array($refund[0]['oid']))->update('status',$refund[0]['o_status']);
			return $this->where('oid=?',array($id))->update('handle',self::REFUND_HANDLE_CLOSE);
		}
		return FALSE;
	}
	
	/**
	 * 更改退款申请的状态
	 */
	function updateHandle($id,$handle)
	{
		return $this->where('id=?',array($id))->update('handle',$handle);
	}
	
	/**
	 * 获得订单的退款申请
	 * @param unknown $oid
	 */
	function getByOid($oid)
	{
		$this->orderby('time','desc');
		$result = $this->where('oid=?',array($oid))->limit(1)->select();
		return isset($result[0])?$result[0]:array();
	}
	
	/**
	 * 检查订单是否是handle状态
	 */
	function checkOid($oid,$handle)
	{
		$result = $this->where('oid=? and handle=?',array($oid,$handle))->select('count(*)');
		return isset($result[0]['count(*)'])?$result[0]['count(*)']>0:false;
	}
	
	function fetchAll(array $filter = array())
	{
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*';
		if (isset($filter['start']) && $filter['length'])
		{
			$this->limit($filter['start'],$filter['length']);
		}
		$this->table('orderlist','left join','refund.oid=orderlist.id');
		$this->table('user','left join','orderlist.uid=user.id');
		return $this->select($parameter);
	}
	
	/**
	 * 删除退货申请
	 * @param unknown $id
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
}