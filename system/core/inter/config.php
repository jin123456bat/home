<?php
namespace system\core\inter;

class config implements \ArrayAccess
{

	/**
	 *
	 * @param $dirname 配置保存位置
	 *        	永久保存当前配置
	 */
	function save($dirname)
	{
		$classname = get_class($this);
		$data = "<?php\n";
		$data .= "class " . $classname . " extends config\n";
		$data .= "{\n";
		$data .= "\tfunction __construct()";
		$data .= "\t{\n";
		foreach($this as $key => $value)
		{
			$data .= "\t\t\$this->" . $key . " = '" . $value . "';\n";
		}
		$data .= "\t}\n";
		$data .= "}\n";
		$data .= "?>";
		file_put_contents(rtrim($dirname, '/') . '/' . $classname . '.php', $data, 0);
	}

	public function offsetSet($offset, $value)
	{
		$this->$offset = $value;
	}

	public function offsetExists($offset)
	{
		return isset($this->$offset);
	}

	public function offsetUnset($offset)
	{
		unset($this->$offset);
	}

	public function offsetGet($offset)
	{
		return isset($this->$offset) ? $this->$offset : null;
	}

	/**
	 * 添加配置
	 */
	public function add($key, $value)
	{
		$this->$key = $value;
	}

	/**
	 * 删除配置
	 *
	 * @param unknown $key        	
	 */
	public function delete($key)
	{
		unset($this->$key);
	}

	/**
	 * 关联配置文件，后面的配置变量覆盖前面的配置变量
	 */
	public function combine(config $config)
	{
		$tempConfig = $this;
		foreach($config as $parameter => $value)
		{
			$tempConfig[$parameter] = $value;
		}
		return $tempConfig;
	}
}
?>