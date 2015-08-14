<?php
namespace system\core;

use system\core\inter\config;
/**
 * 上传文件管理
 *
 * @author 程晨
 *        
 */
class file
{

	function __construct()
	{
		
	}

	function __get($name)
	{
		if(isset($_FILES[$name]))
			return $this->receive($_FILES[$name], config('file'));
		return false;
	}

	/**
	 * 接受上传文件，成功返回文件保存路径，失败返回上传的错误代码，假如不是上传文件则返回false
	 * 使用文件上传注意要设置php.ini中的几个配置
	 * upload_max_filesize
	 * max_input_time
	 * post_max_size
	 * 在iis上
	 * <configuration>
	 * </system.webServer>
	 * <security>
	 * <requestFiltering>
	 * <requestLimits maxAllowedContentLength="314572800"/>
	 * </requestFiltering>
	 * </security>
	 * </system.webServer>
	 * </configuration>
	 *
	 * @param $_FILES['file'] $file        	
	 * @param $config config('file');        	
	 * @return unknown|string|number|bool
	 */
	function receive($file, $config)
	{
		set_time_limit(0);
		//ini_set('memory_limit', $config->size);
		if (is_uploaded_file($file['tmp_name'])) {
			if ($file['error'] != UPLOAD_ERR_OK) {
				return $file['error'];
			}
			if ($file['size'] > $config['size']) {
				return UPLOAD_ERR_INI_SIZE;
			}
			if (!in_array($file['type'], $config['type'])) {
				return 8;
			}
			if (! is_writable(filesystem::path($config['path'])) || !is_dir(filesystem::path($config['path']))) {
				return UPLOAD_ERR_CANT_WRITE;
			}
			$type = empty(filesystem::type($file['name'])) ? 'tmpuploadfile' : filesystem::type($file['name']);
			$filename = rtrim($config['path'], '/') . '/' . md5_file($file['tmp_name']) . sha1_file($file['tmp_name']) . '.' . $type;
			if (move_uploaded_file($file['tmp_name'], $filename)) {
				return $filename;
			}
		}
		return false;
	}
	
	/**
	 * 接收多文件
	 * @param array $files
	 * @param config $config
	 * @return array 返回上传成功的文件的保存路径
	 */
	function receiveMultiFile($files,$config)
	{
		if (! is_writable(filesystem::path($config['path'])) || !is_dir(filesystem::path($config['path']))) {
			return UPLOAD_ERR_CANT_WRITE;
		}
		$index = 0;
		$path = array();
		while(isset($file['error'][$index]))
		{
			if($files['error'][$index] == UPLOAD_ERR_OK)
			{
				if (!isset($config['size']) || $files['size'][$index] < $config['size'])
				{
					if(!isset($config['type']) || in_array($files['type'][$index],$config['type']))
					{
						$type = empty(filesystem::type($files['name'][$index])) ? 'tmpuploadfile' : filesystem::type($files['name'][$index]);
						$filename = rtrim($config['path'], '/') . '/' . md5_file($files['tmp_name'][$index]) . sha1_file($files['tmp_name'][$index]) . '.' . $type;
						if (move_uploaded_file($files['tmp_name'], $filename)) {
							$path[] = $filename;
						}
					}
				}
			}
			$index++;
		}
		return $path;
	}

	/**
	 * 文件合并
	 * 将第二个文件合并到第一个文件末端
	 * 返回合并后的文件路径
	 * 提供了回调函数以监视其合并进度
	 *
	 * @param string $file1        	
	 * @param string $file2        	
	 * @param callable $callback        	
	 * @return string $file
	 */
	function merge($file1, $file2, callable $callback = NULL)
	{
		$file1 = filesystem::path($file1);
		$file2 = filesystem::path($file2);
		$writeHandler = fopen($file1, 'ab');
		$readHandler = fopen($file2, 'rb');
		if ($readHandler && $writeHandler) {
			while (true) {
				$data = fread($readHandler, 8192);
				if (strlen($data) == 0) {
					break;
				}
				if (is_callable($callback)) {
					call_user_func($callback, array(
						$data
					));
				}
				fwrite($writeHandler, $data);
			}
			fclose($readHandler);
			fclose($writeHandler);
			return $file1;
		}
		return false;
	}

	/**
	 * 文件分割,注意使用此函数注意内存要大于$size,成功则返回小文件路径数组
	 *
	 * @param unknown $file
	 *        	要分割的文件
	 * @param unknown $size
	 *        	文件大小 单位字节
	 * @param unknown $path
	 *        	文件保存路径 默认在系统临时目录中
	 * @return array|false
	 */
	function split($file, $size, $path = NULL, callable $callback)
	{
		$path = filesystem::path($path);
		$array = array();
		if (is_writable($path) && is_dir($path)) {
			$readHandler = fopen($file, 'rb');
			if (! $readHandler)
				return false;
			$num = 0;
			while (true) {
				$path = empty($path) ? sys_get_temp_dir() : $path;
				$tmppath = tempnam($path, 'data_');
				$writeHandler = fopen($tmppath, 'ab');
				if (! $writeHandler)
					return false;
				$data = fread($readHandler, $size);
				if (strlen($data) == 0)
					break;
				if (is_callable($callback)) {
					call_user_func($callback, array(
						$data
					));
				}
				fwrite($writeHandler, $data);
				$array[] = $tmppath;
			}
			fclose($readHandler);
			fclose($writeHandler);
			return $array;
		}
		return false;
	}
	
	/**
	 * 将文件的绝对转化为url访问地址
	 */
	static function realpathToUrl($path)
	{
		$path = realpath($path);
		if($path)
		{
			$path = str_replace(realpath(ROOT), '', $path);
			$http = new http();
			return rtrim('http://'.$http->host().$http->path(),'/').$path;
		}
		return NULL;
	}
}