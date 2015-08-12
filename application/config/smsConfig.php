<?php
namespace application\config;

class smsConfig
{
	/*
	 * 发送短信接口url
	 */
	public $url = "http://utf8.sms.webchinese.cn/";
	/*
	 * 获取短信数量url
	 */
	public $getUrl = 'http://sms.webchinese.cn/web_api/SMS/';
	/*
	 * 用户名
	 */
	public $uid = 'womanjia';
	/*
	 * md5密钥
	 */
	public $key = '57fdd24d6d8244d3ccda';
	/*
	 * 签名
	 */
	public $sign = '我们家';
}