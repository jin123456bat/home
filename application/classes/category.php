<?php
namespace application\classes;

class category
{

	private $result;

	function __construct()
	{
		//$this->result = $result;
	}

	/**
	 * 格式化分类,使其适合下拉菜单
	 *
	 * @param unknown $result
	 *        	mysql中查找出来的结果集
	 */
	function format($cid = 0,$b,$deep = 0)
	{
		$a = array();
		foreach ($b as &$bt)
		{
			if($bt['cid'] == $cid)
			{
				$bt['name'] = $this->deep($deep).$bt['name'];
				$a[] = $bt;
				$z = $this->format($bt['id'], $b,$deep+1);
				if(!empty($z))
					$a = array_merge($a, $z);
			}
		}
		return $a;
	}
	
	function deep($deep)
	{
		$str = '';
		for ($i = 0;$i<$deep;$i++)
		{
			$str .= '&nbsp;';
		}
		return $str;
	}
}