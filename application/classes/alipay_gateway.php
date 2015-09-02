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
	 * 系统的一些配置
	 * @var unknown
	 */
	private $_system;
	
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
	 * 接口对接方式   web  wap
	 * @var unknown
	 */
	private $_trade_type;
	
	/**
	 * 构造函数
	 * @param unknown $config  支付宝的配置文件
	 * @param unknown $system  系统的配置
	 */
	function __construct($config,$system,$trade_type)
	{
		$this->_config = $config;
		$this->_system = $system;
		$this->_trade_type = $trade_type;
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
		/**
		 * 同步通知地址
		 */
		$return_url = 'http://'.$http->host().$http->path().'/gateway/alipay/retu.php';
		/**
		 * 异步通知地址
		 */
		$notify_url = 'http://'.$http->host().$http->path().'/gateway/alipay/notify.php';
		
		
		/**
		 * 商品描述
		 */
		$body = '';
		foreach ($orderdetail as $product)
		{
			$body .= $product['productname'].'x'.$product['num'];
		}
		
		/**
		 * 商品名称
		 */
		$subject = $body;
		
		//分账金额50%  添加分账账户
		$separatorAmount = $order['ordertotalamount'] * $this->_system->get('splitrate','alipay');
		$this->_config->createSeparator($this->_system->get('splitpartner','alipay'),$separatorAmount,$this->_system->get('splitcurrency','alipay'));
		
		$data = array(
			'body' => $body,
			'subject' => $subject,
			'sign_type' => $this->_config->sign_type,
			'out_trade_no'=>$order['orderno'],
			'currency' => $this->_system->get('currency','alipay'),//海外币种
			'split_fund_info' => json_encode($this->_config->separator),
			'rmb_fee' => $order['ordertotalamount'],
			'partner' => $this->_system->get('partner','alipay'),
			'supplier' => $this->_system->get('companyname','system'),
			'notify_url' => $notify_url,
			'return_url' => $return_url,
			'_input_charset'=>$this->_config['input_charset'],
			'timeout_rule'=>(new time())->format($this->_system->get('timeout','payment'), true),
		);
	
		switch ($this->_trade_type)
		{
			case 'web':
				$data['product_code'] = 'NEW_OVERSEAS_SELLER';
				$data['service'] = 'create_forex_trade';
				break;
			case 'wap':
				$data['product_code'] = 'NEW_WAP_OVERSEAS_SELLER';
				$data['service'] = 'create_forex_trade_wap';
				break;
			default:return array('code'=>'error','content'=>'不支持的支付方式');
		}
		
		$content = $this->trade($data);
		$data = array(
			'url' => $this->_config['gateway_url'],
			'method' => 'get',
			'parameter' => $content
		);
		return array('code'=>'success','content'=>$data);
	}
	
	/**
	 * 验证通知是否来源于支付宝
	 */
	function verify_notify($notify_id)
	{
		$url = $this->_config->verify_nofity_url;
		$url = $url.'?partner='.$this->_system->get('partner','alipay').'&notify_id='.$notify_id;
		$result = file_get_contents($url);
		return preg_match('/true$/i', $result);
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
	
	/**
	 * 计算支付参数
	 */
	function trade($parameter)
	{
		$parameter = $this->filterParameter($parameter);
		ksort($parameter);
		reset($parameter);
		$parameter['sign'] = $this->sign($parameter);
		return $parameter;
	}
	
	/**
	 * 参数加密
	 * @param unknown $parameter
	 * @return string
	 */
	function sign($parameter,$sign_type = '')
	{
		$parameter = $this->toString($parameter).$this->_system->get('key','alipay');
		$sign_type = trim(strtoupper(empty($sign_type)?$this->_config['sign_type']:$sign_type));
		switch ($sign_type)
		{
			case 'MD5':$parameter = md5($parameter);
				break;
			case 'RSA':
				$private_key = str_replace(' ', '', $this->_system->get('rsaprivatekey'));
				return $this->encryptRSA($parameter, $private_key);
				break;
			case 'DSA':break;
			default:break;
		}
		return $parameter;
	}
	
	/**
	 * RSA私钥加密
	 * @param unknown $string
	 * @param unknown $private_key
	 * @return unknown
	 */
	function encryptRSA($string,$private_key)
	{
		$pk = openssl_pkey_get_private($private_key);
		openssl_private_encrypt($string, $crypted, $pk);
		return $crypted;
	}
	
	/**
	 * RSA私钥解密
	 * @param unknown $string
	 * @param unknown $public_key
	 */
	function decryptRSA($string,$private_key)
	{
		$pk = openssl_pkey_get_private($private_key);
		openssl_private_decrypt($string, $decrypted, $pk);
		return $decrypted;
	}
	
	/**
	 * 将数组参数转化为字符串
	 */
	function toString($parameter)
	{
		$return = '';
		foreach($parameter as $key => $value)
		{
			$return .= ($key.'='.$value.'&');
		}
		return rtrim($return,'&');
	}
	
	/**
	 * 过滤掉不需要加密的参数
	 * @param unknown $parameter
	 */
	function filterParameter($parameter)
	{
		$return = array();
		foreach($parameter as $key => $value)
		{
			if($key == 'sign' || $value == '' || $key == 'sign_type')
				continue;
			$return[$key] = $value;
		}
		return $return;
	}
}