<?php
namespace system\core;

class thread
{

	private $_http;

	private $_log;

	private $_config;

	function __construct()
	{
		$this->_config = config('system');
		$this->_http = http::getInstance();
		$this->_log = new log();
	}

	/**
	 * 启动一个线程
	 *
	 * @param unknown $name
	 *        	线程名称
	 * @param unknown $array(key=>value)
	 *        	线程参数 $this->get->key
	 * @return boolean
	 */
	function call($name, $array = array())
	{
		$url = $this->_http->url($this->_config['thread_enter'], $name, $array);
		$pathinfo = parse_url($url);
		
		$host = '127.0.0.1';
		$port = $this->_http->port();
		
		$query = isset($pathinfo['query']) ? ($pathinfo['path'] . '?' . $pathinfo['query']) : $pathinfo['path'];
		unset($pathinfo);
		
		$errno = 0;
		$errstr = 'completed';
		$fp = fsockopen($host, $port, $errno, $errstr, 5);
		if (! $fp) {
			$this->_log->thread($errno, $errstr);
			return false;
		} else {
			$out = 'GET ' . $query . " HTTP/1.1\r\n";
			$out .= 'Host: ' . $host . "\r\n";
			$out .= $this->_config['thread_enter'] . ': ' . $name . "\r\n";
			$out .= "Connection: Close\r\n\r\n";
			$length = fwrite($fp, $out);
			fclose($fp);
			$this->_log->thread($errno, $errstr);
			return true;
		}
	}
}