<?php
namespace system\core;

use system\core\inter\config;
/**
 * memcached 类
 * @author jin12
 *
 */
class memcached
{
	private $_memcached;
	
	function __construct(config $config)
	{
		if ($config->open)
		{
			$this->_memcached = new \Memcache();
			if(is_array($config->server))
			{
				foreach ($config->server as $key=>$host)
				{
					$this->_memcached->addserver( $host,  $config->port[$key] , $config->persistent[$key], $config->weight[$key], $config->timeout[$key] , $config->retry_interval[$key],$config->status[$key] , $config->failure_callback[$key]);
				}
			}
			else
			{
				$this->_memcached->pconnect($config->server,$config->port,$config->timeout);
				$this->_memcached->setfailurecallback($config->failure_callback);
				$this->_memcached->setcompressthreshold($config->threshold,$config->min_savings);
			}
		}
	}
	
	/**
	 * 判断memcached扩展是否已经加载
	 */
	static function ready()
	{
		return function_exists('memcache_connect');
	}
	
	function __set($name,$value)
	{
		memcache_set($this->_memcached,$name,$value,MEMCACHE_COMPRESSED);
	}
	
	function __isset($name)
	{
		return $this->$name !== false;
	}
	
	function __get($name)
	{
		return memcache_get($this->_memcached,$name);
	}
	
	function __unset($name)
	{
		memcache_delete($name);
	}
	
	function status()
	{
		return memcache_get_server_status($this->_memcached);
	}
}
?>