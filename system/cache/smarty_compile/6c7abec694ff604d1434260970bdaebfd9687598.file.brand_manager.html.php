<?php /* Smarty version Smarty-3.1.16, created on 2015-08-05 17:01:51
         compiled from "D:\wamp\www\home\application\template\admin\brand_manager.html" */ ?>
<?php /*%%SmartyHeaderCode:728055c1b528e475f4-66177111%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c7abec694ff604d1434260970bdaebfd9687598' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\brand_manager.html',
      1 => 1438765310,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '728055c1b528e475f4-66177111',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55c1b528e81cd4_23416959',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'brand' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c1b528e81cd4_23416959')) {function content_55c1b528e81cd4_23416959($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | eCommerce - Dashboard</title>
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
			<div class="theme-panel hidden-xs hidden-sm">
				<div class="toggler">
				</div>
				<div class="toggler-close">
				</div>
				<div class="theme-options">
					<div class="theme-option theme-colors clearfix">
						<span>
						THEME COLOR </span>
						<ul>
							<li class="color-default current tooltips" data-style="default" data-container="body" data-original-title="Default">
							</li>
							<li class="color-darkblue tooltips" data-style="darkblue" data-container="body" data-original-title="Dark Blue">
							</li>
							<li class="color-blue tooltips" data-style="blue" data-container="body" data-original-title="Blue">
							</li>
							<li class="color-grey tooltips" data-style="grey" data-container="body" data-original-title="Grey">
							</li>
							<li class="color-light tooltips" data-style="light" data-container="body" data-original-title="Light">
							</li>
							<li class="color-light2 tooltips" data-style="light2" data-container="body" data-html="true" data-original-title="Light 2">
							</li>
						</ul>
					</div>
					<div class="theme-option">
						<span>
						Layout </span>
						<select class="layout-option form-control input-small">
							<option value="fluid" selected="selected">Fluid</option>
							<option value="boxed">Boxed</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Header </span>
						<select class="page-header-option form-control input-small">
							<option value="fixed" selected="selected">Fixed</option>
							<option value="default">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Mode</span>
						<select class="sidebar-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Menu </span>
						<select class="sidebar-menu-option form-control input-small">
							<option value="accordion" selected="selected">Accordion</option>
							<option value="hover">Hover</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Style </span>
						<select class="sidebar-style-option form-control input-small">
							<option value="default" selected="selected">Default</option>
							<option value="light">Light</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Sidebar Position </span>
						<select class="sidebar-pos-option form-control input-small">
							<option value="left" selected="selected">Left</option>
							<option value="right">Right</option>
						</select>
					</div>
					<div class="theme-option">
						<span>
						Footer </span>
						<select class="page-footer-option form-control input-small">
							<option value="fixed">Fixed</option>
							<option value="default" selected="selected">Default</option>
						</select>
					</div>
				</div>
			</div>
			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			品牌管理 <small>品牌管理中心</small>
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
						<a href="#">商品管理</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'brand','a'=>'manager'),$_smarty_tpl);?>
">品牌管理</a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet box blue-steel">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-thumb-tack"></i>品牌中心
							</div>
						</div>
						<div class="portlet-body">
							<div class="tabbable-line">
								<ul class="nav nav-tabs">
                                	<li class="pull-left">
                                    	<a href="?c=brand&a=manager&start=<?php if (isset($_GET['start'])&&isset($_GET['length'])) {?><?php echo $_GET['start']-$_GET['length'];?>
<?php } else { ?>0<?php }?>&length=10"><<</a>
                                    </li>
                                	<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['brand'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['name'] = 'brand';
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['brand']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['brand']['total']);
?>
									<li class="banner <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['brand']['first']) {?>active<?php }?>" data-id="<?php echo $_smarty_tpl->tpl_vars['brand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['brand']['index']]['id'];?>
">
										<a href="#table-container" data-toggle="tab">
										<?php echo $_smarty_tpl->tpl_vars['brand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['brand']['index']]['name'];?>
 </a>
									</li>
                                    <?php endfor; endif; ?>
                                    <li class="pull-right">
                                    	<a href="?c=brand&a=manager&start=<?php if (isset($_GET['length'])&&isset($_GET['start'])) {?><?php echo $_GET['length']+$_GET['start'];?>
<?php } else { ?>0<?php }?>&length=10">>></a>
                                    </li>
								</ul>
                                <div class="tab-content">
									<div class="tab-pane active" id="table-container">
										<div class="table-responsive">
											<table class="table table-striped table-hover table-bordered">
											<thead>
											<tr>
												<th>
													 产品名称
												</th>
												<th>
													编号
												</th>
                                                <th>
                                                	价格
												</th>
                                                <th>
                                                	库存
                                                </th>
												<th>
												</th>
											</tr>
											</thead>
											<tbody id="container">
											
											</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- End: life time stats -->
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
<div class="page-footer">
	<div class="page-footer-inner">
		 2014 &copy; Metronic by keenthemes.
	</div>
	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
	</div>
</div>
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
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/pages/scripts/ecommerce-index.js" type="text/javascript"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
        jQuery(document).ready(function() {    
           Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
EcommerceIndex.init();
        });
    </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
