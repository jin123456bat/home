<?php
namespace application\control;
use system\core\control;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
use application\message\json;
/**
 * 配送方案控制器
 * @author jin12
 *
 */
class shipControl extends control
{
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/ship.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$shipModel = $this->model('ship');
			$this->view->assign('ship',$shipModel->select());
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 保存修改后的配送方案
	 */
	function save()
	{
		$id = $this->post->id;
		$name =$this->post->name;
		$code = $this->post->code;
		$max = $this->post->max;
		$price = $this->post->price;
		if(empty($id) || empty($name) || empty($code))
			return new json(json::PARAMETER_ERROR,'名称或代码不能为空');
		$max = empty($max)?0:$max;
		$price = empty($price)?0:$price;
		$data = ['name'=>$name,'code'=>$code,'max'=>$max,'price'=>$price];
		if($this->model('ship')->save($id,$data))
		{
			return new json(json::OK);
		}
		return new json(json::PARAMETER_ERROR,'配送方案不存在');
	}
	
	/**
	 * 添加配送方案
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin()&&$roleModel->checkPower($this->session->role,'system',roleModel::POWER_INSERT))
		{
			$name = $this->post->name;
			$code = $this->post->code;
			$max = $this->post->max;
			$price = $this->post->price;
			$shipModel = $this->model('ship');
			if($shipModel->create($name,$code,$max,$price))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>2,'result'=>'failed'));
		}
		return json_encode(array('code'=>3,'result'=>'没有权限'));
	}
	
	/**
	 * 配送方式列表
	 */
	function lists()
	{
		$result = $this->model('ship')->select();
		return new json(json::OK,NULL,$result);
	}
}