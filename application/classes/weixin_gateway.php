<?php
namespace application\classes;
use system\core\http;
/**
 * 微信支付接口
 * @author jin12
 *
 */
class weixin_gateway
{
	/**
	 * 配置
	 * @var unknown
	 */
	private $_config;
	
	/**
	 * 订单信息
	 * @var unknown
	 */
	private $_order;
	
	/**
	 * 存储微信发送的get参数
	 * @var unknown
	 */
	private $_get;
	
	/**
	 * 存储微信发送的post参数
	 * @var unknown
	 */
	private $_post;
	
	/**
	 * 订单商品信息
	 * @var unknown
	 */
	private $_orderdetail;
	
	function __construct($config)
	{
		$this->_config = $config;
	}
	
	function setGetParameter($parameter)
	{
		$this->_get = $parameter;
	}
	
	function setPostParameter($parameter)
	{
		$this->_post = $parameter;
	}
	
	/**
	 * 根据url和get参数创建一个请求，extends是附加参数
	 * @param unknown $url
	 * @param unknown $parameter
	 * @param unknown $extends
	 */
	function createGetRequest($url,$parameter,$extends = '')
	{
		$url .= ('?'.http_build_query($parameter)).(empty($extends)?'':('#'.$extends));
	}
	
	function submit($order,$orderdetail)
	{
		$this->_order = $order;
		$this->_orderdetail = $orderdetail;
		$http = new http();
		if(empty($this->_get->code))
		{
			$url = 'https://open.weixin.qq.com/connect/oauth2/authorize';
			$parameter = array(
				'appid' => $this->_config['APPID'],
				'redirect_uri' => 'http://'.$http->host().$http->path().$_SERVER['QUERY_STRING'],
				'response_type' => 'code',
				'scope' => 'snsapi_base',
				'state' => ''
			);
			$extends = 'wechat_redirect';
			$url = $this->createGetRequest($url, $parameter,$extends);
			return $url;
		}
		else
		{
			var_dump($_GET);
		}
	}
	
	/**
	 * 创建预支付订单
	 */
	function createPrepay($order,$orderdetail)
	{
		$this->_order = $order;
		$this->_orderdetail = $orderdetail;
		/*
		 * 定义微信支付根目录
		 */
		define("WEIXIN_ROOT", ROOT.'/extends/weixin');
		
		include WEIXIN_ROOT.'/example/WxPay.JsApiPay.php';
		$tools = new \JsApiPay();
		$openId = $tools->GetOpenid();
		$http = new http();
		
		$goods_body = '';
		foreach ($this->_orderdetail as $goods)
		{
			$goods_body .= ($goods['productname'].'x'.$goods['num'].'|');
		}
		/*
		 * 统一下单
		 */
		include WEIXIN_ROOT.'/lib/WxPay.Data.php';
		include WEIXIN_ROOT.'/lib/WxPay.Api.php';
		$input = new \WxPayUnifiedOrder();
		$input->SetBody($goods_body);
		//$input->SetAttach($goods_body); 附加数据 原样返回
		$input->SetOut_trade_no($this->_order['orderno']);
		$input->SetTotal_fee($this->order['ordertotalamount'] * 100);
		$input->SetTime_start(date("YmdHis"));
		$input->SetTime_expire(date("YmdHis", time() + 600));
		//$input->SetGoods_tag("test");  使用微信的优惠券
		$input->SetNotify_url("http://'.$http->host().$http->path().'/gateway/weixin/notify.php");
		$input->SetTrade_type("JSAPI");
		$input->SetOpenid($openId);
		$order = \WxPayApi::unifiedOrder($input);
	}
}