<?php
namespace application\message;
class xml
{
	private $_xml;
	
	private $_cdata;
	
	private $_version;
	
	private $_charset;
	
	private $_contentType = 'xml/html';
	
	private $_cache;
	
	/**
	 * @param mixed $content 
	 * @param boolean $cdata 是否开启cdata解析
	 * @param boolean $cache 输出结果是否缓存
	 */
	function __construct($content,$cdata = false,$cache = false)
	{
		$this->_cdata = $cdata;
		if(is_string($content))
		{
			$this->loadString($content);
		}
		else if (is_array($content))
		{
			$this->loadArray($content);
		}
		
	}
	
	/**
	 * 设置输出结果是否缓存
	 * @param unknown $cache
	 */
	function cache($cache)
	{
		$this->_cache = $cache;
	}
	
	/**
	 * 返回是否缓存输出结果
	 * @return unknown
	 */
	function isCache()
	{
		return $this->_cache;
	}
	
	/**
	 * 获得mimetype
	 * @return string
	 */
	function getContentType()
	{
		return $this->_contentType;
	}
	
	function __toString()
	{
		return $this->_xml;
	}
	
	/**
	 * 从字符串载入
	 * @param unknown $string
	 */
	function loadString($string)
	{
		$this->_xml = $string;
	}
	
	/**
	 * 将数组转化为xml字符串
	 * @param unknown $array
	 */
	function loadArray($array)
	{
		$header = '<xml>';
		$footer = '</xml>';
		$this->_xml = $header.$this->parseArray($array).$footer;
	}
	
	/**
	 * 计算hash
	 * @return string
	 */
	function hash()
	{
		return md5($this->_xml);
	}
	
	/**
	 * 将数组转化为xml字符串  无头
	 * @param unknown $array
	 * @return string
	 */
	private function parseArray($array)
	{
		$content = '';
		foreach($array as $key=>$value)
		{
			if (is_string($value))
			{
				$value = $this->_cdata?('<![CDATA['.$value.']]>'):$value;
			}
			else if (is_array($value))
			{
				$value = $this->parseArray($value);
			}
			$content .= '<'.$key.'>'.$value.'</'.$key.'>';
		}
		return $content;
	}
}