<?php
namespace application\control;
use system\core\control;
use system\core\view;
use system\core\http;
use application\classes\login;
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
		$wechat_autologin = $this->_system->get('autologin','weixin');
		//微信的自动登陆和注册
		if (isWechat() && $wechat_autologin)
		{
			if (!login::wechat())
			{
				if ($this->get->code === NULL)
				{
					$location = $this->_wechat->getCode($this->http->url(), 'snsapi_userinfo');
					$this->response->setCode(302);
					$this->response->addHeader('Location',$location);
				}
				else
				{
					$code = $this->get->code;
					$codeinfo = $this->_wechat->getOpenid($code);
					$userinfo = $this->_wechat->getUserInfo($codeinfo['access_token'], $codeinfo['openid']);
					$this->session->wechat_user_info = $userinfo;
				}
			}
			
			if($this->_system->get('open','dist'))
			{
				//对于点击分享链接过来的用户
				if ($this->get->wechat_share_id !== NULL)
				{
					$this->session->wechat_share_id = $this->get->wechat_share_id;
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
			
			$this->view->assign('tempalte_name',trim($this->_template_dir,'/\\'));
			
			if (isWechat())
			{
				if ($wechat_autologin)
				{
					$this->view->assign('need_wechat_login',1);
				}
				
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