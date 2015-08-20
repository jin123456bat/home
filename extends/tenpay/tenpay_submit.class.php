<?php
namespace extend\tenpay;

class tenpay_submit
{
	/**
	 * 配置参数
	 * @var unknown
	 */
	private $_config;
	
	function __construct($config)
	{
		$this->_config = $config;
	}
	
	/**
	 * 去除参数中不需要的东西
	 */
	function filterParameter($parameter)
	{
		$return = array();
		foreach ($parameter as $key => $value)
		{
			if($key == 'sign' || $value == '')
				continue;
			$return[$key] = $value;
		}
		return $return;
	}
	
	/**
	 * 对参数进行签名
	 */
	function signParameter($parameter)
	{
		$parameter = $this->filterParameter($parameter);
		ksort($parameter);
		reset($parameter);
		$parameter['key'] = $this->_config['Key'];
		//$paraStr = http_build_query($parameter);
		$paraStr = '';
		foreach ($parameter as $key => $value)
		{
			$paraStr .= ($key.'='.$value.'&');
		}
		$paraStr = rtrim($paraStr,'&');
		return strtoupper(md5($paraStr));
	}
	
	function buildRequestForm($parameter)
	{
		$sign = $this->signParameter($parameter);
		$parameter['sign'] = $sign;
		
		$content = '<form id="tenpay_form_submit" action="'.$this->_config['url'].'" method="'.$this->_config['method'].'">';
		foreach($parameter as $key => $value)
		{
			$content .= ('<input type="hidden" name="'.$key.'" value="'.$value.'">');
		}
		$content .= '<input type="submit" value="submit">';
		$content .= "<script>document.forms['tenpay_form_submit'].submit();</script>";
		return $content;
		/*$ch = curl_init($this->_config['url']);
		curl_setopt ( $ch, CURLOPT_POST, 1 );
		curl_setopt ( $ch, CURLOPT_HEADER, 0 );
		curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_SSLVERSION, 4);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
		curl_setopt ( $ch, CURLOPT_POSTFIELDS, $parameter );
		$return = curl_exec ( $ch );
		if($return === false)
		{
			var_dump(curl_errno($ch));
			var_dump(curl_error($ch));
		}
		else
		{
			var_dump($return);
		}*/
	}
}