<?php
namespace system\core;

use system\core\config\viewConfig;

/**
 * 应用程序类
 *
 * @author 程晨
 */
class webApplication extends base
{

	private $_config;

	function __construct($config)
	{
		$this->_config = $config;
		parent::__construct();
		date_default_timezone_set($this->_config['timezone']);
	}

	/**
	 * 入口点
	 */
	function run()
	{
		$response = new response();
		$cacheConfig = config('cache');
		
		if ($cacheConfig['cache']) {
			$cache = cache::getInstance($cacheConfig);
			$content = $cache->check($this->http->url());
			if (! empty($content)) {
				$response->setBody($content);
				$response->send();
			}
		}
		try {
			$handler = $this->parseUrl();
			if (is_array($handler)) {
				list ($control, $action) = $handler;
				include ROOT . '/application/control/' . $control . '.php';
				$class = 'application\\control\\' . $control . 'Control';
				if (class_exists($class)) {
					$class = new $class();
					$class->response = &$response;
					if (method_exists($class, $action)) {
						$response->setCode(200);
						$response->appendBody($this->__200($class, $action));
					} else {
						$response->setCode(404);
						$response->appendBody($this->__404($class, $action));
					}
				} else {
					$response->setCode(404);
					$response->appendBody($this->__404($class, $action));
				}
			} else {
				include ROOT . '/application/thread/' . $handler . '.php';
				$class = 'application\\thread\\' . $handler . 'Thread';
				$class = new $class();
				$class->run();
			}
		} catch (\Exception $e) {
			$response->setCode(500);
			$response->appendBody($this->__500($e));
		} finally
		{
			$response->send();
		}
	}

	/**
	 * Url解析
	 */
	function parseUrl()
	{
		switch ($this->_config['pathmode']) {
			case 'pathinfo':
				$pos = stripos($_SERVER['REQUEST_URI'], '.php/');
				if ($pos) {
					$path = substr($_SERVER['REQUEST_URI'], $pos + 5);
					$path = explode('/', $path);
					$control = ! isset($path[0]) || empty($path[0]) ? $this->_config['default_control'] : $path[0];
					$action = ! isset($path[1]) || empty($path[1]) ? $this->_config['default_action'] : $path[1];
					for ($i = 2; $i < count($path); $i += 2) {
						$_GET[$path[$i]] = $path[$i + 1];
						$_REQUEST[$path[$i]] = $path[$i + 1];
					}
				} else {
					$control = $this->_config['default_control'];
					$action = $this->_config['default_action'];
				}
				break;
			default:
				$control = empty($this->get->c) ? $this->_config['default_control'] : $this->get->c;
				$action = empty($this->get->a) ? $this->_config['default_control'] : $this->get->a;
		}
		if ($control === $this->_config['thread_enter']) {
			return $action;
		}
		return array(
			$control,
			$action
		);
	}

	/**
	 * 200响应
	 *
	 * @param unknown $control        	
	 * @param unknown $action        	
	 */
	function __200($control, $action)
	{
		return $control->$action();
	}

	/**
	 * 404响应
	 *
	 * @param unknown $control        	
	 * @param unknown $action        	
	 */
	function __404($control, $action)
	{
		if (method_exists($control, '__404')) {
			return $control->__404();
		} else {
			$viewConfig = new viewConfig();
			$view = new view($viewConfig, '404');
			return $view->display();
		}
	}

	/**
	 * 500响应
	 *
	 * @param \Exception $e        	
	 */
	function __500(\Exception $e)
	{
		echo $e;
		exit();
	}
}