<?php
namespace system\core;

use system\core\db\mysql;
/**
 * 数据模型
 *
 * @author 程晨
 *        
 */
class model
{

	private $_db;

	private $_memcache;

	private $_redis;

	private $_table;

	private $_temp;

	function __construct($table)
	{
		$this->_table = $table;
		$this->__loadDB();
		$this->__loadMemcache();
		$this->__loadRedis();
	}
	
	/**
	 * 额外加载一张数据表
	 * @param unknown $table
	 */
	protected function model($table)
	{
		$this->_table = $table;
		return $this;
	}

	/**
	 * 载入数据库
	 */
	private function __loadDB()
	{
		$_dbConfig = config('db');
		$this->_db = mysql::getInstance($_dbConfig);
	}

	/**
	 * 载入memcache
	 */
	private function __loadMemcache()
	{
		if(memcached::ready())
		{
			$this->_memcache = new memcached(config('memcached'));
		}
	}

	/**
	 * 载入redis
	 */
	private function __loadRedis()
	{
		
	}

	public function select($field = '*')
	{
		$sql = 'select ' . $field . ' from ' . $this->_table.(isset($this->_temp['table'])?$this->_temp['table']:'') . ' ' . (isset($this->_temp['where'])?$this->_temp['where']:'') .(isset($this->_temp['groupby'])?$this->_temp['groupby']:'').' '.(isset($this->_temp['orderby'])?$this->_temp['orderby']:'').' '.(isset($this->_temp['limit'])?$this->_temp['limit']:'');
		$result = $this->_db->query($sql, empty($this->_temp['where']) ? array() : $this->_temp['array']);
		unset($this->_temp);
		return $result;
	}

	/**
	 * 增加条件
	 * 
	 * @param string $sql        	
	 * @param array $array        	
	 * @return \system\core\model
	 */
	public function where($sql, array $array = array(),$combine = 'and')
	{
		if (isset($this->_temp['where'])) {
			$this->_temp['where'] = $this->_temp['where'] .' '. $combine.' ' . $sql;
		} else {
			$this->_temp['where'] = 'where' . ' ' . $sql;
		}
		if (isset($this->_temp['array'])) {
			$this->_temp['array'] = array_merge($this->_temp['array'], $array);
		} else {
			$this->_temp['array'] = $array;
		}
		return $this;
	}

	/**
	 * 插入
	 * 
	 * @param array $array        	
	 * @return Ambigous <boolean, multitype:>
	 */
	public function insert(array $array)
	{
		$parameter = '';
		foreach ($array as $key => $value) {
			if (is_int($key)) {
				$parameter .= '?,';
			} else {
				$parameter .= ':' . $key . ',';
			}
		}
		$parameter = rtrim($parameter, ',');
		$sql = 'insert into ' . $this->_table.(isset($this->_temp['table'])?$this->_temp['table']:'') . ' values (' . $parameter . ')';
		$result = $this->_db->query($sql, $array);
		unset($this->_temp);
		return $result;
	}

	/**
	 * 更改
	 * 
	 * @param string|array $key
	 * @param string|NULL $value        	
	 * @return Ambigous <boolean, multitype:>
	 */
	public function update($key, $value = '')
	{
		if(is_array($key))
		{
			$parameter = '';
			$value = array();
			foreach ($key as $a => $b)
			{
				$parameter .= ($a.' = ?,');
				$value[] = $b;
			}
			$parameter = rtrim($parameter,',');
			$sql = 'update '.$this->_table.(isset($this->_temp['table'])?$this->_temp['table']:'').' set '.$parameter.' '.$this->_temp['where'];
		}
		else
		{
			$sql = 'update '. $this->_table.(isset($this->_temp['table'])?$this->_temp['table']:'') . ' set ' . $key . ' = ? ' . $this->_temp['where'];
			$value = array($value);
		}
		$value = isset($this->_temp['array'])?array_merge($value,$this->_temp['array']):$value;
		$result = $this->_db->query($sql, $value);
		unset($this->_temp);
		return $result;
	}

	/**
	 * 自增
	 * 
	 * @param unknown $key        	
	 * @param number $num        	
	 * @return Ambigous <boolean, multitype:>
	 */
	public function increase($key, $num = 1)
	{
		$sql = 'update ' . $this->_table.(isset($this->_temp['table'])?$this->_temp['table']:'') . ' set ' . $key . ' = ' . $key . ' + ? ' . $this->_temp['where'];
		$result = $this->_db->query($sql, array_merge(array(
			$num
		), $this->_temp['array']));
		unset($this->_temp);
		return $result;
	}

	/**
	 * 删除
	 * 
	 * @return Ambigous <boolean, multitype:>
	 */
	public function delete($table = '')
	{
		$sql = 'delete '.$table.(isset($this->_temp['table'])?$this->_temp['table']:'').' from ' . $this->_table . ' ' . $this->_temp['where'];
		$result = $this->_db->query($sql, $this->_temp['array']);
		unset($this->_temp);
		return $result;
	}
	
	/**
	 * 增加限制规则
	 * @param unknown $start
	 * @param number $length
	 * @return \system\core\model
	 */
	public function limit($start,$length = 0)
	{
		if(empty($length))
			$this->_temp['limit'] = 'limit '.$start;
		else
			$this->_temp['limit'] = 'limit '.$start.','.$length;
		return $this;
	}
	
	/**
	 * 添加排序规则,最先添加的排序规则比重大于后面的排序规则
	 * @param string $field 排序字段
	 * @param string $asc 排序规则 默认为asc从小到大
	 * @return $this
	 */
	public function orderby($field,$asc = 'asc')
	{
		if(isset($this->_temp['orderby']))
		{
			$this->_temp['orderby'] = $this->_temp['orderby'].','.$field.' '.$asc;
		}
		else
		{
			$this->_temp['orderby'] = 'order by '.$field.' '.$asc;
		}
		return $this;
	}
	
	/**
	 * 添加分组查询条件
	 */
	public function groupby($group)
	{
		$this->_temp['groupby'] = ' group by '.$group;
	}
	
	
	/**
	 * 增加搜索表
	 * @param unknown $table
	 * @param string $mode
	 * @param string $on
	 */
	public function table($table,$mode = ',',$on = '')
	{
		if(!isset($this->_temp['table']))
		{
			$this->_temp['table'] = ' '.$mode.' '.$table.' on '.$on;
		}
		else
		{
			$this->_temp['table'] .= ' '.$mode.' '.$table.' on '.$on;
		}
	}
	
	public function query($sql,array $array = array())
	{
		return $this->_db->query($sql,$array);
	}
	
	public function transaction()
	{
		return $this->_db->transaction();
	}
	
	public function commit()
	{
		return $this->_db->commit();
	}
	
	public function rollback()
	{
		return $this->_db->rollback();
	}
	
	public function lastInsertId()
	{
		return $this->_db->lastInsert();
	}
}