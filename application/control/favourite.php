<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use system\core\filter;
/**
 * 用户的收藏控制器
 * @author jin12
 *
 */
class favouriteControl extends control
{
	/**
	 * 获得收藏列表
	 */
	function getlist()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$start = filter::int($this->get->start);
		$length = filter::int($this->get->length);
		$status = filter::int($this->get->status);
		$favouriteModel = $this->model('favourite');
		$result = $favouriteModel->fetchAll($this->session->id,$start,$length,$status);
		foreach($result as &$good)
		{
			$good['prototype'] = $this->model('prototype')->getByPid($good['pid']);
			$good['img'] = $this->model('productimg')->getByPid($good['pid']);
			switch ($good['activity'])
			{
				case 'fullcut':$good['activity_description'] = $this->model('fullcutdetail')->getByPid($good['pid']);break;
				case 'sale':$good['activity_description'] = $this->model('sale')->getByPid($good['pid']);break;
				case 'seckill':$good['activity_description'] = $this->model('seckill')->getByPid($good['pid']);break;
				default:break;
			}
			$good['origin'] = $this->model('flag')->getOrigin($good['origin']);
		}
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 添加收藏
	 */
	function create()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$pid = filter::int($this->post->pid);
		if(!empty($pid))
		{
			if($this->model('favourite')->create($this->session->id,$pid))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'已经收藏过了'));
		}
		return json_encode(array('code'=>3,'result'=>'参数不能为空'));
	}
	
	
	/**
	 * 移除收藏
	 */
	function remove()
	{
		if(!login::user())
			return json_encode(array('code'=>2,'result'=>'尚未登陆'));
		$id = filter::int($this->post->id);
		$pid = filter::int($this->post->pid);
		if(empty($pid) && empty($id))
		{
			return json_encode(array('code'=>3,'result'=>'参数不全'));
		}
		if($this->model('favourite')->remove($id,$pid,$this->session->id))
		{
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}
}