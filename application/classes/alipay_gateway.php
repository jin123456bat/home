<?php
namespace application\classes;
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
	function submit($order)
	{
		//订单信息
		$this->_order = $order;
		//支付宝lib目录
		define('ALIPAY_ROOT', ROOT.'/extends/alipay/');
		
		//Return URL
		$return_url = "http://商户网关地址/create_forex_trade-PHP-UTF-8/return_url.php";
		//After the payment transaction is done
		//Notification URL
		$notify_url = "http://商户网关地址/create_forex_trade-PHP-UTF-8/notify_url.php";
		//The URL for receiving notifications after the payment process.
		
		//Goods name
		$subject = $_POST['WIDsubject'];
		//required，The name of the goods.
		
		//Goods description
		$body = $_POST['WIDbody'];
		//A detailed description of the goods.
		
		//Outside trade ID
		$out_trade_no = $_POST['WIDout_trade_no'];
		//required，A numbered transaction ID （Unique inside the partner system）
		
		//Currency
		$currency = $_POST['WIDcurrency'];
		//required，The settlement currency merchant named in contract.
		
		//Payment sum
		$total_fee = $_POST['WIDtotal_fee'];
		//required，A floating number ranging 0.01～1000000.00
	}
}