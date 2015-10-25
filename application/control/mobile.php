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
			
		//微信的自动登陆和注册
		if (isWechat())
		{
			if (!login::wechat())
			{
				$userModel = $this->model('user');
				if ($this->get->code === NULL)
				{
					$location = $this->_wechat->getCode($this->http->url(), 'snsapi_base');
					$this->response->setCode(302);
					$this->response->addHeader('Location',$location);
				}
				else
				{
					$openid = $this->_wechat->getOpenid($this->get->code);
					$user = $userModel->getByOpenid($openid);
					if (empty($user))
					{
						if($userModel->registerWeiXin($openid,$this->get->wechat_share_id))
						{
							$user = $userModel->loginWeiXin($openid);
						}
						else
						{
							echo "微信注册失败";
						}
					}
					$this->session->id = $user['id'];
					//telephone默认为NULL  判断登陆时候可能导致错误
					$this->session->telephone = empty($user['telephone'])?'':$user['telephone'];
					$this->session->username = $user['username'];
					$this->session->openid = $user['openid'];
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
				$signPackage = $jssdk->getSignPackage();
				$signPackage['wechat_share_id'] = $this->session->id;
				$this->_view->assign('signPackage',$signPackage);
			}
			
			return $this->view->display();
		}
		else
		{
			return $this->call('index', '__404');
		}
	}
}