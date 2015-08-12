<?php
namespace application\model;
use system\core\model;
use application\classes\collection;
/**
 * 商品和属性映射数据模型
 * @author jin12
 *
 */
class collectionModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 创建或更新属性组合
	 * @param int $pid
	 * @param array $content array
	 * @param string $type
	 * @param string $value
	 * @return \system\core\Ambigous|boolean
	 */
	function create($content,$pid,$type,$value)
	{
		ksort($content);
		$content = serialize($content);
		$result = $this->where('content=?',array($content))->select();
		if(isset($result[0]))
		{
			return $this->where('content = ?',array($content))->update(array($type=>$value,'pid'=>$pid));
		}
		else
		{
			$stock = 0;
			$price = 0;
			$sku = '';
			$$type = $value;
			$data = array(NULL,$pid,$content,$stock,$price,$sku);
			if($this->insert($data))
			{
				return $this->lastInsertId();
			}
			return false;
		}
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
	 * 根据商品id和属性关系查询价格和库存还有编码
	 * @param unknown $pid
	 * @param string|array $content 属性id:值下标,属性id:值下标....
	 */
	function find($pid,$content)
	{
		if(is_string($content))
		{
			$content = (new collection())->stringToArray($content);
			if($content === false)
				return false;
		}
		ksort($content);
		$content = serialize($content);
		$result = $this->where('pid=? and content=?',array($pid,$content))->select();
		return isset($result[0])?$result[0]:NULL;
	}
	
	/**
	 * 增加商品的库存 仅仅针对有可选属性的商品
	 * @param int $pid 商品id
	 * @param string|array 属性组合关系
	 * @param int $num 增加的数量
	 */
	function increaseStock($pid,$content,$num)
	{
		if (is_array($content))
		{
			ksort($content);
			$content = serialize($content);
		}
		$this->where('pid=? and content=?',array($pid,$content))->increase('stock',$num);
		$result = $this->where('pid=? and content=?',array($pid,$content))->select('stock');
		if(isset($result[0]['stock']) && $result[0]['stock']>=0)
		{
			return true;
		}
		$this->where('pid=? and content=?',array($pid,$content))->increase('stock',-$num);
		return false;
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