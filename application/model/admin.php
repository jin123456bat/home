<?php
namespace application\model;

use system\core\model;
class adminModel extends model
{
	function __construct($table)
	{
		$this->_table = $table;
	}
}