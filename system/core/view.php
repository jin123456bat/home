<?php
namespace system\core;

use system\core\file;
/**
 * 视图以及模板管理
 *
 * @author 程晨
 *        
 */
class view extends base
{
	/**
	 * 配置
	 */
	private $_viewConfig;
	
	/**
	 * 模板名称
	 * @var unknown
	 */
	private $_viewname;
	
	/**
	 * 模板引擎路径
	 * @var unknown
	 */
	private $_enginePath;
	
	/**
	 * 模板引擎实例
	 * @var unknown
	 */
	private $_smarty;
	/**
	 * 构造函数
	 * @param unknown $viewConfig
	 * @param unknown $viewname
	 */
	function __construct($viewConfig, $viewname)
	{
		parent::__construct();
		$this->_viewConfig = $viewConfig;
		$this->_viewname = $viewname;
		$this->_enginePath = ROOT.'/extends/smarty/Smarty.class.php';
		include_once $this->_enginePath;
		$this->_smarty = new \Smarty();
		$this->init();
	}
	
	/**
	 * 初始化模板引擎
	 */
	private function init()
	{
		$this->_smarty->template_dir = $this->_viewConfig->template_dir;
		$this->_smarty->caching = $this->_viewConfig->caching;									//是否使用缓存
		$this->_smarty->compile_dir = $this->_viewConfig->compile_dir;		//设置编译目录
		$this->_smarty->cache_dir = $this->_viewConfig->cache_dir;						//设置缓存文件夹
		$this->_smarty->left_delimiter = $this->_viewConfig->left_delimiter;							//设置左右标示符
		$this->_smarty->right_delimiter = $this->_viewConfig->right_delimiter;
		
		$http = $this->http->isHttps()?'https://':'http://';
		$path = str_replace('\\', '/', $this->http->path());
		$path = rtrim($path,'/');
		$baseUrl = rtrim($http.$this->http->host().$path.'/application','/');
		$this->_smarty->assign("VIEW_ROOT",$baseUrl);
		$this->_smarty->registerPlugin('function',"url", array($this,'url'));
		$this->_smarty->registerPlugin('function','resource',array($this,'resource'));
		$this->_smarty->registerPlugin('function','formattime',array($this,'formattime'));
		//include ROOT.'/extends/smarty/smartyex.class.php';
		//$this->_smarty->registerObject("smartyex",new \smartyex());
	}
	
	function formattime($parameter)
	{
		$second = $parameter['second'];
		if($second < 5*60)
		{
			return "就在刚才";
		}
		else
		{
			$min = floor($second/60);
			if($min <60)
			{
				return $min.'分钟前';
			}
			else
			{
				$hour = floor($min/60);
				if($hour<24)
				{
					return $hour.'小时前';
				}
				else
				{
					$day = floor($hour/24);
					return $day.'天前';
				}
			}
		}
	}
	
	/**
	 * 图片路径转化
	 * @param unknown $parameter
	 * @return string
	 */
	function resource($parameter)
	{
		if(filter_var($parameter,FILTER_SANITIZE_URL))
			return $parameter;
		$path = $parameter['path'];
		$http = $this->http->isHttps()?'https://':'http://';
		$url = $http.$this->http->host().$this->http->path().str_replace(ROOT, '', $path);
		$default = './application/assets/gravatar.jpg';
		return is_file($path)?$url:$default;
	}
	
	/**
	 * url生成
	 * @param unknown $parameter
	 * @return mixed
	 */
	function url($parameter)
	{
		$http = http::getInstance();
		$c = $parameter['c'];
		$a = $parameter['a'];
		$urlencode = false;
		if(isset($parameter['urlencode']))
		{
			$urlencode = $parameter['urlencode'];
			unset($parameter['urlencode']);
		}
		unset($parameter['c']);
		unset($parameter['a']);
		$array = array('c'=>$c,'a'=>$a,'array'=>$parameter);
		if(!$urlencode)
		{
			return call_user_func_array(array($http,'url'), $array);
		}
		else
		{
			return urlencode(call_user_func_array(array($http,'url'), $array));
		}
	}
	
	/**
	 * 添加模板变量
	 * @param unknown $key
	 * @param unknown $val
	 * @return Smarty_Internal_Data
	 */
	function assign($key,$val)
	{
		return $this->_smarty->assign($key,$val);
	}
	
	/**
	 * 返回模板
	 * @param string $template
	 * @return string
	 */
	function display($template = NULL)
	{
		$template = empty($template)?$this->_viewname:$template;
		return $this->_smarty->fetch($template);
	}
}