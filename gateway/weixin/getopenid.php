<?php
use application\model\systemModel;
use system\core\response;
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=%s#wechat_redirect';

defined('ROOT') or define('ROOT', "D:/wamp/www");
include '../../global.php';

include ROOT.'/application/model/system.php';
$weixinConfig = new systemModel('system');

$queryString = $_SERVER['QUERY_STRING'];
$redirect_url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$queryString;
$scope = 'snsapi_base';
$state = $_GET['id'];//订单id回传
$trade_type = $_GET['trade_type'];
$url = sprintf($url,$weixinConfig->get('appid','weixin'),urlencode($redirect_url),$scope,$state);

if(!isset($_GET['code']))
{
	$response = new response();
	$response->setCode(302);
	$response->addHeader('Location',$url);
	$response->send();
}
else
{
	//根据code获取openid
	$code = $_GET['code'];
	$state = $_GET['state']; //订单id回传
	$appid = $weixinConfig->get('appid','weixin');
	$secret = $weixinConfig->get('appsecret','weixin');
	$url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
	$content = file_get_contents(sprintf($url,$appid,$secret,$code));
	$content = json_decode($content);
	$response = new response();
	if(isset($content->access_token))
	{
		$response->setCode(302);
		$url = 'http://'.$_SERVER['HTTP_HOST'].'/index.php?c=order&a=payment&id='.$state.'&openid='.$content->openid.'&trade_type='.$trade_type;
		$response->addHeader('Location',$url);
		$response->send();
	}
	else
	{
		$response->setCode(200);
		$response->addHeader('Content-Type','html/text;charset="utf-8"');
		$response->setBody('验证失败，请重新发起请求');
		$response->send();
	}
}