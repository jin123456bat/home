<?php
namespace application\model;

use system\core\model;

class brandModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 根据产品数量 对品牌进行分组
	 * @return Ambigous <boolean, multitype:>
	 */
	function fetchByProduct($start,$length)
	{
		$this->table('product','left join','product.bid=brand.id');
		$this->orderby('num','desc');
		$this->orderby('id','asc');
		$this->groupby('product.bid');
		$this->limit($start,$length);
		return $this->select('count(*) as num,brand.name,brand.id');
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
	function del($id)
	{
		$this->where('id=?', array(
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