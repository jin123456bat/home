<?php /* Smarty version Smarty-3.1.16, created on 2015-08-10 17:50:36
         compiled from "D:\wamp\www\home\application\template\admin\role_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:1056855c8554f6518f1-66423313%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '254f77f59ada886eaae6d68b248226310dedb6ac' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\role_admin.html',
      1 => 1439200235,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1056855c8554f6518f1-66423313',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55c8554f695c21_09067445',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'role' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c8554f695c21_09067445')) {function content_55c8554f695c21_09067445($_smarty_tpl) {?><!DOCTYPE html>
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
			用户管理 <small>管理组</small>
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
						<a href="#">用户管理</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'role','a'=>'admin'),$_smarty_tpl);?>
">管理组</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div id="alert-msg">
                    </div>
					 <div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>管理组
							</div>
						</div>
						<div class="portlet-body">
                        	<div class="form-group">
                                <div class="input-group col-md-3">
                                    <span class="input-group-btn">
                                    <button class="btn blue-stripe" id="createBtn" type="button">创建管理组</button>
                                    </span>
                                    <input type="text" name="name" class="form-control hide" placeholder="管理员">
                                    <span class="input-group-btn hide">
                                    <button class="btn blue" type="button" id="okBtn">完成</button>
                                    </span>
                                </div>
                            </div>
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 组名
									</th>
									<th>
										 地址
									</th>
									<th>
										 品牌
									</th>
									<th>
										 分类
									</th>
                                    <th>
										 组合
									</th>
                                    <th>
										 评论
									</th>
                                    <th>
										 优惠
									</th>
                                    <th>
										 满减
									</th>
                                    <th>
										 商品
									</th>
                                    <th>
										 用户
									</th>
                                    <th>
										 管理员
									</th>
                                    <th>
										 订单
									</th>
                                    <th>
										 限时
									</th>
                                    <th>
										 秒杀
									</th>
                                    <th>
										 角色
									</th>
                                    <th>
                                    	#
                                    </th>
								</tr>
								</thead>
								<tbody>
                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['role'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['role']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['name'] = 'role';
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['role']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['role']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['role']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['role']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['role']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['role']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['role']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['role']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['role']['total']);
?>
								<tr>
									<td name="name">
										 <?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['name'];?>

									</td>
									<td>
										 <input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="address" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['address'])) {?>checked="checked"<?php }?>>
									</td>
									<td>
										 <input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="brand" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['brand'])) {?>checked="checked"<?php }?>>
									</td>
									<td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="category" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['category'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="combine" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['combine'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="comment" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['comment'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="coupon" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['coupon'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="fullcut" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['fullcut'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="product" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['product'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="user" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['user'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="admin" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['admin'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="orderlist" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['orderlist'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="sale" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['sale'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="seckill" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['seckill'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
										<input type="checkbox" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
" name="role" <?php if (!empty($_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty',null,true,false)->value['section']['role']['index']]['role'])) {?>checked="checked"<?php }?>>
									</td>
                                    <td>
                                    	<button class="btn btn-xs red-stripe removeBtn" data-id="<?php echo $_smarty_tpl->tpl_vars['role']->value[$_smarty_tpl->getVariable('smarty')->value['section']['role']['index']]['id'];?>
">删除</button>
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
	
	$('input[type=checkbox]').on('click',function(event){
		var checked = $(this).attr('checked');
		var value = 0;
		if(checked=='checked')
		{
			value = 1;
		}
		var name = $(this).attr('name');
		var id = $(this).data('id');
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'role','a'=>'set'),$_smarty_tpl);?>
',{id:id,name:name,value:value},function(data){
			if(data.code != 1)
			{
				Metronic.alert({
					type: 'danger',
					icon: 'warning',
					message: data.result,
					container: $('#alert-msg'),
					place: 'prepend',
					closeInSeconds: 5,
				});
			}
		});
	});
	
	$('.removeBtn').on('click',function(event){
		var id = $(this).data('id');
		var ths = $(this);
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'role','a'=>'remove'),$_smarty_tpl);?>
',{id:id},function(data){
			if(data.code != 1)
			{
				Metronic.alert({
					type: 'danger',
					icon: 'warning',
					message: data.result,
					container: $('#alert-msg'),
					place: 'prepend',
					closeInSeconds: 5,
				});
			}
			else
			{
				ths.parents('tr').remove();
			}
		});
	});
	
	$('#createBtn').on('click',function(event){
		$('.hide').removeClass('hide');
	});
	
	$('#okBtn').on('click',function(event){
		var name = $('input[name=name]').val();
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'role','a'=>'create'),$_smarty_tpl);?>
',{name:name},function(data){
			if(data.code == 1)
			{
				window.location.reload();
			}
			else
			{
				Metronic.alert({
					type: 'danger',
					icon: 'warning',
					message: data.result,
					container: $('#alert-msg'),
					place: 'prepend',
					closeInSeconds: 5,
				});
			}
		});
	});
});
   </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
