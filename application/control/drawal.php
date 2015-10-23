<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use application\message\json;
use application\model\swiftModel;
class drawalControl extends control
{
	/**
	 * 提现申请
	 */
	function create()
	{
		if(!login::user())
			return new json(json::NOT_LOGIN);
		$id = $this->session->id;
		$note = empty($this->post->note)?'':$this->post->note;
		$money = floatval($this->post->money);
		if($money <= 0)
			return new json(json::PARAMETER_ERROR,'提现金额不能为空');
		$bid = $this->post->bid;
		if (empty($bid))
			return new json(json::PARAMETER_ERROR,'提现银行卡不能为空');
		$userModel = $this->model('user');
		$user = $userModel->get($id);
		if(empty($user))
			return new json(json::PARAMETER_ERROR,'用户不存在');
		$money = $money<$user['money']?$money:$user['money'];
		$drawalModel = $this->model('drawal');
		if($drawalModel->create($id,$money,$note,$bid))
		{
			//更改用户余额
			$userModel->where('id=?',array($id))->increase('money',-$money);
			return new json(json::OK);
		}
		return new json(json::PARAMETER_ERROR,'提现账户不存在');
	}
	
	/**
	 * 取消提现申请
	 */
	function quit()
	{
		if(!login::user())
			return new json(json::NOT_LOGIN);
		$id = $this->post->id;
		$uid = $this->session->id;
		$drawalModel = $this->model('drawal');
		$drawal = $drawalModel->get($id);
		if(empty($drawal))
			return new json(json::PARAMETER_ERROR,'提现请求不存在');
		if($drawal['handle'] == 0)
		{
			if($drawalModel->handle($id,2))
			{
				$userModel = $this->model('user');
				$userModel->where('id=?',array($uid))->increase('money',$drawal['money']);
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR,'提现已经取消');
		}
		return new json(json::PARAMETER_ERROR,'该提现无法取消');
	}
	
	/**
	 * 提现请求完成
	 */
	function complete()
	{
		if(login::admin())
		{
			$id = $this->post->id;
			$drawalModel = $this->model('drawal');
			$drawal = $drawalModel->get($id);
			if($drawal['handle'] != 0)
				return new json(json::PARAMETER_ERROR,'提现请求无法完成');
			if($drawalModel->handle($id,1))
			{
				$this->model('swift')->create($drawal['uid'],swiftModel::SWIFT_OUT,$drawal['money'],'提现');
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR,'提现请求已经完成');
		}
		return new json(json::NOT_LOGIN);
	}
	
	/**
	 * 提现请求列表
	 */
	function lists()
	{
		$start = intval($this->get->start);
		$length = intval($this->get->length);
		$start = empty($start)?0:$start;
		$length = empty($length)?10:$length;
		
		$filter = array(
			'start' => $start,
			'length' => $length,
			'order' => array('drawal.time','desc')
		);
		
		if(login::user())
		{
			$filter['uid'] = $this->session->id;
		}
		else if (!login::admin())
		{
			return new json(json::NOT_LOGIN);
		}
		$filter['parameter'] = 'drawal.money,drawal.handle,drawal.handletime,drawal.time,drawal.id,user.username,user.telephone,bankcard.number,bankcard.name,bankcard.bank';
		$drawalModel = $this->model('drawal');
		$result = $drawalModel->fetch($filter);
		
		return new json(json::OK,NULL,$result,true);
	}
}