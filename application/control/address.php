<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\classes\login;
use application\model\roleModel;
use system\core\view;
use application\message\json;
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
		if(!login::user())
			return new json(json::NOT_LOGIN);
		$result = $this->model('address')->getHost($this->session->id);
		return new json(json::OK,NULL,$result);
	}
	
	/**
	 * 获取我所有的收货地址
	 */
	function fetchall()
	{
		if(login::user())
		{
			$addressModel = $this->model('address');
			$filter = array(
				'uid'=>$this->session->id
			);
			$result = $addressModel->fetchAll($filter);
			return new json(json::OK,NULL,$result);
		}
		return new json(json::NOT_LOGIN);
	}
	
	/**
	 * 修改保存配送地址
	 */
	function save()
	{
		$id = filter::int($this->post->id);
		$province = intval($this->post->province);
		$city = intval($this->post->city);
		$county = $this->post->county;
		$address = $this->post->address;
		$name = $this->post->name;
		$telephone = filter::telephone($this->post->telephone);
		$zcode = filter::int($this->post->zcode);
		$host = filter::int($this->post->host);
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->save($id,$this->session->id,$province,$city,$county,$address,$name,$telephone,$zcode,$host);
			return new json(json::OK);
		}
		return new json(json::NOT_LOGIN);
	}
	
	/**
	 * 用户创建配送地址
	 * @return string
	 */
	function create()
	{
		$province = intval($this->post->province);
		$city = intval($this->post->city);
		$county = $this->post->county;
		$address = $this->post->address;
		$name = $this->post->name;
		$telephone = filter::telephone($this->post->telephone);
		$zcode = empty(filter::int($this->post->zcode))?'':filter::int($this->post->zcode);
		$host = empty(filter::int($this->post->host))?0:filter::int($this->post->host);
		if(empty($telephone))
			return new json(json::PARAMETER_ERROR,'手机号码错误');
		if(empty($address) || empty($city) || empty($province) || empty($county))
			return new json(json::PARAMETER_ERROR,'收货地址不完整');
		if(empty($name))
			return new json(json::PARAMETER_ERROR,'收货人姓名不能为空');
		if(login::user())
		{
			$addressModel = $this->model('address');
			$result = $addressModel->create($this->session->id,$province,$city,$county,$address,$name,$telephone,$zcode,$host);
			return new json(json::OK);
		}
		return new json(json::NOT_LOGIN);
	}
	
	/**
	 * 获得指定地址id的信息
	 */
	function information()
	{
		if(!login::user())
			return new json(json::NOT_LOGIN);
		$id = filter::int($this->get->id);
		$addressModel = $this->model('address');
		$filter = array(
			'parameter' => 'city.name as city,province.name as province,province.id as provinceid,city.id as cityid,address.id,address.uid,address.county,address.address,address.zcode,adddress.host,address.name,address.telephone',
			'id' => $id,
			'uid'=>$this->session->id
		);
		$address = $addressModel->fetchAll($filter);
		if (isset($address[0]))
			return new json(json::OK,NULL,$address[0]);
		return new json(json::OK,NULL,array());
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
				return new json(json::OK);
			}
			return new json(4,'删除失败');
		}
		return new json(json::PARAMETER_ERROR);
	}
	
	/**
	 * 收货地址的管理界面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/address.html');
			
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$filter = array(
				'order' => array('address.id','desc'),
			);
			
			$addressModel = $this->model('address');
			$address = $addressModel->fetchAll($filter);
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