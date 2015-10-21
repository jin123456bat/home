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
		return date('mdHis').$uid.random::number(3);
	}
	
	/**
	 * 订单完成支付的handler
	 */
	function complete()
	{
		
	}
}