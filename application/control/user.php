<?php
namespace application\control;

use system\core\control;
use system\core\validate;
use system\core\view;
use application\model\roleModel;
use system\core\filter;
use application\classes\login;

class userControl extends control
{

	/**
	 * 用户注册
	 * @return string
	 */
	function register()
	{
		$telephone = $this->post->telephone;
		$password = $this->post->password;
		$code = $this->post->code;
		$userModel = $this->model('user');
		if ($telephone != NULL && validate::telephone($telephone)) {
			if(login::admin())
			{
				if(empty($password))
					$password = $telephone;
				if($userModel->register($telephone, $password))
				{
					return json_encode(array('code'=>1,'result'=>'success'));
				}
				return json_encode(array('code'=>3,'result'=>'手机号重复注册'));
			}
			else
			{
				foreach ($this->session->code as $precode)
				{
					if($precode == $code)
					{
						
						if($userModel->register($telephone, $password))
						{
							return json_encode(array('code'=>1,'result'=>'success'));
						}
						return json_encode(array('code'=>3,'result'=>'手机号重复注册'));
					}
				}
				return json_encode(array('code'=>'2','result'=>'验证码不匹配'));
			}
		}
		return json_encode(array(
			'code' => 0,
			'result' => '请输入正确的手机号码'
		));
	}

	/**
	 * 普通用户登录接口
	 * @return string
	 */
	function login()
	{
		$telephone = filter::string($this->post->telephone,16);
		$password = filter::string($this->post->password);
		if($telephone != NULL && $password != NULL && validate::telephone($telephone))
		{
			$userModel = $this->model('user');
			$uinfo = $userModel->login($telephone,$password);
			if(isset($uinfo['uid']) && !empty($uinfo['uid']))
			{
				$this->session->id = $uinfo['uid'];
				$this->session->group = $uinfo['group'];
			}
		}
		return json_encode(array('code'=>0,'result'=>'请求失败'));
	}
	
	/**
	 * 用户列表页面  管理员
	 */
	function userlist()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/userlist.html');
			$userModel = $this->model('user');
			$this->view->assign('user',$userModel->select());
			return $this->view->display();
		}
	}
	
	/**
	 * 
	 * ajax调用用户数据列表
	 */
	function userlistajax()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_SELECT))
		{
			$userModel = $this->model('user');
			
			$num = $userModel->select('count(*)');
			$result = $userModel->searchable($_POST);
		
			$resultObj = new \stdClass();
			$resultObj->draw = $_POST['draw'];
			$resultObj->recordsTotal = (int)$num[0]['count(*)'];
  			$resultObj->recordsFiltered = count($result);
  			$resultObj->data = array_slice($result,$this->post->start,$this->post->length);
  			return json_encode($resultObj);
		}
	}
}