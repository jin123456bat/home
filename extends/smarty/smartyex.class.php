<?php
/**
 * smarty扩展类
 * @author jcc
 *
 */
class smartyex extends functional
{
	function __construct()
	{
		
	}
	
	/**
	 * 将秒数计算为x日y小时z分w秒的形式
	 * @param unknown_type $time
	 */
	public function extra_time($time)
	{
		$day = floor($time/(60*60*24));
		$hour = floor(($time - $day*60*60*24)/(60*60));
		$second = $time%60;
		$minutes = floor(($time - $day*60*60*24 - $hour*60*60)/60);
		echo (empty($day)?'':$day.'天').(empty($hour)?'':$hour.'小时').(empty($minutes)?'':$minutes.'分').$second.'秒';
	}
}