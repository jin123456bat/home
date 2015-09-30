<?php
namespace application\control;

use system\core\control;
/**
 * 缓存管理控制器
 * @author jin12
 *
 */
class cacheControl extends control
{
	/**
	 * 调用线程删除所有错误的产品图像
	 */
	function productimg()
	{
		$this->thread->call('productimg');
		echo "OK";
	}
	
	/**
	 * 清空系统日志
	 */
	function log()
	{
		$this->thread->call('log');
		echo "ok";
	}
	
	/**
	 * 清空用户登陆日志
	 */
	function user_login()
	{
		$this->thread->call('user_login');
		echo "ok";
	}
	
	/**
	 * 清空缓存的物流信息
	 */
	function waybills()
	{
		$this->thread->call('waybills');
		echo "ok";
	}
}