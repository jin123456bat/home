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
		$this->where('theme.id=?',array($tid));
		$this->table('theme_product','left join','theme.id=theme_product.tid');
		$this->table('product','left join','product.id=theme_product.pid');
		$result = $this->select();
		$productimgModel = $this->model('productimg');
		foreach($result as &$product)
		{
			unset($product['smallpic']);
			unset($product['bigpic']);
			unset($product['middlepic']);
			$img = $productimgModel->where('pid=?',array($product['id']))->select();
			foreach ($img as &$image)
			{
				$image['base_path'] = empty($image['base_path'])?'':file::realpathToUrl($image['base_path']);
				$image['small_path'] = empty($image['small_path'])?'':file::realpathToUrl($image['small_path']);
				$image['thumbnail_path'] = empty($image['thumbnail_path'])?'':file::realpathToUrl($image['thumbnail_path']);
			}
			$product['img'] = $img;
		}
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
	 * 后台获取所有主题
	 */
	function fetchAll($length = 0)
	{
		if(!empty($length))
			$this->limit($length);
		return $this->select();
	}
}