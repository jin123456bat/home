<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use system\core\filter;
use application\model\roleModel;
use system\core\view;
/**
 * o2o店铺相关Api
 * @author jin12
 *
 */
class o2oControl extends control
{
	/**
	 * o2o用户管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/o2ouser.html');
			$this->view->assign('o2o',$this->model('o2ouser')->fetchAll());
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	function login()
	{
		
	}
	
	function o2oclient()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_ALL))
		{
			$id = filter::int($this->get->id);
			if(!empty($id))
			{
				$this->view = new view(config('view'), 'admin/o2oclient.html');
				//$this->view->assign('')
				$o2oModel = $this->model('o2ouser');
				$o2o = $o2oModel->get($id);
				$userModel = $this->model('user');
				$client = $userModel->getByOid($id);
				$this->view->assign('client',$client);
				$this->view->assign('o2o',$o2o);
				$this->response->setBody($this->view->display());
			}
			else
			{
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('index','__404'));
			}
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 管理员添加o2o账户
	 * @param post uid 不得为空
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_INSERT))
		{
			$uid = filter::int($this->post->uid);
			$rate = filter::number($this->post->rate);
			$name = $this->post->name;
			$address = $this->post->address;
			$qq = $this->post->qq;
			if(empty($name) || empty($address) || empty($qq) || empty($rate))
				return json_encode(array('code'=>2,'result'=>'数据不全'));
			$o2oModel = $this->model('o2ouser');
			if($o2oModel->create($uid,$name,$qq,$address,$rate))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>'3','result'=>'添加失败'));
		}
		else
		{
			return json_encode(array('code'=>0,'result'=>'没有权限'));
		}
	}
	
	/**
	 * 删除一个o2o账号
	 * @return string
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_DELETE))
		{
			$id = $this->get->id;
			$o2oModel = $this->model('o2ouser');
			$o2oModel->remove($id);
			$userModel = $this->model('user');
			$userModel->clearOid($id);
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('o2o','admin'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
}