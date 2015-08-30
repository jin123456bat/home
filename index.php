<?php
use system\core\webApplication;

/* 定义根目录 */
defined('ROOT') or define('ROOT', str_replace('\\', '/', __DIR__));
/* 导入global向导 */

require_once ROOT . '/global.php';

$config = config('system');
(new webApplication($config))->run();