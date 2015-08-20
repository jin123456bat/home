<?php

use application\config\weixinConfig;
use system\core\response;
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';

defined('ROOT') or define('ROOT', "D:/wamp/www/home");
include '../../global.php';

$weixinConfig = new weixinConfig();

$queryString = $_SERVER['QUERY_STRING'];
$redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].$queryString;
$scope = 'snsapi_base';
$state = '';
$url = sprintf($url,$weixinConfig->APPID,$redirect_url,$scope,$state);

$response = new response();
$response->setCode(302);
$response->addHeader('Location',$url);
$response->send();