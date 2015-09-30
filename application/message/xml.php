<?php
namespace application\message;
class xml
{
	private $_xml;
	
	private $_contentType = 'xml/html';
	
	function __construct($content)
	{
		if(is_string($content))
		{
			$this->loadString($content);
		}
	}
	
	function getContentType()
	{
		return $this->_contentType;
	}
	
	function __toString()
	{
		return $this->_xml;
	}
	
	function loadString($string)
	{
		$this->_xml = $string;
	}
}