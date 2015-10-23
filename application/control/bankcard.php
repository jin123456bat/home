<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use application\message\json;
/**
 * 银行卡控制器
 * @author jin12
 *
 */
class bankcardControl extends control
{
	/**
	 * 增加
	 */
	function create()
	{
		if (login::user())
		{
			$uid = $this->session->id;
			$bank = $this->post->bank;
			$number = $this->post->number;
			$name = $this->post->name;
			$type = intval($this->post->type);
			$subbank = $this->post->subbank;
			$province = intval($this->post->province);
			$city = intval($this->post->city);
			
			if($type == 2)
			{
				if (empty($province))
					$province = NULL;
				if (empty($city))
					$city = NULL;
			}
			
			if(empty($bank) || empty($number) || empty($name))
				return new json(json::PARAMETER_ERROR,'参数错误');
			$bankcardModel = $this->model('bankcard');
			if($bankcardModel->create($uid,$bank,$number,$name,$subbank,$province,$city,$type))
			{
				return new json(json::OK);
			}
			return new json(json::PARAMETER_ERROR);
		}
		else
		{
			return new json(json::NOT_LOGIN);
		}
	}
	
	/**
	 * 列表 假如是用户的话则获取的为用户的列表
	 */
	function lists()
	{
		$start = $this->get->start;
		$length = $this->get->length;
		$start = empty($start)?0:$start;
		$length = empty($length)?10:$length;
		
		$filter = array(
			'start' => 0,
			'length' => $length,
			'order' => array('bankcard.id','desc')
		);
		
		if(login::user())
		{
			$filter['uid'] = $this->session->id;	
		}
		$filter['parameter'] = 'bankcard.bank,bankcard.name,bankcard.number,bankcard.subbank,bankcard.type,province.name as province,city.name as city,bankcard.id,bankcard.uid,province.id as provinceid,city.id as cityid';
		$bankcardModel = $this->model('bankcard');
		$result = $bankcardModel->fetch($filter);
		
		return new json(json::OK,NULL,$result);
	}
	
	/**
	 * 信息
	 */
	function information()
	{
		$id = $this->get->id;
		$parameter = 'bankcard.bank,bankcard.name,bankcard.number,bankcard.subbank,bankcard.type,province.name as province,city.name as city,bankcard.id,bankcard.uid,province.id as provinceid,city.id as cityid';
		$result = $this->model('bankcard')->get($id,$parameter);
		return new json(json::OK,NULL,$result);
	}
	
	/**
	 * 删除
	 */
	function remove()
	{
		$id = $this->post->id;
		if($this->model('bankcard')->remove($id))
		{
			return new json(json::OK);
		}
		return new json(json::PARAMETER_ERROR,'银行卡不存在');
	}
	
	/**
	 * 改
	 */
	function save()
	{
		$id = $this->post->id;
		$data = $this->post->data;
		if(!is_array($data))
			return new json(json::PARAMETER_ERROR);
		if($this->model('bankcard')->save($id,$data))
		{
			return new json(json::OK);
		}
		return new json(json::PARAMETER_ERROR);
	}
}