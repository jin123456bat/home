<?php
namespace application\model;
use system\core\model;
/**
 * 微信的预支付订单
 * @author jin12
 *
 */
class weixinprepayModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加微信预支付信息
	 * @param unknown $data
	 */
	function create($orderno,$data)
	{
		$time = $_SERVER['REQUEST_TIME'];
		$result = $this->get($orderno);
		if(empty($result))
			return $this->insert(array_merge(array('id'=>NULL),$data,array('orderno'=>$orderno,'createtime'=>$time)));
		return false;
	}
	
	/**
	 * 删除预支付订单
	 */
	function remove($orderno)
	{
		return $this->where('orderno=?',array($orderno))->delete();
	}
	
	/**
	 * 获取微信预支付信息
	 * @param unknown $orderno
	 */
	function get($orderno,$name = '*')
	{
		$result = $this->where('orderno=?',array($orderno))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
}