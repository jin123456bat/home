<?php
namespace system\core;

/**
 * 缓存
 *
 * @author 程晨
 */
class cache extends base
{
	private $_config;
	private static $_instance;

	function __construct($config)
	{
		$this->_config = $config;
		parent::__construct();
	}

	static public function getInstance($config)
	{
		if(self::$_instance === NULL)
		{
			self::$_instance = new cache($config);
		}
		return self::$_instance;
	}

	/**
	 * 检查缓存是否可用
	 *
	 * @param unknown $url        	
	 * @return string|NULL 可用的话返回缓存内容 不可用返回NULL
	 */
	public function check($url)
	{
		$md5 = md5($url);
		$file = filesystem::path($this->_config['path'] . '/' . $md5 . '.' . $this->_config['suffix']);
		if(is_file($file))
		{
			$mtime = filemtime($file);
			if($this->http->time() - $mtime < $this->_config['time'])
				return file_get_contents($file);
		}
		return NULL;
	}

	/**
	 * 写入缓存
	 *
	 * @param unknown $url        	
	 * @param unknown $content        	
	 * @return int
	 */
	public function write($url, $content)
	{
		$md5 = md5($url);
		$file = filesystem::path($this->_config['path'] . '/' . $md5 . '.' . $this->_config['suffix']);
		return file_put_contents($file, $content);
	}
}