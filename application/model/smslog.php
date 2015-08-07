<?php
namespace application\model;

use system\core\model;
/**
 * 短信日志数据模型
 * @author jin12
 *
 */
class smslogModel extends model
{
	/**
	 * @param unknown $telephone
	 * @param unknown $content
	 */
	function create($telephone,$code)
	{
		$data = array(NULL,$telephone,$code,$_SERVER['REQUEST_TIME']);
		return $this->insert($data);
	}
	
	/**
	 * 检查短信验证码或者检查手机号是否可以发送短信
	 * 3分钟3条短信
	 * @param unknown $telephone
	 * @param string $code
	 */
	function check($telephone,$code = NULL)
	{
		if(empty($code))
		{
			$this->where('time > ?',array($_SERVER['REQUEST_TIME'] - 180));
			$result = $this->where('telephone=?',array($telephone))->select('count(*)');
			return (!isset($result[0]['count(*)'])) || ($result[0]['count(*)'] <= 3);
		}
		else
		{
			$this->where('time>?',array($_SERVER['REQUEST_TIME'] - 1800));
			$result = $this->where('code=? and telephone=?',array($code,$telephone))->select('count(*)');
			return (isset($result[0]['count(*)']) && $result[0]['count(*)']>0);
		}
	}
}