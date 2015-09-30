<?php
namespace application\control;
use system\core\control;
use system\core\view;
use application\classes\login;
use system\core\filter;
use application\model\roleModel;
/**
 * 留言箱控制器
 * @author jin12
 *
 */
class messageControl extends control
{
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'message',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/message.html');
			$this->view->assign('role',$roleModel->get($this->session->role));
			$messageModel = $this->model('message');
			
			$start = filter::int($this->get->start);
			$length = filter::int($this->get->length);
			$start = empty($start)?0:$start;
			$length = empty($length)?10:$length;
			$this->get->start = $start;
			$this->get->length = $length;
			
			$count = $messageModel->select('count(*)');
			$count = $count[0]['count(*)'];
			$this->view->assign('count',$count);
			
			$message = $messageModel->fetchAll($start,$length);
			$this->view->assign('message',$message);
			return $this->view->display();
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 添加建议和反馈
	 */
	function create()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$content = $this->post->content;
		if(!empty($content))
		{
			$messageModel = $this->model('message');
			if($messageModel->create($this->session->id,$content))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
		}
		return json_encode(array('code'=>0,'result'=>'提交内容不能为空'));
	}
}