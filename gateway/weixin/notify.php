<?php


$path = str_replace("/gateway/weixin", '', dirname($_SERVER['PHP_SELF']));
$url = 'http://'.$_SERVER['HTTP_HOST'].$path.'/index.php?c=order&a=notify&type='.$openId;
header('Location: '.$url,true,302);