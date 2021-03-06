<?php
namespace application\control;
use system\core\control;
use system\core\view;
use system\core\http;
use application\classes\wechat;

class mobileControl extends control
{
	private $_config;
	
	private $_template_dir;
	
	private $_system;
	
	private $_wechat;
	
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