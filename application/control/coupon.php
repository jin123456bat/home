<?php
namespace application\control;
use system\core\control;
use application\classes\category;
use application\model\roleModel;
use application\classes\login;
use system\core\view;
use system\core\random;
use system\core\filter;
use application\classes\collection;
use application\message\json;
/**
 * 优惠券打折码控制器
 * @author jin12
 *
 */
class couponControl extends control
{
	/**
	 * 获得我的优惠券
	 */
	function mycoupon()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$couponModel = $this->model('coupon');
		$coupon = $couponModel->mycoupon($this->session->id,true);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$coupon));
	}
	
	/**
	 * 获取可以使用的优惠券  添加参数pid 可以根据购物车还是根据单商品
	 */
	function getavaliable()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$couponModel = $this->model('coupon');
		
		$pid = filter::int($this->post->pid);
		if(empty($pid))
		{
			//根据购物车获取可以使用的优惠券
			$cartModel = $this->model('cart');
			//获取用户购物车中所有商品
			$cart = $cartModel->getByUid($this->session->id);
		}
		else
		{
			$content = $this->post->content;
			$content = empty($content)?'':$content;
			//根据单商品获取可以使用的优惠券 
			$cart = array();
			$productModel = $this->model('product');
			$product = $productModel->get($pid);
			$product['content'] = (new collection())->stringToArray($content);
			$product['content'] = serialize($product['content']);
			$cart[] = $product;
		}
		//购买的商品价格
		$price = 0;
		
		$collectionModel = $this->model('collection');
		
		$coupondetailModel = $this->model('coupondetail');
		$product_category_array = array();
		foreach($cart as $goods)
		{
			//参加了活动的商品不能使用优惠券
			if(isset($goods['activity']) && $goods['activity'] === '')
			{
				$product_category_array[] = $goods['category'];
				//计算商品价格
				$content = unserialize($goods['content']);
				$collection = $collectionModel->find($goods['pid'],$content);
				if(empty($collection))
				{
					$price += $goods['price'];
				}
				else
				{
					$price += $collection['price'];
				}
			}
		}
		
		$result = $coupondetailModel->where('(categoryid in (?) or categoryid=0)',$product_category_array)->select();
		$coupon_id_array = array();
		foreach($result as $coupon)
		{
			$coupon_id_array[] = $coupon['couponid'];
		}
		$couponModel->where('id in (?)',$coupon_id_array);
		//公开可以使用的优惠券
		$body1 = $couponModel->publicCoupon($price);
		//我的优惠券
		$filter = array(
			'max' => $price
		);
		$body2 = $couponModel->mycoupon($this->session->id,false,$filter);
		$body = array_unique(array_merge($body1,$body2),SORT_REGULAR);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$body));
	}
	
	/**
	 * 将优惠券分发给所有用户
	 */
	function copy()
	{
		if (login::admin())
		{
			set_time_limit(0);
			$code = json_decode($this->randomcode(),true);
			$code = $code['body'];
			$id = $this->post->id;
			$couponModel = $this->model('coupon');
			$coupon = $couponModel->get($id);
			if (empty($coupon))
				return new json(json::PARAMETER_ERROR,'没有找到优惠券');
			$userModel = $this->model('user');
			$user = $userModel->select();
			foreach ($user as $item)
			{
				$couponModel->copyForUser($item['id'],$code,$coupon);
				$code = json_decode($this->randomcode(),true);
				$code = $code['body'];
			}
			return new json(json::OK);
		}
	}
	
	/**
	 * 获取一个可以使用的优惠券信息
	 */
	function information()
	{
		$couponno = $this->get->couponno;
		$couponModel = $this->model('coupon');
		$coupon = $couponModel->get($couponno);
		if(empty($coupon))
			return new json(json::PARAMETER_ERROR,'优惠券不存在');
		if($coupon['display'] == 1 && $coupon['times'] >0 && $coupon['starttime']<$_SERVER['REQUEST_TIME'] && ($coupon['endtime'] == 0 || $coupon['endtime']>$_SERVER['REQUEST_TIME']) && $coupon['uid']== 0)
			return new json(json::OK,NULL,$coupon);
		return new json(json::PARAMETER_ERROR,'优惠券不可用');
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
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
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
		$code = strtoupper(date('ymdHis',$_SERVER['REQUEST_TIME']).random::word(6,'',random::RANDOM_WORD_NUMBER));
		while ($couponModel->exist($code))
		{
			$code = strtoupper(date('ymdHis',$_SERVER['REQUEST_TIME']).random::word(6,'',random::RANDOM_WORD_NUMBER));
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
			$uid = filter::int($this->post->uid);
			$max = filter::number($this->post->max);
			$value = filter::number($this->post->value);
			$couponModel = $this->model('coupon');
			$result = $couponModel->create($couponno,$uid,$total,$starttime,$endtime,$max,$display,$type,$value);
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
	 * 新用户注册活动赠送优惠卷
	 */
	function register()
	{
		if(!login::user())
			return new json(json::NOT_LOGIN);
		
		//活动id
		$id = 1;
		
		$coupon_id = $this->model('register')->get($id,'template_coupon');
		if(!empty($coupon_id))
		{
			
			$couponModel = $this->model('coupon');
			$coupon = $couponModel->get($coupon_id);
			if(empty($coupon))
				return new json(json::PARAMETER_ERROR,'优惠券模板不存在');
			$register_logModel = $this->model('register_log');
			if(!$register_logModel->checkUser($this->session->id))
				return new json(5,'该用户已经领取过优惠券');
			//优惠代码
			$couponno = $this->randomcode();
			$couponno = json_decode($couponno)->body;
			$cid = $couponModel->copyForUser($this->session->id,$couponno,$coupon);
			if($cid)
			{
				$register_logModel->write($this->session->id,$cid);
				return new json(json::OK);
			}
			return new json(4,'优惠券领取失败');
		}
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
		foreach ($result as &$coupon)
		{
			$coupon['category'] = $this->model('coupondetail')->getByCouponid($coupon['id'],'name');
		}
		$resultObj->data = $result;
		return json_encode($resultObj);
	}
	
	/**
	 * 删除优惠券
	 * @return string
	 */
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