<?php
namespace application\control;

use system\core\control;
use system\core\filter;
/**
 * 商品属性控制器
 * @author jin12
 *
 */
class prototypeControl extends control
{
	/**
	 * 增加商品的附加属性
	 * @return string
	 */
	function create()
	{
		$pid = empty(filter::int($this->post->id))?0:filter::int($this->post->id);
		$prototype = json_decode(htmlspecialchars_decode($this->post->prototype));
		if(empty($prototype))
			return json_encode(array('code'=>2,'result'=>'属性格式不合法'));
		$name = $prototype->name;
		$type = $prototype->type;
		$value = $prototype->value;
		
		$prototypeModel = $this->model('prototype');
		$id = $prototypeModel->create($name,$type,$value,$pid);
		if(!empty($id))
		{
			if($type == 'radio')
			{
				//移除所有属性组合
				$collectionModel = $this->model('collection');
				$collectionModel->remove($pid);
			}
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$id));
		}
		return json_encode(array('code'=>0,'result'=>'failed'));
	}
	
	/**
	 * 获取商品的附加属性
	 */
	function product()
	{
		$this->response->addHeader('Cache-Control','nocache');
		$pid = filter::int($this->get->pid);
		$prototypeModel = $this->model('prototype');
		$result = $prototypeModel->getByPid($pid);
		return json_encode(array('code'=>1,'result'=>'ok','body'=>$result));
	}
	
	/**
	 * 移除商品的额外属性
	 * @return string
	 */
	function remove()
	{
		$id = filter::int($this->post->id);
		if (!empty($id)) {
			$prototypeModel = $this->model('prototype');
			if($prototypeModel->remove($id))
			{
				return json_encode(array('code'=>1,'result'=>'ok'));
			}
			return json_encode(array('code'=>0,'result'=>'删除失败'));
		}
		return json_encode(array('code'=>2,'result'=>'参数错误'));
	}
}