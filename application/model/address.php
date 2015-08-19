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
	
	function get($id,$name = '*')
	{
		$result = $this->where('id=?',array($id))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	/**
	 * 获取用户的地址
	 * @param unknown $uid
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll($uid)
	{
		$this->where('uid=?',array($uid));
		return $this->select();
	}
	
	/**
	 * 保存用户的地址
	 * @param unknown $id
	 * @param unknown $uid
	 * @param unknown $province
	 * @param unknown $city
	 * @param unknown $address
	 * @param unknown $name
	 * @param unknown $telephone
	 * @param unknown $zcode
	 * @param unknown $host
	 */
	function save($id,$uid,$province,$city,$address,$name,$telephone,$zcode,$host = 0)
	{
		$host = empty($host)?0:1;
		if(!empty($host))
		{
			//取消其他的默认地址
			$this->where('uid=?',array($uid))->update('host',0);
		}
		$this->where('id=? and uid=?',array($id,$uid))->update(array('province'=>$province,'city'=>$city,'address'=>$address,'name'=>$name,'telephone'=>$telephone,'zcode'=>$zcode,'host'=>$host));
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
	function create($uid,$province,$city,$address,$name,$telephone,$zcode,$host = 0)
	{
		$host = empty($host)?0:1;
		if($host)
		{
			//取消其他的默认地址
			$this->where('uid=?',array($uid))->update('host',0);
		}
		$array = array(NULL,$uid,$province,$city,$address,$name,$telephone,$zcode,$host);
		if($this->insert($array))
		{
			return $this->lastInsertId();
		}
		return false;
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