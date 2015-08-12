<?php /* Smarty version Smarty-3.1.16, created on 2015-08-10 18:01:22
         compiled from "D:\wamp\www\home\application\template\admin\log.html" */ ?>
<?php /*%%SmartyHeaderCode:2600555bb07d1743da0-35491467%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a838e5da4a7e5fdb980f941d73fa4496097304bb' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\log.html',
      1 => 1439044348,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2600555bb07d1743da0-35491467',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55bb07d1783020_30906525',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'log' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55bb07d1783020_30906525')) {function content_55bb07d1783020_30906525($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wamp\\www\\home\\extends\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Pages - Timeline</title>
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
/assets/admin/pages/css/timeline.css" rel="stylesheet" type="text/css"/>
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
	<?php echo $_smarty_tpl->getSubTemplate ('admin/public/sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN STYLE CUSTOMIZER -->
			<?php echo $_smarty_tpl->getSubTemplate ('admin/public/style.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			系同日志 <small>管理员操作记录</small>
			</h3>
			<div class="page-bar">
				<ul class="page-breadcrumb">
					<li>
						<i class="fa fa-home"></i>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'index','a'=>'index'),$_smarty_tpl);?>
">主页</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'log','a'=>'index'),$_smarty_tpl);?>
">系统日志</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<ul class="timeline">
						<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['log'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['log']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['name'] = 'log';
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['log']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['log']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['log']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['log']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['log']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['log']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['log']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['log']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['log']['total']);
?>
						<li class="timeline-blue timeline-noline">
							<div class="timeline-time">
								<span class="date">
								<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['log']->value[$_smarty_tpl->getVariable('smarty')->value['section']['log']['index']]['time'],"Y-m-d");?>
 </span>
								<span class="time">
								<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['log']->value[$_smarty_tpl->getVariable('smarty')->value['section']['log']['index']]['time'],"H:i");?>
 </span>
							</div>
							<div class="timeline-icon">
								<i class="fa fa-bar-chart-o"></i>
							</div>
							<div class="timeline-body">
								<h2><?php echo $_smarty_tpl->tpl_vars['log']->value[$_smarty_tpl->getVariable('smarty')->value['section']['log']['index']]['username'];?>
</h2>
								<div class="timeline-content">
									<?php echo $_smarty_tpl->tpl_vars['log']->value[$_smarty_tpl->getVariable('smarty')->value['section']['log']['index']]['content'];?>

								</div>
								<div class="timeline-footer">
									<a href="#" class="nav-link">
									Read more <i class="m-icon-swapright m-icon-white"></i>
									</a>
								</div>
							</div>
						</li>
                        <?php endfor; else: ?>
						<div class="wall">
                        	sorry，暂时没有找到任何相关记录
                        </div>
                        <?php endif; ?>
					</ul>
				</div>
			</div>
			<!-- END PAGE CONTENT-->
		</div>
	</div>
	<!-- END CONTENT -->
	<?php echo $_smarty_tpl->getSubTemplate ('admin/public/quickslider.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

</div>
<!-- END CONTAINER -->
<?php echo $_smarty_tpl->getSubTemplate ('admin/public/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

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
/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
jQuery(document).ready(function() {       
   // initiate layout and plugins
   Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
