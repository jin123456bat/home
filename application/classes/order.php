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
	function swift($uid,$length = 3)
	{
		return date('mdHis').$uid.random::number($length);
	}
}