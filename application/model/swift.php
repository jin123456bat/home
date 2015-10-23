<?php
namespace application\model;
use system\core\model;
class swiftModel extends model
{
	/**
	 * 收入
	 * @var unknown
	 */
	const SWIFT_IN = 0;
	
	/**
	 * 支出
	 * @var unknown
	 */
	const SWIFT_OUT = 1;
	
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加流水记录
	 * @param unknown $uid
	 * @param unknown $type
	 * @param unknown $money
	 * @param string $note
	 * @return \system\core\Ambigous
	 */
	function create($uid,$type,$money,$note = '')
	{
		$data = array(
			'id' => NULL,
			'uid' => $uid,
			'type' => $type,
			'money' =>$money,
			'time' => $_SERVER['REQUEST_TIME'],
			'note' => $note
		);
		return $this->insert($data);
	}
	
	/**
	 * 获得流水记录
	 */
	function fetchAll($filter)
	{
		if(isset($filter['uid']))
		{
			$this->where('uid=?',array($filter['uid']));
		}
		if(isset($filter['order']))
		{
			if(is_array($filter['order']))
			{
				if (is_array($filter['order'][0]))
				{
					foreach ($filter['order'][0] as $key => $value)
					{
						$this->orderby($key,$value);
					}
				}
				else if (is_string($filter['order'][0]))
				{
					$this->orderby($filter['order'][0],$filter['order'][1]);
				}
			}
			else if (is_string($filter['order']))
			{
				$this->orderby($filter['order']);
			}
		}
		if (isset($filter['start']) && isset($filter['length']))
		{
			$this->limit($filter['start'],$filter['length']);
		}
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*';
		return $this->select($parameter);
	}
}