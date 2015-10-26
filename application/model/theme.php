<?php
namespace application\model;
use system\core\model;
use system\core\file;
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
	
	/**
	 * 创建主题
	 * @param unknown $name
	 * @param unknown $description
	 * @param unknown $big
	 * @param unknown $middle
	 * @param unknown $small
	 * @return \system\core\Ambigous
	 */
	function create($name,$description,$big,$middle,$small,$tid = NULL)
	{
		return $this->insert(array(NULL,$name,$description,$big,$middle,$small,0,$tid));
	}
	
	/**
	 * 移除主题
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
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
		$theme_productModel = $this->model('theme_product');
		$theme_productModel->table('product','left join','product.id=theme_product.pid');
		$result = $theme_productModel->where('tid=?',array($tid))->select();
		return $result;
	}
	
	/**
	 * 将产品推送到主题
	 */
	function insertProduct($tid,$pid)
	{
		$theme_productModel = $this->model('theme_product');
		$result = $theme_productModel->where('tid=? and pid=?',array($tid,$pid))->select();
		if(empty($result))
		{
			return $theme_productModel->insert(array(NULL,$tid,$pid));
		}
		return false;
	}
	
	/**
	 * 删除主题中的商品
	 * @param unknown $tid
	 * @param unknown $pid
	 * @return \system\core\Ambigous
	 */
	function removeProduct($tid,$pid)
	{
		$theme_productModel = $this->model('theme_product');
		return $theme_productModel->where('tid=? and pid=?',array($tid,$pid))->delete();
	}
	
	/**
	 * 后台获取所有主题
	 */
	function fetchAll(array $filter = array())
	{
		if (isset($filter['tid']))
		{
			if ($filter['tid'] === NULL)
			{
				$this->where('theme.tid is null');
			}
			else
			{
				$this->where('theme.tid = ?',array($filter['tid']));
			}
		}
		if(isset($filter['length']))
		{
			$this->limit($filter['length']);
		}
		if(isset($filter['orderby']))
		{
			if (is_string($filter['orderby']))
			{
				$this->orderby($filter['orderby']);
			}
			else if (is_array($filter['orderby']))
			{
				$this->orderby($filter['orderby'][0],$filter['orderby'][1]);
			}
		}
		$parameter = isset($filter['parameter'])?$filter['parameter']:'*';
		if(isset($filter['lock_user']))
		{
				$this->table('theme_lock','right join','theme_lock.tid=theme.id');
				$this->where('theme_lock.uid=?',array($filter['lock_user']));
				return $this->select($parameter);
		}
		else
		{
			return $this->select($parameter);
		}
	}
}