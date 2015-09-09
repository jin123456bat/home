<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\validate;
use system\core\view;
use application\model\roleModel;
use system\core\filter;

class brandControl extends control
{

	/**
	 * 添加品牌 接口
	 */
	function add()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'brand',roleModel::POWER_ALL))
		{
			$name = $this->post->name;
			if(empty($name))
				return json_encode(array('code'=>2,'result'=>'品牌名称不能为空'));
			$logo = $this->file->logo;
			if (! file_exists($logo)) {
				return json_encode(array(
					'code' > 3,
					'result' => 'logo上传失败'
				));
			}
			$description = empty($this->post->description)?'':$this->post->description;
			$brandModel = $this->model('brand');
			if ($brandModel->create($name, $logo, $description))
			{
				$this->model('log')->write($this->session->username,'添加了一个品牌'.$name);
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('brand','manager'));
			}
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}

	/**
	 * 获得一个品牌信息 接口
	 */
	function get()
	{
		$id = $this->get->id;
		if (validate::int($id)) {
			$brandModel = $this->model('brand');
			$result = $brandModel->get($id);
			return json_encode(array(
				'code' => 1,
				'result' => 'ok',
				'body' => $result
			));
			return json_encode(array('code'=>2,'result'=>'不存在'));
		}
		return json_encode(array('code'=>0,'result'=>'参数错误'));
	}

	/**
	 * 是否封禁品牌下所有产品
	 * 
	 * @return string
	 */
	function setClose()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'brand',roleModel::POWER_ALL))
		{
			$id = $this->post->id;
			if (validate::int($id)) {
				$brandModel = $this->model('brand');
				$result = $brandModel->get($id);
				if (isset($result['close']) && $result['close'] == 1) {
					$brandModel->setClose($id, 0);
				} else {
					$brandModel->setClose($id, 1);
				}
				return json_encode(array(
					'code' => 1,
					'result' => 'ok'
				));
			}
			return json_encode(array(
				'code' => 0,
				'result' => 'fail'
			));
		}
		else
		{
			return json_encode(array('code'=>2,'result'=>'没有权限'));
		}
	}

	/**
	 * 删除一个品牌 以及该品牌的所有产品
	 * 
	 * @return string
	 */
	function del()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'brand',roleModel::POWER_DELETE))
		{
			$id = $this->post->id;
			if (validate::int($id)) {
				$brandModel = $this->model('brand');
				if ($brandModel->del($id)) {
					$productModel = $this->model('product');
					$productModel->deleteByBrand($id);
					return json_encode(array(
						'code' => 1,
						'result' => 'ok'
					));
				}
				return json_encode(array('code'=>0,'result'=>'删除失败'));
			}
			return json_encode(array(
				'code' => 2,
				'result' => '参数错误'
			));
		}
		else
		{
			return json_encode(array('code'=>3,'result'=>'没有权限'));
		}
	}

	/**
	 * 获得所有品牌列表，包括封印的品牌
	 */
	function fetchAll()
	{
		$brandModel = $this->model('brand');
		$result = $brandModel->fetchAll();
		return json_encode(array(
			'code' => 1,
			'result' => 'ok',
			'body' => $result
		));
	}
	
	/**
	 * 品牌管理页面
	 */
	function manager()
	{
		$roleModel = $this->model('role');
		$start = empty(filter::int($this->get->start))?0:filter::int($this->get->start);
		$length = empty(filter::int($this->get->length))?10:filter::int($this->get->length);
		if(login::admin() && $roleModel->checkPower($this->session->role,'brand',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/brand_manager.html');
			$brandModel = $this->model('brand');
			$result = $brandModel->fetchByProduct($start,$length);
			$this->view->assign('brand',$result);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->http->jump($this->http->url('index','__404'));
		}
	}
}