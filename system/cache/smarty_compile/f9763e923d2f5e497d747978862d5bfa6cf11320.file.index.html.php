<?php /* Smarty version Smarty-3.1.16, created on 2015-08-13 17:14:03
         compiled from "/Library/WebServer/Documents/www/ourhome/application/template/index.html" */ ?>
<?php /*%%SmartyHeaderCode:141616038955cc5fdb8b9ec0-33979163%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f9763e923d2f5e497d747978862d5bfa6cf11320' => 
    array (
      0 => '/Library/WebServer/Documents/www/ourhome/application/template/index.html',
      1 => 1439438780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '141616038955cc5fdb8b9ec0-33979163',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cc5fdb8e8dc8_60392805',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cc5fdb8e8dc8_60392805')) {function content_55cc5fdb8e8dc8_60392805($_smarty_tpl) {?><!DOCTYPE html>
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
