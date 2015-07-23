<?php
namespace system\core\config;

use system\core\inter\config;

/**
 * mysql配置文件
 *
 * @author 程晨
 *        
 */
class mysqlConfig extends config
{

	/**
	 * 数据库类型
	 *
	 * @var unknown
	 */
	public $db_type = 'mysql';

	/**
	 * 数据库地址
	 *
	 * @var unknown
	 */
	public $db_server = 'localhost';

	/**
	 * 数据库名
	 *
	 * @var unknown
	 */
	public $db_dbname = '';

	/**
	 * 数据库用户名
	 *
	 * @var unknown
	 */
	public $db_user = 'root';

	/**
	 * 数据库密码
	 *
	 * @var unknown
	 */
	public $db_password = '';

	/**
	 * 持久化连接
	 *
	 * @var unknown
	 */
	public $db_forever = false;

	/**
	 * 字符集
	 *
	 * @var unknown
	 */
	public $db_charset = 'utf-8';
}