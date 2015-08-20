<?php
/*
 * 支付宝异步返回页面
 */
$path = str_replace("/gateway/alipay", '', dirname($_SERVER['PHP_SELF']));
$url = 'http://'.$_SERVER['HTTP_HOST'].$path.'/index.php?c=order&a=alipay&action=return';
header('Location: '.$url,true,307);