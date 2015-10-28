<?php
namespace application\model;
use system\core\model;
use application\classes\order;
class rechargeModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function create($uid,$money)
	{
		$orderHelper = new order();
		$orderno = $orderHelper->swift($uid,4);
		$data = ['id'=>NULL,'orderno'=>$orderno,'uid'=>$uid,'money'=>$money,'time'=>$_SERVER['REQUEST_TIME'],'status'=>0];
		$id = $this->insert($data);
		if($id)
		{
			$data['id'] = $id;
			return $data;
		}
		return false;
	}
	
	function get($orderno)
	{
		$result = $this->where('orderno=?',array($orderno))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 更改充值订单状态
	 * @param unknown $orderno
	 * @param unknown $status
	 * @return \system\core\Ambigous
	 */
	function status($orderno,$status)
	{
		return $this->where('orderno=?',array($orderno))->update('status',$status);
	}
	
	function fetchAll()
	{
		return $this->select();
	}
}