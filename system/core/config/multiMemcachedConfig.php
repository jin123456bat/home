<?php
namespace system\config;
use system\core\inter\config;
/**
 * 多memcached服务器配置
 * @author jin12
 *
 */
class multiMemcachedConfig extends config
{
	function __construct()
	{
		/**
		 * 服务器地址
		 */
		$this->server = array(
			'192.168.1.101',
			'192.168.1.102'
		);
		
		/**
		 * 端口号，注意和服务器地址保持一致，使用unix套接字的时候设置为0
		 */
		$this->port = array(
			11211,
			11211
		);
		
		/**
		 * 持久化连接
		 */
		$this->persistent = array(
			true,
			true
		);
		
		/**
		 * 服务器被选中的概率
		 */
		$this->weight = array(
			5,
			5
		);
		
		/**
		 * 超时时间
		 */
		$this->timeout = array(
			1,
			1
		);
		
		/**
		 * 当服务器连接失败的时候重试连接的时间间隔，在间隔期间服务器被标记为连接失败
		 */
		$this->retry_interval = array(
			15,
			15
		);
		
		/**
		 * 指示服务器是否可以被标记为在线状态
		 */
		$this->status = array(
			true,
			true
		);
		
		/**
		 * 连接失败时候的回调函数
		 */
		$this->failure_callback = array(
			function($server,$port){
				echo $server.' connect failed at '.$port;
			},
			function($server,$port){
				echo $server.' connect failed at '.$port;
			}
		);
	}
}