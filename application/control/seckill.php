<?php
namespace application\control;
use system\core\control;

/**
 * 秒杀活动控制器
 * @author jin12
 *
 */
class seckillControl extends control
{
	function index()
	{
		
	}
	
	/**
	 * 获得所有秒杀商品信息
	 */
	function product()
	{
		$seckillModel = $this->model('seckill');
		$result = $seckillModel->product();
		return json_encode(array('code'=>1,'result'=>'ok',body=>$result));
	}
}