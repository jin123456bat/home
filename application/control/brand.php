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
		$name = $this->post->name;
		$logo = $this->file->logo;
		if (! file_exists($logo)) {
			return json_encode(array(
				'code' > 3,
				'result' => 'logo上传失败'
			));
		}
		$description = $this->post->description;
		$brandModel = $this->model('brand');
		if ($brandModel->add($name, $logo, $description))
		{
			$this->model('log')->write($this->session->username,'添加了一个品牌'.$name);
			return json_encode(array('code' => 1,'result' => '成功'));
		}
		return json_encode(array(
			'code' => 0,
			'result' => '失败'
		));
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

	/**
	 * 删除一个品牌 以及该品牌的所有产品
	 * 
	 * @return string
	 */
	function del()
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