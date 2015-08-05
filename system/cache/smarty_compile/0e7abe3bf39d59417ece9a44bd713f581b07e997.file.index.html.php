<?php /* Smarty version Smarty-3.1.16, created on 2015-08-04 12:58:25
         compiled from "D:\wamp\www\home\application\template\index.html" */ ?>
<?php /*%%SmartyHeaderCode:2701755c046409b5853-43204675%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0e7abe3bf39d59417ece9a44bd713f581b07e997' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\index.html',
      1 => 1438664301,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2701755c046409b5853-43204675',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55c046409e5604_82964235',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c046409e5604_82964235')) {function content_55c046409e5604_82964235($_smarty_tpl) {?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
</head>
<body>
<form action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'index','a'=>'index'),$_smarty_tpl);?>
" enctype="multipart/form-data" method="post">
<input type="file" name="file[]">
<input type="file" name="file[]">
<input type="hidden" name="post" value="1">
<input type="submit">
</form>
</body>
</html><?php }} ?>
