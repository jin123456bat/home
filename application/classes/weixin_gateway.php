<?php
namespace application\classes;
use system\core\http;
use Exception;
use system\core\random;
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
		//sb微信 不能用?传递get参数 跨目录
		$url .= ('/'.http_build_query($parameter,NULL,'/',PHP_QUERY_RFC3986)).(empty($extends)?'':('#'.$extends));
		return $url;
	}
	
	/**
	 * xml转数组
	 * @param unknown $xml
	 * @return multitype:NULL 
	 */
	function xmlToArray($xml)
	{
		$array = array();
		$xml = (array)$xml;
		foreach($xml as $key => $value)
		{
			$array[$key] = $value->__toString();
		}
		return $array;
	}
	
	/**
	 * 微信支付入口
	 * @param unknown $order
	 * @param unknown $orderdetail
	 * @param array $prepay 微信预支付订单信息
	 */
	function submit($order,$orderdetail)
	{
		$this->_order = $order;
		$this->_orderdetail = $orderdetail;
		$http = new http();
		if(empty($this->_get->openid))
		{
			//没有openid则通过gateway获取openid
			$url = 'http://'.$http->host().'/gateway/weixin/getopenid.php';
			$parameter = array(
				'id' => $order['id'],
				'trade_type' => $this->_get->trade_type
			);
			$url = $this->createGetRequest($url, $parameter);
			$response = array('action'=>'redict','content'=>$url);
			return $response;
		}
		else
		{
			//生成商品描述
			$body = '';
			foreach ($this->_orderdetail as $good)
			{
				$body .= $good['productname'].'x'.$good['num'].'|';
			}
			//生成预支付订单
			$data = array(
				'device_info' => 'WEB',
				'attach' => '',
				'time_start' => date("YmdHis",$order['createtime']),
				'time_expire' => date("YmdHis",$order['createtime']+1800),
				'appid' => $this->_config->APPID,
				'fee_type' => 'CNY',
				'mch_id' => $this->_config->MCHID,
				'openid' => $this->_get->openid,
				'trade_type' => strtoupper($this->_get->trade_type),
				'attach' => '',//回传的时候回来的数据
				'body' => $body,//商品描述
				'nonce_str' => random::word(32),//随机字符串
				'notify_url' => urlencode('http://'.$_SERVER['HTTP_HOST'].'/index.php?c=order&a=notify&type=weixin'),//异步通知地址
				'out_trade_no' => $this->_order['orderno'],//订单号
				'spbill_create_ip' => empty($_SERVER['REMOTE_ADDR'])?'unkonwn':$_SERVER['REMOTE_ADDR'],//ip地址
				'total_fee' => $this->_order['ordertotalamount'] * 100,
			);
			if($data['trade_type'] == 'NATIVE')
			{
				//扫码支付时添加商品id
				$data['product_id'] = '';//商品id
			}
			$content = $this->createPrepay($data);
			$xmlResult = new \SimpleXMLElement($content);
			$xmlResult = $this->xmlToArray($xmlResult);
			if($xmlResult['return_code'] != 'SUCCESS')
			{
				return array('action'=>'error','content'=>$xmlResult['return_msg']);
			}
			else
			{
				if($this->verifyResult($xmlResult))
				{
					//有效的微信信息
					if($xmlResult['result_code'] != 'FAIL')
					{
						//订单生成成功
						return array('action'=>'return','content'=>$xmlResult);
					}
					else
					{
						//订单生成失败  比如已经生成过了
						return array('action'=>'error','content'=>$xmlResult['err_code'].'|'.$xmlResult['err_code_des']);
					}
				}
				else
				{
					return array('action'=>'error','content'=>'无效的微信消息');
				}
			}
		}
	}
	
	/**
	 * 查询订单 成功返回订单信息 失败返回false
	 * @param unknown $order
	 */
	function query($order = NULL)
	{
		$order = empty($order)?$this->_order:$order;
		$url = 'https://api.mch.weixin.qq.com/pay/closeorder';
		$data = array(
			'appid' => $this->_config->APPID,
			'mch_id' => $this->_config->MCHID,
			'transaction_id' => $order['paynumber'],
			'out_trade_no' => $order['orderno'],
			'nonce_str' => random::word(32)
		);
		$data['sign'] = $this->sign($data);
		$content = '<xml>';
		foreach ($data as $key => $value)
		{
			$content .= ('<'.$key.'>'.$value.'</'.$key.'>');
		}
		$content .= '</xml>';
		$context = stream_context_create(array(
			'http'=>array(
				'method'=>"POST",
				'header'=> "Content-type: application/x-www-form-urlencoded\r\n",
				'content'=>$content
			)
		));
		$response = file_get_contents($url,NULL,$context);
		$response = simplexml_load_string($response);
		$response = $this->xmlToArray($response);
		if($response['return_code'] == 'SUCCESS' && isset($response['err_code']) && $response['err_code'] == 'SUCCESS')
			return $response;
		return false;
	}
	
	/**
	 * 申请退款
	 * @param $refund 退款申请信息
	 * @param $order NULL 订单信息
	 */
	function refund($refund,$order = NULL)
	{
		$order = empty($order)?$this->_order:$order;
		$url = 'https://api.mch.weixin.qq.com/secapi/pay/refund';
		$data = array(
			'appid' => $this->_config->APPID,
			'mch_id' => $this->_config->MCHID,
			'nonce_str'=> random::word(32),
			'transaction_id' => $order['paynumber'], //支付单号
			'out_trade_no' => $order['orderno'],  //订单号
			'out_refund_no' => $order['refundid'],  //退款单号id
			'total_fee' => $order['ordertotalamount'] * 100,  //订单总金额
			'refund_fee' => $order['refund_fee']*100,//退款金额
			'refund_fee_type' => 'CNY',
			'op_user_id' => $this->_config->MCHID,  //同意退款人
		);
		$data['sign'] = $this->sign($data);
		$content = '<xml>';
		foreach ($data as $key => $value)
		{
			$content .= ('<'.$key.'>'.$value.'</'.$key.'>');
		}
		$content .= '</xml>';
		$pem = '';//证书地址
		$response = $this->postSsl($url, $content, $pem);
		$response = simplexml_load_string($response);
		$response = $this->xmlToArray($response);
		if($response['result_code'] == 'SUCCESS' && isset($response['err_code']) && $response['return_code'] == 'SUCCESS')
		{
			return $response;
		}
		return false;
	}
	
	/**
	 * 关闭订单  返回true成功 false失败
	 */
	function close($order = NULL)
	{
		$order = empty($order)?$this->_order:$order;
		$url = 'https://api.mch.weixin.qq.com/pay/closeorder';
		$data = array(
			'appid' => $this->_config->APPID,
			'mch_id' => $this->_config->MCHID,
			'out_trade_no' => $order['orderno'],
			'nonce_str' => random::word(32)
		);
		$data['sign'] = $this->sign($data);
		$content = '<xml>';
		foreach ($data as $key => $value)
		{
			$content .= ('<'.$key.'>'.$value.'</'.$key.'>');
		}
		$content .= '</xml>';
		$context = stream_context_create(array(
			'http'=>array(
				'method'=>"POST",
				'header'=> "Content-type: application/x-www-form-urlencoded\r\n",
				'content'=>$content
			)
		));
		$response = file_get_contents($url,NULL,$context);
		$response = simplexml_load_string($response);
		$response = $this->xmlToArray($response);
		if($response['return_code'] == 'SUCCESS' && isset($response['err_code']) && $response['err_code'] == 'SUCCESS')
			return $response;
		return false;
	}
	
	/**
	 * 输出微信浏览器中的支付验证器
	 */
	function output($prepay_id)
	{
		$data = array(
			'appId' => $this->_config['APPID'],
			'timeStamp' => $_SERVER['REQUEST_TIME'],
			'nonceStr' => random::word(32),
			'package'=> 'prepay_id='.$prepay_id,
			'signType' => 'MD5'
		);
		$data['paySign'] = $this->sign($data);
		/*$success_url = NULL;
		$cancel_url = NULL;
		$quit_url = NULL;
		$tpl = 'document.addEventListener("WeixinJSBridgeReady", function onBridgeReady() {WeixinJSBridge.invoke("getBrandWCPayRequest",{"appId" : '.$data['appid'].',"timeStamp"" : '.$data['timeStamp'].', "nonceStr" : '.$data['nonceStr'].', "package" : '.$data['package'].',"signType" : '.$data['signType'].', "paySign" : '.$data['paySign'].'},function(res){WeixinJSBridge.log(res.err_msg);if(res.err_msg == "get_brand_wcpay_request:ok"){alert("微信支付成功!"); window.location.href='.$success_url.'}else if(res.err_msg == "get_brand_wcpay_request:cancel"){  alert("用户取消支付!");window.location.href='.$cancel_url.'}else{alert("支付失败!"+res.err_msg);window.location.href='.$quit_url.'}});}, false);';
		return '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><title>微信安全支付</title></head><body><script type="text/javascript">'.$tpl.'</script></body></html>';
		*/
		return $data;
	}
	
	/**
	 * 验证微信返回的数据
	 */
	function verifyResult($data)
	{
		return $this->sign($data) == $data['sign'];
	}
	
	/**
	 * 带ssl的post提交
	 */
	function postSsl($url,$data,$pem)
	{
		$ch = curl_init($url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch,CURLOPT_SSLKEYTYPE,'PEM');
		curl_setopt($ch,CURLOPT_SSLKEY,$pem);
		curl_setopt($ch,CURLOPT_HEADER,0);
		curl_setopt($ch,CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
		curl_setopt($ch,CURLOPT_POSTFIELDS, $data);
		return curl_exec($ch);
	}
	
	/**
	 * 创建预支付订单
	 */
	function createPrepay($data)
	{
		$data['sign'] = $this->sign($data);
		//构造传递数据
		$content = '<xml>';
		foreach ($data as $key => $value)
		{
			$content .= ('<'.$key.'>'.$value.'</'.$key.'>');
		}
		$content .= '</xml>';
		//接口地址
		$url = 'https://api.mch.weixin.qq.com/pay/unifiedorder';
		$context = stream_context_create(array(
			'http'=>array(
				'method'=>"POST",
				'header'=> "Content-type: application/x-www-form-urlencoded\r\n",
				'content'=>$content
			)
		));
		return file_get_contents($url,NULL,$context);
	}
	
	/**
	 * 数据签名
	 * @param unknown $data
	 * @return string
	 */
	function sign($data)
	{
		$data = $this->filterParameter($data);
		ksort($data);
		reset($data);
		$str = $this->toString($data).'&key='.$this->_config->KEY;
		$str = strtoupper(md5($str));
		return $str;
	}
	
	/**
	 * 过滤不需要加密的参数
	 * @param unknown $data
	 */
	function filterParameter($data)
	{
		$parameter = array();
		foreach ($data as $key => $value)
		{
			if($value == '' || $key == 'sign')
				continue;
			$parameter[$key] = $value;
		}
		return $parameter;
	}
	
	/**
	 * 将参数列表转化为url字符串
	 * @param array $data
	 */
	function toString($data)
	{
		$str = '';
		foreach($data as $key => $value)
		{
			$str .= ($key.'='.$value.'&');
		}
		return rtrim($str,'&');
	}
}

/**
 * 微信接口异常
 * @author jin12
 *
 */
class WeixinException extends \Exception
{
	function __construct($message, $code, $previous)
	{
		parent::__construct($message, $code, $previous);
	}
}