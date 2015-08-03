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
	 * 获取指定id品牌的信息
	 * @param int $id 品牌id
	 * @return array|NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?', array(
			$id
		))->select();
		return isset($result[0]) ? $result[0] : NULL;
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