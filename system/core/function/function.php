<?php

/**
 * 载入配置文件
 *
 * @param string $name
 *        	配置名称
 * @param bool $parent
 *        	强制只载入系统配置
 * @return new config
 */
function config($name, $parent = false)
{
	static $_instance = array();
	if (! isset($_instance[$name])) {
		$classname = $name . 'Config';
		$path = ROOT . '/system/core/config/' . $classname . '.php';
		if (file_exists($path)) {
			include $path;
			$namespace = 'system\\core\\config\\' . $classname;
			$_instance[$name] = new $namespace();
		}
		$userPath = ROOT . '/application/config/' . $classname . '.php';
		if (file_exists($userPath) && ! $parent) {
			$namespace = '\\application\\config\\' . $classname;
			include $userPath;
			$userViewConfig = new $namespace();
			if (isset($_instance[$name])) {
				$_instance[$name] = $_instance[$name]->combine($userViewConfig);
			} else {
				$_instance[$name] = $userViewConfig;
			}
		}
	}
	return $_instance[$name];
}

/**
 * xml对象转化为数组
 */
function xmlToArray($xmlString)
{
	if(is_string($xmlString))
	{
		$xmlObj = simplexml_load_string($xmlString);
		return json_decode(json_encode($xmlObj,true),true);
	}
}