<?php
namespace application\model;

use system\core\model;
use system\core\file;
use system\core\filesystem;

class productimgModel extends model
{
	function __construct($table)
	{
		parent::__construct($table);
	}
	
	/**
	 * 清除产品下的所有图像包括文件
	 * @param unknown $pid
	 * @return \system\core\Ambigous
	 */
	function removeByPid($pid)
	{
		$imgs = $this->where('pid=?',array($pid))->select();
		foreach ($imgs as $img)
		{
			filesystem::unlink($img['small_path']);
			filesystem::unlink($img['base_path']);
			filesystem::unlink($img['thumbnail_path']);
			filesystem::unlink($img['oldimage']);
		}
		return $this->where('pid=?',array($pid))->delete();
	}

	/**
	 * 获得产品的图像信息
	 * @param unknown $pid
	 * @param string $name
	 * @return Ambigous <boolean, multitype:>
	 */
	function getByPid($pid,$name = '*')
	{
		$this->orderby('orderby','desc');
		$result = $this->where('pid=?', array(
			$pid
		))->select($name);
		foreach ($result as &$img)
		{
			$img['oldimage'] = empty($img['oldimage'])?'':file::realpathToUrl($img['oldimage']);
			$img['base_path'] = empty($img['base_path'])?'':file::realpathToUrl($img['base_path']);
			$img['small_path'] = empty($img['small_path'])?'':file::realpathToUrl($img['small_path']);
			$img['thumbnail_path'] = empty($img['thumbnail_path'])?'':file::realpathToUrl($img['thumbnail_path']);
		}
		return $result;
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
	function add($oldimage,$base, $small, $thumbnail, $title, $orderby = 1, $pid = 0)
	{
		$data = array(
			NULL,
			$pid,
			$title,
			$orderby,
			$oldimage,
			$base,
			$small,
			$thumbnail
		);
		$result = $this->insert($data);
		if ($result) {
			$data[0] = $this->lastInsertId();
			$data[5] = file::realpathToUrl($data[5]);
			$data[6] = file::realpathToUrl($data[6]);
			$data[7] = file::realpathToUrl($data[7]);
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
	
	/**
	 * 删除图像信息
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		$result = $this->where('id=?',array($id))->select();
		if(!empty($result))
		{
			$result = $result[0];
			filesystem::unlink($result['small_path']);
			filesystem::unlink($result['base_path']);
			filesystem::unlink($result['thumbnail_path']);
			return $this->where('id=?',array($id))->delete();
		}
		return false;
	}
}