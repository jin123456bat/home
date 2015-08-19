<?php
/*
 * 支付宝异步返回页面
 */
$url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?c=order&a=alipay&action=notify';
header('Location: '.$url,true,307); 