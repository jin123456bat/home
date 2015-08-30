<?php
namespace application\control;
use system\core\control;
use system\core\file;
use system\core\filter;
use application\classes\login;
use application\model\roleModel;
use system\core\view;
use system\core\image;
class themeControl extends control
{
	/**
	 * 获取一个主题内容
	 */
	function information()
	{
		$this->response->addHeader('Content-Type','application/json');
		$id = filter::int($this->get->id);
		$themeModel = $this->model('theme');
		$result = $themeModel->get($id);
		$result['bigpic'] = empty($result['bigpic'])?'':file::realpathToUrl($result['bigpic']);
		$result['middlepic'] = empty($result['middlepic'])?'':file::realpathToUrl($result['middlepic']);
		$result['smallpic'] = empty($result['smallpic'])?'':file::realpathToUrl($result['smallpic']);
		$result['product'] = $themeModel->product($id);
		foreach($result['product'] as $product)
		{
			switch ($product['activity'])
			{
				case 'sale':$product['activity_description'] = $this->model('sale')->getByPid($product['id']);break;
				case 'seckill':$product['activity_description'] = $this->model('seckill')->getByPid($product['id']);break;
				case 'fullcut':$product['activity_description'] = $this->model('fullcutdetail')->getByPid($product['id']);break;
				default:break;
			}
			$product['img'] = $this->model('productimg')->getByPid($product['id']);
			$product['prototype'] = $this->model('prototype')->getByPid($product['id']);
			$product['collection'] = $this->model('collection')->getByPid($product['id']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 获取首页显示的主题
	 */
	function getlist()
	{
		$this->response->addHeader('Content-Type','application/json');
		$length = filter::int($this->get->length);
		$length = empty($length)?3:$length;
		$themeModel = $this->model('theme');
		$result = $themeModel->fetchAll($length);
		foreach ($result as &$value)
		{
			$value['smallpic'] = file::realpathToUrl($value['smallpic']);
			$value['middlepic'] = file::realpathToUrl($value['middlepic']);
			$value['bigpic'] = file::realpathToUrl($value['bigpic']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 主题管理
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'theme',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/theme_admin.html');
			$themeModel = $this->model('theme');
			$theme = $themeModel->fetchAll();
			foreach ($theme as &$a)
			{
				$a['bigpic'] = empty($a['bigpic'])?'#':file::realpathToUrl($a['bigpic']);
				$a['smallpic'] = empty($a['smallpic'])?'#':file::realpathToUrl($a['smallpic']);
				$a['middlepic'] = empty($a['middlepic'])?'#':file::realpathToUrl($a['middlepic']);
			}
			$this->view->assign('theme',$theme);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 创建主题
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'theme',roleModel::POWER_INSERT))
		{
			$name = $this->post->name;
			$description = $this->post->description;
			$bigpic = $this->file->bigpic;
			$middlepic = $this->file->middlepic;
			$smallpic = $this->file->smallpic;
			$image = new image();
			if (!empty($bigpic))
			{
				$bigpic = $image->resizeImage($bigpic, 640, 280);
			}
			else
			{
				$bigpic = '';
			}
			if(!empty($middlepic))
			{
				$middlepic = $image->resizeImage($middlepic, 320, 260);
			}
			else 
			{
				$middlepic = '';
			}
			if(!empty($smallpic))
			{
				$smallpic = $image->resizeImage($smallpic, 320, 130);
			}
			else
			{
				$smallpic = '';
			}
			$themeModel = $this->model('theme');
			if($themeModel->create($name,$description,$bigpic,$middlepic,$smallpic))
			{
				$this->response->addHeader('Location',$this->http->url('theme','admin'));
			}
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 保存对主题的修改
	 */
	function save()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'theme',roleModel::POWER_UPDATE))
		{
			$id = $this->post->id;
			$name = $this->post->name;
			$description = $this->post->description;
			$bigpic = $this->file->bigpic;
			$middlepic = $this->file->middlepic;
			$smallpic = $this->file->smallpic;
			$themeModel = $this->model('theme');
			if(empty($id))
				return json_encode(array('code'=>2,'result'=>'空id'));
			if(!empty($name))
			{
				$themeModel->where('id=?',array($id))->update('name',$name);
				$body = $name;
			}
			if(!empty($description))
			{
				$themeModel->where('id=?',array($id))->update('description',$description);
				$body = $description;
			}
			$image = new image();
			if(!empty($bigpic))
			{
				$bigpic = $image->resizeImage($bigpic, 640, 280);
				$themeModel->where('id=?',array($id))->update('bigpic',$bigpic);
				$body = file::realpathToUrl($bigpic);
			}
			if(!empty($middlepic))
			{
				$middlepic = $image->resizeImage($middlepic, 320, 260);
				$themeModel->where('id=?',array($id))->update('middlepic',$middlepic);
				$body = file::realpathToUrl($middlepic);
			}
			if(!empty($smallpic))
			{
				$smallpic = $image->resizeImage($smallpic, 320, 130);
				$themeModel->where('id=?',array($id))->update('smallpic',$smallpic);
				$body = file::realpathToUrl($smallpic);
			}
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$body));
		}
		return json_encode(array('code'=>0,'result'=>'没有权限'));
	}
	
	/**
	 * 移除主题
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'theme',roleModel::POWER_DELETE))
		{
			$id = $this->post->id;
			if($this->where('id=?',array($id))->delete())
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'删除失败'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
	
	/**
	 * 将产品推送到主题
	 */
	function product()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'theme',roleModel::POWER_UPDATE))
		{
			$tid = filter::int($this->post->tid);
			$pid = filter::int($this->post->pid);
			$themeModel = $this->model('theme');
			if($themeModel->insertProduct($tid,$pid))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'商品已经添加到主题了，换一个吧？'));
		}
		return json_encode(array('code'=>2,'result'=>'权限不足'));
	}
}