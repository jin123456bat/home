<?php
namespace application\model;
use system\core\model;
/**
 * 收货地址数据模型
 * @author jin12
 *
 */
class addressModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加收货地址
	 * @param unknown $uid 用户id
	 * @param unknown $city 城市
	 * @param unknown $address 详细地址
	 * @param unknown $name 收货人名称
	 * @param unknown $telephone 收货人电话
	 * @param unknown $host 是否为默认地址
	 */
	function create($uid,$city,$address,$name,$telephone,$host = 0)
	{
		if($host)
		{
			//取消其他的默认地址
			$this->where('uid=?',array($uid))->update('host',0);
		}
		$array = array(NULL,$uid,$city,$address,$name,$telephone,$host);
		$this->insert($array);
		return $this->lastInsertId();
	}
	
	/**
	 * 设置一个地址为默认收货地址
	 * @param unknown $id 收货地址的id
	 * @param unknown $uid 收货地址的用户id
	 */
	function setHost($id,$uid)
	{
		$this->where('uid=?',array($uid))->update('host',0);
		$this->where('id=? and uid=?',array($id,$uid))->update('host',1);
	}
	
	
	/**
	 * 移除一个收货地址
	 * @param unknown $id
	 */
	function remove($id)
	{
		$this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 获取一个用户的默认收货地址 当没有默认收货地址时获得最后一次添加的收货地址
	 * @param unknown $uid 用户id
	 * @return array 收货地址信息
	 */
	function getHost($uid)
	{
		$this->where('uid=?',array($uid));
		$result = $this->orderby('host','desc')->orderby('id','desc')->select();
		return isset($result[0])?$result[0]:NULL;
	}
}