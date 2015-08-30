<?php
namespace application\classes;
class time
{
	/**
	 * 将单位为分钟的转化为小时或秒
	 */
	function format($minutes,$output)
	{
		if($output)
		{
			if($minutes >= 60)
			{
				$hour = (int)($minutes/60);
				if($hour >= 24)
				{
					$day = (int)($hour/24);
					return $day.'d';
				}
				else
				{
					return $hour.'h';
				}
			}
			else
			{
				return $minutes.'m';
			}
		}
		else
		{
			return $minutes*60;
		}
	}
}