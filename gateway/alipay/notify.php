<?php
$url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?c=order&a=notify&type=alipay';

$log = json_encode($_POST);
file_put_contents('./alipay_notify.txt', $log);

$ch = curl_init($url);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER, false);
curl_setopt($ch,CURLOPT_POST, true);
curl_setopt($ch,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
curl_setopt($ch,CURLOPT_POSTFIELDS, $_POST);
curl_exec($ch);