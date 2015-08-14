<?php
namespace application\model;
use system\core\model;
/**
 * @author jin12
 *
 */
class themeModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function create($name,$description,$big,$middle,$small)
	{
		return $this->insert(array(NULL,$name,$description,$big,$middle,$small));
	}
	
	/**
	 * 获取一个主题信息
	 * @param unknown $name
	 * @param string $parameter
	 * @return NULL
	 */
	function get($id,$name = '*')
	{
		$result = $this->where('id=?',array($id))->select($name);
		if($name=='*')
			return isset($result[0])?$result[0]:NULL;
		return isset($result[0][$name])?$result[0][$name]:NULL;
	}
	
	/**
	 * 获取主题的产品信息
	 */
	function product($tid)
	{
		$this->where('id=?',array($tid));
		$this->table('theme_product','left join','theme.id=theme_product.tid');
		$this->table('product','left join','product.id=theme_product.pid');
		return $this->select();
	}
	
	/**
	 * 后台获取所有主题
	 */
	function fetchAll($length = 0)
	{
		if(!empty($length))
			$this->limit($length);
		return $this->select();
	}
}