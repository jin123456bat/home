<?php
namespace application\control;

use system\core\control;
use system\core\view;
use application\classes\sms;
use system\core\validate;
use system\core\random;
use system\core\image;
use application\classes\weixin_gateway;
use application\message\json;
use system\core\file;

class indexControl extends control
{
	
	function index()
	{
		//$weixin = new weixin_gateway(config('weixin'));
		//return $weixin->output('wx201508241358272acbe3a4ea0291668002');
		if(isset($_POST['post']))
		{
			var_dump($_FILES);
		}
		else
		{
			$view = new view(config('view'), 'index.html');
			return $view->display();
		}
	}
	
	/**
	 * 获取服务器当前时间
	 * @return number
	 */
	function time()
	{
		return time();
	}

	/**
	 * 发送手机验证码
	 */
	function code()
	{
		$telephone = $this->post->telephone;
		if(validate::telephone($telephone))
		{
			$smslogModel = $this->model('smslog');
			if($smslogModel->check($telephone))
			{
				$code = random::number(6);
				$template = $this->model('system')->get('smstemplate','system');
				$template = sprintf($template,$code);
				$sms = new sms();
				$result = $sms->send($telephone, $template);
				if($result > 0)
				{
					$smslogModel->create($telephone,$code);
					return json_encode(array('code'=>1,'result'=>'ok','body'=>$code));
				}
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
	 * 根据传入内容生成二维码
	 */
	function eqcode()
	{
		$content = htmlspecialchars_decode($this->get->content);
		$image = new image();
		$file = $image->QRCode($content);
		$this->response->addHeader('Content-Type','image/png');
		echo file_get_contents($file);
	}
	
	/**
	 * 临时文件上传通道
	 */
	function image()
	{
		$file = $this->file->file;
		if(is_file($file))
		{
			$image = new image();
			$file = $image->resizeImage($file, 640, 640*2);
			return new json(json::OK,NULL,file::realpathToUrl($file));
		}
		return new json(json::PARAMETER_ERROR,'图片上传失败');
	}

	/**
	 * optional
	 */
	function __404()
	{
		$this->view = new view(config('view'), '__404.html');
		return $this->view->display();
	}
}