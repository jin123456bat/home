<?php
namespace application\classes;

use \SoapClient;
use \SoapHeader;
use \SoapFault;

class cbti
{
	private $_system;
	
	function __construct($system)
	{
		$this->_system = $system;
	}
	
	/**
	 * 下单
	 */
	function order($order,$orderdetail)
	{
		
		$goods = array();
		$good = array();
		foreach ($orderdetail as $product)
		{
			$good['code'] = $product['sku'];
			$good['name'] = $product['productname'];
			$good['unit'] = '个';
			$good['model'] = $product['sku'];
			$good['brand'] = $product['brand'];
			$good['unitPrice'] = $product['unitprice'];
			$good['sourceArea'] = $product['origin'];
			$good['count'] = $product['num'];
			$good['currencyType'] = 'CNY';
		}
		$goods['@attributes'] = $good;
		
		$xmlArray = array(
			'@attributes' => array(
				'service' => 'OrderService',
				'lang' => 'zh_cn',
				'printType'=>$this->_system->get('printtype','shippment')
			),
			'Head' => "sdafssadfsa",
			'Body' => array(
				"Order" => array(
					'@attributes' => array(
						'orderSourceSystem'=>'3',
						'businessLogo'=>$this->_system->get('sendername','system'),
						'customerOrderNo'=>$order['orderno'],
						'expressType'=>'全球顺',
						'payType'=>'寄方付',//$this->_system->get('paytype','shippment'),
						//'pkgLength'=>'12',
						//'pkgWidth'=>'32',
						//'pkgHeigth'=>'41',
						//'pkgTotalCount'=>'2',
						//'pkgVolume'=>'213',
						//'totalWeight'=>'2.123',
						//'recPkgTime'=>'2015-01-18 20:14:33',
						'recCompany'=>$order['consignee'],
						'recConcact'=>$order['consignee'],
						'recTelphone'=>$order['consigneetel'],
						'recMobile'=>$order['consigneetel'],
						'recCountry'=>'中国',
						'recProvinoce'=>$order['consigneeprovince'],
						'recCityCode'=>'CN',
						'recCity'=>$order['consigneecity'],
						'recCounty'=>'CN',
						'recZipcode'=>$order['zipcode'],
						'recAddress'=>$order['consigneeaddress'],
						//'turnover'=>'150',
						//'closingDate'=>'2013-02-28 22:00:22',
						'freight'=>$order['feeamount'],
						'freightCurrency'=>'CNY',
						//'buyersNickname'=>'ZZZ',
						//'ordersName'=>'abcDEF',
						//'ordersDocumentType'=>'身份证',
						//'orderDocumentNumber'=>'11010119680101247X'
					),
					'Goods' =>$goods
				))
		);
		print_r($xmlArray);
		
		$xml = array2xml($xmlArray,"Request"); // 生成XML
		
		//echo $xml;
		
		$arr = array(
			"verifyCode"=>'3DE97718-A922-4B74-97AF-9BD2561DF845', // verifyCode
			'Servicefun' => 'issuedOrder', // webserver 方法
			'server' => 'http://cbtitest.sfb2c.com:8003/CBTA/ws/orderService?wsdl', // webserver 服务
			'authtoken' => 'CD6A98CF20C3C79D2A7F5C789B5F25C1', // authtoken
			'headerNamespace' => 'http://cbtitest.sfb2c.com:8003/CBTA/' // SoapHeader命名空间
		);
		
		$Api = new orderService();
		$response = $Api->getOrderData($xml,$arr);
		return $response;
	}
	
	
	/**
	 * 查询
	 */
	function query($orderno)
	{
		$array = Array(
			'server' => 'http://cbtitest.sfb2c.com:8005/CBTT/ws/routeQueryService?wsdl', // webserver 服务
			'authToken' => '+SVLulpUoT993cvqVeO2II0HhZp6NfgkHf8+LWjbhBKo5oC4dkGo1Q==', // authToken
			'headerNamespace' => 'http://cbtitest.sfb2c.com8005/CBTT', // SoapHeader命名空间（与webserver域同步）
			'customerCode' => 'sf5713898735', //客户代码
			'mailorderNo' => $orderno, //运单号或电商原始订单号
			'secretKey' => '7%&y*p#e', //秘钥向量
			'mix' => '(-&t@p#p' // 混淆向量
		);
		
		$Api = new routeApi(); // 实例化
		return $Api->getRoute($array);
	}
	
}

class CryptDes {
	var $key;
	var $iv;
	function CryptDes($key, $iv){
		$this->key = $key;
		$this->iv = $iv;
	}
		
