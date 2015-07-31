<?php
namespace system\core;

/**
 * http管理
 *
 * @author 程晨
 */
class http
{

	/**
	 * 获取当前url或者根据设置的控制器名称，方法名称，以及其他参数生成一个url
	 *
	 * @param string $c
	 *        	控制器名称
	 * @param string $a
	 *        	方法名
	 * @param string $array
	 *        	get参数
	 * @param string $query
	 *        	#后面的内容
	 * @return string
	 */
	function url($c = NULL, $a = NULL, $array = array(), $query = NULL)
	{
		$protocal = (isset($_SERVER['https']) ? 'https://' : 'http://');
		$port = isset($_SERVER['https']) ? (($this->port() == 443) ? '' : ':' . $this->port()) : (($this->port() == 80) ? '' : ':' . $this->port());
		if ($c === NULL && $a === NULL) {
			return $protocal . $this->host() . $port . $_SERVER['PHP_SELF'] . '?' . $_SERVER['QUERY_STRING'];
		} else {
			$config = config('system', true);
			switch ($config['pathmode']) {
				case 'pathinfo':
					$parameter = '/' . urlencode($c) . '/' . urlencode($a);
					foreach ($array as $key => $value) {
						$parameter .= '/' . $key . '/' . urlencode($value);
					}
				default:
					$parameter = '?c=' . urlencode($c) . '&a=' . urlencode($a);
					$parameter .= empty($array)?'':('&' . http_build_query($array));
			}
			$query = ($query === NULL) ? '' : '#' . $query;
			return $protocal . $this->host() . $port . $_SERVER['PHP_SELF'] . $parameter . $query;
		}
	}

	/**
	 * 当前请求方式
	 *
	 * @return GET|POST|DELETE|PUT
	 */
	function method()
	{
		return $_SERVER['REQUEST_METHOD'];
	}

	/**
	 * 请求时间
	 *
	 * @return string unix时间戳
	 */
	public static function time()
	{
		return $_SERVER['REQUEST_TIME'];
	}

	/**
	 * 主机名
	 *
	 * @return string
	 */
	function host()
	{
		return $_SERVER['HTTP_HOST'];
	}

	/**
	 * 主机ip
	 *
	 * @return string IPv4地址
	 */
	function ip($host = NULL)
	{
		$host = ($host === NULL) ? $this->host() : $host;
		return gethostbyname($host);
	}

	/**
	 * 端口号
	 *
	 * @return string
	 */
	function port()
	{
		return $_SERVER['SERVER_PORT'];
	}
	
	/**
	 * 页面跳转
	 * @param unknown $url
	 */
	function jump($url)
	{
		header('Location: '.$url,'302',true);
	}

	/**
	 * 协议
	 *
	 * @return HTTP /1.1
	 */
	function protal()
	{
		return $_SERVER['SERVER_PROTOCOL'];
	}

	/**
	 * 上一个页面地址
	 *
	 * @return string|null
	 */
	function referer()
	{
		return isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : NULL;
	}

	/**
	 * 浏览器信息
	 *
	 * @return mixed
	 */
	function agnet()
	{
		return get_browser(NULL, true);
	}
	
	/**
	 * 脚本路径
	 * @return unknown
	 */
	function path()
	{
		return pathinfo($_SERVER['PHP_SELF'],PATHINFO_DIRNAME);
	}
}