<?php
namespace application\control;

use system\core\control;
use system\core\image;
use system\core\filter;
use system\core\filesystem;
use system\core\file;

class productimgControl extends control
{

	/**
	 * 产品图像上传
	 * 小图200x200
	 * 缩略图100x100
	 */
	function upload()
	{
		// 文件上传后的路径
		$filepath = $this->file->receive($_FILES['file'], config('file'));
		if (is_file($filepath)) {
			$image = new image();
			$small = $image->resizeImage($filepath, 200, 200);
			$thumbnail = $image->resizeImage($filepath, 100, 100);
			$productimgModel = $this->model('productimg');
			$info = $productimgModel->add($filepath, $small, $thumbnail, $_FILES['file']['name']);
			return json_encode(array(
				'code' => 1,
				'result' => 'ok',
				'body'=>$info
			));
		}
		return json_encode(array(
			'code' => 0,
			'result' => 'file upload failed'
		));
	}

	/**
	 * 获取自定义图像大小
	 */
	function resize()
	{
		$width = filter::int($this->get->width);
		$height = filter::int($this->get->height);
		$id = filter::int($this->get->id);
		$productimgModel = $this->model('productimg');
		$result = $productimgModel->get($id);
		if (! empty($result)) {
			$this->response->addHeader('Content-Type', (new filesystem())->mimetype($result['base_path']));
			$image = new image();
			$file = $image->resizeImage($result['base_path'], $width, $height);
			$this->response->setBody(file_get_contents($file));
			@unlink($file);
		}
	}
	
	/**
	 * 获得产品所有图像信息
	 */
	function getproductimg()
	{
		$pid = filter::int($this->get->pid);
		if(!empty($pid))
		{
			$productimgModel = $this->model('productimg');
			$img = $productimgModel->getByPid($pid);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$img));
		}
		return json_encode(array('code'=>0,'result'=>'no pic'));
	}
	

}