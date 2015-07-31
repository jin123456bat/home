<?php
namespace application\model;

use system\core\model;
use system\core\file;

class productimgModel extends model
{

	/**
	 * 搜索所有无效的图像数据
	 */
	function GetAndRemoveInvalidImg()
	{
		//select * from productimg where `productimg`.pid not in (select id from product)
		return $this->where('`productimg`.pid not in (select id from product)')->delete();
	}
	
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	function removeByPid($pid)
	{
		return $this->where('pid=?',array($pid))->delete();
	}

	function getByPid($pid)
	{
		return $this->where('pid=?', array(
			$pid
		))->select();
	}

	/**
	 * 更新pid信息
	 * 
	 * @param array $picid 设置图片对应的商品id      	
	 * @param unknown $pid        	
	 */
	function updatepid($picid, $pid)
	{
		if (! empty($picid)) {
			if (is_array($picid)) {
				foreach ($picid as $id) {
					$this->where('id=?', array(
						$id
					))->update('pid', $pid);
				}
			}
			else
			{
				$this->where('id=?',array($picid))->update('pid',$pid);
			}
		}
	}

	/**
	 * 添加一张图片信息
	 * 
	 * @param unknown $base
	 *        	基础图像地址
	 * @param unknown $small
	 *        	小图地址
	 * @param unknown $thumbnail
	 *        	缩略图地址
	 * @param string $pid        	
	 * @return array|false 插入成功返回插入的所有信息 失败false
	 */
	function add($base, $small, $thumbnail, $title, $orderby = 1, $pid = '')
	{
		$data = array(
			NULL,
			$pid,
			$title,
			$orderby,
			$base,
			$small,
			$thumbnail
		);
		$result = $this->insert($data);
		if ($result) {
			$data[0] = $this->lastInsertId();
			$data[4] = file::realpathToUrl($data[4]);
			$data[5] = file::realpathToUrl($data[5]);
			$data[6] = file::realpathToUrl($data[6]);
			return $data;
		}
		return false;
	}

	/**
	 * 获取一个图像信息
	 * 
	 * @param unknown $id        	
	 * @return NULL
	 */
	function get($id)
	{
		$result = $this->where('id=?', array(
			$id
		))->select();
		return isset($result[0]) ? $result[0] : NULL;
	}
}