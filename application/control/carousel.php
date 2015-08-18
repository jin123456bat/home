<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
use system\core\image;
use system\core\file;
/**
 * 滚动图控制器
 * @author jin12
 */
class carouselControl extends control
{
	
	/**
	 * app获取滚动图接口
	 */
	function getlist()
	{
		$carousel = $this->model('carousel');
		$result = $carousel->select();
		foreach($result as &$carousel)
		{
			$carousel['pic'] = file::realpathToUrl($carousel['pic']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 滚动图管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'carousel',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/carousel_admin.html');
			$themeModel = $this->model('theme');
			$theme = $themeModel->select();
			$this->view->assign('theme',$theme);
			$productModel = $this->model('product');
			$product = $productModel->where('stock>?',array(0))->select();
			$this->view->assign('product',$product);
			$carouselModel = $this->model('carousel');
			$this->view->assign('carousel',$carouselModel->fetchAll('url'));
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	function save()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'carousel',roleModel::POWER_INSERT))
		{
			$carouselModel = $this->model('carousel');
			$pic = $this->file->pic;
			$id = $this->post->id;
			if(!empty($pic))
			{
				$image = new image();
				$pic = $image->resizeImage($pic, 640, 320);
				$carouselModel->where('id=?',array($id))->update('pic',$pic);
			}
			$title = $this->post->title;
			$stop = filter::int($this->post->stop);
			$type = $this->post->type;
			$src_product = filter::int($this->post->src_product);
			$src_url = filter::url($this->post->src_url);
			$src_theme = filter::int($this->post->src_theme);
			switch ($type)
			{
				case 'url':$src = $src_url;break;
				case 'product':$src = $src_product;break;
				case 'theme':$src = $src_theme;break;
				default:$src = '';break;
			}
			$carouselModel->save($id,$title,$stop,$type,$src);
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('carousel','admin'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 添加滚动图
	 */
	function create()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'carousel',roleModel::POWER_INSERT))
		{
			$pic = $this->file->pic;
			if(!empty($pic))
			{
				$image = new image();
				$pic = $image->resizeImage($pic, 640, 320);
			}
			else
			{
				$pic = ROOT.'/application/assets/global/plugins/jcrop/demos/demo_files/image3.jpg';
			}
			$title = $this->post->title;
			$stop = $this->post->stop;
			$type = $this->post->type;
			$src_product = filter::int($this->post->src_product);
			$src_url = filter::url($this->post->src_url);
			$src_theme = filter::int($this->post->src_theme);
			switch ($type)
			{
				case 'url':$src = $src_url;break;
				case 'product':$src = $src_product;break;
				case 'theme':$src = $src_theme;break;
				default:$src = '';break;
			}
			$carouselModel = $this->model('carousel');
			$id = $carouselModel->create($title,$pic,$stop,$type,$src);
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('carousel','admin'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 移除滚动图
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'carousel',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			$carouselModel = $this->model('carousel');
			if($carouselModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'删除失败'));
		}
		else
		{
			return json_encode(array('code'=>2,'result'=>'没有权限'));
		}
	}
}