<?php /* Smarty version Smarty-3.1.16, created on 2015-08-14 11:50:07
         compiled from "/Library/WebServer/Documents/www/ourhome/application/template/mobile/category.html" */ ?>
<?php /*%%SmartyHeaderCode:205552158555cd654f123651-25409499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '912e2e4cb84ad62bbea836979a680baa2fe42931' => 
    array (
      0 => '/Library/WebServer/Documents/www/ourhome/application/template/mobile/category.html',
      1 => 1439524206,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '205552158555cd654f123651-25409499',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cd654f148aa9_67918693',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cd654f148aa9_67918693')) {function content_55cd654f148aa9_67918693($_smarty_tpl) {?><!DOCTYPE html>
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
/assets/mobile/js/jquery.transit.js"></script>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/js/common.js"></script>
  <script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/js/jquery.fly.js"></script>
</head>
<body>
  <div id="header">
    <header>
      <h1>分类</h1>
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
    <div class="class_cont">
      <div class="classify clearfix">
        <div class="item active">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
        <div class="item">
          <a href="">分类1</a>
        </div>
      </div>  
    </div>
    <div class="subclass">
      <div class="inner clearfix">
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon001.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon002.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon003.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon004.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon005.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon006.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon007.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
        <a class="item">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/icon008.png">
          </div>
          <div class="name">子分类1.1</div>
        </a>
      </div>
    </div>
    <div class="pro_cont">
      <div class="inner clearfix">
        <hr>
        <a class="pro">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
            <div class="label miaosha"></div>
            <div class="country">美国</div>
          </div>
          <div class="downth">
            <div class="desc">香港代购Avene雅漾活泉水喷雾300ml 雅漾喷雾补水保湿爽肤水抗敏感...</div>
            <div class="prices clearfix">
              <div class="price">￥200</div>
              <div class="oldp"><span class="cross">￥300</span></div>
              <div class="discount">4.7</div>
            </div> 
          </div> 
        </a>
        <a class="pro">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
            <div class="label temai"></div>
            <div class="country">美国</div>
          </div>
          <div class="downth">
            <div class="desc">香港代购Avene雅漾活泉水喷雾300ml 雅漾喷雾补水保湿爽肤水抗敏感...</div>
            <div class="prices clearfix">
              <div class="price">￥200</div>
              <div class="oldp"><span class="cross">￥300</span></div>
              <div class="discount">4.7</div>
            </div> 
          </div> 
        </a>
        <hr>
        <a class="pro">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
            <div class="label manjian"></div>
            <div class="country">美国</div>
          </div>
          <div class="downth">
            <div class="desc">香港代购Avene雅漾活泉水喷雾300ml 雅漾喷雾补水保湿爽肤水抗敏感...</div>
            <div class="prices clearfix">
              <div class="price">￥200</div>
              <div class="oldp"><span class="cross">￥300</span></div>
              <div class="discount">4.7</div>
            </div> 
          </div> 
        </a>
        <a class="pro">
          <div class="pic">
            <img src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/mobile/images/pro1.jpg">
            <div class="label zuhe"></div>
            <div class="country">美国</div>
          </div>
          <div class="downth">
            <div class="desc">香港代购Avene雅漾活泉水喷雾300ml 雅漾喷雾补水保湿爽肤水抗敏感...</div>
            <div class="prices clearfix">
              <div class="price">￥200</div>
              <div class="oldp"><span class="cross">￥300</span></div>
              <div class="discount">4.7</div>
            </div> 
          </div> 
        </a>
      </div>
    </div>
  </div>
  <div id="footer">

  </div>
  <script type="text/javascript">
    $(function () {
      $('.subclass .inner .item .pic').each(function(){
        $(this).css('height',$(this).outerWidth()-2);
      });
      var cwi = 0;
      $('.classify .item').each(function(){
        cwi += $(this).outerWidth();
        console.log(cwi);
      });
      if(cwi<=$(window).width()){
        var clwth = $(window).width()/$('.classify .item').length;
        $('.classify .item').css('width',clwth);
      }else{
        $(".classify").css('width',cwi+3);
        $(".classify").fly({
          d:true,
          woh:$('.classify').width(),
        });
      }
      $('.pro .pic').css('height',$('.pro .pic').eq(0).width());
      // console.log(cwi);
    });

  </script>
</body>
</html><?php }} ?>
