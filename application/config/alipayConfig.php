<?php
namespace application\config;
use system\core\inter\config;
/**
 * 支付宝配置
 * @author jin12
 *
 */
class alipayConfig extends config
{
	function __construct()
	{
		$this->verify_nofity_url = 'http://notify.alipay.com/trade/notify_query.do';
		
		//合作身份者id，以2088开头的16位纯数字
		$this->partner = '2088111956092332';
		
		//安全检验码，以数字和字母组成的32位字符
		$this->key = '136nflj7uu24i7v6cheubmpy0uav4tdx';
		
		
		//↑↑↑↑↑↑↑↑↑↑请在这里配置您的基本信息↑↑↑↑↑↑↑↑↑↑↑↑↑↑↑
		
		
		//签名方式 不需修改
		$this->sign_type = strtoupper('MD5');
		
		//字符编码格式 目前支持 gbk 或 utf-8
		$this->input_charset = strtolower('utf-8');
		
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$this->cacert = ROOT.'/extends/alipay/cacert.pem';
		
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$this->transport = 'https';
	}
}