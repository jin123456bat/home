<?php
namespace application\control;

use system\core\control;
use system\core\validate;

class brandControl extends control
{

	/**
	 * 添加品牌
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
			return json_encode(array(
				'code' => 1,
				'result' => '成功'
			));
		return json_encode(array(
			'code' => 0,
			'result' => '失败'
		));
	}

	/**
	 * 获得一个品牌信息
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
		}
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
	 * 删除一个品牌
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
}