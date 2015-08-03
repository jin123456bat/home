<?php
namespace application\model;
use system\core\model;
class collectionModel extends model
{
	/**
	 * 创建或更新属性组合
	 * @param int $pid
	 * @param array $content array
	 * @param int $stock
	 * @param double $price
	 * @return \system\core\Ambigous|boolean
	 */
	function create($pid,$content,$stock,$price)
	{
		$content = serialize(sort($content));
		$this->where('pid=?',array($pid));
		$row = $this->where('content = ?',array($content))->update(array('price'=>$price,'stock'=>$stock));
		if($row == 0)
		{
			$data = array(NULL,$pid,$content,$stock,$price);
			if($this->insert($data))
			{
				return $this->insert($data);
			}
			return false;
		}
		return true;
	}
	
	/**
	 * 获得商品的所有组合属性
	 * @param unknown $pid
	 * @return Ambigous <boolean, multitype:>
	 */
	function getByPid($pid)
	{
		return $this->where('pid=?',array($pid))->select();
	}
	
	/**
	 * 移除商品的所有组合属性
	 * @param unknown $pid
	 */
	function remove($pid)
	{
		return $this->where('pid=?',array($pid))->delete();
	}
}