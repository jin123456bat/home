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
		$baseUrl = rtrim($http.$this->http->host().$this->http->path().'/application','/');
		$this->_smarty->assign("VIEW_ROOT",$baseUrl);
		$this->_smarty->registerPlugin('function',"url", array($this,'url'));
		$this->_smarty->registerPlugin('function','resource',array($this,'resource'));
		//include ROOT.'/extends/smarty/smartyex.class.php';
		//$this->_smarty->registerObject("smartyex",new \smartyex());
	}
	
	function resource($parameter)
	{
		$path = $parameter['path'];
		$http = $this->http->isHttps()?'https://':'http://';
		$url = $http.$this->http->host().$this->http->path().str_replace(ROOT, '', $path);
		$default = './application/assets/gravatar.jpg';
		return is_file($path)?$url:$default;
	}
	
	function url($parameter)
	{
		$http = http::getInstance();
		$c = $parameter['c'];
		$a = $parameter['a'];
		unset($parameter['c']);
		unset($parameter['a']);
		$array = array('c'=>$c,'a'=>$a,'array'=>$parameter);
		return call_user_func_array(array($http,'url'), $array);
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