<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\sms;
use system\core\validate;
use system\core\random;
use system\core\filter;

class indexControl extends control
{

	function index()
	{
		
	}

	/**
	 * 发送手机验证码
	 */
	function code()
	{
		$telephone = $this->post->telephone;
		if(validate::telephone($telephone))
		{
			if(isset($this->session->codeTimes))
			{
				if($this->session->codeTimes > 10)
				{
					return json_encode(array('code'=>2,'result'=>'短信发送次数太多'));
				}
			}
			else
			{
				$this->session->codeTimes = 1;
			}
			$code = random::number(4);
			$template = "您的验证码:".$code;
			$sms = new sms();
			$result = $sms->send($telephone, $template);
			if($result > 0)
			{
				$this->session->codeTimes = $this->session->codeTimes + 1;
				if(isset($this->session->code))
				{
					$this->session->code = array_merge($this->session->code,array($code));
				}
				else
				{
					$this->session->code = array($code);
				}
				return json_encode(array('code'=>1,'result'=>'ok','body'=>$code));
			}
			return json_encode(array('code'=>2,'result'=>'短信发送失败'));
		}
		else
		{
			return json_encode(array(
				'code' => 0,
				'result' => '手机号码不合法'
			));
		}
	}

	/**
	 * optional
	 */
	function __404()
	{
		
	}
}