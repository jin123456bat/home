<?php
namespace application\control;
use system\core\control;
use application\classes\category;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
use system\core\random;
use system\core\filter;
/**
 * 优惠券打折码控制器
 * @author jin12
 *
 */
class couponControl extends control
{
	
	/**
	 * 获取可以使用的优惠券
	 */
	function getavaliable()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$couponModel = $this->model('coupon');
		$cartModel = $this->model('cart');
		//获取用户所有商品
		$cart = $cartModel->getByUid($this->session->id);
		$coupondetailModel = $this->model('coupondetail');
		$prodcut_category_array = array();
		foreach($cart as $goods)
		{
			if(isset($goods['activity']) && empty($goods['activity']))
			{
				$product_category_array[] = $goods['category'];
			}
		}
		$result = $coupondetailModel->where('categoryid in (?)',array(implode(',', $product_category_array)))->select('couponid');
		$coupon_id_array = array();
		foreach($result as $coupon)
		{
			$coupon_id_array[] = $coupon['couponid'];
		}
		$body = $couponModel->where('id in (?) and display=? and (starttime>? or starttime=0) and (endtime<? or endtime=0) and times>?',array(implode(',', $coupon_id_array),1,$_SERVER['REQUEST_TIME'],$_SERVER['REQUEST_TIME'],0));
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$body));
	}
	
	/**
	 * 优惠券打折码管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'coupon',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/coupon_admin.html');
			$categoryModel = $this->model('category');
			$category = $categoryModel->select();
			$categoryHelper = new category();
			$category = $categoryHelper->format(0,$category);
			$this->view->assign('category',$category);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 随机生成一个优惠代码
	 */
	function randomcode()
	{
		$this->response->addHeader('Content-Type','application/json');
		$couponModel = $this->model('coupon');
		$code = strtoupper(date('ymdHis',$_SERVER['REQUEST_TIME']).random::word(4,'',random::RANDOM_WORD_NUMBER));
		while ($couponModel->exist($code))
		{
			$code = strtoupper(date('ymdHis',$_SERVER['REQUEST_TIME']).random::word(4,'',random::RANDOM_WORD_NUMBER));
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$code));
	}
	
	/**
	 * 创建优惠码
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'coupon',roleModel::POWER_INSERT))
		{
			$couponno = $this->post->couponno;
			$starttime = $this->post->starttime;
			$endtime = $this->post->endtime;
			$total = filter::int($this->post->total);
			$category = json_decode(htmlspecialchars_decode($this->post->category));
			$type = $this->post->type;
			$display = filter::int($this->post->display);
			$max = filter::number($this->post->max);
			$value = filter::number($this->post->value);
			$couponModel = $this->model('coupon');
			$result = $couponModel->create($couponno,$total,$starttime,$endtime,$max,$display,$type,$value);
			if($result)
			{
				$this->model('coupondetail')->create($result,$category);
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'添加失败'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
	
	/**
	 * ajaxdatatable请求
	 */
	function ajaxdatatable()
	{
		$resultObj = new \stdClass();
		$resultObj->draw = $this->post->draw;
		$couponModel = $this->model('coupon');
		$result = $couponModel->searchable($this->post);
		$resultObj->recordsTotal = $couponModel->count();
		$resultObj->recordsFiltered = count($result);
		$result = array_slice($result, $this->post->start,$this->post->length);
		$resultObj->data = $result;
		return json_encode($resultObj);
	}
	
	function remove()
	{
		$this->response->addHeader('Content-Type','appication/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'coupon',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			if(!empty($id))
			{
				$couponModel = $this->model('coupon');
				if($couponModel->remove($id))
				{
					return json_encode(array('code'=>1,'result'=>'删除成功'));
				}
				return json_encode(array('code'=>3,'result'=>'删除失败'));
			}
			return json_encode(array('code'=>0,'result'=>'参数错误'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
}