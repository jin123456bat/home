<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
use application\message\json;
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
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$id = 1;
			
			$registerModel = $this->model('register');
			$reigster = $registerModel->get($id);
			$this->view->assign('register',$reigster);
			
			$themeModel = $this->model('theme');
			$theme = $themeModel->select();
			$this->view->assign('theme',$theme);
			
			$productModel = $this->model('product');
			$product = $productModel->where('stock>?',array(0))->select();
			$this->view->assign('product',$product);
			
			$couponModel = $this->model('coupon');
			$coupon = $couponModel->select();
			$this->view->assign('coupon',$coupon);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 保存新用户注册活动的页面内容
	 */
	function save()
	{
		$id = filter::int($this->post->id);
		$name = $this->post->name;
		$value = $this->post->value;
		
		switch ($name)
		{
			case 'starttime':
			case 'endtime':
				$value = strtotime($value);
				break;
			case 'redict_url':
			case 'redict_theme':
			case 'redict_product':
				$name = 'redict';
				break;
			default:
				
				break;
		}
		
		$registerModel = $this->model('register');
		$registerModel->save($id,$name,$value);
		return new json(json::OK);
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
			if($this->get->type=='code')
			{
				$this->response->addHeader('Content-Type','text/html');
				return $result['content'];
			}
			else 
			{
				return new json(json::OK,NULL,$result);
			}
		}
		return new json(json::PARAMETER_ERROR);
	}
}