<?php
namespace application\model;
use system\core\model;
/**
 * 银行卡模型
 * @author jin12
 *
 */
class bankcardModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function get($id,$name= '*')
	{
		$this->table('province','left join','province.id=bankcard.province');
		$this->table('city','left join','city.id=bankcard.city');
		$result = $this->where('bankcard.id=?',array($id))->select($name);
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 添加用户银行卡
	 * @param unknown $uid
	 * @param unknown $bank
	 * @param unknown $number
	 * @param unknown $name
	 * @return \system\core\Ambigous
	 */
	function create($uid,$bank,$number,$name,$subbank,$province,$city,$type)
	{
		return $this->insert(array(NULL,$uid,$bank,$number,$name,$subbank,$province,$city,$type));
	}
	
	/**
	 * 保存修改
	 * @param unknown $id
	 * @param array $data
	 * @return \system\core\Ambigous
	 */
	function save($id,array $data = array())
	{
		return $this->where('id=?',array($id))->update($data);
	}
	
	/**
	 * 查询
	 * @param array $filter
	 */
	function fetch(array $filter = array())
	{
		if (isset($filter['start']) && isset($filter['length']))
		{
			$this->limit($filter['start'],$filter['length']);
		}
		if(isset($filter['uid']))
		{
			$this->where('bankcard.uid=?',array($filter['uid']));
		}
		if(isset($filter['order']))
		{
			if(is_string($filter['order']))
			{
				$this->orderby($filter['order']);
			}
			else
			{
				$this->orderby($filter['order'][0],$filter['order'][1]);
			}
		}
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*';
		$this->table('province','left join','province.id=bankcard.province');
		$this->table('city','left join','city.id=bankcard.city');
		
		$result = $this->select($parameter);
		return $result;
	}
	
	/**
	 * 删除用户银行卡
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
}