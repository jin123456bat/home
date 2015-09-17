<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
use system\core\filter;
use application\message\json;

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
	 * 更改管理员密码
	 */
	function resetpwd()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->id,'admin',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->post->id);
			$password= $this->post->password;
			$adminModel = $this->model('admin');
			if($adminModel->changepwd($id,$password))
			{
				$this->model('log')->write($this->session->username,"更改了管理员的密码");
				return new json(json::OK);
			}
			return new json(4,'修改后的密码和原密码相同');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 删除管理员账户
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'admin',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			$adminModel = $this->model('admin');
			if($adminModel->remove($id))
			{
				$this->model('log')->write($this->session->username,"删除了管理员账户");
				return new json(json::OK);
			}
			return new json(4,'删除失败');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 管理后台主页
	 */
	function dashboard()
	{
		if(login::admin())
		{
			$this->view = new view(config('view'), 'admin/dashboard.html');
			$this->model('log')->write($this->session->username,"登陆了系统");
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * ajax请求管理员列表
	 * @return string
	 */
	function adminlistajax()
	{
		$roleModel = $this->model('role');
		$resultObj = new \stdClass();
		$resultObj->draw = $this->post->draw;
		$resultObj->recordsTotal = 0;
		$resultObj->recordsFiltered = 0;
		$resultObj->data = array();
		if (login::admin() && $roleModel->checkPower($this->session->role, 'admin', roleModel::POWER_SELECT)) {
			$adminModel = $this->model('admin');
			$num = $adminModel->select('count(*)');
			$result = $adminModel->searchable($_POST);
			$resultObj->recordsTotal = (int) $num[0]['count(*)'];
			$resultObj->recordsFiltered = count($result);
			$resultObj->data = array_slice($result, $this->post->start, $this->post->length);
		}
		return json_encode($resultObj);
	}
	
	/**
	 * 管理员列表 页面
	 */
	function adminlist()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'admin',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/adminlist.html');
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
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
				return new json(json::OK,'登陆成功');
			}
			return new json(json::NOT_LOGIN,'用户名或密码错误');
		}
		return new json(json::PARAMETER_ERROR,"用户名或密码格式错误");
	}
	
	/**
	 * 管理员注销
	 */
	function logout()
	{
		unset($this->session->id);
		unset($this->session->role);
		unset($this->session->username);
	}
	
	/**
	 * 添加管理员 接口
	 */
	function register()
	{
		if(!login::admin())
			return new json(json::NOT_LOGIN);
		$roleModel = $this->model('role');
		if($roleModel->checkPower($this->session->role,'admin',roleModel::POWER_INSERT))
		{
			$username = filter::string($this->post->username,16);
			$password = filter::string($this->post->password,16);
			$adminModel = $this->model('admin');
			if($adminModel->register($username,$password))
			{
				$this->model('log')->write($this->session->username,'添加了一个管理员账号'.$username);
				return new json(json::OK);
			}
			return new json(4,'用户名已经存在');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 更改管理员的管理组
	 */
	function setrole()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'admin',roleModel::POWER_UPDATE))
		{
			$aid = $this->post->id;
			$roleid = $this->post->role;
			$adminModel = $this->model('admin');
			if($adminModel->where('id=?',array($aid))->update('role',$roleid))
			{
				$this->model('log')->write($this->session->username,'更改了管理员的管理组id=>'.$aid.'role=>'.$roleid);
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR,'管理组不存在或者无任何更改');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * __404
	 * optional
	 */
	function __404()
	{
		$this->view = new view(config('view'), 'admin/__404.html');
		return $this->view->display();
	}
}