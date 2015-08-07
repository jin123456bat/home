<?php
namespace system\core\config;

use system\core\inter\config;

/**
 * memcached配置文件
 *
 * @author 程晨
 *        
 */
class memcachedConfig extends config
{
	public $open = false;
	/**
	 * memcached服务器地址
	 * @var ip地址或域名
	 */
	public $server = 'localhost';
	
	/**
	 * memcached服务器端口号
	 * @var unknown
	 */
	public $port = 11211;
	
	/**
	 * 超时时间  最好不要修改
	 * @var unknown
	 */
	public $timeout = 1;
	
	/**
	 * 
	 */
	function __construct()
	{
		$this->failure_callback = function($server,$port){
			echo $server." connect failed at ".$port;
		};
		
		$this->retry_interval = 15;
		
		/**
		 * 连接失败后是否放弃该连接
		 */
		$this->status = false;
		
		/**
		 * 对于大于这个数值的数据进行自动压缩
		 */
		$this->threshold = 20000;
		
		/**
		 * 压缩比例
		 */
		$this->min_savings = 0.2;
	}
}