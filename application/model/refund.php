<?php
namespace application\model;
use system\core\model;
/**
 * 退货申请数据模型
 * @author jin12
 *
 */
class refundModel extends model
{
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
	function create($uid,$oid,$reason)
	{
		$orderlistModel = $this->model('orderlist');
		$result = $orderlistModel->where('id=? and uid=? and status=?',array($oid,$uid,1))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$handle = self::REFUND_HANDLE_NO;
		return $this->insert(array(NULL,$oid,$_SERVER['REQUEST_TIME'],$reason,$handle));
	}
	
	/**
	 * 更改退款申请的状态
	 */
	function updateHandle($id,$handle)
	{
		$this->where('id=?',array($id))->update('handle',$handle);
	}
	
	/**
	 * 获得订单的退款申请
	 * @param unknown $oid
	 */
	function getByOid($oid)
	{
		$this->orderby('time','desc');
		$result = $this->where('oid=?',array($oid))->select();
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
	
	function fetchAll()
	{
		$this->table('orderlist','left join','refund.oid=orderlist.id');
		$this->table('user','left join','orderlist.uid=user.id');
		return $this->select('orderlist.id as order_id,orderlist.feeamount as order_feeamount,orderlist.ordertaxamount as order_ordertaxamount,orderlist.ordergoodsamount as order_ordergoodsamount,orderlist.ordertotalamount as order_ordertotalamount,refund.id as id,orderlist.orderno as order_orderno,refund.reason,user.gravatar as user_gravatar,user.username as user_username,user.telephone as user_telephone');
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