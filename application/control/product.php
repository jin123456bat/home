<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\view;
use application\model\roleModel;
use application\classes\category;
class productControl extends control
{
	/**
	 * 商品列表
	 */
	function index()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/product.html');
			$categoryModel = $this->model('category');
			$category = $categoryModel->select();
			$categoryHelper = new category();
			$category = $categoryHelper->format(0,$category);
			$this->view->assign('category',$category);
			$this->response->setBody($this->view->display());
		}
	}
	
	/**
	 * 商品编辑页面
	 */
	function edit()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'product_edit.html');
			$this->response->setBody($this->view->display());
		}
	}
	
	/**
	 * 商品列表
	 * @return string
	 */
	function ajaxdatatable()
	{
		$productModel = $this->model('product');
		$resultObj = new \stdClass();
		try{
			if($this->post->customActionType == 'group_action')
			{
				$roleModel = $this->model('role');
				if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_SELECT))
				{
					if(!empty($this->post->customActionName))
					{
						foreach ($this->post->id as $id)
						{
							$productModel->where('id=?',array($id))->update('status',$this->post->customActionName);
						}
					}
				}
			}
		}
		catch (\Exception $e)
		{
			return json_encode(array('code'=>0,'result'=>'参数异常'));
		}
		finally
		{
			$resultObj->draw = $this->post->draw;
			$result = $productModel->searchable($this->post);
			$resultObj->data = $result;
			$resultObj->recordsTotal = $productModel->count();
			$resultObj->recordsFiltered = count($result);
		}
		return json_encode($resultObj);
	}
}