<?php
namespace application\classes;

class email
{

	private $_instance;

	function __construct($config)
	{
		include_once ROOT . '/extends/phpmailer/class.phpmailer.php';
		$this->_instance = new \PHPMailer();
		$this->_instance->host = $config['server'];
		$this->_instance->IsSMTP();
		$this->_instance->SMTPAuth = $config['auth'];
		$this->_instance->Username = $config['user'];
		$this->_instance->Password = $config['pass'];
		$this->_instance->SMTPSecure = $config['SMTPSecure'];
		$this->_instance->Port = $config['smtp_port'];
		$this->_instance->From = $config['from'];
		$this->_instance->FromName = $config['fromname'];
		$this->_instance->isHTML($config['html']);
		$this->_instance->PluginDir = ROOT.'/extends/phpmailer/';
	}

	function send($address, $subject, $content, $cc = '', $bcc = '')
	{
		if (is_array($address))
			call_user_func_array(array(
				$this->_instance,
				'addAddress'
			), $address);
		else
			$this->_instance->AddAddress($address);
		
		if (! empty($cc)) {
			if (is_array($cc)) {
				foreach ($cc as $address) {
					$this->_instance->AddCC($address);
				}
			}
		}
		
		if (! empty($bcc)) {
			if (is_array($bcc)) {
				call_user_func_array(array(
					$this->_instance,
					'AddBCC'
				), $bcc);
			} else {
				$this->_instance->AddBCC($bcc);
			}
		}
		$this->_instance->Subject = $subject;
		$this->_instance->Body = $content;
		$this->_instance->AltBody = $content;
		return $this->_instance->Send();
	}
}
?>