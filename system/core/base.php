<?php
namespace system\core;

/**
 * webApplication基类
 *
 * @author 程晨
 *        
 */
class base
{

	/**
	 * post类
	 *
	 * @var $_POST
	 */
	protected $post;

	/**
	 * get类
	 *
	 * @var $_GET
	 */
	protected $get;

	/**
	 * file类
	 *
	 * @var file
	 */
	protected $file;

	/**
	 * $_SESSION
	 * 
	 * @var unknown
	 */
	protected $session;
	
	/**
	 * $_COOKIE
	 * @var unknown
	 */
	protected $cookie;

	/**
	 * http管理
	 *
	 * @var unknown
	 */
	protected $http;

	function __construct()
	{
		$this->session = session::getInstance();
		$this->post = post::getInstance();
		$this->get = get::getInstance();
		$this->http = http::getInstance();
		$this->file = new file();
		$this->cookie= new cookie(config('cookie'));
	}
}