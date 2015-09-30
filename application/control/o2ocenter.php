<?php
namespace application\control;
use system\core\control;
use system\core\http;
use system\core\view;
use application\classes\login;
use system\core\filter;
/**
 * o2o控制页面
 * @author jin12
 *
 */
class o2ocenterControl extends control
{
	/**
	 * view控制文件
	 * @var unknown
	 */
	private $_config;
	
	/**
	 * 模板目录
	 * @var unknown
	 */
	private $_template_dir;
	
	/**
	 * 构造函数
	 */
	function __construct()
	{
		parent::__construct();
		
		$this->_template_dir = 'o2o/';
		
		$this->_config = config('view');
	}
	
	/**
	 * 公共模板方法
	 * @param view $view
	 */
	private function publicTemplate(view $view)
	{
		
	}
	
	/**
	 * 映射
	 * @param unknown $name
	 * @param unknown $args
	 */
	function __call($name,$args)
	{
		if(!empty($args))
			return $this->call('index', '__404');
		if($name != 'login')
		{
			if (!login::o2o())
			{
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('o2ocenter','login'));
				return false;
			}
		}
		$action = array('index','search','profile');
		$template = $this->_template_dir.$name.'.html';
		$http = http::getInstance();
		$base_template = ROOT . '/application/template/'.$template;
		if(file_exists($base_template))
		{
			$this->view = new view($this->_config, $template);
			if(in_array($name, $action))
			{
				//加载系统配置
				$systemModel = $this->model('system');
				$system = $systemModel->fetch(array('system'));
				$temp = array();
				foreach($system as $key=>$value)
				{
					$temp[$value['name'].'_'.$value['type']] = $value['value'];
				}
				$this->view->assign('system',$temp);
				
				//载入用户的o2o配置
				$o2oModel = $this->model('o2ouser');
				$o2o = $o2oModel->get($this->session->id);
				if(empty($o2o))
					return $this->call('index', '__404');
				
				//载入用户的基本信息
				$userModel = $this->model('user');
				$user = $userModel->get($this->session->id);
				$this->view->assign('user', $user);
				
				switch ($name)
				{
					case 'search':
						
						$start = empty(filter::int($this->get->start))?0:filter::int($this->get->start);
						$length = empty(filter::int($this->get->length))?10:filter::int($this->get->length);
						$this->view->assign('start',$start);
						$this->view->assign('length',$length);
						$query = str_replace(' ', '%', str_replace('  ', ' ', $this->get->query));
						$userModel = $this->model('user');
						$userModel->where('user.oid=?',array($this->session->id));
						if(!empty($query))
						{
							$userModel->where('(username like ? or telephone like ? or email like ?)',array('%'.$query.'%','%'.$query.'%','%'.$query.'%'));
						}
						$userModel->limit($start,$length);
						$search = $userModel->select();
						$this->view->assign('search',$search);
						break;
					default:
				}
				
				$this->view->assign('o2o',$o2o);
			}
			return $this->view->display();
		}
		else
		{
			return $this->call('index', '__404');
		}
	}
}