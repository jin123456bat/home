<?php
namespace application\control;

use system\core\control;
use system\core\view;

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
	
	/**
	 * 管理员登陆接口
	 */
	function login()
	{
		$username = $this->post->username;
		$password = $this->post->password;
		if(!empty($username) && !empty($password))
		{
			$adminModel = $this->model('admin');
			$ainfo = $adminModel->login($username,$password);
			if(!empty($ainfo))
			{
				$this->session->id = $ainfo['id'];
				$this->session->group = $ainfo['group'];
			}
		}
	}
	
	/**
	 * 添加管理员
	 */
	function register()
	{
		
	}
}