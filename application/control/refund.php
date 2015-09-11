<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\classes\login;
use application\model\refundModel;
use system\core\view;
use application\model\roleModel;
use system\core\file;
/**
 * 退账申请
 * @author jin12
 *
 */
class refundControl extends control
{
	function admin()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'refund',roleModel::POWER_ALL))
		{
			$this->view = new view(config('view'), 'admin/refund_admin.html');
			$refundModel = $this->model('refund');
			$refund = $refundModel->fetchAll();
			foreach ($refund as &$ref)
			{
				$ref['user_gravatar'] = file::realpathToUrl($ref['user_gravatar']);
			}
			$this->view->assign('refund',$refund);
			$this->response->setBody($this->view->display());
		}
		else
		{
			$this->response->setCode(302);
			$this->response->addHeader('Location',$this->http->url('admin','index'));
		}
	}
	
	/**
	 * 创建退账申请
	 */
	function create()
	{
		$id = filter::int($this->post->id);
		$reason = $this->post->reason;
		if(login::user())
		{
			$refundModel = $this->model('refund');
			if($refundModel->create($this->session->id,$id,$reason))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'申请失败'));
		}
		return json_encode(array('code'=>2,'result'=>'尚未登陆'));
	}
	
	/**
	 * 关闭退款申请
	 */
	function remove()
	{
		//退账的id
		$id = filter::int($this->post->id);
		if(login::user())
		{
			$refundModel = $this->model('refund');
			if($refundModel->updateHandle($id,refundModel::REFUND_HANDLE_CLOSE))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'删除失败'));
		}
		return json_encode(array('code'=>2,'result'=>'尚未登陆'));
	}
}