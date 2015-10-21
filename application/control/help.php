<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\filter;
use application\model\roleModel;
use system\core\view;
use application\classes\blog;
use application\message\json;
class helpControl extends control
{
	/**
	 * 
	 * 帮助页面
	 */
	function page()
	{
		$id = filter::int($this->get->id);
		$name = $this->get->name;
		$helpModel = $this->model('help');
		$result = $helpModel->where('id=? or title = ?',array($id,$name))->select();
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
				$roleModel = $this->model('role');
				$this->view->assign('role',$roleModel->get($this->session->role));
				$this->view->assign('help',$result);
				return $this->view->display();
			}
		}
		else
		{
			if(!empty($result))
			{
				return new json(json::OK,NULL,$result[0]);
			}
			return new json(json::PARAMETER_ERROR);
		}
	}
	
	/**
	 * 帮助文档列表
	 * @return \application\message\json
	 */
	function lists()
	{
		$helpModel = $this->model('help');
		$result = $helpModel->select();
		return new json(json::OK,NULL,$result);
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
				$this->view->assign('role',$roleModel->get($this->session->role));
					
				$systemModel = $this->model('system');
				$system = $systemModel->fetch('system');
				$system = $systemModel->toArray($system,'system');
				$this->view->assign('system',$system);
				
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
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
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
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR);
		}
		return new json(json::NO_POWER);
	}
	
	function create()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'help',roleModel::POWER_INSERT))
		{
			if($this->post->submit === NULL)
			{
				$this->view = new view(config('view'), 'admin/help_create.html');
				$this->view->assign('role',$roleModel->get($this->session->role));
				
				$systemModel = $this->model('system');
				$system = $systemModel->fetch('system');
				$system = $systemModel->toArray($system,'system');
				$this->view->assign('system',$system);
				
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
	
	
	
	function __404()
	{
		return $this->call('admin','__404');
	}
}