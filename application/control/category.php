<?php
namespace application\control;

use system\core\control;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
use system\core\validate;
class categoryControl extends control
{
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'category',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/category.html');
			$this->response->setBody($this->view->display());
		}
	}
	
	function ajaxtree()
	{
		$icon = array("icon-state-warning","icon-state-success","icon-state-danger","icon-state-info");
		if($this->get->parent == '#')
		{
			$parent = 0;
		}
		else
		{
			list($node,$parent) = explode('_', $this->get->parent);
		}
		if(validate::int($parent))
		{
			$categoryModel = $this->model('category');
			$result = $categoryModel->fetchChild();
			$tree = array_map(function($cate){
				$category = new \stdClass();
				$category->id = "node_".$cate['id'];
				$category->text = $cate['name'];
				$category->icon = "fa fa-folder icon-lg ".array_rand($icon);
				$category->children = !empty($categoryModel->fetchChild($cate['id']));
				if($parent == 0)
					$category->type = "root";
				return $category;
			}, $result);
			return json_encode($tree);
		}
	}
}