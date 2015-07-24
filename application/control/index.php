<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\sms;

class indexControl extends control
{

	function index()
	{
		$this->view = new view(config('view'), 'index');
		$this->view->assign("index", "你好啊");
		$this->view->assign("index1", 'value1');
		$this->view->assign("index2", 'value2');
		return $this->view->display();
	}

	/**
	 * 发送手机验证码
	 */
	function code()
	{
		sms::send('18548143019', "泥豪");
		$telephone = $this->post->telephone;
		if($telephone != NULL)
		{
			$telephone = $telephone->telephone();
		}
	}

	/**
	 * optional
	 */
	function __404()
	{}
}