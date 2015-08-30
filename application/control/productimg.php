<?php
namespace application\control;

use system\core\control;
use system\core\image;
use system\core\filter;
use system\core\filesystem;
use system\core\file;

class productimgControl extends control
{

	function crontab()
	{
		
	}
	
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
			$system = $this->model('system');
			$base = $image->resizeImage($filepath,$system->get('productbasewidth','image') , $system->get('productbaseheight','image'));
			$small = $image->resizeImage($filepath, $system->get('productsmallwidth','image'), $system->get('productsmallheight','image'));
			$thumbnail = $image->resizeImage($filepath, $system->get('productthumbnailwidth','image'), $system->get('productthumbnailheight','image'));
			$productimgModel = $this->model('productimg');
			$info = $productimgModel->add($filepath,$base, $small, $thumbnail, $_FILES['file']['name']);
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
			$this->response->addHeader('Content-Type', (new filesystem())->mimetype($result['oldimage']));
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
	
	
	/**
	 * 删除产品图像信息
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
		$id = filter::int($this->post->id);
		if(!empty($id))
		{
			$productimgModel = $this->model('productimg');
			if($productimgModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}

}