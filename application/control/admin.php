<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\login;
use application\model\roleModel;
use system\core\filter;
use application\message\json;
use application\model\refundModel;

class adminControl extends control
{
	
	private $_module_power = ['shipmodify'=>'system'];
	
	
	/**
	 * 管理员登陆界面
	 */
	function index()
	{
		$this->view = new view(config('view'), 'admin/login.html');
		
		$systemModel = $this->model('system');
		$system = $systemModel->fetch('system');
		$system = $systemModel->toArray($system,'system');
		$this->view->assign('system',$system);
		
		return $this->view->display();
	}
	
	/**
	 * 更改管理员密码
	 */
	function resetpwd()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->id,'admin',roleModel::POWER_UPDATE))
		{
			$id = filter::int($this->post->id);
			$password= $this->post->password;
			$adminModel = $this->model('admin');
			if($adminModel->changepwd($id,$password))
			{
				$this->model('log')->write($this->session->username,"更改了管理员的密码");
				return new json(json::OK);
			}
			return new json(4,'修改后的密码和原密码相同');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 删除管理员账户
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'admin',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			$adminModel = $this->model('admin');
			if($adminModel->remove($id))
			{
				$this->model('log')->write($this->session->username,"删除了管理员账户");
				return new json(json::OK);
			}
			return new json(4,'删除失败');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 管理后台主页
	 */
	function dashboard()
	{
		if(login::admin())
		{
			$this->view = new view(config('view'), 'admin/dashboard.html');
			$this->model('log')->write($this->session->username,"登陆了系统");
			
			$roleModel = $this->model('role');
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			//发货提醒
			$shipalertModel = $this->model('shipalert');
			$filter = array(
				'field' => 'shipalert.id,user.username,user.telephone,shipalert.oid,orderlist.orderno'
			);
			$shipalert = $shipalertModel->fetchAll($filter);
			$this->view->assign('shipalert',$shipalert);
			//商品无库存提醒
			$stockalert = $this->model('system')->get('stockalert','system');
			if(!empty($stockalert))
			{
				$productModel = $this->model('product');
				$collection = $this->model('collection');
				$product1 = $productModel->where('stock<?',array($stockalert))->select('id,name');
				$collection->table('product','right join','product.id=collection.pid');
				$product2 = $collection->where('collection.stock<?',array($stockalert))->select('product.id,product.name');
				
				$product = array_unique(array_merge($product1,$product2),SORT_REGULAR);
				$this->view->assign('product',$product);
			}
			//退款提醒
			$refundModel = $this->model('refund');
			$refundModel->table('orderlist','left join','orderlist.id=refund.oid');
			$refundModel->table('user','left join','user.id=refund.uid');
			$refund = $refundModel->where('refund.handle=?',array(refundModel::REFUND_HANDLE_NO))->select('orderlist.orderno,refund.*,user.username,user.telephone');
			//$refund = $refundModel->select();
			//var_dump($refund);
			$this->view->assign('refund',$refund);
			
			//7天以内的信息
			$notifyTime = $_SERVER['REQUEST_TIME']-7*24*3600;
			//新用户注册通知
			$userModel = $this->model('user');
			$userModel->orderby('regtime','desc');
			$register = $userModel->where('regtime>?',array($notifyTime))->select('*');
			//新订单产生通知
			$orderModel = $this->model('orderlist');
			$orderModel->orderby('createtime','desc');
			$orderModel->orderby('tradetime','desc');
			$order = $orderModel->where('createtime>? or tradetime>?',array($notifyTime,$notifyTime))->select();
			$this->view->assign('register',$register);
			$this->view->assign('order',$order);
			
			$recentLogin = $userModel->orderby('logtime','desc')->limit(20)->select();
			$this->view->assign('recentLogin',$recentLogin);
			
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * ajax请求管理员列表
	 * @return string
	 */
	function adminlistajax()
	{
		$roleModel = $this->model('role');
		$resultObj = new \stdClass();
		$resultObj->draw = $this->post->draw;
		$resultObj->recordsTotal = 0;
		$resultObj->recordsFiltered = 0;
		$resultObj->data = array();
		if (login::admin() && $roleModel->checkPower($this->session->role, 'admin', roleModel::POWER_SELECT)) {
			$adminModel = $this->model('admin');
			$num = $adminModel->select('count(*)');
			$result = $adminModel->searchable($_POST);
			$resultObj->recordsTotal = (int) $num[0]['count(*)'];
			$resultObj->recordsFiltered = count($result);
			$resultObj->data = array_slice($result, $this->post->start, $this->post->length);
		}
		return json_encode($resultObj);
	}
	
	/**
	 * 管理员列表 页面
	 */
	function adminlist()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'admin',roleModel::POWER_SELECT))
		{
			$this->view = new view(config('view'), 'admin/adminlist.html');
			
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 管理员登陆接口
	 */
	function login()
	{
		$username = filter::string($this->post->username,16);
		$password = filter::string($this->post->password,16);
		if(!empty($username) && !empty($password))
		{
			$adminModel = $this->model('admin');
			$ainfo = $adminModel->login($username,$password);
			if(!empty($ainfo))
			{
				$this->session->id = $ainfo['id'];
				$this->session->username = $ainfo['username'];
				$this->session->role = $ainfo['role'];
				return new json(json::OK,'登陆成功');
			}
			return new json(json::NOT_LOGIN,'用户名或密码错误');
		}
		return new json(json::PARAMETER_ERROR,"用户名或密码格式错误");
	}
	
	/**
	 * 管理员注销
	 */
	function logout()
	{
		unset($this->session->id);
		unset($this->session->role);
		unset($this->session->username);
		$this->response->setCode(302);
		$this->response->addHeader('Location',$this->http->url('admin','index'));
	}
	
	/**
	 * 添加管理员 接口
	 */
	function register()
	{
		if(!login::admin())
			return new json(json::NOT_LOGIN);
		$roleModel = $this->model('role');
		if($roleModel->checkPower($this->session->role,'admin',roleModel::POWER_INSERT))
		{
			$username = filter::string($this->post->username,16);
			$password = filter::string($this->post->password,16);
			$adminModel = $this->model('admin');
			if($adminModel->register($username,$password))
			{
				$this->model('log')->write($this->session->username,'添加了一个管理员账号'.$username);
				return new json(json::OK);
			}
			return new json(4,'用户名已经存在');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 更改管理员的管理组
	 */
	function setrole()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'admin',roleModel::POWER_UPDATE))
		{
			$aid = $this->post->id;
			$roleid = $this->post->role;
			$adminModel = $this->model('admin');
			if($adminModel->where('id=?',array($aid))->update('role',$roleid))
			{
				$this->model('log')->write($this->session->username,'更改了管理员的管理组id=>'.$aid.'role=>'.$roleid);
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR,'管理组不存在或者无任何更改');
		}
		return new json(json::NO_POWER);
	}
	
	/**
	 * 模板映射
	 * @param unknown $name
	 * @param unknown $args
	 */
	function __call($name,$args)
	{
		$this->view = new view(config('view'), 'admin/'.$name.'.html');
		$this->init($name);
		return $this->view->display();
	}
	
	private function init($name)
	{
		$roleModel = $this->model('role');
		if (!(login::admin() && $roleModel->checkPower($this->session->role,$this->_module_power[$name],roleModel::POWER_ALL)))
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}	
		$this->view->assign('role',$roleModel->get($this->session->role));	
		$systemModel = $this->model('system');
		$system = $systemModel->fetch('system');
		$system = $systemModel->toArray($system,'system');
		$this->view->assign('system',$system);
		switch ($name)
		{
			case 'drawal':
				$filter = array(
					'order' => array('time','desc'),
					'parameter' => 'bankcard.bank,bankcard.name,bankcard.number,user.username,drawal.id,drawal.money,drawal.time,drawal.handle,drawal.handletime,drawal.note'
				);
				$drawal = $this->model('drawal')->fetch($filter);
				$this->view->assign('drawal',$drawal);
				break;
			case 'shipmodify':
				$id = $this->get->id;
				$shipModel = $this->model('ship');
				$ship = $shipModel->get($id);
				$this->view->assign('ship',$ship);
				break;
			default:
		}
		
		
	}
	
	/**
	 * __404
	 * optional
	 */
	function __404()
	{
		$this->view = new view(config('view'), 'admin/__404.html');
		return $this->view->display();
	}
}