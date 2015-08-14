<?php /* Smarty version Smarty-3.1.16, created on 2015-08-14 14:45:22
         compiled from "D:\wamp\www\home\application\template\admin\o2oclient.html" */ ?>
<?php /*%%SmartyHeaderCode:174355cc434bdf3537-31167133%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9ebb49c1448762ce974cc1fd714456847458eb50' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\o2oclient.html',
      1 => 1439531628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '174355cc434bdf3537-31167133',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cc434be911a8_00989919',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'o2o' => 0,
    'client' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cc434be911a8_00989919')) {function content_55cc434be911a8_00989919($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Page Layouts - Blank Page</title>
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
<body class="page-header-fixed page-quick-sidebar-over-content">
<?php echo $_smarty_tpl->getSubTemplate ('admin/public/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

<!-- BEGIN CONTAINER -->
<div class="page-container">
	<?php echo $_smarty_tpl->getSubTemplate ('admin/public/sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

    <!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<?php echo $_smarty_tpl->getSubTemplate ('admin/public/style.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			推广 <small>o2o用户</small>
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
						<a href="#">推广</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'o2o','a'=>'admin'),$_smarty_tpl);?>
">o2o用户</a>
                        <i class="fa fa-angle-right"></i>
					</li>
                    
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'o2o','a'=>'o2oclient'),$_smarty_tpl);?>
&id=<?php echo $_GET['id'];?>
">o2o客户</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					 <div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i><?php echo $_smarty_tpl->tpl_vars['o2o']->value['username'];?>
/<?php echo $_smarty_tpl->tpl_vars['o2o']->value['telephone'];?>

							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 #
									</th>
									<th>
										 用户名
									</th>
									<th>
										 手机号
									</th>
									<th>
										 订单数量
									</th>
									<th>
										 账户余额
									</th>
                                    <th>
                                    	操作
                                    </th>
								</tr>
								</thead>
								<tbody>
                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['client'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['client']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['name'] = 'client';
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['client']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['client']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['client']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['client']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['client']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['client']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['client']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['client']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['client']['total']);
?>
								<tr>
									<td>
										 1
									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['client']->value[$_smarty_tpl->getVariable('smarty')->value['section']['client']['index']]['username'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['client']->value[$_smarty_tpl->getVariable('smarty')->value['section']['client']['index']]['telephone'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['client']->value[$_smarty_tpl->getVariable('smarty')->value['section']['client']['index']]['ordernum'];?>

									</td>
                                    <td>
										 <?php echo $_smarty_tpl->tpl_vars['client']->value[$_smarty_tpl->getVariable('smarty')->value['section']['client']['index']]['money'];?>

									</td>
									<td>
										<button class="btn btn-xs btn-danger">查看日志</button>
									</td>
								</tr>
                                <?php endfor; endif; ?>
								</tbody>
								</table>
							</div>
						</div>
					</div>
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
