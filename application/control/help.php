<?php
namespace application\control;

use system\core\control;
use system\core\filter;
class helpControl extends control
{
	/**
	 * 
	 * 帮助页面
	 */
	function page()
	{
		$id = filter::int($this->get->id);
		$helpModel = $this->model('help');
		$result = $helpModel->get($id);
		if(isset($result['content']))
		{
			return json_encode(array('code'=>1,'result'=>'ok','body'=>$result['content']));
		}
		return json_encode(array('code'=>0,'result'=>'no contents'));
	}
}