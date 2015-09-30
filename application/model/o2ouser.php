<?php
namespace application\model;
use system\core\model;
/**
 * o2o用户数据模型
 * @author jin12
 *
 */
class o2ouserModel extends model
{
	/**
	 * 构造函数
	 * @param unknown $table
	 */
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 获取推广员信息
	 * @param unknown $id
	 * @param string $name
	 * @return NULL
	 */
	function get($id,$name = '*')
	{
		$this->table('user','left join','o2ouser.uid=user.id');
		$result = $this->where('o2ouser.uid=?',array($id))->select($name);
		if($name == '*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	/**
	 * 把会员设置为推广员用户
	 * @param unknown $uid
	 * @param unknown $name
	 * @param unknown $qq
	 * @param unknown $address
	 * @param unknown $rate
	 * @return boolean|\system\core\Ambigous
	 */
	function create($uid,$name,$qq,$address,$rate)
	{
		$result = $this->where('uid=?',array($uid))->select('count(*)');
		if(isset($result[0]['count(*)']) && $result[0]['count(*)']>0)
			return false;
		$num = 0;
		$money = 0;
		$data = array(NULL,$uid,$_SERVER['REQUEST_TIME'],$name,$qq,$address,$rate,$num,$money);
		return $this->insert($data);
	}
	
	/**
	 * 移除推广员
	 * @param unknown $uid
	 * @return \system\core\Ambigous
	 */
	function remove($uid)
	{
		return $this->where('uid=?',array($uid))->delete();
	}
	
	/**
	 * o2o用户的手机号码获得用户id  没有返回NULL
	 * @param unknown $telephone
	 * @return NULL
	 */
	function check($telephone)
	{
		$this->table('user','left join','o2ouser.uid=user.id');
		$this->where('user.telephone=?',array($telephone));
		$result = $this->select('user.id');
		return isset($result[0]['id'])?$result[0]['id']:NULL;
	}
	
	/**
	 * 编译推广员所有信息
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll(array $filter = array())
	{
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*,o2ouser.money as o_money';
		if(isset($filter['telephone']))
		{
			$this->where('user.telephone=?',array($filter['telephone']));
		}
		$this->table('user','left join','o2ouser.uid=user.id');
		return $this->select($parameter);
	}
	
	
	/**
	 * o2o用户登录
	 * @param unknown $telephone
	 * @param unknown $password
	 * @return boolean
	 */
	function login($telephone,$password)
	{
		$filter = array(
			'parameter' => 'user.id,user.telephone,user.password,user.salt,o2ouser.name',
			'telephone' => $telephone
		);
		$result = $this->fetchAll($filter);
		if(!isset($result[0]) || empty($result))
			return false;
		$password = md5($password.$result[0]['salt']);
		if($password == $result[0]['password'])
		{
			return $result[0];
		}
		return false;
	}
}