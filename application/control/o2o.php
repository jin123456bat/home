<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use system\core\filter;
use application\model\roleModel;
use system\core\view;
use application\message\json;
use application\model\orderlistModel;
use system\core\file;
/**
 * o2o店铺相关Api
 * @author jin12
 *
 */
class o2oControl extends control
{
	/**
	 * o2o用户管理页面
	 */
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/o2ouser.html');
			$this->view->assign('o2o',$this->model('o2ouser')->fetchAll());
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	
	function o2oclient()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_ALL))
		{
			$id = filter::int($this->get->id);
			if(!empty($id))
			{
				$this->view = new view(config('view'), 'admin/o2oclient.html');
				//$this->view->assign('')
				$o2oModel = $this->model('o2ouser');
				$o2o = $o2oModel->get($id);
				$userModel = $this->model('user');
				$client = $userModel->getByOid($id);
				$this->view->assign('client',$client);
				$this->view->assign('o2o',$o2o);
				$this->response->setBody($this->view->display());
			}
			else
			{
				$this->response->setCode(302);
				$this->response->addHeader('Location',$this->http->url('index','__404'));
			}
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * o2o登陆接口
	 */
	function login()
	{
		$telephone = $this->post->telephone;
		$password = $this->post->password;
		$o2oModel = $this->model('o2ouser');
		$uinfo = $o2oModel->login($telephone,$password);
		if($uinfo)
		{
			$this->session->id = $uinfo['id'];
			$this->session->telephone = $uinfo['telephone'];
			$this->session->o2o = $uinfo['name'];
			return new json(json::OK);
		}
		else
		{
			return new json(json::PARAMETER_ERROR,'用户名或者密码错误');
		}
	}
	
	/**
	 * o2o统计
	 */
	function statistics()
	{
		if(login::o2o())
		{
			$timetype = empty($this->get->timetype)?'day':$this->get->timetype;
			if(!in_array($timetype, array('day','week','month')))
				return new json(json::PARAMETER_ERROR,'日期范围错误');
			switch ($timetype)
			{
				case 'day':$time = $_SERVER['REQUEST_TIME']-24*3600;break;
				case 'week':$time = $_SERVER['REQUEST_TIME']-7*24*3600;break;
				case 'month':$time = $_SERVER['REQUEST_TIME']-30*24*3600;break;
				default:$time = $_SERVER['REQUEST_TIME'];break;
			}
			
			$userModel = $this->model('user');
			$o2oModel = $this->model('o2ouser');
			$rate = $o2oModel->get($this->session->id,'rate');
			
			//$status = array(orderlistModel::STATUS_CLOSE,orderlistModel::STATUS_REFUND,orderlistModel::STATUS_QUITE,orderlistModel::STATUS_PAYING);
			$status = array(
				0,2,3,7
			);
			
			if($this->get->form == 1)
			{
				$userModel->where('user.oid=?',array($this->session->id));
				$userModel->table('orderlist','left join','orderlist.uid=user.id');
				$userModel->table('orderdetail','left join','orderdetail.oid=orderlist.id');
				$userModel->where('orderlist.status not in (?)',$status);
				$userModel->where('orderlist.tradetime>?',array($time));
				$sale = $userModel->select('sum(orderdetail.num)');
				$result['sale'] = number_format($sale[0]['sum(orderdetail.num)']);
				
				$userModel->where('user.oid=?',array($this->session->id));
				$userModel->table('orderlist','left join','orderlist.uid=user.id');
				$userModel->where('orderlist.status not in (?)',$status);
				$userModel->where('orderlist.tradetime>?',array($time));
				$revenue = $userModel->select('sum(orderlist.ordertotalamount)');
				$result['revenue'] = number_format($revenue[0]['sum(orderlist.ordertotalamount)'] * $rate,2);
				
				$userModel->where('user.oid=?',array($this->session->id));
				$usernum = $userModel->select('count(id)');
				$userModel->where('user.regtime>?',array($time));
				$result['usernum'] = number_format($usernum[0]['count(id)']);
				
				$userModel->where('user.oid=?',array($this->session->id));
				$userModel->table('orderlist','left join','orderlist.uid=user.id');
				$userModel->where('orderlist.status not in (?)',$status);
				$userModel->where('orderlist.createtime>?',array($time));
				$ordernum = $userModel->select('count(orderlist.id)');
				$result['ordernum'] = number_format($ordernum[0]['count(orderlist.id)']);
				
				$temp = array();
				if($this->get->timetype == 'month')
				{
					for($i=0;$i<6;$i++)
					{
						$obj = array();
						$year = date("Y");
						//echo $year;
						$month = date("m");
						$day = date("d");
					
						
						if($month-$i<1)
						{
							$month+=12;
							$year--;
						}
						$starttime = strtotime($year.'-'.($month-$i).'-1 0:0:0');
						$obj['period'] = ($month-$i).'月';
						//$endtime = strtotime($year.'-'.$month.'-1 0:0:0');
						$endtime = strtotime('+1 month',$starttime);
						//echo date("Y-m-d H:i:s",$starttime).'=>';
						//echo date("Y-m-d H:i:s",$endtime).'<br>';
						$userModel->where('user.oid=?',array($this->session->id));
						$userModel->table('orderlist','left join','orderlist.uid=user.id');
						$userModel->table('orderdetail','left join','orderdetail.oid=orderlist.id');
						$userModel->where('orderlist.status not in (?)',$status);
						$userModel->where('orderlist.tradetime>? and orderlist.tradetime<?',array($starttime,$endtime));
						$sale = $userModel->select('sum(orderdetail.num)');
						$obj['sales'] = number_format($sale[0]['sum(orderdetail.num)']);
					
					
						$userModel->where('user.oid=?',array($this->session->id));
						$userModel->table('orderlist','left join','orderlist.uid=user.id');
						$userModel->where('orderlist.status not in (?)',$status);
						$userModel->where('orderlist.tradetime>? and orderlist.tradetime<?',array($starttime,$endtime));
						$revenue = $userModel->select('sum(orderlist.ordertotalamount)');
						$obj['profit'] = number_format($revenue[0]['sum(orderlist.ordertotalamount)'] * $rate,2);
					
						$temp[] = $obj;
					}
				}
				$result['detail'] = $temp;
			}
			else if($this->get->form == 2)
			{
			
				$userModel->where('user.oid=?',array($this->session->id));
				$userModel->table('user_login_log','left join','user.id=user_login_log.uid');
				$userModel->where('user_login_log.time>?',array($time));
				$logintimes = $userModel->select('count(user_login_log.id)');
				$result['logintimes'] = number_format($logintimes[0]['count(user_login_log.id)']);
				
				
				$userModel->where('user.oid=?',array($this->session->id));
				$userModel->where('user.regtime>?',array($time));
				$newuser = $userModel->select('count(id)');
				$result['newuser'] = number_format($newuser[0]['count(id)']);
				
				$userModel->where('user.oid=?',array($this->session->id));
				$userModel->table('orderlist','left join','orderlist.uid=user.id');
				$userModel->where('orderlist.status not in (?)',$status);
				$userModel->groupby('user.id');
				
				$parameter = 'user.id,user.username,user.gravatar,user.telephone,sum(orderlist.ordertotalamount) as sum,count(orderlist.id) as count,avg(orderlist.ordertotalamount) as avg';
				$result['detail'] = $userModel->select($parameter);
				foreach ($result['detail'] as &$value)
				{
					$value['gravatar'] = file::realpathToUrl($value['gravatar']);
				}
			}
			return new json(json::OK,NULL,$result);
		}
		return new json(json::NOT_LOGIN);
	}
	
	/**
	 * o2o用户注销
	 */
	function logout()
	{
		unset($this->session->id);
		unset($this->session->telephone);
		unset($this->session->o2o);
		$this->response->setCode(302);
		$this->response->addHeader('Location',$this->http->url('o2ocenter','login'));
	}
	
	/**
	 * 管理员添加o2o账户
	 * @param post uid 不得为空
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_INSERT))
		{
			$uid = filter::int($this->post->uid);
			$rate = filter::number($this->post->rate);
			$name = $this->post->name;
			$address = $this->post->address;
			$qq = $this->post->qq;
			if(empty($name) || empty($address) || empty($qq) || empty($rate))
				return json_encode(array('code'=>2,'result'=>'数据不全'));
			$o2oModel = $this->model('o2ouser');
			if($o2oModel->create($uid,$name,$qq,$address,$rate))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>'3','result'=>'添加失败'));
		}
		else
		{
			return json_encode(array('code'=>0,'result'=>'没有权限'));
		}
	}
	
	/**
	 * 删除一个o2o账号
	 * @return string
	 */
	function remove()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'o2ouser',roleModel::POWER_DELETE))
		{
			$id = $this->get->id;
			$o2oModel = $this->model('o2ouser');
			$o2oModel->remove($id);
			$userModel = $this->model('user');
			$userModel->clearOid($id);
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('o2o','admin'));
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
}