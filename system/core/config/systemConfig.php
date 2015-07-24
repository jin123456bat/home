<?php
namespace system\core\config;

use system\core\inter\config;

/**
 *
 * @author 程晨
 */
class systemConfig extends config
{

	/**
	 * 版本号
	 *
	 * @var unknown
	 */
	public $version = '1.0';

	/**
	 * 字符集
	 *
	 * @var unknown
	 */
	public $charset = 'utf-8';

	/**
	 * url解析方式
	 * pathinfo:index.php/a/b 对应a控制器中的b方法 控制器名和方法名可以都写也可以都不写 当不填写为默认的控制器和方法 请不要填写一个，填写一个为调用线程
	 * none:index.php?a=1&b=2...
	 *
	 * @var unknown
	 */
	public $pathmode = 'none';

	/**
	 * 默认控制器
	 *
	 * @var unknown
	 */
	public $default_control = 'index';

	/**
	 * 默认方法
	 *
	 * @var unknown
	 */
	public $default_action = 'index';

	/**
	 * 线程入口关键词，当控制器名称为thread_enter的时候为调用异步线程，防止冲突 这个可以更改
	 *
	 * @var unknown
	 */
	public $thread_enter = 'asyncthreadhandler';

	/**
	 * 时区
	 *
	 * @var unknown
	 */
	public $timezone = 'Asia/Shanghai';
}
?>