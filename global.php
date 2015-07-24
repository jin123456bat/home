<?php
/*
 * 引入系统函数
 */
array_map(function ($filename) {
	if ($filename != '.' && $filename != '..') {
		require ROOT . '/system/core/function/' . $filename;
	}
}, scandir(ROOT . '/system/core/function'));
/*
 * 引入用户自定义函数
 */
array_map(function ($filename) {
	if ($filename != '.' && $filename != '..') {
		require ROOT . '/application/function/' . $filename;
	}
}, scandir(ROOT . '/application/function/'));
/*
 * 引用系统类库
 */
spl_autoload_register(function ($classname) {
	$path = ROOT . '/' . str_replace('\\', '/', $classname) . '.php';
	if (file_exists($path)) {
		include $path;
	}
});