<?php
namespace application\model;
use system\core\model;
/**
 * 注册活动领奖记录
 * @author jin12
 *
 */
class register_logModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 是领过奖
	 * @param unknown $uid
	 */
	function checkUser($uid)
	{
		$result = $this->where('uid=?',array($uid))->select();
		return empty($result);
	}
	
	function write($uid,$cid)
	{
		return $this->insert(array(NULL,$uid,$cid));
	}
}