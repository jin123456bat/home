<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\classes\login;
use application\model\roleModel;
use system\core\view;
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
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$result = $this->model('address')->getHost($this->session->id);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 获取我所有的收货地址
	 */
	function fetchall()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->myAddress($this->session->id);
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
		return json_encode(array('code'=>0,'result'=>'尚未登陆'));
	}
	
	/**
	 * 用户创建配送地址
	 * @return string
	 */
	function create()
	{
		$province = $this->post->province;
		$city = $this->post->city;
		$address = $this->post->address;
		$name = $this->post->name;
		$telephone = filter::telephone($this->post->telephone);
		$zcode = empty(filter::int($this->post->zcode))?'':filter::int($this->post->zcode);
		$host = empty(filter::int($this->post->host))?0:filter::int($this->post->host);
		if(empty($telephone))
			return json_encode(array('code'=>2,'result'=>'请填写正确的手机号码'));
		if(empty($address) || empty($city) || empty($province))
			return json_encode(array('code'=>3,'result'=>'收货地址不完整'));
		if(empty($name))
			return json_encode(array('code'=>4,'result'=>'收货人姓名不能为空'));
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->create($this->session->id,$province,$city,$address,$name,$telephone,$zcode,$host);
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'尚未登陆'));
	}
	
	/**
	 * 获得指定地址id的信息
	 */
	function information()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$id = filter::int($this->get->id);
		$addressModel = $this->model('address');
		$address = $addressModel->get($id);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$address));
	}
	
	/**
	 * 用户删除配送地址
	 * @return string
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
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
	
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/address.html');
			
			$addressModel = $this->model('address');
			$address = $addressModel->fetchAll();
			$this->view->assign('address',$address);
		
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','__404'));
		}
	}
}