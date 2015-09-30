<?php
namespace application\thread;
use system\core\control;
class logThread extends control
{
	function run()
	{
		$logModel = $this->model('log');
		$logModel->query('TRUNCATE log');
	}
}