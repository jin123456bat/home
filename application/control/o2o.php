<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\image;
use system\core\file;
/**
 * o2o店铺相关Api
 * @author jin12
 *
 */
class o2oControl extends control
{
	/**
	 * 用户通过此方法进入首页
	 */
	function userenter()
	{
		$id = filter::int($this->get->id);
		$o2oModel = $this->model('o2oshop');
		if($o2oModel->exist($id))
		{
			$this->session->o2o = $id;
		}
		//跳转到首页
		$this->http->jump($this->http->url('index','index'));
	}
	
	/**
	 * 管理员添加o2o账户
	 * @param post name 不得为空
	 * @param post telephone 电话号码不的为空
	 */
	function create()
	{
		$name = $this->post->name;
		$address = $this->post->address;
		$telephone = filter::telephone($this->post->telephone);
		$backrate = $this->post->backrate;
		$logo = $this->file->logo;
		
		if(empty($telephone) || empty($name))
			return json_encode(array('code'=>0,'result'=>'参数错误'));
		
		$o2oshopModel = $this->model('o2oshop');
		$oid = $o2oshopModel->create($name,$address,$telephone,$backrate,$logo);
		if($oid)
		{
			$image = new image();
			$filename = ROOT.'/application/upload/'.md5($oid.$name).'.png';
			$image->QRCode($this->http->url('o2o','userenter',array('id'=>$oid)),$filename,$logo);
			if(file::path($filename))
			{
				$o2oshopModel->updateEQ($oid,$filename);
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>2,'result'=>'创建成功，但是二维码创建失败'));
		}
		return json_encode(array('code'=>3,'result'=>'创建失败'));
	}
	
	/**
	 * 删除一个o2o账号
	 * @return string
	 */
	function remove()
	{
		$id = filter::int($this->get->id);
		if(!empty($id))
		{
			$o2oModel = $this->model('o2oshop');
			if($o2oModel->remove($id))
				return json_encode(array('code'=>1,'result'=>'ok'));
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'参数错误'));
	}
	
}