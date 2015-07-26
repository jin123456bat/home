<?php
namespace application\control;

use system\core\control;
use system\core\validate;

class userControl extends control
{

	function register()
	{
		$telephone = $this->post->telephone;
		$password = $this->post->password;
		$code = $this->post->code;
		if ($telephone != NULL && $password != NULL && validate::telephone($telephone) && validate::int($code)) {
			foreach ($this->session->code as $precode)
			{
				if($precode == $code)
				{
					$userModel = $this->model('user');
					if($userModel->register($telephone, $password))
					{
						return json_encode(array('code'=>1,'result'=>'success'));
					}
					return json_encode(array('code'=>3,'result'=>'手机号重复注册'));
				}
			}
			return json_encode(array('code'=>'2','result'=>'验证码不匹配'));
			
		}
		return json_encode(array(
			'code' => 0,
			'result' => '请求失败'
		));
	}

	function login()
	{
		$telephone = $this->post->telephone;
		$password = $this->post->password;
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
}