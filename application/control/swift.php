<?php
namespace application\control;
use system\core\control;
use application\classes\login;
use application\message\json;
class swiftControl extends control
{
	/**
	 * 查看资金流水记录
	 */
	function lists()
	{
		$filter = array();
		if (login::user())
		{
			$filter['uid'] = $this->session->id;
		}
		else if (!login::admin())
		{
			return new json(json::NOT_LOGIN);
		}
		$start = empty($this->get->start)?0:$this->get->start;
		$start = intval($start);
		$length = empty($this->get->length)?10:$this->get->length;
		$length = intval($length);
		$filter['start'] = $start;
		$filter['length'] = $length;
		$filter['order'] = array(
			array(
				'time' => 'desc',
			),
			array(
				'id' => 'desc'		
			)
		);
		$result = $this->model('swift')->fetchAll($filter);
		return new json(json::OK,NULL,$result);
	}
}