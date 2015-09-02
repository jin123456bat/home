<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use system\core\filter;
use application\model\roleModel;
/**
 * 商品多属性和商品价格库存编号之间的映射关系控制器
 * @author jin12
 *
 */
class collectionControl extends control
{
	
	/**
	 * 根据商品pid，属性关系表，查询价格库存和编码
	 */
	function find()
	{
		$pid = filter::int($this->get->pid);
		$array = array();
		$a = explode(',', $this->get->content);
		foreach ($a as $b)
		{
			list($c,$d) = explode(':', $b);
			$array[$c] = $d;
		}
		if(!empty($array))
		{
			$collectionModel = $this->model('collection');
			$result = $collectionModel->find($pid,$array);
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}
	
	/**
	 * 更改映射关系对应的价格库存或者是商品编号  自动更新
	 */
	function updatevalue()
	{
		$roleModel = $this->model('role');
		if(login::admin() && $roleModel->checkPower($this->session->role,'product',roleModel::POWER_UPDATE))
		{
			$data = json_decode(htmlspecialchars_decode($this->post->data));
			$pid = $this->post->pid;
			$collectionModel = $this->model('collection');
			foreach ($data as $value)
			{
				$array = array();
				$type = $value->type;
				$did = $value->did;
				$val = $value->value;
				$didd = explode(',', $did);
				foreach ($didd as $a)
				{
					list($x,$y) = explode(':',$a);
					$array[$x] = $y;
				}
				$collectionModel->create($array,$pid,$type,$val);
			}
			return json_encode(array('code'=>1,'result'=>'ok'));
		}
		return json_encode(array('code'=>2,'result'=>'没有权限'));
	}
}