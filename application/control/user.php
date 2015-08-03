<?php
namespace application\control;

use system\core\control;
use system\core\validate;
use system\core\view;
use application\model\roleModel;
use system\core\filter;
use application\classes\login;
use application\classes\email;

class userControl extends control
{
	
	/**
	 * 用户遗忘密码
	 */
	function forgetpwd()
	{
		$code = $this->post->code;
		$telephone = filter::int($this->post->telephone);
		$password = $this->post->password;
		$smslogModel = $this->model('smslog');
		if($smslogModel->check($telephone,$code))
		{
			$userModel = $this->model('user');
			if($userModel->changepwd($telephone,$password));
				return json_encode(array('code'=>1,'result'=>'ok'));
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'验证码错误'));
	}
	
	/**
	 * 用户更改密码
	 */
	function changepwd()
	{
		$oldepwd = $this->post->oldpwd;
		$newpwd = $this->post->newpwd;
		if(login::user())
		{
			$id = $this->session->id;
			if(!empty($oldepwd) && !empty($newpwd))
			{
				$userModel = $this->model('user');
				if($userModel->authpwd($id,$oldepwd))
				{
					return json_encode(array('code'=>1,'result'=>'密码更改成功'));
				}
			}
		}
		return json_encode(array('code'=>0,'result'=>'密码更改失败，旧密码不正确'));
	}

	/**
	 * 用户封印
	 * @return string
	 */
	function close()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'user', roleModel::POWER_UPDATE)) {
			$id = filter::int($this->post->id);
			$close = filter::int($this->post->toggle);
			$userModel = $this->model('user');
			if ($userModel->where('id=?', array(
				$id
			))->update('close', $close)) {
				return json_encode(array(
					'code' => 1,
					'result' => 'ok'
				));
			}
			return json_encode(array(
				'code' => 0,
				'result' => 'failed'
			));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}

	/**
	 * 用户注册
	 * 
	 * @return string
	 */
	function register()
	{
		$telephone = filter::telephone($this->post->telephone);
		$password = $this->post->password;
		$o2o = $this->session->o2o;
		$code = $this->post->code;
		$userModel = $this->model('user');
		if ($telephone != NULL && validate::telephone($telephone)) {
			if (login::admin()) {
				if (empty($password))
					$password = $telephone;
				if ($userModel->register($telephone, $password,$o2o)) {
					return json_encode(array(
						'code' => 1,
						'result' => 'success'
					));
				}
				else
				{
					return json_encode(array(
						'code' => 3,
						'result' => '手机号重复注册'
					));
				}
			} else {
				$smslogModel = $this->model('smslog');
				if($smslogModel->check($telephone,$code))
				{
					if ($userModel->register($telephone, $password))
					{
						unset($this->session->code);
						return json_encode(array(
							'code' => 1,
							'result' => 'success'
						));
					}
					else
					{
						return json_encode(array(
							'code' => 3,
							'result' => '手机号重复注册'
						));
					}
				}
			}
			return json_encode(array(
				'code' => '2',
				'result' => '验证码不匹配'
			));
		}
	}

	/**
	 * 普通用户登录接口
	 * 
	 * @return string
	 */
	function login()
	{
		$telephone = filter::telephone($this->post->telephone);
		$password = $this->post->password;
		if ($telephone != NULL && $password != NULL && validate::telephone($telephone)) {
			$userModel = $this->model('user');
			$uinfo = $userModel->login($telephone, $password);
			if (isset($uinfo['uid']) && ! empty($uinfo['uid'])) {
				if(empty($uinfo['close']))
				{
					$this->session->id = $uinfo['uid'];
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_decode(array('code'=>2,'result'=>'被管理员封印ing'));
			}
		}
		return json_encode(array(
			'code' => 0,
			'result' => '请求失败'
		));
	}

	/**
	 * 用户列表页面 管理员
	 */
	function userlist()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'user', roleModel::POWER_SELECT)) {
			$this->view = new view(config('view'), 'admin/userlist.html');
			return $this->view->display();
		}
	}

	/**
	 * 向用户发送邮件
	 */
	function sendmail()
	{
		$uid = $this->post->uid;
		$content = urldecode($this->post->content);
		try {
			$title = '测试邮件';
			$uid = json_decode($uid);
			$uid = '(' . implode(',', $uid) . ')';
			$userModel = $this->model('user');
			$result = $userModel->where('id in ' . $uid)->select('email');
			$mail = new email(config('email'));
			$emailaddress = array_map(function ($user) {
				if (isset($user['email']) && ! empty($user['email'])) {
					return $user['email'];
				}
			}, $result);
			if ($mail->send($emailaddress, '测试邮件', $content)) {
				return json_encode(array(
					'code' => 1,
					'result' => '发送完毕'
				));
			}
			return json_encode(array(
				'code' => 2,
				'result' => '邮件发送失败，请检查您的配置和网络'
			));
		} catch (\Exception $e) {
			return json_encode(array(
				'code' => 0,
				'result' => '发送过程中失败了'
			));
		}
	}

	/**
	 * ajax调用用户数据列表
	 */
	function userlistajax()
	{
		$roleModel = $this->model('role');
		$resultObj = new \stdClass();
		$resultObj->draw = $this->post->draw;
		$resultObj->recordsTotal = 0;
		$resultObj->recordsFiltered = 0;
		$resultObj->data = array();
		if (login::admin() && $roleModel->checkPower($this->session->role, 'user', roleModel::POWER_SELECT)) {
			$userModel = $this->model('user');
			$num = $userModel->select('count(*)');
			$result = $userModel->searchable($_POST);
			$resultObj->recordsTotal = (int) $num[0]['count(*)'];
			$resultObj->recordsFiltered = count($result);
			$resultObj->data = array_slice($result, $this->post->start, $this->post->length);
		}
		return json_encode($resultObj);
	}
}