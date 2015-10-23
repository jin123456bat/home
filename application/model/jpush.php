<?php
namespace application\model;
use system\core\model;
class jpushModel extends model
{
	
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 
	 * @param unknown $uid
	 * @param unknown $content
	 * @param unknown $json
	 * @return \system\core\Ambigous
	 */
	function create($uid,$content,$send_no,$message_id)
	{
		$data = array(
			'id'=>NULL,
			'uid'=>$uid,
			'content'=>$content,
			'time'=>$_SERVER['REQUEST_TIME'],
			'sendno' => $send_no,
			'msg_id' => $message_id
		);
		return $this->insert($data);
	}
	
	/**
	 * 获取记录
	 * @param unknown $parameter
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetch($parameter)
	{
		$this->table('admin','left join','jpush.uid=admin.id');
		return $this->select($parameter);
	}
}