<?php
namespace application\classes;

require_once ROOT.'/vendor/autoload.php';

use JPush\Model as JPushModel;
use JPush\JPushClient;
use JPush\Exception\APIConnectionException;
use JPush\Exception\APIRequestException;
/**
 * 极光推送客户端
 * @author jin12
 *
 */
class jpush
{
	private $_app_key;
	
	private $_master_secret;
	
	function __construct($app_key,$master_secret)
	{
		$this->_app_key = $app_key;
		$this->_master_secret = $master_secret;
	}
	
	function send($content)
	{
		$br = '<br/>';
		$client = new JPushClient($this->_app_key, $this->_master_secret);
		
		$result = $client->push()
		->setPlatform(JPushModel\all)
		->setAudience(JPushModel\all)
		->setNotification(JPushModel\notification($content))
		->send();
		return $result;
	}
}