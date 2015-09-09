<?php
namespace application\model;
use system\core\model;
use system\core\file;

/**
 * 留言反馈数据模型
 * @author jin12
 *
 */
class messageModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function fetchAll($start,$length)
	{
		$this->limit($start,$length);
		$this->orderby('message.time','desc');
		$this->table('user','left join','message.uid=user.id');
		$result = $this->select();
		foreach($result as &$message)
		{
			$message['gravatar'] = file::realpathToUrl($message['gravatar']);
		}
		return $result;
	}
	
	function create($uid,$content)
	{
		return $this->insert(array(NULL,$uid,$_SERVER['REQUEST_TIME'],$content));
	}
}