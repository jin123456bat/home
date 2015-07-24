<?php
namespace system\core;

/**
 * 视图以及模板管理
 *
 * @author 程晨
 *        
 */
class view extends base
{

	private $_config;

	private $_templateContent;

	private $_var = array();

	function __construct($viewConfig, $viewname)
	{
		$this->_config = $viewConfig;
		$path = realpath($this->_config['path'] . DIRECTORY_SEPARATOR . $viewname . '.' . ltrim($this->_config->suffix, '.'));
		$this->_templateContent = file_get_contents($path);
		parent::__construct();
	}

	/**
	 * 解析模板
	 */
	private function parse()
	{
		$containerTimes = 0;
		if (strpos($this->_templateContent, $this->_config->leftContainer) !== false) {
			if (++ $containerTimes > $this->_config['containerTimes']) {
				break;
			}
			// 处理include标签
			$pattern = '/{%\s*include\s*file=[\'"]?.+[\'"]?\s*%}/';
			if (preg_match_all($pattern, $this->_templateContent, $match)) {
				$replaced = end($match);
				array_map(function ($replace) {
					$pattern = '/file=[\'"]?.+[\'"]/';
					if (preg_match($pattern, $replace, $match1)) {
						$file = trim(trim(str_replace('file=', '', $match1[0]), '"'), '\'');
						$file = realpath($this->_config->path . '/' . $file);
						$this->_templateContent = str_replace($replace, file_get_contents($file), $this->_templateContent);
					}
				}, $replaced);
			}
			// 处理普通变量
			foreach ($this->_var as $key => $value) {
				$pattern = '/' . $this->_config->leftContainer . '\s*\$' . $key . '\s*' . $this->_config->rightContainer . '/';
				$this->_templateContent = preg_replace($pattern, $value, $this->_templateContent);
			}
		}
	}

	/**
	 * 缓存并返回模板
	 *
	 * @return mixed
	 */
	function display()
	{
		// 解析模板
		$this->parse();
		// 将模板存入缓存
		$cacheConfig = config('cache');
		if ($cacheConfig['cache']) {
			$cache = cache::getInstance($cacheConfig);
			if ($cache->check($this->http->url())) {
				$cache->write($this->http->url(), $this->_templateContent);
			}
		}
		// 返回模板内容
		return $this->_templateContent;
	}

	/**
	 * 替换模板变量
	 *
	 * @param unknown $var        	
	 * @param unknown $val        	
	 */
	function assign($var, $val)
	{
		$this->_var[$var] = $val;
		// $pattern = '/' . $this->_config->leftContainer . '\s*\$' . $var . '\s*' . $this->_config->rightContainer . '/';
		// $this->_templateContent = preg_replace($pattern, $val, $this->_templateContent);
	}
}