<?php /* Smarty version Smarty-3.1.16, created on 2015-08-14 11:36:45
         compiled from "/Library/WebServer/Documents/www/ourhome/application/template/mobile/index.html" */ ?>
<?php /*%%SmartyHeaderCode:44083469655cd624dd41034-49982226%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1b9a041a6d21a185fc1c9aad52997c17ee2e8113' => 
    array (
      0 => '/Library/WebServer/Documents/www/ourhome/application/template/mobile/index.html',
      1 => 1439523162,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '44083469655cd624dd41034-49982226',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cd624ddb5d58_54551703',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cd624ddb5d58_54551703')) {function content_55cd624ddb5d58_54551703($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
  <title>我们家</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
  <meta name="Keywords" content="" />
  <meta name="description" content="" />
  <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/css/reset.css">
  <link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/css/style.css">
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/js/jquery-1.8.3.min.js"></script>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/js/common.js"></script>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/js/jquery.transit.js"></script>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/js/jquery.mslides.js"></script>
</head>
<body>
  <div id="header">
    <header>
      <h1>我们家</h1>
      <a class="btn right_btn"><i class="icon magnify"></i></a>
    </header>
  </div>
  <div class="caidanCon">
    <div class="logo J_caidan" onclick="toggleCaidan()"></div>
    <div class="caidan small">
      <a class="home"></a>
      <a class="cart"></a>
      <a class="prolist"></a>
      <a class="user"></a>
      <a class="kefu"></a>
    </div>
  </div>
  <div id="content" style="padding-top:50px">
    <div class="banner_cont">
      <div id="slider">
        <ul class="clearfix slide1">
          <li>
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/zhuti.jpg">
          </li>
          <li>
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/zhuti.jpg">
          </li>
        </ul>
      </div>
      <div id="pagi" class="clearfix">
      </div>
    </div>
    <div class="homemid">
      <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/homemid.png">
    </div>  
    <div class="homemiaosha">
      <div class="label"></div>
      <div class="tith">手机秒杀</div>
      <div class="upper">
        <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/ms.png">
        <div class="timmer">
          <div class="tit">距本场结束还有</div>
          <div class="clock clearfix">
            <span id="c1">0</span>
            <span id="c2">0</span>
            <span class="clockm">:</span>
            <span id="c3">0</span>
            <span id="c4">0</span>
            <span class="clockm">:</span>
            <span id="c5">0</span>
            <span id="c6">0</span>
          </div>
          <div class="next">
            <span>下一场</span>
            <a href="">11:00</a>
          </div>
        </div>
      </div>
      <div class="downer clearfix">
        <a class="leftpic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/leftpic.png">
        </a>
        <a class="rightpic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/rightpic1.png">
        </a>
        <a class="rightpic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/rightpic2.png">
        </a>
      </div>
    </div>
    <div class="zhutide_pros">
      <div class="tits"><div class="icon clocko"></div>今日限时特卖</div>
      <div class="item clearfix">
        <div class="pic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
          <div class="label miaosha"></div>
        </div>
        <div class="right">
          <div class="name">日本NIVEA妮维雅隔离防晒乳离</div>
          <div class="desc">15年最新加强防晒指数单品</div>
          <div class="prices clearfix">
            <div class="price">￥200</div>
            <div class="oldp"><span class="cross">￥300</span></div>
            <div class="discount">4.7</div>
          </div>
          <div class="from clearfix">
            <div class="coutryflag australia"></div>
            <div class="icon plane"></div>
            <div class="text">意大利米兰发货直邮邮回国内</div>
          </div>
          <div class="cuxiao">
            <div class="cuxiaoname">七月七号促销</div>
            <div class="time">距结束时间  01:30</div>
          </div>
        </div>
      </div>
      <div class="item clearfix">
        <div class="pic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
          <div class="label miaosha"></div>
        </div>
        <div class="right">
          <div class="name">日本NIVEA妮维雅隔离防晒乳离</div>
          <div class="desc">15年最新加强防晒指数单品</div>
          <div class="prices clearfix">
            <div class="price">￥200</div>
            <div class="oldp"><span class="cross">￥300</span></div>
            <div class="discount">4.7</div>
          </div>
          <div class="from clearfix">
            <div class="coutryflag australia"></div>
            <div class="icon plane"></div>
            <div class="text">意大利米兰发货直邮邮回国内</div>
          </div>
          <div class="cuxiao">
            <div class="cuxiaoname">七月七号促销</div>
            <div class="time">距结束时间  01:30</div>
          </div>
        </div>
      </div>
    </div>
    <div class="zhutide_pros">
      <div class="tits"><div class="icon earth"></div>全球热销</div>
      <div class="item clearfix">
        <div class="pic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
          <div class="label miaosha"></div>
        </div>
        <div class="right">
          <div class="name">日本NIVEA妮维雅隔离防晒乳离</div>
          <div class="desc">15年最新加强防晒指数单品</div>
          <div class="prices clearfix">
            <div class="price">￥200</div>
            <div class="oldp"><span class="cross">￥300</span></div>
            <div class="discount">4.7</div>
          </div>
          <div class="from clearfix">
            <div class="coutryflag australia"></div>
            <div class="icon plane"></div>
            <div class="text">意大利米兰发货直邮邮回国内</div>
          </div>
          <div class="cuxiao">
            <div class="cuxiaoname">七月七号促销</div>
            <div class="time">距结束时间  01:30</div>
          </div>
        </div>
      </div>
      <div class="item clearfix">
        <div class="pic">
          <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
          <div class="label miaosha"></div>
        </div>
        <div class="right">
          <div class="name">日本NIVEA妮维雅隔离防晒乳离</div>
          <div class="desc">15年最新加强防晒指数单品</div>
          <div class="prices clearfix">
            <div class="price">￥200</div>
            <div class="oldp"><span class="cross">￥300</span></div>
            <div class="discount">4.7</div>
          </div>
          <div class="from clearfix">
            <div class="coutryflag australia"></div>
            <div class="icon plane"></div>
            <div class="text">意大利米兰发货直邮邮回国内</div>
          </div>
          <div class="cuxiao">
            <div class="cuxiaoname">七月七号促销</div>
            <div class="time">距结束时间  01:30</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">
    $(function () {
      $(".banner_cont").mslides({
        slideContainer:'slider',
        page:'pagi',
      });
      
      
    });

  </script>
</body>
</html><?php }} ?>
