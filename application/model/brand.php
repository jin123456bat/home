<?php
namespace application\model;

use system\core\model;
use system\core\file;

class brandModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function save($id,$name,$logo,$description)
	{
		$this->where('id=?',array($id))->update(['name'=>$name,'description'=>$description]);
		if(is_file($logo))
		{
			$this->where('id=?',array($id))->update('logo',$logo);
		}
		return true;
	}
	
	/**
	 * 根据产品数量 对品牌进行分组
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchByProduct($start,$length)
	{
		$this->where('close=?',array(0));
		$this->limit($start,$length);
		$brand = $this->select();
		$productModel = $this->model('product');
		foreach ($brand as &$value)
		{
			$value['logo'] = file::realpathToUrl($value['logo']);
			$productModel->where('bid=?',array($value['id']));
			$result = $productModel->select('count(*)');
			$value['num'] = $result[0]['count(*)'];
		}
		usort($brand, function($a,$b){
			if($a['num'] == $b['num'])
				return 0;
			return ($a['num']>$b['num'])?-1:1;
		});
		return $brand;
	}
	
	/**
	 * 获取指定id品牌的信息
	 * @param int $id 品牌id
	 * @return array|NULL
	 */
	function get($id,$name = '*')
	{
		$result = $this->where('id=?', array(
			$id
		))->select($name);
		if($name == '*')
			return isset($result[0]) ? $result[0] : NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}

	/**
	 * 创建品牌
	 * @param unknown $name
	 * @param unknown $logo
	 * @param unknown $description
	 * @return \system\core\Ambigous
	 */
	function create($name, $logo, $description)
	{
		$close = 0;
		return $this->insert(array(
			NULL,
			$name,
			$logo,
			$description,
			$close
		));
	}

	/**
	 * 关闭品牌
	 * @param unknown $id
	 * @param unknown $value
	 */
	function setClose($id, $value)
	{
		$this->where('id=?', array(
			$id
		))->update('close', $value);
	}

	/**
	 * 删除品牌
	 * @param unknown $id
	 */
	function remove($id)
	{
		return $this->where('id=?', array(
			$id
		))->delete();
	}

	/**
	 * 获得所有品牌
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchAll()
	{
		return $this->select();
	}
}