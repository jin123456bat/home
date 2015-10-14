<?php
namespace application\model;
use system\core\model;
/**
 * 系统配置数据模型
 * @author jin12
 *
 */
class systemModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 获取系统配置
	 * @param unknown $name
	 * @param unknown $type
	 * @return NULL
	 */
	function get($name,$type)
	{
		$result = $this->where('name=? and type=?',array($name,$type))->select('value');
		return isset($result[0]['value'])?$result[0]['value']:NULL;
	}
	
	function fetch($type)
	{
		if(is_array($type))
		{
			$result = $this->where('type in (?)',$type)->select();
		}
		else
		{
			$result = $this->where('type=?',array($type))->select();
		}
		return $result;
	}
	
	/**
	 * 将系统配置转化为数组
	 * @param array $array
	 * @param string $key
	 * @return multitype:unknown 
	 */
	function toArray(array $array,$key = '')
	{
		$temp = array();
		foreach($array as $item)
		{
			if ($item['type'] == $key)
			{
				$temp[$item['name']] = $item['value'];
			}
		}
		return $temp;
	}
	
	/**
	 * 修改添加并保存系统配置
	 */
	function set($name,$type,$value)
	{
		$result = $this->where('name=? and type=?',array($name,$type))->select();
		if(isset($result[0]))
		{
			return $this->where('name=? and type=?',array($name,$type))->update('value',$value);
		}
		else
		{
			return $this->insert(array(NULL,$name,$type,$value));
		}
	}
}