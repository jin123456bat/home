<?php
namespace application\model;
use system\core\model;
/**
 * 提现数据模型
 * @author jin12
 *
 */
class drawalModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 请求提现
	 * @param unknown $uid
	 * @param unknown $money
	 * @param unknown $note
	 * @param unknown $bid
	 * @return \system\core\Ambigous
	 */
	function create($uid,$money,$note,$bid)
	{
		$data = array(
			'id' => NULL,
			'uid'=>$uid,
			'money'=>$money,
			'time'=>$_SERVER['REQUEST_TIME'],
			'handle'=>0,
			'handletime'=>0,
			'note'=>$note,
			'bid'=>$bid
		);
		return $this->insert($data);
	}
	
	/**
	 * 更改提现请求的处理状态
	 * @param unknown $id
	 * @param unknown $handle
	 * @return \system\core\Ambigous
	 */
	function handle($id,$handle)
	{
		if($handle == 1)
			return $this->where('id=?',array($id))->update(array('handle'=>1,'handletime'=>$_SERVER['REQUEST_TIME']));
		return $this->where('id=?',array($id))->update('handle',$handle);
	}
	
	function fetch($filter)
	{
		if(isset($filter['start']) && isset($filter['length']))
		{
			$this->limit($filter['start'],$filter['length']);
		}
		if(isset($filter['uid']))
		{
			$this->where('drawal.uid=?',array($filter['uid']));
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
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*';
		$this->table('user','left join','drawal.uid=user.id');
		$this->table('bankcard','left join','bankcard.id=drawal.bid');
		return $this->select($parameter);
	}
}