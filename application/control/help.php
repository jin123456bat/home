<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\filter;
use application\model\roleModel;
use system\core\validate;
use system\core\view;
use application\classes\blog;
class helpControl extends control
{
	/**
	 * 
	 * 帮助页面
	 */
	function page()
	{
		$id = filter::int($this->get->id);
		$helpModel = $this->model('help');
		$result = $helpModel->get($id);
		if($this->get->admin == 1)
		{
			if(empty($result))
			{
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('help','admin'));
			}
			else
			{
				$this->view = new view(config('view'), 'admin/help_page.html');
				$this->view->assign('help',$result);
				return $this->view->display();
			}
		}
		else
		{
			if(isset($result['content']))
			{
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
			}
			return json_encode(array('code'=>0,'result'=>'no contents'));
		}
	}
	
	/**
	 * 文章编辑页面
	 */
	function edit()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'help',roleModel::POWER_ALL))
		{
			$helpModel=$this->model('help');
			if($this->post->submit === NULL)
			{
				$id = filter::int($this->get->id);
				$help = $helpModel->get($id);
				$this->view = new view(config('view'), 'admin/help_create.html');
				$this->view->assign('help',$help);
				$this->response->setBody($this->view->display());
			}
			else
			{
				$id = $this->post->id;
				$title = $this->post->title;
				$content = $this->post->content;
				$helpModel->save($id,$title,$content);
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('help','admin'));
			}
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 管理界面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'help',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/help_admin.html');
			$helpModel = $this->model('help');
			$help = $helpModel->select();
			foreach($help as &$article)
			{
				$article['pic'] = (new blog())->getPic($article['content']);
				$article['short'] = (new blog())->getShort($article['content']);
			}
			$this->view->assign('help',$help);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 删除自定义页面
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'help',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			$helpModel = $this->model('help');
			if($helpModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
	
	function create()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'help',roleModel::POWER_INSERT))
		{
			if($this->post->submit === NULL)
			{
				$this->view = new view(config('view'), 'admin/help_create.html');
				$this->response->setBody($this->view->display());
			}
			else
			{
				$helpModel = $this->model('help');
				if($helpModel->create($this->post->title,$this->post->content))
				{
					$this->response->setCode(302);
					$this->response->addHeader('Location',$this->http->url('help','admin'));
				}
			}
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
}