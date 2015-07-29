<?php
namespace application\model;

use system\core\model;

class categoryModel extends model
{

	function __construct()
	{
		parent::__construct('category');
	}

	/**
	 * 创建分类
	 * 
	 * @param unknown $name        	
	 * @param number $cid
	 *        	上级分类ｉｄ
	 */
	function add($name, $cid = 0)
	{
		$array = array(
			NULL,
			$name,
			$cid
		);
		$this->insert($array);
		return $this->lastInsertId();
	}

	/**
	 * 获得一个分类下的子类 无递归
	 */
	function fetchChild($cid = 0)
	{
		return $this->where('cid=?', array(
			$cid
		))->select();
	}

	/**
	 * 更改分类名称
	 * 
	 * @param unknown $id        	
	 * @param unknown $name        	
	 * @return \system\core\Ambigous
	 */
	function rename($id, $name)
	{
		return $this->where('id=?', array(
			$id
		))->update('name', $name);
	}

	/**
	 * 删除一个分类
	 * 
	 * @param unknown $id        	
	 * @return \system\core\Ambigous
	 */
	function del($id)
	{
		return $this->where('id=?', array(
			$id
		))->delete();
	}

	/**
	 * 移动分类
	 * 
	 * @param unknown $id        	
	 * @param unknown $cid        	
	 * @return \system\core\Ambigous
	 */
	function move($id, $cid)
	{
		return $this->where('id=?', array(
			$id
		))->update('cid', $cid);
	}
	
	function paste($id,$mode,$cid)
	{
		try {
			$this->transaction();
			if($mode =='move_node')
			{
				foreach ($id as $t)
				{
					$this->move($t, $cid);
				}
				return true;
			}
			else
			{
				foreach($id as $t)
				{
					$result = $this->where('id=?',array($t))->select('name');
					if(isset($result[0]['name']) && !empty($result[0]['name']))
					{
						$this->insert(array(NULL,$result[0]['name'],$cid));
					}
				}
			}
			$this->commit();
		}
		catch (\Exception $e)
		{
			$this->rollback();
			return false;
		}
	}
}