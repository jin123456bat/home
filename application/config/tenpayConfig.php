<?php
namespace application\config;
use system\core\inter\config;
class tenpayConfig extends config
{
	function __construct()
	{
		/**
		 * 商户号 10位数字
		 */
		$this->partner = '1251529901';
		
		/**
		 * 密钥
		 */
		$this->Key = '4dd9d79acafd65972898623410b02a5b';
		
		/**
		 * 密钥序号
		 */
		$this->sign_key_index = '1';
		
		/**
		 * 请求地址
		 */
		$this->url = 'https://mch.tenpay.com/cgi-bin/mch_custom_declare.cgi';
		
		/**
		 * 接口版本
		 */
		$this->service_version = '1.0';
		
		/**
		 * 字符集
		 */
		$this->input_charset = 'UTF-8';
		
		/**
		 * 签名方式 MD5 | RSA
		 */
		$this->sign_type = 'md5';
		
		/**
		 * 查询方式  get|post
		 */
		$this->method = 'get';
		
		/**
		 * 0 无需上报海关
			1广州
			2杭州
			3宁波
			4深圳
			5郑州
			6重庆
			7西安
			8上海
			9 河南
		 */
		$this->customs = '0';
		
		/**
		 * 商户在海关的备案号
		 */
		$this->mch_customs_no = '';
		
		/**
		 * 证件类型
		 */
		$this->cert_type = '1';
		
		/**
		 * 证件号码
		 */
		$this->cert_id = '150203199010190332';
		
		/**
		 * 证件姓名
		 */
		$this->name = '金程晨';
	}
}