<?php
function call($control,$action, $array = array())
{
	$host = '127.0.0.1';
	$port = 80;
	
	$errno = 0;
	$errstr = 'completed';
	$query = '/index.php';
	$fp = fsockopen($host, $port, $errno, $errstr, 5);
	if (! $fp) {
		return false;
	} else {
		$out = 'GET ' . $query.'?c='.$control.'&a='.$action . " HTTP/1.1\r\n";
		$out .= 'Host: ' . $host . "\r\n";
		$out .= "Connection: Close\r\n\r\n";
		$length = fwrite($fp, $out);
		fclose($fp);
		return true;
	}
}

call('product','crontab');
call('cart','crontab');
call('order','crontab');
call('seckill','crontab');
call('sale','crontab');
call('fullcut','crontab');