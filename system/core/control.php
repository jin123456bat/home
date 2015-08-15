<?php
namespace system\core;

/**
 * 控制器
 *
 * @author 程晨
 *        
 */
class control extends base
{

	/**
	 * response管理
	 *
	 * @var unknown
	 */
	public $response;

	/**
	 * 模板管理
	 *
	 * @var unknown
	 */
	public $view;

	/**
	 * 线程管理
	 *
	 * @var unknown
	 */
	protected $thread;

	function __construct()
	{
		parent::__construct();
		$this->thread = new thread();
		$viewConfig = config('view');
	}

	/**
	 * 载入数据模型
	 */
	function model($name)
	{
		static $instance = array();
		if(!isset($instance[$name]))
		{
			$path = ROOT.'/application/model/'.$name.'.php';
			include $path;
			$model = "application\\model\\" . $name . 'Model';
			$instance[$name] = new $model($name);
		}
		return $instance[$name];
	}
	
	/**
	 * 调用另外一个control中的action方法
	 */
	function call($c,$a)
	{
		$path = ROOT.'/application/control/'.$c.'.php';
		include $path;
		$control = 'application\\control\\'.$c.'Control';
		return (new $control)->$a();
		//return file_get_contents($this->http->url($c,$a));
	}
}