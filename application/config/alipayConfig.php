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
	/**
	 * 
	 */
	function __construct()
	{
		/**
		 * 支付宝网关地址
		 */
		$this->gateway_url = 'https://mapi.alipay.com/gateway.do';
		
		/**
		 * 支付宝消息验证接口
		 */
		$this->verify_nofity_url = 'http://notify.alipay.com/trade/notify_query.do';
		
		//签名方式 不需修改
		$this->sign_type = strtoupper('MD5');
		
		//字符编码格式 目前支持 gbk 或 utf-8
		$this->input_charset = strtolower('utf-8');
		
		//ca证书路径地址，用于curl中ssl校验
		//请保证cacert.pem文件在当前文件夹目录中
		$this->cacert = ROOT.'/extends/alipay/cacert.pem';
		
		//访问模式,根据自己的服务器是否支持ssl访问，若支持请选择https；若不支持请选择http
		$this->transport = 'https';
		
		/**
		 * 分账账户
		 */
		$this->separator = array();
	}
	
	/**
	 * 添加分账账户
	 * @param unknown $transIn
	 * @param unknown $amount
	 * @param unknown $currency
	 * @param string $desc
	 */
	function createSeparator($transIn,$amount,$currency,$desc = '')
	{
		$obj = new \stdClass();
		$obj->transIn = $transIn;
		$obj->amount = $amount;
		$obj->currency = $currency;
		$obj->desc = $desc;
		$this->separator[] = $obj;
	}
}