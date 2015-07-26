<?php
namespace system\core;

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
	 * 载入数据库
	 */
	private function __loadDB()
	{
		$_dbConfig = config('db');
		include ROOT . '/system/core/db/' . $_dbConfig->db_type . '.php';
		$this->_db = \mysql::getInstance($_dbConfig);
	}

	/**
	 * 载入memcache
	 */
	private function __loadMemcache()
	{}

	/**
	 * 载入redis
	 */
	private function __loadRedis()
	{}

	public function select($field = '*')
	{
		$sql = 'select ' . $field . ' from ' . $this->_table . ' ' . $this->_temp['where'];
		$result = $this->_db->query($sql, empty($this->_temp['where']) ? array() : $this->_temp['array']);
		unset($result);
		return $result;
	}

	/**
	 * 增加条件
	 * 
	 * @param unknown $sql        	
	 * @param unknown $array        	
	 * @return \system\core\model
	 */
	public function where($sql, $array = array())
	{
		if (isset($this->_temp['where'])) {
			$this->_temp['where'] = $this->_temp['where'] . ' and ' . $sql;
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
		$sql = 'insert into ' . $this->_table . ' values (' . $parameter . ')';
		$result = $this->_db->query($sql, $array);
		unset($this->_temp);
		return $result;
	}

	/**
	 * 更改
	 * 
	 * @param unknown $key        	
	 * @param unknown $value        	
	 * @return Ambigous <boolean, multitype:>
	 */
	public function update($key, $value)
	{
		$sql = 'update ' . $this->_table . ' set ' . $key . ' = ? ' . $this->_temp['where'];
		$result = $this->_db->query($sql, array_merge(array(
			$value
		), $this->_temp['array']));
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
		$sql = 'update ' . $this->_table . ' set ' . $key . ' = ' . $key . ' + ? ' . $this->_temp['where'];
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
	public function delete()
	{
		$sql = 'delete from ' . $this->_table . ' ' . $this->_temp['where'];
		$result = $this->_db->query($sql, $this->_temp['array']);
		unset($this->_temp);
		return $result;
	}
}