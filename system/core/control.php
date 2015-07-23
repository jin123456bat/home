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
	protected $view;
	
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
		$class->view = new view($viewConfig, $control);
	}
}