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
}