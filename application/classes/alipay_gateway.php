<?php
namespace application\classes;
use system\core\http;
/**
 * 支付宝支付接口
 * @author jin12
 *
 */
class alipay_gateway
{
	/**
	 * 存储订单信息
	 * @var unknown
	 */
	private $_order;
	
	/**
	 * 订单商品信息
	 * @var unknown
	 */
	private $_orderdetail;
	
	/**
	 * 用于存储支付宝配置信息
	 * @var unknown
	 */
	
	private $_config;
	
	/**
	 * 构造函数  参数是一个订单信息
	 * @param unknown $order
	 */
	function __construct($config)
	{
		$this->_config = $config;
	}
	
	/**
	 * 用于数据提交
	 */
	function submit($order,$orderdetail)
	{
		//订单信息
		$this->_order = $order;
		$this->_orderdetail = $orderdetail;
		//支付宝lib目录
		define('ALIPAY_ROOT', ROOT.'/extends/alipay');
		
		$http = new http();
		//Return URL
		$return_url = 'http://'.$http->host().$http->path().'/gateway/alipay/returnpage.php';
		//After the payment transaction is done
		//Notification URL
		$notify_url = 'http://'.$http->host().$http->path().'/gateway/alipay/notifypage.php';
		//The URL for receiving notifications after the payment process.
		
		$goods_description = '';
		foreach ($this->_orderdetail as $goods)
		{
			$goods_description .= ($goods['productname'].'x'.$goods['num']);
		}
		
		//Goods name
		$subject = $goods_description;
		//required，The name of the goods.
		
		
		
		//Goods description
		$body = $goods_description;
		//A detailed description of the goods.
		
		//Outside trade ID
		$out_trade_no = $this->_order['orderno'];
		//required，A numbered transaction ID （Unique inside the partner system）
		
		//Currency
		$currency = 'GBP';
		//required，The settlement currency merchant named in contract.
		
		//Payment sum
		$rmb_fee = $this->_order['ordertotalamount'];
		//required，A floating number ranging 0.01～1000000.00
		
		$parameter = array(
			"service" => "create_forex_trade",
			"partner" => trim($this->_config['partner']),
			"return_url"	=> $return_url,
			"notify_url"	=> $notify_url,
			"subject"	=> $subject,
			"body"	=> $body,
			"out_trade_no"	=> $out_trade_no,
			"currency"	=> $currency,
			"rmb_fee"	=> $rmb_fee,
			"_input_charset"	=> trim(strtolower($this->_config['input_charset']))
		);
		
		$path = ALIPAY_ROOT.'/lib/alipay_submit.class.php';
		include $path;
		//建立请求
		$alipaySubmit = new \AlipaySubmit($this->_config);
		$html_text = $alipaySubmit->buildRequestForm($parameter,"get", "确认");
		return ($html_text);
	}
	
	/**
	 * 验证通知的合法性
	 */
	function verify_notify($partner,$notify_id)
	{
		$url = $this->_config->verify_nofity_url;
		$url = $url.'?partner='.$partner.'&notify_id='.$notify_id;
		$result = file_get_contents($url);
		return ($result==='true');
	}
	
	/**
	 * 退款
	 * @param $refund 退款申请记录
	 * @param $order 订单
	 * @param $orderdetail 商品记录
	 */
	function refund($refund,$order,$orderdetail)
	{
		
	}
}