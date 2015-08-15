<?php
namespace application\control;
use system\core\control;
use system\core\view;
use application\model\roleModel;
use application\classes\login;
/**
 * 滚动图控制器
 * @author jin12
 */
class carouselControl extends control
{
	/**
	 * 滚动图管理页面
	 */
	function admin()
	{
		$this->view = new view(config('view'), 'admin/carousel_admin.html');
		$themeModel = $this->model('theme');
		$theme = $themeModel->select();
		$this->view->assign('theme',$theme);
		$productModel = $this->model('product');
		$product = $productModel->where('stock>?',array(0))->select();
		$this->view->assign('product',$product);
		return $this->view->display();
	}
	
	/**
	 * 添加滚动图
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'carousel',roleModel::POWER_INSERT))
		{
			$pic = $this->file->pic;
			$title = $this->post->title;
			$stop = $this->post->stop;
			$type = $this->post->type;
			$src_product = $this->post->src_product;
			$src_url = $this->post->src_url;
			$src_theme = $this->post->src_theme;
			switch ($type)
			{
				case 'url':$src = $src_url;break;
				case 'product':$src = $src_product;break;
				case 'theme':$src = $src_theme;break;
				default:$src = '';break;
			}
			$carouselModel = $this->model('carousel');
			$id = $carouselModel->create($pic,$title,$stop,$type,$src);
			if($id)
			{
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$id));
			}
			return json_encode(array('code'=>0,'result'=>'创建失败'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
}