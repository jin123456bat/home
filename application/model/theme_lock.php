<?php
namespace application\model;
use system\core\model;
/**
 * 主题用户锁
 * @author jin12
 *
 */
class theme_lockModel extends model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * 添加用户锁
	 * @param unknown $uid
	 * @param unknown $tid
	 * @return \system\core\Ambigous|boolean
	 */
	function create($uid,$tid)
	{
		$result = $this->where('uid=? and tid=?',array($uid,$tid))->select();
		if(empty($result))
		{
			return $this->insert(array(NULL,$uid,$tid));
		}
		return false;
	}
}