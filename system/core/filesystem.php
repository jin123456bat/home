<?php
namespace system\core;

class filesystem
{

	/**
	 * 文件不存在返回false
	 * 没有执行权限返回false
	 * 其他返回文件格式化后的绝对路径
	 * 不要测试2G以上文件
	 *
	 * @param unknown $path        	
	 * @return string|false
	 */
	public static function path($path)
	{
		return realpath($path);
	}
	
	/**
	 * 删除文件
	 * @param unknown $file
	 * @return boolean
	 */
	public static function remove($file)
	{
		$path = self::path($file);
		if($path)
			return @unlink($path);
		return true;
	}

	/**
	 * 返回文件大小
	 * 支持包装器
	 * 不要测试2G以上文件
	 *
	 * @param unknown $filename        	
	 * @return int
	 */
	public static function size($filename)
	{
		return filesize(self::path($filename));
	}

	/**
	 * 创建一个目录
	 *
	 * @param unknown $dirname        	
	 * @return bool
	 */
	public static function mkdir($dirname)
	{
		return mkdir($dirname, 0777, true);
	}

	/**
	 * 删除一个目录，包括所有子文件
	 *
	 * @param unknown $dir        	
	 */
	public static function rmdir($dir)
	{
		$dirs = self::scan($dir);
		foreach ($dirs as $directory) {
			@unlink($directory);
		}
		return rmdir($dir);
	}

	/**
	 * 获得一个目录下所有文件
	 * 包括绝对路径
	 *
	 * @param string $dir        	
	 * @param bool $sdir
	 *        	是否包含子目录
	 * @return array
	 */
	public static function scan($dir, $sdir = false)
	{
		static $array = array();
		$file = scandir($dir);
		foreach ($file as $sfile)
		{
			if($sfile !== '.' && $sfile !== '..')
			{
				if(is_dir($sfile) && $sdir)
				{
					$array = array_merge($array,self::scan($sfile,true));
				}
				else
				{
					$array[] = $sfile;
				}
			}
		}		
		return $array;
	}

	/**
	 * 获得文件后缀
	 *
	 * @param unknown $filename        	
	 * @return mixed
	 */
	public static function type($filename)
	{
		return pathinfo($filename, PATHINFO_EXTENSION);
	}

	/**
	 * 文件mimetype
	 *
	 * @param unknown $file        	
	 * @param string $options        	
	 * @param unknown $magicFile        	
	 * @return unknown
	 */
	public static function mimetype($file, $options = FILEINFO_MIME_TYPE, $magicFile = NULL)
	{
		$result = finfo_file(finfo_open($options, $magicFile), self::path($file));
		// return $result ? $result : self::getMimeTypeByExtension($file);
		return $result;
	}

	/**
	 * 获得文件路径
	 */
	public static function dirname($filename)
	{
		return dirname(self::path($filename));
	}
	
	/**
	 * 文件删除
	 * @param unknown $path
	 * @return boolean
	 */
	public static function unlink($path)
	{
		$path = self::path($path);
		if($path)
		{
			return unlink($path);
		}
	}
}