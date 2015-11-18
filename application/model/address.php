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
		$this->table('province','left join','province.id=address.province');
		$this->table('city','left join','city.id=address.city');
		$result = $this->where('address.id=?',array($id))->select($name);
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 收货地址列表
	 * @param unknown $start
	 * @param unknown $length
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll(array $filter = array())
	{
		if (isset($filter['id']))
		{
			$this->where('address.id=?',array($filter['id']));
		}
		if(isset($filter['uid']))
		{
			$this->where('address.uid=?',array($filter['uid']));
		}
		if (isset($filter['start']) && isset($filter['length']))
		{
			$this->limit($filter['start'],$filter['length']);		
		}
		if(isset($filter['order']))
		{
			if(is_array($filter['order']))
			{
				$this->orderby($filter['order'][0],$filter['order'][1]);
			}
			else
			{
				$this->orderby($filter['order']);
			}
		}
		$this->table('user','left join','address.uid=user.id');
		$this->table('province','left join','province.id=address.province');
		$this->table('city','left join','address.city=city.id');
		return $this->select('city.name as city,province.name as province,province.id as provinceid,city.id as cityid,address.id,user.gravatar,user.username,user.telephone as u_telephone,address.address,address.name,address.telephone,address.zcode,address.host,address.county');
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
	function save($id,$uid,$province,$city,$county,$address,$name,$telephone,$zcode,$host = 0)
	{
		$host = empty($host)?0:1;
		if(!empty($host))
		{
			//取消其他的默认地址
			$this->where('uid=?',array($uid))->update('host',0);
		}
		$data = array('province'=>$province,'city'=>$city,'county'=>$county,'address'=>$address,'name'=>$name,'telephone'=>$telephone,'zcode'=>$zcode,'host'=>$host);
		return $this->where('id=? and uid=?',array($id,$uid))->update($data);
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
	function create($uid,$province,$city,$county,$address,$name,$telephone,$zcode,$host = 0)
	{
		$host = empty($host)?0:1;
		if($host)
		{
			//取消其他的默认地址
			$this->where('uid=?',array($uid))->update('host',0);
		}
		$array = array(NULL,$uid,$province,$city,$county,$address,$name,$telephone,$zcode,$host);
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
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 获取一个用户的默认收货地址 当没有默认收货地址时获得最后一次添加的收货地址
	 * @param unknown $uid 用户id
	 * @return array 收货地址信息
	 */
	function getHost($uid)
	{
		$this->where('uid=?',array($uid));
		$this->table('province','left join','address.province=province.id');
		$this->table('city','left join','address.city=city.id');
		$result = $this->orderby('host','desc')->orderby('id','desc')->limit(1)->select('address.id,address.province as provinceid,province.name as province,city.name as city,address.city as cityid,address.host,address.telephone,address.name,address.zcode,address.address,address.county');
		return isset($result[0])?$result[0]:NULL;
	}
}