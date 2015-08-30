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
	 * 用于app首页显示满减优惠  所有商品的满减信息以及商品信息
	 */
	function getIndex($length)
	{
		$a = $_SERVER['REQUEST_TIME'];
		$this->table('fullcutdetail','left join','fullcut.id=fullcutdetail.fid');
		$this->table('product','left join','fullcutdetail.pid=product.id');
		$this->where('(fullcut.starttime<? or fullcut.starttime=0) and (fullcut.endtime<? or fullcut.endtime=0) and (product.starttime<? or product.starttime=0) and (product.endtime>? or product.endtime=0)',array($a,$a,$a,$a));	
		$this->where('product.status=?',array(1));
		$this->where('product.stock>?',array(0));
		$this->limit($length);
		return $this->select('*,fullcut.starttime as f_startime,fullcut.endtime as f_endtime,fullcut.name as f_name');
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
		//清空activity
		$productModel = $this->model('product');
		$productModel->where('id in (select pid from fullcutdetail where fullcutdetail.fid=?)',array($id));
		$productModel->update('activity','');
		//删除fullcut
		$this->where('fullcut.id=?',array($id));
		return $this->delete();
	}
	
	
}