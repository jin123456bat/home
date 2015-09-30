<?php
namespace application\thread;
use system\core\control;
class waybillsThread extends control
{
	function run()
	{
		$this->model('waybilsls')->query('TRUNCATE waybills');
	}
}