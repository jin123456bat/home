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
		$path = ROOT . '/application/model/' . $name . '.php';
		$instance = NULL;
		if (file_exists($path)) {
			require $path;
			$model = "application\\model\\" . $name . 'Model';
			$instance = new $model();
		}
		return $instance;
	}
}