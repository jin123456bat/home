<?php
namespace application\model;
use system\core\model;
/**
 * 
 * 满减组合数据模型
 * @author jin12
 *
 */
class fullcutModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 保存
	 */
	function save($id,$name,$max,$minus,$starttime,$endtime)
	{
		$starttime = strtotime($starttime);
		$endtime = strtotime($endtime);
		return $this->where('id=?',array($id))->update(array('name'=>$name,'max'=>$max,'minus'=>$minus,'starttime'=>$starttime,'endtime'=>$endtime));
	}
	
	/**
	 * 获得指定id的信息
	 * @param unknown $id
	 * @return NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?',array($id))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 获得所有满减组合数据
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll()
	{
		return $this->select();
	}
	
	/**
	 * 创建满减组合规则
	 */
	function create($name,$max,$minus,$starttime,$endtime)
	{
		$starttime = strtotime($starttime);
		$endtime = strtotime($endtime);
		$data =array(NULL,$name,$max,$minus,$starttime,$endtime);
		return $this->insert($data);
	}
	
	/**
	 * 移除满减组合规则 以及组下的所有产品
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		$this->table('fullcutdetail','left join','fullcut.id=fullcutdetail.fid');
		$this->where('fullcut.id=?',array($id));
		return $this->delete('fullcut,fullcutdetail');
	}
	
	
}