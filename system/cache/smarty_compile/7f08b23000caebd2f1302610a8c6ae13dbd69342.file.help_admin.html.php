<?php /* Smarty version Smarty-3.1.16, created on 2015-08-15 15:47:11
         compiled from "D:\wamp\www\home\application\template\admin\help_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:1694855cde81c256da5-44293750%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7f08b23000caebd2f1302610a8c6ae13dbd69342' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\help_admin.html',
      1 => 1439624830,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1694855cde81c256da5-44293750',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cde81c2ebc85_57707438',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'help' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cde81c2ebc85_57707438')) {function content_55cde81c2ebc85_57707438($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Pages - Blog</title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport"/>
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description"/>
<meta content="" name="author"/>
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/pages/css/blog.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/pages/css/news.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
<?php echo $_smarty_tpl->getSubTemplate ('admin/public/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- BEGIN CONTAINER -->
<div class="page-container">
	<!-- BEGIN SIDEBAR -->
	<?php echo $_smarty_tpl->getSubTemplate ('admin/public/sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN STYLE CUSTOMIZER -->
			<?php echo $_smarty_tpl->getSubTemplate ('admin/public/style.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			Blog <small>blog listing and post samples</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'index','a'=>'index'),$_smarty_tpl);?>
">首页</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="#">静态页</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'admin'),$_smarty_tpl);?>
">自定义内容页</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12 blog-page">
					<div class="row">
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['help'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['help']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['name'] = 'help';
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['help']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['help']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['help']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['help']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['help']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['help']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['help']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['help']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['help']['total']);
?>
                        <div class="col-md-12 col-sm-6 article-block">
							<div class="row">
								<div class="col-md-2 blog-img blog-tag-data">
									<img src="<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['pic'];?>
" alt="" class="img-responsive">
									<!--<ul class="list-inline">
										<li>
											<i class="fa fa-calendar"></i>
											<a href="#">
											April 16, 2013 </a>
										</li>
										<li>
											<i class="fa fa-comments"></i>
											<a href="#">
											38 Comments </a>
										</li>
									</ul>-->
									<ul class="list-inline blog-tags col-md-12">
										<li>
											<i class="fa fa-tags"></i>
											<a href="#" class="removeBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['id'];?>
">
											删除 </a>
											<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'edit'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['id'];?>
">
											编辑 </a>
											<a href="#" class="getLink">
											获取API连接 </a>
                                            <input type="text" style="width:0px;" class="display-none" value="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'page'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['id'];?>
" readonly>
										</li>
									</ul>
								</div>
								<div class="col-md-8 blog-article">
									<h3>
									<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'page'),$_smarty_tpl);?>
&admin=1&id=<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['id'];?>
">
									<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['title'];?>
 </a>
									</h3>
									<p>
										 <?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['short'];?>

									</p>
									<a class="btn blue" href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'page'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['help']->value[$_smarty_tpl->getVariable('smarty')->value['section']['help']['index']]['id'];?>
&admin=1">
									查看全文 <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
							<hr>
							
						</div>
						<?php endfor; endif; ?>
					</div>
					<ul class="pagination pull-right">
						<li>
							<a href="#">
							<i class="fa fa-angle-left"></i>
							</a>
						</li>
						<li>
							<a href="#">
							1 </a>
						</li>
						<li>
							<a href="#">
							2 </a>
						</li>
						<li>
							<a href="#">
							3 </a>
						</li>
						<li>
							<a href="#">
							4 </a>
						</li>
						<li>
							<a href="#">
							5 </a>
						</li>
						<li>
							<a href="#">
							6 </a>
						</li>
						<li>
							<a href="#">
							<i class="fa fa-angle-right"></i>
							</a>
						</li>
					</ul>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	<!-- BEGIN QUICK SIDEBAR -->
	<?php echo $_smarty_tpl->getSubTemplate ('admin/public/quickslider.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<?php echo $_smarty_tpl->getSubTemplate ('admin/public/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/respond.min.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	
	$('.getLink').on('click',function(){
		$(this).next().removeClass('display-none').animate({width:'250px'});
	});
	
	$('.removeBtn').on('click',function(){
		var id = $(this).data('id');
		bootbox.dialog({
			message: "尽管不推荐删除该页面，这可能导致所有指向该页面的连接失效切无法恢复",
			title: "确定删除？",
			buttons:{
				danger: {
					label: "确定!",
					className: "red btn-sm",
					callback: function(event) {
						$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'remove'),$_smarty_tpl);?>
',{id:id},function(data){
							window.location.href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'help','a'=>'admin'),$_smarty_tpl);?>
";
						});
					}
				},
				main: {
					label: "取消!",
					className: "blue btn-sm"
				}
			}
		});
	});
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
