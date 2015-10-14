<?php
namespace application\control;
use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
use system\core\image;
use system\core\file;
use system\core\filesystem;
use system\core\filter;
use application\message\json;
/**
 * 结算管理控制器
 * @author jin12
 *
 */
class systemControl extends control
{
	/**
	 * 保存系统配置
	 */
	function save()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_UPDATE))
		{
			$systemModel = $this->model('system');
			
			$config = config('file');
			$config['path'] = ROOT.'/application/cert/';//证书文件保存位置
			unset($config['type']);//允许所有文件类型
			//检查文件上传
			foreach ($_FILES as $key=>$value)
			{
				$file = $this->file->receive($_FILES[$key],$config);
				if(is_file($file))
				{
					$_POST[$key] = $file;
				}
			}
			
			foreach($_POST as $key => $value)
			{
				list($system,$type,$name) = explode('_', $key);
				if($system == 'system')
				{
					$systemModel->set($name,$type,$value);
				}
			}
			
			$this->model('log')->write($this->session->username,'修改了系统配置');
			if(empty($this->http->referer()))
			{
				$lastpage = $this->http->url('admin','__404');
			}
			else
			{
				$lastpage = $this->http->referer();
			}
			
			$this->response->setCode(302);
			$this->response->addHeader('Location',$lastpage);
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 报关设置
	 */
	function costums()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/system_costums.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$costums = $systemModel->fetch(array('costums'));
			$systemConfig = array();
			foreach ($costums as $value)
			{
				$systemConfig['system_'.$value['type'].'_'.$value['name']] = $value['value'];
			}
			$this->view->assign('systemConfig',$systemConfig);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 获取app配置信息
	 */
	function app()
	{
		$type = $this->get->type;
		if(empty($type))
			return new json(json::PARAMETER_ERROR);
		$return = array();
		$startpage = array();
		$systemModel = $this->model('system');
		$app = $systemModel->fetch('app');
		foreach ($app as $value)
		{
			$startpage[] = file::realpathToUrl($value['value']);
		}
		$return['startpage'] = $startpage;
		$return['splitrate'] = $systemModel->get('splitrate','alipay');
		$return['servicetelephone'] = '400-400-400';
		return new json(json::OK,NULL,$return);
	}
	
	/**
	 * 物流配置页面
	 */
	function shippment()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/system_shippment.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			$shippment = $this->model('system')->fetch(array('shippment'));
			$system = array();
			foreach ($shippment as $value)
			{
				$system['system_'.$value['type'].'_'.$value['name']] = $value['value'];
			}
			$this->view->assign('system',$system);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 用于保存app的一些配置信息
	 */
	function saveapp()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_UPDATE))
		{
			$startpage1 = $this->file->system_app_startpage1;
			$startpage2 = $this->file->system_app_startpage2;
			$startpage3 = $this->file->system_app_startpage3;
			$startpage4 = $this->file->system_app_startpage4;
			if(is_file($startpage1))
			{
				$image = new image();
				$startpage1 = $image->resizeImage($startpage1, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage1','app',$startpage1))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage1)));
				}
			}
			if(is_file($startpage2))
			{
				$image = new image();
				$startpage2 = $image->resizeImage($startpage2, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage2','app',$startpage2))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage2)));
				}
			}
			if(is_file($startpage3))
			{
				$image = new image();
				$startpage3 = $image->resizeImage($startpage3, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage3','app',$startpage3))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage3)));
				}
			}
			if(is_file($startpage4))
			{
				$image = new image();
				$startpage3 = $image->resizeImage($startpage4, 414, 736);
				$systemModel = $this->model('system');
				if($systemModel->set('startpage4','app',$startpage4))
				{
					return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($startpage4)));
				}
			}
		}
		else
		{
			return json_encode(array('code'=>2,'result'=>'权限不足'));
		}
	}
	
	/**
	 * 移除启动图
	 */
	function removeapp()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$key = $this->post->key;
			list($system,$type,$key) = explode('_', $key);
			if($system !== 'system' || $type !== 'app')
				return json_encode(array('code'=>3,'result'=>'error'));
			$systemModel = $this->model('system');
			if($systemModel->set($key,$type,''))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		else
		{
			return json_encode(array('code'=>2,'result'=>'权限不足'));
		}
	}
	
	/**
	 * 结算方式控制页面
	 */
	function payment()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$systemModel = $this->model('system');
			$payment = $systemModel->fetch(array('weixin','alipay','payment'));
			$this->view = new view(config('view'), 'admin/system_payment.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$systemConfig = array();
			foreach ($payment as $value)
			{
				$systemConfig['system_'.$value['type'].'_'.$value['name']] = $value['value'];
			}
			$this->view->assign('systemConfig',$systemConfig);
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 系统基础配置
	 */
	function base()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/system_base.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$systemConfig = $systemModel->fetch('system');
			$systemConfig = $systemModel->toArray($systemConfig,'system');
			$this->view->assign('systemConfig',$systemConfig);
			
			$config = $systemModel->fetch(array('system','image','app','theme','jpush'));
			$system = array();
			foreach ($config as $value)
			{
				if($value['type'] == 'app')
				{
					$value['value'] = file::realpathToUrl($value['value']);
				}
				$system['system_'.$value['type'].'_'.$value['name']] = $value['value'];
			}
			$this->view->assign('system',$system);
			
			$flagModel = $this->model('flag');
			$flag = $flagModel->fetchAll();
			$this->view->assign('flag',$flag);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 缓存
	 */
	function cache()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/cache.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			return $this->view->display();
		}
		else
		{
			$this->response->set(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 上传国家图标
	 * @return string
	 */
	function flag()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_UPDATE))
		{
			$name = $this->post->name;
			$config = config('file');
			$config->path = ROOT.'/application/assets/flag/';
			$flag = $this->file->receive($_FILES['flag'],$config);
			if(empty($name) || !is_file($flag))
			{
				return json_encode(array('code'=>2,'result'=>'国家名或者国家图标上传失败'));
			}
			$flagModel = $this->model('flag');
			if($flagModel->create($name,$flag))
			{
				return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($flag)));
			}
			return json_encode(array('code'=>0,'result'=>'国家已经存在'));
		}
		return json_encode(array('code'=>3,'result'=>'权限不足'));
	}
	
	/**
	 * 获得国家图标
	 */
	function getflag()
	{
		$id = $this->get->id;
		$flagModel = $this->model('flag');
		$flag = $flagModel->get($id);
		if(!empty($flag))
		{
			$mimetype = filesystem::mimetype($flag['file']);
			$this->response->addHeader('Content-Type',$mimetype);
			readfile($flag['file']);
		}
		else
		{
			$this->response->addCode(302);
			$this->response->addHeader('Location',$this->http->url('index','__404'));
		}
	}
	
	function getflagname()
	{
		$id = $this->get->id;
		$flagModel = $this->model('flag');
		$flag = $flagModel->get($id);
		if(!empty($flag))
		{
			return $flag['name'];
		}
	}
	
	/**
	 * 移除设定中的国旗
	 * @return string
	 */
	function removeflag()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'system',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->post->id);
			if(empty($id))
				return json_encode(array('code'=>3,'result'=>'参数错误'));
			$flagModel = $this->model('flag');
			if($flagModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
		}
		return json_encode(array('code'=>2,'result'=>'权限不足'));
	}
}