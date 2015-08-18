<?php
namespace application\control;

use system\core\control;
use system\core\file;
use application\classes\login;
use system\core\view;
use application\model\roleModel;
use application\classes\category;
use system\core\filter;
use application\classes\excel;
class productControl extends control
{
	/**
	 * 导出商品数据
	 */
	function export()
	{
		$data = json_decode(htmlspecialchars_decode($this->get->data));
		$productModel = $this->model('product');
		if(!empty($data))
		{
			$productModel->where('id in (?)',array(implode(',', $data)));
		}
		$product = $productModel->select('id,sku,name,category,price,oldprice,stock,short_description,time');
		foreach($product as &$good)
		{
			$good['time'] = date('Y-m-d H:i:s',$good['time']);
			$good['category'] = $this->model('category')->get($good['id'],'name');
			unset($good['id']);
		}
		$excel = new excel();
		$excel->xls($product,array('商品货号','商品名称','分类','标价','市场价','库存','描述','添加时间'));
	}
	
	/**
	 * 获得一个商品的所有详细信息
	 */
	function information()
	{
		$this->response->addHeader('Content-Type','application/json');
		$pid = empty(filter::int($this->get->pid))?0:filter::int($this->get->pid);
		$productModel = $this->model('product');
		$product = $productModel->get($pid);
		if(!empty($product))
		{
			$prototypeModel = $this->model('prototype');
			$prototype = $prototypeModel->getByPid($pid);
			$product['prototype'] = $prototype;
			$collectionModel = $this->model('collection');
			$collection = $collectionModel->getByPid($pid);
			$product['collection'] = $collection;
			$product['category'] = $this->model('category')->get($product['id'],'name');
			$product['brand'] = $this->model('brand')->get($product['bid'],'name');
			unset($product['bid']);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$product));
		}
		return json_encode(array('code'=>0,'result'=>'商品不存在'));
	}
	
	/**
	 * 获得某一个分类下所有商品信息  包括子分类
	 */
	function category()
	{
		$this->response->addHeader('Content-Type','application/json');
		$cid = empty(filter::int($this->get->cid))?0:filter::int($this->get->cid);
		$start = empty(filter::int($this->get->start))?0:filter::int($this->get->start);
		$length = empty(filter::int($this->get->length))?5:filter::int($this->get->length);
		$array = array($cid);
		//获得子分类信息
		$categoryModel = $this->model('category');
		while (current($array) !== false)
		{
			$result = $categoryModel->fetchChild(current($array));
			foreach($result as $category)
			{
				if (!in_array($category['id'], $array))
				{
					//将子分类id加入数组
					$array[] = $category['id'];
				}
			}
			next($array);
		}
		//$array = implode(',', $array);
		$productModel = $this->model('product');
		$brandModel = $this->model('brand');
		$prototypeModel = $this->model('prototype');
		$productimgModel = $this->model('productimg');
		$productModel->limit($start,$length);
		$productModel->where('status=?',array(1));
		$productModel->where('stock>?',array(0));
		$productModel->where('(starttime=? or starttime<?) and (endtime=? or endtime>?)',array(0,$_SERVER['REQUEST_TIME'],0,$_SERVER['REQUEST_TIME']));
		$product = $productModel->where('category in (?)',$array)->select();
		foreach ($product as &$goods)
		{
			$goods['category'] = $categoryModel->get($goods['category'],'name');
			$goods['brand'] = $brandModel->get($goods['bid'],'name');
			unset($product['bid']);
			$goods['prototype'] = $prototypeModel->getByPid($goods['id']);
			$goods['img'] = $productimgModel->getByPid($goods['id']);
		}
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
				$this->model('log')->write($this->session->username,'修改了商品属性'.$id);
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
			$fullcutModel = $this->model('fullcut');
			$fullcut = $fullcutModel->fetchAll();
			$this->view->assign('fullcut',$fullcut);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
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
			$brandModel = $this->model('brand');
			$brand = $brandModel->fetchAll();
			$shipModel = $this->model('ship');
			$ship = $shipModel->select();
			$this->view->assign('ship',$ship);
			$this->view->assign('brand',$brand);
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
						$logModel = $this->model('log');
						foreach ($this->post->id as $id)
						{
							$logModel->write($this->session->username,'修改了商品('.$id.')的操作方式:'.$this->post->customActionName);
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
			$resultObj->recordsTotal = $productModel->count();
			$resultObj->recordsFiltered = count($result);
			$result = array_slice($result, $this->post->start,$this->post->length);
			$brandModel = $this->model('brand');
			$prototypeModel = $this->model('prototype');
			$categoryModel = $this->model('category');
			$productimgModel = $this->model('productimg');
			foreach ($result as &$product)
			{
				if(isset($product['id']))
				{
					if(isset($product['bid']))
					{
						$product['brand'] = $brandModel->get($product['bid'],'name');
						unset($product['bid']);
					}
					$product['prototype'] = $prototypeModel->getByPid($product['id']);
					$product['img'] = $productimgModel->getByPid($product['id']);
					foreach ($product['img'] as &$img)
					{
						$img['thumbnail_path'] = file::realpathToUrl($img['thumbnail_path']);
						$img['small_path'] = file::realpathToUrl($img['small_path']);
						$img['base_path'] = file::realpathToUrl($img['base_path']);
					}
					if(isset($product['category']))
					{
						$product['category'] = $categoryModel->get($product['category'],'name');
					}
				}
			}
			$resultObj->data = $result;
		}
		return json_encode($resultObj);
	}
}