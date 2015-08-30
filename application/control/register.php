<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
/**
 * 新用户注册活动控制器
 * @author jin12
 *
 */
class registerControl extends control
{
	/**
	 * 新用户注册活动管理界面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'register',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/register_admin.html');
			$themeModel = $this->model('theme');
			$theme = $themeModel->select();
			$this->view->assign('theme',$theme);
			$productModel = $this->model('product');
			$product = $productModel->where('stock>?',array(0))->select();
			$this->view->assign('product',$product);
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 获取一个活动页的信息
	 */
	function information()
	{
		
		$id = filter::int($this->get->id);
		if(!empty($id))
		{
			$registerModel = $this->model('register');
			$result = $registerModel->get($id);
			if($this->get->type=="code")
			{
				$this->response->addHeader('Content-Type','text/html');
				return $result['content'];
			}
			else 
			{
				$this->response->addHeader('Content-Type','application/json');
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
			}
		}
		return json_encode(array('code'=>0,'result'=>'参数错误'));
	}
}