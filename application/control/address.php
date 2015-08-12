<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\classes\login;
/**
 * 收货地址控制器
 * @author jin12
 *
 */
class addressControl extends control
{
	
	/**
	 * 获取用户的一个默认收货地址
	 */
	function gethost()
	{
		$result = $this->model('address')->getHost($this->session->id);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 获取我所有的收货地址
	 */
	function fetchall()
	{
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->fetchAll($this->session->id);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
		return json_encode(array('code'=>2,'result'=>'尚未登陆'));
	}
	
	/**
	 * 修改保存配送地址
	 */
	function save()
	{
		$id = filter::int($this->post->id);
		$province = htmlspecialchars_decode($this->post->province);
		$city = htmlspecialchars_decode($this->post->city);
		$address = htmlspecialchars_decode($this->post->address);
		$name = htmlspecialchars_decode($this->post->name);
		$telephone = filter::telephone($this->post->telephone);
		$zcode = filter::int($this->post->zcode);
		$host = filter::int($this->post->host);
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->save($id,$this->session->id,$province,$city,$address,$name,$telephone,$zcode,$host);
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'failed','尚未登陆'));
	}
	
	/**
	 * 用户创建配送地址
	 * @return string
	 */
	function create()
	{
		$province = htmlspecialchars_decode($this->post->province);
		$city = htmlspecialchars_decode($this->post->city);
		$address = htmlspecialchars_decode($this->post->address);
		$name = htmlspecialchars_decode($this->post->name);
		$telephone = filter::telephone($this->post->telephone);
		$zcode = filter::int($this->post->zcode);
		$host = filter::int($this->post->host);
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->create($this->session->id,$province,$city,$address,$name,$telephone,$zcode,$host);
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'尚未登陆'));
	}
	
	/**
	 * 用户删除配送地址
	 * @return string
	 */
	function remove()
	{
		$id = filter::int($this->post->id);
		if(!empty($id))
		{
			$addressModel = $this->model('address');
			if($addressModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>2,'result'=>'删除失败'));
		}
		return json_encode(array('code'=>0,'result'=>'参数错误'));
	}
}