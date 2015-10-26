<?php
namespace application\control;
use system\core\control;
use system\core\view;
use system\core\http;
use application\classes\login;
use application\classes\wechat;
use application\message\json;

class mobileControl extends control
{
	private $_config;
	
	private $_template_dir;
	
	private $_system;
	
	private $_wechat;
	
	function __construct()
	{
		parent::__construct();
		
		$this->_template_dir = 'mobile1/';
		
		$this->_config = config('view');
		
		$this->_system = $this->model('system');
		
		if (isWechat())
		{
			$appid = $this->_system->get('appid','weixin');
			$appsecret = $this->_system->get('appsecret','weixin');
			$this->_wechat = new wechat($appid, $appsecret);
		}
	}
	
	function __call($name,$args)
	{
		if(!empty($args))
			return $this->call('index', '__404');
			
		//微信的自动登陆和注册
		if (isWechat() && $this->_system->get('autologin','weixin'))
		{
			
			if (!login::wechat())
			{
				if ($this->get->code === NULL)
				{
					$location = $this->_wechat->getCode($this->http->url(), 'snsapi_base');
					$this->response->setCode(302);
					$this->response->addHeader('Location',$location);
				}
				else
				{
					$this->session->code = $this->get->code;
				}
			}
			
			if($this->_system->get('open','dist'))
			{
				//对于点击分享链接过来的用户
				if ($this->get->wechat_share_id !== NULL)
				{
					$wechat_share_id = intval($this->get->wechat_share_id);
					$userModel=$this->model('user');
					$user = $userModel->get($this->session->id);
					if (!empty($user) && empty($user['oid']))
					{
						$userModel->where('id=?',array($user['id']))->update('oid',$wechat_share_id);
					}
				}
			}
		}
		
		//主题锁
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
			
			if (isWechat())
			{
				$jssdk = $this->_wechat->getJSSDK();
				$jssdk->setAccessToken($this->call('wechat', 'access_token'));
				$signPackage = $jssdk->getSignPackage();
				$signPackage['wechat_share_id'] = $this->session->id;
				
				$this->view->assign('signPackage',$signPackage);
			}
			
			return $this->view->display();
		}
		else
		{
			return $this->call('index', '__404');
		}
	}
}