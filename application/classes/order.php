<?php
namespace application\classes;

use system\core\random;
/**
 * 订单的helper类
 * @author jin12
 *
 */
class order
{
	/**
	 * 随机生成一个流水号
	 */
	function swift($uid)
	{
		return date('YmdHis').$uid.random::number(4);
	}
	
	/**
	 * 订单完成支付的handler
	 */
	function complete()
	{
		
	}
}