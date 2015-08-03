<?php
namespace application\model;

use system\core\model;
/**
 * 商品自定义属性规则
 * @author jin12
 *
 */
class prototypeModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 为商品添加自定义属性  属性存在的话会覆盖
	 * @param int $pid 商品id
	 * @param string $name 属性名称
	 * @param string $type 属性类型 text|radio
	 * @param string|array $value 属性值
	 */
	function create($name,$type,$value,$pid = 0)
	{
		if($type == 'radio')
		$value = serialize($value);
		$array = array(NULL,$pid,$name,$type,$value);
		if($this->insert($array))
		{
			return $this->lastInsertId();
		}
		return false;
	}
	
	/**
	 * 更新pid
	 * @param unknown $prototype_id
	 * @param unknown $pid
	 */
	function updatepid($prototype_id,$pid)
	{
		if(!empty($prototype_id))
		{
			if(is_array($prototype_id))
			{
				foreach ($prototype_id as $id)
				{
					$this->where('id=?',array($id))->update('pid',$pid);
				}
			}
			else
			{
				$this->where('id=?',array($prototype_id))->update('pid',$pid);
			}
		}
	}
	
	/**
	 * 获得商品所有属性 对于radio型数据已经反序列化了
	 * @param unknown $pid
	 * @return array
	 */
	function getByPid($pid)
	{
		$result = $this->where('pid=?',array($pid))->select();
		foreach($result as $key => &$value)
		{
			if($value['type'] == 'radio')
			{
				$value['value'] = unserialize($value['value']);
			}
		}
		return $result;
	}
}