<?php
$url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?c=order&a=thankyou';
$parameter = http_build_query($_GET);
$url .= (!empty($parameter)?('&'.$parameter):$parameter);
header('Location: '.$url,true,307);