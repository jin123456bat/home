<?php
namespace application\model;
use system\core\model;
/**
 * 物流缓存信息
 * @author jin12
 *
 */
class waybillsModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 添加或更新运单信息
	 * @param unknown $postmode
	 * @param unknown $content
	 * @param array $waybills
	 * @param unknown $orderno
	 * @return \system\core\Ambigous
	 */
	function create($postmode,$content,array $waybills,$orderno)
	{
		$content = is_array($content)?json_encode($content):$content;
		$waybills = serialize($waybills);
		
		if(empty($this->query($orderno)))
		{
			$data = array(
				'NULL',
				$_SERVER['REQUEST_TIME'],
				$postmode,
				$content,
				$waybills,
				$orderno
			);
			return $this->insert($data);
		}
		else
		{
			$data = array(
				'time' => $_SERVER['REQUEST_TIME'],
				'content' => $content,
			);
			return $this->where('orderno=?',array($orderno))->update($data);
		}
	}
	
	function getByOrderno($orderno)
	{
		$result = $this->where('orderno=?',array($orderno))->select();
		if(isset($result[0]))
			return $result[0];
		return NULL;
	}
}