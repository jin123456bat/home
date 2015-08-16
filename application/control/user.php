<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\model\roleModel;
use system\core\filter;
use application\classes\login;
use application\classes\email;
use application\classes\excel;
use system\core\image;
use system\core\filesystem;
use application\classes\sms;
use system\core\file;

/**
 * 用户控制器
 * @author jin12
 *
 */
class userControl extends control
{
	/**
	 * 给用户发送短信
	 */
	function message()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_ALL))
		{
			$content = htmlspecialchars_decode($this->post->content);
			if(mb_strlen($content,'utf8')>350)
				return json_encode(array('code'=>2,'result'=>'短信长度不得超过350个字'));
			if(mb_strlen($content,'utf-8')<10)
				return json_encode(array('code'=>5,'result'=>'短信长度太短了，为了能通过接口还是多写几个字吧'));
			$userModel = $this->model('user');
			if(!empty($this->post->data))
			{
				$data = json_decode(htmlspecialchars_decode($this->post->data));
				$userModel->where('id in (?)',array(implode(',', $data)));
				$result = $userModel->select('telephone');
				$telephone = array();
				if(isset($result[0]['telephone']) && !empty($result[0]['telephone']))
				{
					$telephone[] = $result[0]['telephone'];
				}
				$sms = new sms();
				$result = $sms->send($telephone, $content);
				if((int)$result>0)
				{
					$this->model('log')->write($this->session->username,'给'.count($telephone).'个用户发送了短信:'.$content);
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				else if((int)$result < 0)
				{
					return json_encode(array('code'=>5,'result'=>'短信接口异常'.$result));
				}
				return json_encode(array('code'=>0,'result'=>'选择人数太多，请控制在100个以内'));
			}
			return json_encode(array('code'=>4,'result'=>'参数错误'));
		}
		return json_encode(array('code'=>3,'result'=>'没有权限'));
	}
	
	/**
	 * 导出用户数据
	 */
	function export()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_SELECT))
		{
			$userModel = $this->model('user');
			$addressModel = $this->model('address');
			if(!empty($this->get->data))
			{
				$data = json_decode(htmlspecialchars_decode($this->get->data));
				$userModel->where('id in (?)',array(implode(',', $data)));
			}
			$result = $userModel->select('id,telephone,email,username,regtime,logtime,money,score,ordernum,cost');
			foreach($result as &$user)
			{
				$user['regtime'] = date("Y-m-d H:i:s",$user['regtime']);
				$user['logtime'] = date("Y-m-d H:i:s",$user['logtime']);
				$address = $addressModel->getHost($user['id']);
				if(empty($address))
					$addstr = '';
				else
					$addstr = "省份:".$address['province']." 城市:".$address['city']." 详细地址:".$address['address']." 邮编:".$address['zcode'];
				$user['address'] = $addstr;
			}
			$excel = new excel();
			$excel->xls($result,array('会员ID','手机号','Email','昵称','注册时间','最近登陆时间','余额','积分','订单数','消费金额','会员收货地址信息'),'user.xls');
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	/**
	 * 获取用户个人信息
	 * @return string
	 */
	function information()
	{
		if(login::user())
		{
			$userModel = $this->model('user');
			$info = $userModel->get($this->session->id);
			$info['gravatar'] = file::realpathToUrl($info['gravatar']);
			if(!empty($info))
			{
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$info));
			}
			return json_encode(array('code'=>2,'result'=>'不存在该用户'));
		}
		return json_encode(array('code'=>0,'result'=>'尚未登陆 '));
	}
	
	/**
	 * 用户设置自己昵称和头像
	 */
	function setnamegravatar()
	{
		if(login::user())
		{
			$username = $this->post->username;
			$gravatar = $this->file->file;
			if(!is_file($gravatar) || empty($username))
			{
				return json_encode(array('code'=>3,'result'=>'参数错误'));
			}
			$image = new image();
			$file = $image->resizeImage($gravatar, 200, 200);
			filesystem::unlink($gravatar);
			$userModel = $this->model('user');
			if($userModel->setNameGravatar($this->session->id,$username,$file))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'添加失败'));
		}
		return json_encode(array('code'=>2,'result'=>'尚未登陆'));
	}
	
	/**
	 * 用户遗忘密码
	 */
	function forgetpwd()
	{
		$code = $this->post->code;
		$telephone = filter::int($this->post->telephone);
		$password = $this->post->password;
		$smslogModel = $this->model('smslog');
		if($smslogModel->check($telephone,$code))
		{
			$userModel = $this->model('user');
			if($userModel->changepwd($telephone,$password));
				return json_encode(array('code'=>1,'result'=>'ok'));
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'验证码错误'));
	}
	
	/**
	 * 根据用户id获取用户手机号
	 */
	function telephone()
	{
		$roleModel = $this->model('role');
		if(login::admin())
		{
			$id = filter::int($this->get->id);
			$userModel = $this->model('user');
			$result = $userModel->where('id=?',array($id))->select('telephone');
			if(isset($result[0]))
			{
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$result[0]['telephone']));
			}
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
	
	/**
	 * 用户更改密码
	 */
	function changepwd()
	{
		$oldepwd = $this->post->oldpwd;
		$newpwd = $this->post->newpwd;
		if(login::user())
		{
			$id = $this->post->id;
			if(!empty($oldepwd) && !empty($newpwd))
			{
				$userModel = $this->model('user');
				if($userModel->authpwd($id,$oldepwd,$newpwd))
				{
					return json_encode(array('code'=>1,'result'=>'密码更改成功'));
				}
				return json_encode(array('code'=>2,'result'=>'旧密码不正确'));
			}
			else
			{
				return json_encode(array('code'=>3,'result'=>'新密码或旧密码不得为空'));
			}
		}
		return json_encode(array('code'=>0,'result'=>'尚未登陆'));
	}

	/**
	 * 用户封印
	 * @return string
	 */
	function close()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'user', roleModel::POWER_UPDATE)) {
			$id = filter::int($this->post->id);
			$close = filter::int($this->post->toggle);
			$userModel = $this->model('user');
			if ($userModel->where('id=?', array(
				$id
			))->update('close', $close)) {
				return json_encode(array(
					'code' => 1,
					'result' => 'ok'
				));
			}
			return json_encode(array(
				'code' => 0,
				'result' => 'failed'
			));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}

	/**
	 * 用户注册
	 * 
	 * @return string
	 */
	function register()
	{
		$this->response->addHeader('Content-Type','application/json');
		$telephone = filter::telephone($this->post->telephone);
		$password = $this->post->password;
		$o2o = $this->post->o2o;
		$code = $this->post->code;
		$client = $this->post->client;
		$userModel = $this->model('user');
		if ($telephone != NULL) {
			
			if (login::admin()) {
				if (empty($password))
					$password = $telephone;
				if ($userModel->register($telephone, $password,$o2o,$client)) {
					
					return json_encode(array(
						'code' => 1,
						'result' => 'success'
					));
				}
				else
				{
					return json_encode(array(
						'code' => 3,
						'result' => '手机号重复注册'
					));
				}
			} else {
				$smslogModel = $this->model('smslog');
				if($smslogModel->check($telephone,$code))
				{
					if(!empty($o2o))
					{
						$o2oModel = $this->model('o2ouser');
						$o2o = $o2oModel->check($o2o);
						if(empty($oid))
						{
							return json_encode(array('code'=>6,'result'=>'推广员手机号错误'));
						}
					}
					if ($userModel->register($telephone, $password,$o2o))
					{
						$o2oModel->where('uid=?',array($o2o))->increase('num',1);
						return json_encode(array(
							'code' => 1,
							'result' => 'success'
						));
					}
					else
					{
						return json_encode(array(
							'code' => 3,
							'result' => '手机号重复注册'
						));
					}
				}
				return json_encode(array('code'=>4,'result'=>'验证码不存在或者已过期'));
			}
			return json_encode(array(
				'code' => 2,
				'result' => '验证码不匹配'
			));
		}
		return json_encode(array('code'=>5,'result'=>'手机号格式不正确'));
	}

	/**
	 * 普通用户登录接口
	 * 
	 * @return string
	 */
	function login()
	{
		$telephone = filter::telephone($this->post->telephone);
		$password = $this->post->password;
		if ($telephone != NULL && $password != NULL) {
			$userModel = $this->model('user');
			$uinfo = $userModel->login($telephone, $password);
			if (isset($uinfo['id']) && ! empty($uinfo['id'])) {
				if(empty($uinfo['close']))
				{
					$this->session->id = $uinfo['id'];
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_encode(array('code'=>2,'result'=>'被管理员封印ing'));
			}
			return json_encode(array('code'=>3,'result'=>'账号或密码错误'));
		}
		return json_encode(array(
			'code' => 0,
			'result' => '请求失败'
		));
	}
	
	/**
	 * 删除用户账户
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'user',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			if(!empty($id))
			{
				$userModel = $this->model('user');
				if($userModel->remove($id))
				{
					$logModel = $this->model('log');
					$logModel->write($this->session->username,"删除了一个用户");
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_encode(array('code'=>0,'result'=>'删除失败'));
			}
			return json_encode(array('code'=>2,'result'=>'参数错误 '));
		}
		return json_encode(array('code'=>3,'result'=>'没有权限'));
	}

	/**
	 * 用户列表页面 管理员
	 */
	function userlist()
	{
		$roleModel = $this->model('role');
		if (login::admin() && $roleModel->checkPower($this->session->role, 'user', roleModel::POWER_SELECT)) {
			$this->view = new view(config('view'), 'admin/userlist.html');
			return $this->view->display();
		}
	}

	/**
	 * 向用户发送邮件
	 */
	function sendmail()
	{
		$uid = $this->post->uid;
		$content = urldecode($this->post->content);
		try {
			$title = '测试邮件';
			$uid = json_decode($uid);
			$uid = '(' . implode(',', $uid) . ')';
			$userModel = $this->model('user');
			$result = $userModel->where('id in ' . $uid)->select('email');
			$mail = new email(config('email'));
			$emailaddress = array_map(function ($user) {
				if (isset($user['email']) && ! empty($user['email'])) {
					return $user['email'];
				}
			}, $result);
			if ($mail->send($emailaddress, '测试邮件', $content)) {
				return json_encode(array(
					'code' => 1,
					'result' => '发送完毕'
				));
			}
			return json_encode(array(
				'code' => 2,
				'result' => '邮件发送失败，请检查您的配置和网络'
			));
		} catch (\Exception $e) {
			return json_encode(array(
				'code' => 0,
				'result' => '发送过程中失败了'
			));
		}
	}

	/**
	 * ajax调用用户数据列表
	 */
	function userlistajax()
	{
		$roleModel = $this->model('role');
		$resultObj = new \stdClass();
		$resultObj->draw = $this->post->draw;
		$resultObj->recordsTotal = 0;
		$resultObj->recordsFiltered = 0;
		$resultObj->data = array();
		if (login::admin() && $roleModel->checkPower($this->session->role, 'user', roleModel::POWER_SELECT)) {
			$userModel = $this->model('user');
			$num = $userModel->select('count(*)');
			$result = $userModel->searchable($_POST);
			$resultObj->recordsTotal = (int) $num[0]['count(*)'];
			$resultObj->recordsFiltered = count($result);
			$resultObj->data = array_slice($result, $this->post->start, $this->post->length);
		}
		return json_encode($resultObj);
	}
}