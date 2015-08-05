<?php
namespace application\control;

use system\core\control;
use system\core\filter;
use application\classes\login;
class cartControl extends control
{
	/**
	 * 将一件商品添加到购物车
	 * @param post pid 商品id
	 * @param post num 商品数量 不提交或者为空则为1
	 * @param post content 能够声明唯一商品的属性集合 字符串或数组
	 * @param session id 用户id
	 */
	function add()
	{
		if(!login::user())
			return json_encode(array('code'=>3,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		$num = filter::int($this->post->num);
		$content = filter::int($this->post->content);
		$uid = $this->session->id;
		$num = empty($num)?1:$num;
		if(empty($pid))
		{
			$productModel = $this->model('product');
			$cartModel = $this->model('cart');
			$prototypeModel = $this->model('prototype');
			$radioPrototype = $prototypeModel->getByPid($pid,'radio');
			if($cartModel->add($uid,$pid,$content,$num))
			{
				if(empty($radioPrototype))
				{
					//不存在可选属性
					$productModel->increaseStock($pid,-$num);
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				else
				{
					foreach ($radioPrototype as $prototype)
					{
						
					}
				}
			}
			return json_encode(array('code'=>2,'result'=>'添加到购物车失败,没有库存了?'));
		}
		return json_encode(array('code'=>0,'result'=>'请指定商品'));
	}
	
	/**
	 * 从购物车中移除商品
	 * @param post pid 商品id
	 * @param post cid 能够声明唯一商品的属性集合
	 * @param post num 移除数量 不提交或者为空则为1
	 * @param session id 用户id
	 */
	function remove()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		$cid = filter::int($this->post->cid);
		$num = filter::int($this->post->num);
		$uid = $this->session->id;
		$num = empty($num)?1:$num;
		$cartModel = $this->model('cart');
		if($cartModel->remove($uid,$pid,$cid,$num))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'fail'));
	}
	
	/**
	 * 计算购物车中的商品原价 折扣价 和折扣后的价格
	 * @param session id 用户id
	 */
	function calculation()
	{
		$this->response->addHeader('CacheControl','nocache');
		
	}
	
	/**
	 * 将购物车中的商品转化为订单
	 */
	function order()
	{
		
	}
}