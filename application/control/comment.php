<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\filter;
class commentControl extends control
{

	/**
	 * 发送评论
	 */
	function send()
	{
		if(!login::user())
			return json_encode(array('code'=>3,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		$content = $this->post->content;
		if(!empty($pid))
		{
			$commentModel = $this->model('comment');
			if($commentModel->add($this->session->id,$pid,$content))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'参数错误'));
	}
	
	/**
	 * 获得一个商品下的所有评论
	 */
	function getlist()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$pid = filter::int($this->get->pid);
		if(!empty($pid))
		{
			$commentModel = $this->model('comment');
			$result = $commentModel->getByPid($pid);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
		return json_encode(array('code'=>0,'result'=>'参数错误'));
	}
	
	
	/**
	 * 删除评论
	 */
	function del()
	{
		$id = filter::int($this->post->id);
		if (!empty($id))
		{
			$commentModel = $this->model('comment');
			if($commentModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'failed'));
		}
		return json_encode(array('code'=>2,'result'=>'参数错误'));
	}
}