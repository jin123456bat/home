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
	public $uid = 'jin123456bat';
	/*
	 * md5密钥
	 */
	public $key = '0acc44172cc9023b5062';
	/*
	 * 签名
	 */
	public $sign = '杭州棱水科技';
}