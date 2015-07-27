<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
use system\core\filter;

class adminControl extends control
{
	/**
	 * 管理员登陆界面
	 */
	function index()
	{
		$this->view = new view(config('view'), 'admin/login.html');
		return $this->view->display();
	}
	
	function dashboard()
	{
		$this->view = new view(config('view'), 'admin/dashboard.html');
		return $this->view->display();
	}
	
	/**
	 * 管理员登陆接口
	 */
	function login()
	{
		$username = filter::string($this->post->username,16);
		$password = filter::string($this->post->password,16);
		if(!empty($username) && !empty($password))
		{
			$adminModel = $this->model('admin');
			$ainfo = $adminModel->login($username,$password);
			if(!empty($ainfo))
			{
				$this->session->id = $ainfo['id'];
				$this->session->username = $ainfo['username'];
				$this->session->role = $ainfo['role'];
				return json_encode(array('code'=>1,'result'=>'登陆成功'));
			}
			return json_encode(array('code'=>2,'result'=>'用户名或密码错误'));
		}
		return json_encode(array('code'=>0,'result'=>'用户名或密码格式错误'));
	}
	
	/**
	 * 添加管理员
	 */
	function register()
	{
		if(!login::admin())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$roleModel = $this->model('role');
		if($roleModel->checkPower($this->session->role,'admin',roleModel::POWER_INSERT))
		{
			$username = filter::string($this->post->username,16);
			$password = filter::string($this->post->password,16);
			$adminModel = $this->model('admin');
			if($adminModel->register($username,$password))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'用户名已存在'));
		}
		return json_encode(array('code'=>3,'result'=>'权限不足'));
	}
}