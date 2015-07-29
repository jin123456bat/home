<?php
namespace system\core;

/**
 * response管理
 *
 * @author 程晨
 *        
 */
class response
{

	/**
	 *
	 * @var int
	 */
	private $_code;

	/**
	 *
	 * @var object(header)
	 */
	private $_header;

	/**
	 *
	 * @var string
	 */
	private $_body;

	public function __construct()
	{
		$this->_code = http_response_code();
		$this->_header = new header();
	}

	/**
	 * 设置状态码
	 *
	 * @param unknown $code        	
	 */
	public function setCode($code)
	{
		if (is_int($code)) {
			$this->_code = $code;
		}
	}

	/**
	 * 获取状态码
	 *
	 * @return int
	 */
	public function getCode()
	{
		return $this->_code;
	}

	/**
	 * 设置响应body
	 *
	 * @param unknown $body        	
	 */
	public function setBody($body)
	{
		$this->_body = $body;
	}

	/**
	 * 添加相应body
	 *
	 * @param unknown $body        	
	 */
	public function appendBody($body)
	{
		$this->_body .= $body;
	}

	/**
	 * 添加header
	 *
	 * @param unknown $string        	
	 */
	public function addHeader($key,$value = NULL)
	{
		$this->_header->add($key,$value);
	}

	/**
	 * 检查header是否存在
	 *
	 * @param unknown $string        	
	 */
	public function checkHeader($string)
	{
		$this->_header->check($string);
	}

	/**
	 * 删除一个header
	 *
	 * @param unknown $string        	
	 */
	public function deleteHeader($string)
	{
		$this->_header->delete($string);
	}

	/**
	 * 将这个response发送到client
	 */
	public function send()
	{
		http_response_code($this->_code);
		$this->_header->sendAll();
		echo $this->_body;
		exit();
	}
}