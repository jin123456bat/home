<?php
namespace application\control;

use system\core\control;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
/**
 * 管理员角色控制器
 * @author jin12
 */
class roleControl extends control
{
	
	/**
	 * 更改用户组权限
	 */
	function set()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'role',roleModel::POWER_UPDATE))
		{
			$id = $this->post->id;
			$name = $this->post->name;
			$value = $this->post->value;
			$value = empty($value)?0:15;
			$result = $roleModel->where('id=?',array($id))->update($name,$value);
			if($result)
				return json_encode(array('code'=>1,'result'=>'ok'));
			return json_encode(array('code'=>2,'result'=>'更改失败'));
		}
		return json_encode(array('code'=>0,'result'=>'没有权限'));
	}
	
	/**
	 * 移除管理组
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'role',roleModel::POWER_DELETE))
		{
			$id = $this->post->id;
			if($roleModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>2,'result'=>'删除失败'));
		}
		return json_encode(array('code'=>0,'result'=>'没有权限'));
	}
	
	/**
	 * 管理员角色管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'role',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/role_admin.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			$result = $roleModel->fetchAll();
			$this->view->assign('roleGroup',$result);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 获取所有角色列表及权限内容
	 * @return string
	 */
	function fetch()
	{
		$roleModel = $this->model('role');
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$roleModel->select('id,name')));
	}
	
	/**
	 * 创建管理员角色
	 * @param string post name 角色名称
	 * @return string
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'role',roleModel::POWER_INSERT))
		{
			$name = $this->post->name;
			if(!empty($name))
			{
				$result = $roleModel->add($name);
				if($result)
				{
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
			}
			return json_encode(array('code'=>0,'result'=>'请填写管理组名'));
		}
		return json_encode(array('code'=>2,'result'=>'权限不足'));
	}
}