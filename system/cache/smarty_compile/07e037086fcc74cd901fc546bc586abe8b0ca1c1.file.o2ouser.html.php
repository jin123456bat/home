<?php /* Smarty version Smarty-3.1.16, created on 2015-08-14 14:45:03
         compiled from "D:\wamp\www\home\application\template\admin\o2ouser.html" */ ?>
<?php /*%%SmartyHeaderCode:946055cc2ac9bae719-48746025%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '07e037086fcc74cd901fc546bc586abe8b0ca1c1' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\o2ouser.html',
      1 => 1439531628,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '946055cc2ac9bae719-48746025',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cc2ac9c5afb3_12169793',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'o2o' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cc2ac9c5afb3_12169793')) {function content_55cc2ac9c5afb3_12169793($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wamp\\www\\home\\extends\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
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
			推广 <small>o2o会员管理</small>
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
">o2o会员管理</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                
					 <div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>o2o会员
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 用户名
									</th>
									<th>
										 手机号
									</th>
                                    <th>
                                    	创建时间
                                    </th>
									<th>
										 分佣比例
									</th>
									<th>
										 客户数量
									</th>
									<th>
										 分佣金额
									</th>
                                    <th>
                                    	操作
                                    </th>
								</tr>
								</thead>
								<tbody>
                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['name'] = 'o2o';
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['o2o']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['o2o']['total']);
?>
								<tr>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['username'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['telephone'];?>

									</td>
                                    <td>
                                    	<?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['ctime'],"Y-m-d H:i:s");?>

                                    </td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['rate'];?>

									</td>
                                    <td>
                                    	<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'o2o','a'=>'o2oclient'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['uid'];?>
"><span class="label label-success">
										<?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['num'];?>
 </span></a>
                                    </td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['o_money'];?>

									</td>
									<td>
										<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'o2o','a'=>'remove'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['o2o']->value[$_smarty_tpl->getVariable('smarty')->value['section']['o2o']['index']]['uid'];?>
" class="btn btn-sm red-stripe default">删除</a>
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
