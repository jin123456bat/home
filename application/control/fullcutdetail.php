<?php
namespace application\control;
use system\core\control;
use system\core\filter;
use application\model\roleModel;
use application\classes\login;
/**
 * 满减优惠控制器
 * @author jin12
 *
 */
class fullcutdetailControl extends control
{
	/**
	 * 添加满减优惠
	 */
	function create()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'fullcut',roleModel::POWER_INSERT))
		{
			$fid = filter::int($this->post->fid);
			$pid = filter::int($this->post->pid);
			if(!(empty($fid) || empty($pid)))
			{
				$productModel = $this->model('product');
				$resut = $productModel->get($pid);
				if(empty($resut) || !empty($resut['activity']))
					return json_encode(array('code'=>2,'result'=>'该商品已经有优惠政策了或者商品不存在'));
				$fullcutdetailModel = $this->model('fullcutdetail');
				if(!$fullcutdetailModel->exist($pid))
				{
					if($fullcutdetailModel->create($fid,$pid))
					{
						$productModel->setActivity($pid,'fullcut');
						return json_encode(array('code'=>1,'result'=>'ok'));
					}
					return json_encode(array('code'=>0,'result'=>'添加失败'));
				}
				else
				{
					return json_encode(array('code'=>3,'result'=>'已经存在于优惠当中了'));
				}
			}
			return json_encode(array('code'=>5,'result'=>'参数错误'));
		}
		return json_encode(array('code'=>6,'result'=>'没有权限'));
	}
}