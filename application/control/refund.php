<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\classes\login;
use application\model\refundModel;
use system\core\view;
use application\model\roleModel;
use system\core\file;
use application\model\orderlistModel;
use system\core\image;
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
			$this->view->assign('role',$roleModel->get($this->session->role));
			
			$systemModel = $this->model('system');
			$system = $systemModel->fetch('system');
			$system = $systemModel->toArray($system,'system');
			$this->view->assign('system',$system);
			
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
		$type = filter::int($this->post->type);
		$type = empty($type)?0:1;
		$reason = $this->post->reason;
		
		$money = filter::number($this->post->money);
		$money = empty($money)?0:$money;
		if(empty($id) || empty($reason) || empty($money))
			return json_encode(array('code'=>5,'result'=>'参数不全'));
		
		$description = $this->post->description;
		$description = empty($description)?'':$description;
		
		$imgs = array();
		if(isset($_FILES['img']))
		{
			$image = new image();
			$imgs = $this->file->receiveMultiFile($_FILES['img'], config('file'));
			foreach ($imgs as &$img)
			{
				$img = $image->resizeImage($img, 640, 320);
			}
		}
		
		if(login::user())
		{
			$orderModel = $this->model('orderlist');
			$order = $orderModel->get($id);
			if(empty($order))
				return json_encode(array('code'=>3,'result'=>'订单不存在'));
			if(!in_array($order['status'], array(orderlistModel::STATUS_COMPLETE,orderlistModel::STATUS_PAYED,orderlistModel::STATUS_SHIPPED,orderlistModel::STATUS_SHIPPING)))
				return json_encode(array('code'=>4,'result'=>'该订单不允许退款或者已经退款'));
			$refundModel = $this->model('refund');
			if($refundModel->create($this->session->id,$id,$type,$reason,$money,$description,$imgs))
			{
				$orderModel->refund($id);
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
		//订单id
		$id = filter::int($this->post->id);
		if(login::user())
		{
			$refundModel = $this->model('refund');
			if($refundModel->close($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'取消失败'));
		}
		return json_encode(array('code'=>2,'result'=>'尚未登陆'));
	}
}