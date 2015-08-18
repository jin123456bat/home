<?php
namespace application\classes;
/**
 * prototypeHelper
 * @author jin12
 *
 */
class prototype
{
	/**
	 * 将属性数组转化为可阅读的字符串
	 */
	function format($prototype_array,$collection)
	{
		$collection = unserialize($collection);
		$return = '';
		
		foreach($prototype_array as $prototype)
		{
			if($prototype['type'] == 'text')
			{
				$return .= ($prototype['name'].':'.$prototype['value'].',');
			}
			else
			{
				foreach ($collection as $key=>$value)
				{
					if($key == $prototype['id'])
					{
						$return .= ($prototype['name'].':'.$prototype['value'][$value]);
					}
				}
			}
		}
		return rtrim($return,',');
	}
}