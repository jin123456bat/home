<?php
namespace application\control;

use system\core\control;
use application\classes\login;
use system\core\filter;
use system\core\filesystem;
use application\model\roleModel;
use system\core\file;
use system\core\image;
use application\classes\user;
class commentControl extends control
{

	/**
	 * 发送评论
	 */
	function send()
	{
		$this->response->addHeader('Content-Type','application/json');
		if(!login::user())
			return json_encode(array('code'=>3,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		$content = $this->post->content;
		
		if(isset($_FILES['file']))
		{
			$image = new image();
			$files = $this->file->receiveMultiFile($_FILES['file'],config('file'));
			foreach ($files as &$file)
			{
				$file = $image->resizeImage($file, 640, 320);
			}
		}
		else
		{
			$files = array();
		}
		
		$score = filter::int($this->post->score);
		$score = ($score<=5 && $score>=0)?$score:0;
		
		if(!empty($pid))
		{
			$commentModel = $this->model('comment');
			if($commentModel->create($this->session->id,$pid,$content,$score,$files))
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
		$start = empty($this->get->start)?0:$this->get->start;
		$length = empty($this->get->length)?5:$this->get->length;
		$pid = filter::int($this->get->pid);
		if(!empty($pid))
		{
			$commentModel = $this->model('comment');
			$result = $commentModel->getByPid($pid,$start,$length);
			$userHelper = new user();
			foreach($result as &$comment)
			{
				$uinfo = $this->model('user')->get($comment['uid']);
				$comment['telephone'] = $userHelper->hideName($uinfo['telephone']);
				$comment['gravatar'] = file::realpathToUrl($uinfo['gravatar']);
				$comment['username'] = $userHelper->hideName($uinfo['username']);
				unset($comment['uid']);
				$comment['img'] = $this->model('comment_pic')->getByCid($comment['id'],'url');
			}
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
		return json_encode(array('code'=>0,'result'=>'参数错误'));
	}
	
	/**
	 * ajax获取某商品下的评论
	 */
	function ajaxcomment()
	{
		$resultObj = new \stdClass();
		$resultObj->draw = $this->post->draw;
		$commentModel = $this->model('comment');
		$pid = filter::int($this->get->pid);
		$result = $commentModel->searchable($this->post,$pid);
		$resultObj->recordsFiltered = count($result);
		$result = array_slice($result, $this->post->start,$this->post->length);
		$count = $commentModel->select('count(*)');
		$resultObj->recordsTotal = isset($count[0]['count(*)'])?$count[0]['count(*)']:0;
		foreach ($result as &$comment)
		{
			$img = $this->model('comment_pic')->getByCid($comment['id'],'url');
			foreach ($img as &$pic)
			{
				$pic = file::realpathToUrl($pic);
			}
			$comment['img'] = $img;
		}
		$resultObj->data = $result;
		return json_encode($resultObj);
	}
	
	
	/**
	 * 删除评论
	 */
	function del()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'comment',roleModel::POWER_DELETE))
		{
			$id = filter::int($this->post->id);
			if (!empty($id))
			{
				$commentModel = $this->model('comment');
				if($commentModel->remove($id))
				{
					//删除磁盘图片
					$comment_picModel = $this->model('comment_pic');
					$comment_pic = $comment_picModel->getByCid($id,'path');
					foreach ($comment_pic as $pic)
					{
						filesystem::unlink($pic);
					}
					$this->model('log')->write($this->session->username,'删除了一条评论');
					//删除图片记录
					$comment_picModel->removeByCid($id);
					return json_encode(array('code'=>1,'result'=>'ok'));
				}
				return json_encode(array('code'=>0,'result'=>'failed'));
			}
			return json_encode(array('code'=>2,'result'=>'参数错误'));
		}
		return json_encode(array('code'=>3,'result'=>'没有权限'));
	}
}