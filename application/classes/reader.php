<?php
namespace application\classes;

class reader
{
	function txt($file)
	{
		if(file_exists($file))
		{
			return file($file);
		}
	}
}