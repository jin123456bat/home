<?php
namespace application\control;

use system\core\control;
use application\model\roleModel;
use application\classes\login;
/**
 * 管理员角色控制器
 * @author jin12
 */
class roleControl extends control
{
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
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'role',roleModel::POWER_INSERT))
		{
			$name = $this->post->name;
			if(!empty($name))
			{
				if($roleModel->add($name))
				{
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
			}
			return json_encode(array('code'=>0,'result'=>'参数错误'));
		}
		return json_encode(array('code'=>2,'result'=>'权限不足'));
	}
}