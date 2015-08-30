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
	 * 添加商品到满减优惠
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
				{
					switch ($resut['activity'])
					{
						case 'sale':$result = '限时优惠';break;
						case 'seckill':$result = '秒杀';break;
						case 'fullcut':$result = '满减';break;
					}
					return json_encode(array('code'=>2,'result'=>'该商品已经参加了'.$result.',请先移除原活动在推送'));
				}
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
	
	/**
	 * 从满减优惠中移除商品
	 */
	function remove()
	{
		$this->response->addHeader('Content-Type','application/json');
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'fullcut',roleModel::POWER_UPDATE))
		{
			$pid = filter::int($this->post->pid);
			$fid = filter::int($this->post->fid);
			$fullcutdetailModel = $this->model('fullcutdetail');
			if($fullcutdetailModel->remove($fid,$pid))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'移除失败'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
}