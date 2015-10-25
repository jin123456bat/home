<?php
namespace application\model;
use system\core\model;
class menuModel extends model
{
	/**
	 * 添加菜单
	 * @param unknown $name
	 * @param unknown $type
	 * @param unknown $key
	 * @param string $pid
	 * @return \system\core\Ambigous
	 */
	function create($name,$type,$key,$pid = NULL)
	{
		$data = array(
			'id' => NULL,
			'name' => $name,
			'type' => $type,
			'keyword' => $key,
			'pid' => $pid
		);
		return $this->insert($data);
	}
	
	/**
	 * 删除菜单
	 * @param unknown $id
	 * @return \system\core\Ambigous
	 */
	function remove($id)
	{
		return $this->where('id=?',array($id))->delete();
	}
	
	/**
	 * 转化为微信数据格式
	 */
	function toWeiXin()
	{
		$result = $this->select();
		$temp = array();
		foreach($result as &$menu)
		{
			$menu['key'] = $menu['keyword'];
			unset($menu['keyword']);
			if($menu['pid'] === NULL)
			{
				$temp[] = $menu;
				unset($menu);
			}
		}
		foreach($temp as &$menu)
		{
			foreach($result as $submenu)
			{
				if($menu['id'] == $submenu['pid'])
				{
					unset($submenu['id']);
					unset($submenu['pid']);
					$menu['sub_button'][] = $submenu;
					unset($menu['type']);
					unset($menu['key']);
					unset($menu['pid']);
					unset($menu['id']);
					continue;
				}
			}
		}
		foreach ($temp as &$menu)
		{
			unset($menu['id']);
			unset($menu['pid']);
		}
		return $temp;
		
	}
	
	/**
	 * 配合前段使用
	 */
	function fetchAll()
	{
		$result = $this->select();
		$temp = array();
		foreach($result as &$menu)
		{
			$menu['key'] = $menu['keyword'];
			unset($menu['keyword']);
			if($menu['pid'] === NULL)
			{
				$temp[] = $menu;
				unset($menu);
			}
		}
		foreach($result as $submenu)
		{
			foreach($temp as &$menu)
			{
				if($menu['id'] == $submenu['pid'])
				{
					$menu['sub_button'][] = $submenu;
				}
			}
		}
		return $temp;
	}
	
	/**
	 * 获得菜单长度
	 * @return number
	 */
	function checkMenuLength($id = NULL)
	{
		if ($id === NULL)
			$result = $this->where('pid is ?',array($id))->select();
		else 
			$result = $this->where('pid=?',array($id))->select();
		return count($result);
	}
}