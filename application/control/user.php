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
		if($telephone != NULL && $password != NULL && validate::telephone($telephone))
		{
			$userModel = $this->model('user');
			$userModel->register($telephone,$password);
		}
		return json_encode(array('code'=>0,'result'=>'请求失败'));
	}

	function login($telephone, $password)
	{
		
	}
}