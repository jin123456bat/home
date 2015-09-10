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
	
}