	function encrypt($input){
		$size = mcrypt_get_block_size(MCRYPT_DES,MCRYPT_MODE_CBC); //3DES加密将MCRYPT_DES改为MCRYPT_3DES
		$input = $this->pkcs5_pad($input, $size); //如果采用PaddingPKCS7，请更换成PaddingPKCS7方法。
		$key = str_pad($this->key,8,'0'); //3DES加密将8改为24
		$td = mcrypt_module_open(MCRYPT_DES, '', MCRYPT_MODE_CBC, '');
		if( $this->iv == '' )
		{
			$iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		}
		else
		{
			$iv = $this->iv;
		}
		@mcrypt_generic_init($td, $key, $iv);
		$data = mcrypt_generic($td, $input);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$data = base64_encode(bin2hex($data));//如需转换二进制可改成  bin2hex 转换
		return $data;
	}

	function decrypt($encrypted){
		$encrypted = base64_decode($encrypted); //如需转换二进制可改成  bin2hex 转换

		$key = str_pad($this->key,8,'0'); //3DES加密将8改为24
		$td = mcrypt_module_open(MCRYPT_DES,'',MCRYPT_MODE_CBC,'');//3DES加密将MCRYPT_DES改为MCRYPT_3DES
		if( $this->iv == '' )
		{
			$iv = @mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
		}
		else
		{
			$iv = $this->iv;
		}
		$ks = mcrypt_enc_get_key_size($td);
		@mcrypt_generic_init($td, $key, $iv);
		$decrypted = mdecrypt_generic($td, $encrypted);
		mcrypt_generic_deinit($td);
		mcrypt_module_close($td);
		$y=$this->pkcs5_unpad($decrypted);
		return $y;
	}

	function hextobin($hexstr) {
		$n = strlen($hexstr);
		$sbin="";
		$i=0;
		while($i<$n)
		{
			$a =substr($hexstr,$i,2);
			$c = pack("H*",$a);
			if ($i==0){$sbin=$c;}
			else {$sbin.=$c;}
			$i+=2;
		}
		return $sbin;
	}

	function hex2bin( $str ) {
		$sbin = "";
		$len = strlen( $str );
		for ( $i = 0; $i < $len; $i += 2 ) {
			$sbin .= pack( "H*", substr( str_replace(' ', '', $str), $i, 2 ) );
		}

		return $sbin;
	}

	function pkcs5_pad ($text, $blocksize) {
		$pad = $blocksize - (strlen($text) % $blocksize);
		return $text . str_repeat(chr($pad), $pad);
	}

	function pkcs5_unpad($text){
		$pad = ord($text{strlen($text)-1});
		if ($pad > strlen($text)) {
			return false;
		}
		if (strspn($text, chr($pad), strlen($text) - $pad) != $pad){
			return false;
		}
		return substr($text, 0, -1 * $pad);
	}

	function PaddingPKCS7($data) {
		$block_size = mcrypt_get_block_size(MCRYPT_DES, MCRYPT_MODE_CBC);//3DES加密将MCRYPT_DES改为MCRYPT_3DES
		$padding_char = $block_size - (strlen($data) % $block_size);
		$data .= str_repeat(chr($padding_char),$padding_char);
		return $data;
	}
}


class orderService {

	public function base64($str){ // base64转码

		return base64_encode($str);

	}

	public function _md5($str){ // md5加密并转大写

		return strtoupper(md5($str));

	}

	/**
	 * 获取订单数据
	 * @param $xml XML字符串
	 * @param $checkword 密钥
	 */

	public function getOrderData($xml,$arr){

		$md5Data = $this->_md5($xml.$arr['verifyCode']);

		$verifyCode = $this->base64($md5Data);

		$this->callWebServer($xml,$arr,$verifyCode); // 调用webserver
	}

	/**
	 * 调用webserver
	 * @param $xml XML字符串
	 * @param $verifyCode 加密后的字符串
	 * 返回xml格式
	 */

	public function callWebServer($xml,$arr,$verifyCode){

		$client = new SoapClient($arr['server'],array('trace' => true, 'exceptions' => true ));

		$authToken = $arr['authtoken'];

		$headers = new SoapHeader($arr['headerNamespace'],"authtoken",$authToken, false, SOAP_ACTOR_NEXT);

		$client->__setSoapHeaders(array($headers));

		$result = $client->__soapCall($arr['Servicefun'], array("data" => $xml, "verifyCode"=> $verifyCode));

		//var_dump($client->__getLastRequest());

		echo $result; //返回xml格式
	}
}


class routeApi {

	/**
	 * 调用webserver
	 * 返回xml格式
	 */
	public function getRoute($arr){

		$client = new SoapClient($arr['server']);

		$authToken = (object) array("authToken"=>$arr['authToken']);

		$headers = new SoapHeader($arr['headerNamespace'],"AuthHeader",$authToken);

		$client->__setSoapHeaders($headers);
		try {
				
			$res = $client->__soapCall( 'getRouteInfo', array('customerCode' => $arr['customerCode'], 'mailorderNo' => $arr['mailorderNo']));
				
			$CryptDes  = new CryptDes($arr['secretKey'],$arr['mix']); //（秘钥向量，混淆向量）

			$res = $CryptDes->decrypt(str_replace(array("\r","\n"," "), "", $res));
				
			echo $res;
				
		} catch (SoapFault $e) {
				
			echo "Error: {$e}";
				
		}
	}
}
