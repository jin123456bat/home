<?php
namespace system\core;

use system\core\filesystem;

class log
{
	private $_config;

	function __construct()
	{
		$this->_config = config('log');
	}

	/**
	 * 记录线程日志
	 *
	 * @param unknown $errno        	
	 * @param unknown $errstr        	
	 */
	function thread($errno, $errstr)
	{
		$out = date(http::time(), "Y-m-d H:i:s") . ' ' . $errno . ' ' . $errstr;
		if(filesystem::path($this->_config['thread_path']))
		{
			file_put_contents($this->_config['thread_path'], $out);
		}
	}

	/**
	 * mysql日志
	 *
	 * @param unknown $error        	
	 * @param unknown $errstr        	
	 */
	function mysql($errno, $errstr)
	{
		$out = date(http::time(), "Y-m-d H:i:s") . ' ' . $errno . ' ' . $errstr;
		if(filesystem::path($this->_config['mysql_path']))
		{
			file_put_contents($this->_config['mysql_path'], $out);
		}
	}
}