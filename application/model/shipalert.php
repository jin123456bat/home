<?php
namespace application\model;
use system\core\model;
class shipalertModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加提醒
	 * @param unknown $uid
	 * @param unknown $oid
	 * @return \system\core\Ambigous|boolean
	 */
	function create($uid,$oid)
	{
		if(!$this->check($uid, $oid))
		{
			return $this->insert(array(NULL,$uid,$oid,$_SERVER['REQUEST_TIME'],0));
		}
		return false;
	}
	
	/**
	 * 检查是否已经提醒过了
	 * @param unknown $uid
	 * @param unknown $oid
	 */
	function check($uid,$oid)
	{
		$result = $this->where('uid=? and oid=? and ok=?',array($uid,$oid,0))->select();
		return !empty($result);
	}
	
	/**
	 * 检索
	 * @param array $filter
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll(array $filter)
	{
		$field = (isset($filter['field']) && !empty($filter['field']))?$filter['field']:'*';
		$this->table('user','left join','user.id=shipalert.uid');
		$this->table('orderlist','left join','orderlist.id=shipalert.oid');
		$this->where('ok=?',array(0));
		$this->orderby('shipalert.time','desc');
		return $this->select($field);
	}
	
	function ok($id)
	{
		return $this->where('id=?',array($id))->update('ok',1);
	}
	
}