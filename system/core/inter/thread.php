<?php
namespace system\core\inter;

interface thread
{

	function __construct()
	{
		set_time_limit(0);
	}

	public function run();
}