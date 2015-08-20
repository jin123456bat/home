<?php
namespace application\classes;
use extend;
use extend\tenpay\tenpay_submit;
class tenpay_gateway
{
	/**
	 * 定单信息
	 * @var unknown
	 */
	private $_order;
	
	/**
	 * 订单商品信息
	 * @var unknown
	 */
	private $_orderdetail;
	
	/**
	 * 财付通配置信息
	 * @var unknown
	 */
	private $_config;
	
	function __construct($config)
	{
		$this->_config = $config;
	}
	
	/**
	 * 订单提交
	 * @param unknown $order
	 * @param unknown $orderdetail
	 */
	function submit($order,$orderdetail)
	{
		$this->_order = $order;
		$this->_orderdetail = $orderdetail;
		
		$data = array(
			'sign_type' => strtoupper($this->_config['sign_type']),
			'service_version' => $this->_config['service_version'],
			'input_charset' => strtoupper(trim($this->_config['input_charset'])),
			'sign_key_index' => $this->_config['sign_key_index'],
			'partner' => $this->_config['partner'],
			'out_trade_no' => $this->_order['orderno'],
			'fee_type' => 'CNY',
			'order_fee' => $this->_order['ordertotalamount'] * 100,
			'transport_fee' => $this->_order['feeamount'] * 100,
			'product_fee' => $this->_order['ordergoodsamount'] * 100,
			'duty' => $this->_order['ordertaxamount'] * 100,
			'customs' => $this->_config['customs'],
			'mch_customs_no' => $this->_config['mch_customs_no'],
			'cert_type' => $this->_config['cert_type'],
			'cert_id' => $this->_config['cert_id'],
			'name' => $this->_config['name'],
			'action_type' => $this->_order['action_type'],
		);
		
		include_once ROOT.'/extends/tenpay/tenpay_submit.class.php';
		$tenpay = new tenpay_submit($this->_config);
		return $tenpay->buildRequestForm($data);
	}
}