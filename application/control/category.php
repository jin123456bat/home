<?php
namespace application\control;

use system\core\control;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
use system\core\validate;
use system\core\filter;
use application\message\json;

class categoryControl extends control
{
	
	/**
	 * 获得一个分类下的子分类
	 */
	function getchild()
	{
		$this->response->addHeader('Cache-Control','nocache');
		$cid = empty(filter::int($this->get->cid))?0:filter::int($this->get->cid);
		$categoryModel = $this->model('category');
		$result = $categoryModel->fetchChild($cid);
		return new json(json::OK,NULL,$result);
	}

	/**
	 * 分类管理界面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'category', roleModel::POWER_SELECT)) {
			$this->view = new view(config('view'), 'admin/category.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}

	/**
	 * ajax请求树
	 * 
	 * @return string
	 */
	function ajaxtree()
	{
		$icon = array(
			"icon-state-warning",
			"icon-state-success",
			"icon-state-danger",
			"icon-state-info"
		);
		if ($this->get->parent == '#') {
			$parent = 0;
		} else {
			$parent = $this->get->parent;
		}
		if (validate::int($parent)) {
			$categoryModel = $this->model('category');
			$result = $categoryModel->fetchChild($parent);
			$tree = array();
			foreach ($result as $category) {
				$temp = array();
				$temp['id'] = $category['id'];
				$temp['text'] = $category['name'];
				$temp['icon'] = "fa fa-folder icon-lg " . $icon[array_rand($icon)];
				//$temp['icon'] = 'http://localhost/home/application/assets/gravatar.jpg';
				$result = $categoryModel->fetchChild($category['id']);
				$temp['children'] = ! empty($result);
				if ($parent == 0)
					$temp['type'] = 'root';
				$tree[] = $temp;
			}
			return new json($tree);
		}
		return new json(json::PARAMETER_ERROR,'错误的分类id');
	}

	/**
	 * 创建分类
	 */
	function add()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'category', roleModel::POWER_INSERT)) {
			$cid = empty($this->post->parent)?0:$this->post->parent;
			if (! empty($this->post->name)) {
				$categoryModel = $this->model('category');
				$pic= '';
				$id = $categoryModel->add($this->post->name,$pic, $cid);
				if ($id) {
					$this->model('log')->write($this->session->username,'添加了一个分类');
					return new json(json::OK,NULL,$id);
				}
				return new json(json::PARAMETER_ERROR,NULL,'添加分类失败');
			}
			return new json(json::PARAMETER_ERROR,NULL,'分类名称不能为空');
		}
		return new json(json::NOT_LOGIN);
	}

	/**
	 * 更改分类名称
	 */
	function rename()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'category', roleModel::POWER_UPDATE)) {
			$id = filter::int($this->post->id);
			$name = $this->post->name;
			if (! empty($id) && ! empty($name)) {
				$categoryModel = $this->model('category');
				if ($categoryModel->rename($id, $name)) {
					return new json(json::OK);
				}
				return new json(json::PARAMETER_ERROR,'改名失败');
			}
			return new json(json::PARAMETER_ERROR);
		}
		return new json(json::NOT_LOGIN);
	}

	/**
	 * 删除分类
	 * 
	 * @return string
	 */
	function del()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'category', roleModel::POWER_DELETE)) {
			$id = filter::int($this->post->id);
			if (! empty($id)) {
				$categoryModel = $this->model('category');
				$result = $categoryModel->fetchChild($id);
				if (empty($result)) {
					if ($categoryModel->del($id)) {
						$this->model('log')->write($this->session->username,'删除了一个分类');
						return new json(json::OK);
					}
					return new json(json::PARAMETER_ERROR);
				}
				return new json(json::PARAMETER_ERROR,'请先删除子分类');
			}
			return new json(json::PARAMETER_ERROR,'参数错误');
		}
		return new json(json::NOT_LOGIN);
	}

	/**
	 * 移动分类
	 * 
	 * @return string
	 */
	function move()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'category', roleModel::POWER_UPDATE)) {
			$id = filter::int($this->post->id);
			if ($this->post->parent == '#') {
				$parent = 0;
			} else {
				$parent = filter::int($this->post->parent);
			}
			if (! empty($id) && ! empty($parent)) {
				$categoryModel = $this->model('category');
				if ($categoryModel->move($id, $parent)) {
					return new json(json::OK);
				}
				return new json(json::PARAMETER_ERROR,'失败');
			}
			return new json(json::PARAMETER_ERROR,'参数错误');
		}
		return new json(json::NOT_LOGIN);
	}
	
	/**
	 * 复制或者剪切的ajax请求
	 * @return string
	 */
	function paste()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'category',roleModel::POWER_UPDATE))
		{	
			$id = json_decode($this->post->id);
			$mode = $this->post->mode;
			$parent = ($this->post->parent == '#')?0:filter::int($this->post->parent);
			
			if(empty($id) || empty($mode) || empty($parent))
			{
				return json_encode(array('code'=>0,'result'=>'参数错误'));
			}
			$categoryModel = $this->model('category');
			if($categoryModel->paste($id,$mode,$parent))
			{
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR,'失败了');
		}
		return new json(json::NOT_LOGIN);
	}
}