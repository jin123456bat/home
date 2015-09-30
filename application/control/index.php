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
		$this->response->setCode(302);
		$this->response->addHeader('Location',$this->http->url('mobile','index'));
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
		$this->response->addHeader('Cache-Control','cache-directive');
		$this->response->addHeader('cache-directive','public');
		$this->response->addHeader('Content-Type','image/png');
		if($this->get->download == 'true')
		{
			$this->response->addHeader('Content-Disposition','attachment; filename="eqcode.png"');
		}
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
			$width = $this->get->width;
			$height = $this->get->height;
			$width = empty($width)?640:$width;
			$height = empty($height)?640*2:$height;
			$image = new image();
			$file = $image->resizeImage($file, $width, $height);
			if($this->get->type == 'text')
			{
				return json_encode(array('code'=>1,'result'=>'ok','body'=>file::realpathToUrl($file)));
			}
			else
			{
				return new json(json::OK,NULL,file::realpathToUrl($file));
			}
		}
		if($this->get->type == 'text')
		{
			return json_encode(array('code'=>0,'result'=>'图片上传失败'));
		}
		else
		{
			return new json(json::PARAMETER_ERROR,'图片上传失败');
		}
	}
	
	/**
	 * 手机app下载
	 */
	function app()
	{
		
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