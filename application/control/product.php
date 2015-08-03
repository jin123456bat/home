<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\view;
use application\model\roleModel;
use application\classes\category;
use system\core\filter;
class productControl extends control
{
	
	/**
	 * 获得一个商品的所有详细信息
	 */
	function information()
	{
		$pid = empty(filter::int($this->get->pid))?0:filter::int($this->get->pid);
		$pcontent_array = json_decode($this->post->pcontent);
		if(!empty($pcontent_array))
		{
			$pcontent_array = sort($pcontent_array);
			$pserialize = serialize($pcontent_array);
		}
		$productModel = $this->model('product');
		$product = $productModel->get($pid);
		$prototypeModel = $this->model('prototype');
		$prototype = $prototypeModel->getByPid($pid);
		$product['prototype'] = $prototype;
		$collectionModel = $this->model('collection');
		$collection = $collectionModel->getByPid($pid);
		$product['collection'] = $collection;
		
	}
	
	/**
	 * 获得某一个分类下所有商品信息  包括子分类
	 */
	function category()
	{
		$cid = empty(filter::int($this->get->cid))?0:filter::int($this->get->cid);
		$array = array($cid);
		//获得子分类信息
		$categoryModel = $this->model('category');
		$result = $categoryModel->fetchChild($cid);
		foreach($result as $category)
		{
			//将子分类id加入数组
			$array[] = $category['id'];
		}
		$array = implode(',', $array);
		$productModel = $this->model('product');
		$product = $productModel->where('category in (?)',array($array))->select();
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$product));
	}
	
	/**
	 * 保存商品信息
	 * @return string
	 */
	function save()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_INSERT+$roleModel::POWER_UPDATE))
		{
			$productModel = $this->model('product');
			$id = $productModel->save($this->post);
			if($id)
			{
				$pid = empty($this->post->id)?$id:$this->post->id;
				if(!empty($this->post->picid))
				{
					$picid = json_decode(htmlspecialchars_decode($this->post->picid));
					$productimgModel = $this->model('productimg');
					$productimgModel->updatepid($picid,$pid);
				}
				if(!empty($this->post->prototype_id))
				{
					$prototype_id = json_decode(htmlspecialchars_decode($this->post->prototype_id));
					$prototypeModel = $this->model('prototype');
					$prototypeModel->updatepid($prototype_id,$pid);
				}
				return json_encode(array('code'=>1,'result'=>'ok','id'=>$id));
			}
			return json_encode(array('code'=>2,'result'=>'failed'));
		}
		return json_encode(array('code'=>0,'result'=>'权限不足'));
	}
	
	/**
	 * 商品列表 页面
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
			$this->view = new view(config('view'), 'admin/product_edit.html');
			$productModel = $this->model('product');
			$result = $productModel->get($this->get->id);
			if($this->get->action == 'edit' && !empty($result))
			{
				$this->view->assign('product',$result);
			}
			else
			{
				$this->view->assign('new',1);
			}
			$categoryModel = $this->model('category');
			$category = $categoryModel->select();
			$category = (new category())->format(0,$category);
			$this->view->assign('category',$category);
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
							switch ($this->post->customActionName)
							{
								case 1:
								case 2:$productModel->where('id=?',array($id))->update('status',$this->post->customActionName);break;
								case 3:$productModel->where('id=?',array($id))->delete();break;
								default:break;
							}
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