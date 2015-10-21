<?php
namespace application\control;
use system\core\control;
use system\core\view;
use system\core\http;
use application\classes\login;

class mobileControl extends control
{
	private $_config;
	
	private $_template_dir;
	
	private $_system;
	
	function __construct()
	{
		parent::__construct();
		
		$this->_template_dir = 'mobile/';
		
		$this->_config = config('view');
		
		$this->_system = $this->model('system');
	}
	
	function __call($name,$args)
	{
		if(!empty($args))
			return $this->call('index', '__404');
			
		//-----------felixchen----------
		$system = $this->model('system');
		$dist = $system->get('open','dist');
		if($dist)
		{
			if(!login::user()){
				$type = $this->get->type;
				if(isset($type)){
					$util=$this->call("util","addUser");//调用控制器方法,获取授权注册
				}else{//已经注册不需要授权登陆
					$util=$this->call("util","userFind");
				}
			}
		}
		//-----------felixchen----------	
		
		switch (strtolower($name))
		{
			case 'themedetail':
				if($this->_system->get('lock','theme'))
				{
					$this->session->theme_lock = $this->get->id;
				}
				break;
			default:
		}
		
		$template = $this->_template_dir.$name.'.html';
		$http = http::getInstance();
		$base_template = ROOT . '/application/template/'.$template;
		if(file_exists($base_template))
		{
			$this->view = new view($this->_config, $template);
			return $this->view->display();
		}
		else
		{
			return $this->call('index', '__404');
		}
	}
}