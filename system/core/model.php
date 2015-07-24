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
		include ROOT.'/system/core/db/'.$_dbConfig->db_type.'.php';
		$this->_db = \mysql::getInstance($_dbConfig);
	}
	
	/**
	 * 载入memcache
	 */
	private function __loadMemcache()
	{
		
	}
	
	/**
	 * 载入redis
	 */
	private function __loadRedis()
	{
		
	}
	
	public function select($field = '*')
	{
		$sql = 'select '.$field.' from '.$this->_table.' '.$this->_temp['where'];
		return $this->_db->query($sql,empty($this->_temp['where'])?array():$this->_temp['array']);
	}
	
	public function where($sql,$array = array())
	{
		$this->_temp['where'] = 'where'.' '.$sql;
		$this->_temp['array'] = $array;
		return $this;
	}
	
	public function insert(array $array)
	{
		$parameter = '';
		foreach ($array as $key => $value)
		{
			if(is_int($key))
			{
				$parameter .= '?,';
			}
			else
			{
				$parameter .= ':'.$key.',';
			}
		}
		$parameter = rtrim($parameter,',');
		$sql = 'insert into '.$this->_table.' values ('.$parameter.')';
		return $this->_db->query($sql,$array);
	}
	
	public function update($key,$value)
	{
		$sql = 'update '.$this->_table.' set '.$key.' = ? '.$this->_temp['where'];
		return $this->_db->query($sql,array_merge(array($value),$this->_temp['array']));
	}
	
	public function increase($key,$num = 1)
	{
		$sql = 'update '.$this->_table.' set '.$key.' = '.$key.' + ? '.$this->_temp['where'];
		return $this->_db->query($sql,array_merge(array($num),$this->_temp['array']));
	}
}