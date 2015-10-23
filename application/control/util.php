<?php
namespace application\control;
use system\core\control;

class utilControl extends control
{
	
	
	//获取openid注册
	function addUser(){
		header('Content-type: text/html; charset=utf-8');
		
		$system = $this->model('system');
		$dist = $system->fetch('dist');
		
		$user_tab=$this->model("user");
		$userid=intval($this->get->userid);//主页作为分享获取上级推荐用户
		$oid=0;
		if($userid)
		{
			$user=$user_tab->getById($userid);
			if(isset($user[0]) && $user[0]['cost'] >= $dist['money']){
				$oid=$user[0]['id'];
			}
		}
		
		//获取微信openid
		$code=$this->get->code;
		
		$config=config("weixin");
		$url_access_token='https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$config['APPID'].'&secret='.$config['APPSECRET'].'&code='.$code.'&grant_type=authorization_code';
		
		$html=file_get_contents($url_access_token);
		
		$jsondata=json_decode(''.$html.'',true);
		$openid2=$jsondata['openid'];
		$access_token=$jsondata['access_token'];
		
		$url2='https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid2;
		$html2=file_get_contents($url2);
		$jsondata2=json_decode($html2,true);
		$nickname=$jsondata2['nickname'];
		$headimgurl=$jsondata2['headimgurl'];
		
		$openid=$jsondata2['openid'];
		
		if(isset($openid)){//存在
			//微信用户登陆
			$return_boolean=$user_tab->loginWeiXin($openid);
			
			if($return_boolean==false){//未注册,同时登陆
				$id=$user_tab->registerWeiXin($openid,$oid,'weixin',$nickname,$headimgurl);
				if($id){
					$this->session->id = $id;
					$this->session->telephone = '';
					$this->session->username = $nickname;
				}else{
					echo '注册失败';
					exit;
				}
			}else{//直接登陆
				$this->session->id = $return_boolean['id'];
				$this->session->telephone = $return_boolean['telephone'];
				$this->session->username = $return_boolean['username'];
			}
		}
	}
	
	//已经注册自动登陆
	function userFind(){
		
			$config=config("weixin");
			$openid=$this->get->openid;
			if(isset($openid)){//存在
				//微信用户登陆
				$user_tab = $this->model('user');
				$return_boolean=$user_tab->loginWeiXin($openid);			
				if($return_boolean==false){//未注册,同时登陆
					$url="http://home.hzlianhai.com/womenjia/index.php?c=mobile&a=index&type=weixinAdd";
			    	$turl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$config['APPID']."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
			    
					header("Location: $turl");
				}else{//直接登陆
					$this->session->id = $return_boolean['id'];
					$this->session->telephone = $return_boolean['telephone'];
					$this->session->username = $return_boolean['username'];		
				}
			}else{
				$url="http://home.hzlianhai.com/womenjia/index.php?c=mobile&a=index&type=weixinAdd";
				$turl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$config['APPID']."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
				
				header("Location: $turl");
			}
	    
	}
	//微信公众号，自定义菜单栏配置点击跳转接口
	function urlIndex(){
		$config=config("weixin");
		$url = $this->http->url('mobile','index');
		$turl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$config['APPID']."&redirect_uri=".urlencode($url)."&response_type=code&scope=snsapi_base&state=1#wechat_redirect";
		header("Location: $turl");
	}
	//分享接口 参数retUrl内容为回调地址，
	//回调地址必须包含参数type=weixinAdd，以及分享的用户ID参数 userid=19
	//回调地址必须urlencode加密
	function authorizeIndex(){		
		$config=config("weixin");
		$url=$this->get->retUrl;
		if(empty($url))
			return false;
		//urlencode解密判断跳转地址合法性
		$url2=urldecode($url);
		$var=explode("&",$url2);
		if(count($var)==4){
			$i=0;
			foreach ($var as $key =>$value){
				$var2=explode("=",$value);
				if($var2[0]=="type"&&$var2[1]=="weixinAdd"){
					$i++;
				}
				if($var2[0]=="userid"){
					
					$userid=(int)$var2[1];
					if($userid==0){
						return $this->call('index', '__404');
					}
					$i++;
				}
			}
			if($i<2){
				return $this->call('index', '__404');
			}
			
		}else{
			return $this->call('index', '__404');
		}
		$turl="https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$config['APPID']."&redirect_uri=".$url."&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
		header("Location: $turl");
	}
}