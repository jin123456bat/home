<?php /* Smarty version Smarty-3.1.16, created on 2015-08-08 22:37:57
         compiled from "D:\wamp\www\home\application\template\admin\fullcut_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:2592355c3339cc07e31-41608829%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '94fed4a7de9dbd6970d38248459405cf5b00c96b' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\fullcut_admin.html',
      1 => 1439043884,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2592355c3339cc07e31-41608829',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55c3339cd14585_54633953',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'fullcut' => 0,
    'fullcutdetail' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c3339cd14585_54633953')) {function content_55c3339cd14585_54633953($_smarty_tpl) {?><!DOCTYPE html>
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
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
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
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="fullcut" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
                    	<form id="fullcut-form" role="form" class="form-horizontal">
                        <input type="hidden" name="fid" value="0">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">创建满减组合规则</h4>
						</div>
						<div class="modal-body">
							 <div class="form-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">组合名称</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="name" placeholder="组合名称">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-2">满减区间</label>
                                    <div class="col-md-9">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="max" placeholder="满">
                                            <span class="input-group-addon">
                                            减 </span>
                                            <input type="text" class="form-control" name="minus" placeholder="减">
                                        </div>
                                        <!-- /input-group -->
                                        <span class="help-block">
                                        满多少减多少 </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">活动时间</label>
                                    <div class="col-md-9">
                                        <div class="input-group date-picker input-daterange" data-date="10/11/2012" data-date-format="mm/dd/yyyy">
                                            <input type="text" class="form-control datetimepicker" name="starttime" placeholder="开始时间">
                                            <span class="input-group-addon">
                                            到 </span>
                                            <input type="text" class="form-control datetimepicker" name="endtime" placeholder="结束时间">
                                        </div>
                                        <!-- /input-group -->
                                        <span class="help-block">
                                        请确保活动时间在商品上架期间内 </span>
                                    </div>
                                </div>
                                
                            </div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn blue">创建</button>
							<button type="button" class="btn default" data-dismiss="modal">取消</button>
						</div>
                        </form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<?php echo $_smarty_tpl->getSubTemplate ('admin/public/style.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			活动中心 <small>满减</small>
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
						<a href="#">活动中心</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'fullcut','a'=>'admin'),$_smarty_tpl);?>
">满减</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div id="alert">
                   
                    </div>
					 <div class="portlet box blue">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>满减组合
							</div>
                            <div class="tools">
                            	<button class="btn btn-sm default green-stripe" data-action="new" data-toggle="modal" href="#fullcut"><i class="fa fa-plus"></i> 创建满减规则</button>
                            </div>
						</div>
						<div class="portlet-body">
							<div class="row">
								<div class="col-md-3 col-sm-3 col-xs-3">
									<ul class="nav nav-tabs tabs-left">
										<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['name'] = 'fullcut';
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fullcut']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total']);
?>
										<li class="<?php if ($_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['first']) {?>active<?php }?>">
                                        	    <a data-toggle="tab" tabindex="-1" href="#fullcut_<?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['id'];?>
">
                                                <?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['name'];?>
 
                                                <i class="fa fa-angle-down pull-right"></i>
                                                </a>
										</li>
                                        <?php endfor; else: ?>
                                        <li class="active">
                                        	<a>尚无数据</a>
                                        </li>
                                        <?php endif; ?>
									</ul>
								</div>
								<div class="col-md-9 col-sm-9 col-xs-9">
									<div class="tab-content">
										<?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['name'] = 'fullcut';
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fullcut']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcut']['total']);
?>
                                        <div class="tab-pane <?php if ($_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['first']) {?>active<?php }?>" id="fullcut_<?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['id'];?>
">
											<div class="portlet">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-bell-o"></i><?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['name'];?>

                                                    </div>
                                                    <div class="pull-right">
                                                        <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'fullcut','a'=>'remove'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['id'];?>
" class="btn btn-sm default red-stripe">
                                                        	删除规则
                                                        </a>
                                                        <a data-action="edit" href="#fullcut" data-id="<?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['id'];?>
" data-toggle="modal" class="btn btn-sm default purple-stripe">
                                                        	修改规则
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-scrollable">
                                                        <table class="table table-striped table-bordered table-advance table-hover">
                                                        <thead>
                                                        <tr>
                                                            <th>
                                                                <i class="fa fa-briefcase"></i> 产品名称
                                                            </th>
                                                            <th class="hidden-xs">
                                                                <i class="fa fa-user"></i> 产品价格
                                                            </th>
                                                            <th class="hidden-xs">
                                                                <i class="fa fa-user"></i> 产品库存
                                                            </th>
                                                            <th>
                                                                <i class="fa fa-shopping-cart"></i> 操作
                                                            </th>
                                                            
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['name'] = 'fullcutdetail';
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['fullcutdetail']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['fullcutdetail']['total']);
?>
                                                        	<?php if ($_smarty_tpl->tpl_vars['fullcutdetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcutdetail']['index']]['fid']==$_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['id']) {?>
                                                            <tr>
                                                                <td class="highlight">
                                                                    <div class="success">
                                                                    </div>
                                                                    &nbsp;
                                                                    <?php echo $_smarty_tpl->tpl_vars['fullcutdetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcutdetail']['index']]['name'];?>

                                                                </td>
                                                                <td class="hidden-xs">
                                                                     <?php echo $_smarty_tpl->tpl_vars['fullcutdetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcutdetail']['index']]['price'];?>

                                                                </td>
                                                                <td>
                                                                     <?php echo $_smarty_tpl->tpl_vars['fullcutdetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcutdetail']['index']]['stock'];?>

                                                                </td>
                                                               
                                                                <td>
                                                                    <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'edit'),$_smarty_tpl);?>
&action=edit&id=<?php echo $_smarty_tpl->tpl_vars['fullcutdetail']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcutdetail']['index']]['pid'];?>
" class="btn default btn-xs purple">
                                                                    <i class="fa fa-edit"></i> 查看 </a>
                                                                </td>
                                                            </tr>
                                                        	<?php }?>
                                                         <?php endfor; else: ?>
                                                         	<tr>
                                                            	<td colspan="4" class="highlight">
                                                                	没有数据
                                                               	</td>
                                                            </tr>
                                                         <?php endif; ?>
                                                        </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
										</div>
										<?php endfor; endif; ?>
									</div>
								</div>
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
/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	
	$(".datetimepicker").datetimepicker({
		autoclose: true,
		isRTL: Metronic.isRTL(),
		format: "yyyy-mm-dd hh:ii",
		pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left")
	});

	$('#fullcut-form').on('submit',function(){
		var name = $.trim($(this).find('input[name=name]').val());
		var max = $.trim($(this).find('input[name=max]').val());
		var minus = $.trim($(this).find('input[name=minus]').val());
		var starttime = $.trim($(this).find('input[name=starttime]').val());
		var endtime = $.trim($(this).find('input[name=endtime]').val());
		if(name.length==0)
		{
			$(this).find('input[name=name]').parents('.form-group').addClass('has-error');
			return false;
		}
		else
		{
			$(this).find('input[name=name]').parents('.form-group').removeClass('has-error');
		}
		if(max.length==0)
		{
			$(this).find('input[name=max]').parents('.form-group').addClass('has-error');
			return false;
		}
		else
		{
			$(this).find('input[name=max]').parents('.form-group').removeClass('has-error');
		}
		if(minus.length==0)
		{
			$(this).find('input[name=minus]').parents('.form-group').addClass('has-error');
			return false;
		}
		else
		{
			$(this).find('input[name=minus]').parents('.form-group').removeClass('has-error');
		}
		if(starttime.length==0)
		{
			$(this).find('input[name=starttime]').parents('.form-group').addClass('has-error');
			return false;
		}
		else
		{
			$(this).find('input[name=starttime]').parents('.form-group').removeClass('has-error');
		}
		if(endtime.length==0)
		{
			$(this).find('input[name=endtime]').parents('.form-group').addClass('has-error');
			return false;
		}
		else
		{
			$(this).find('input[name=endtime]').parents('.form-group').removeClass('has-error');
		}
		var id = $(this).find('input[name=fid]').val();
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'fullcut','a'=>'create'),$_smarty_tpl);?>
',{id:id,name:name,max:max,minus:minus,starttime:starttime,endtime:endtime},function(data){
			data = $.parseJSON(data);
			if(data.code == 1)
			{
				$('#fullcut').modal('hide');
				window.location.reload();
			}
			else
			{
				Metronic.alert({
					type: 'danger',
					icon: 'warning',
					closeInSeconds: 5,
					message: data.result,
					container: $('#alert'),
					place: 'prepend'
				});
			}
		});
		return false;
	});
	
	var unixtotime = function(unixTime, isFull, timeZone) {
		if (typeof (timeZone) == 'number')
		{
			unixTime = parseInt(unixTime) + parseInt(timeZone) * 60 * 60;
		}
		var time = new Date(unixTime * 1000);
		var ymdhis = "";
		ymdhis += time.getUTCFullYear() + "-";
		ymdhis += (time.getUTCMonth()+1) + "-";
		ymdhis += time.getUTCDate();
		if (isFull === true)
		{
			ymdhis += " " + time.getUTCHours() + ":";
			ymdhis += time.getUTCMinutes() + ":";
			ymdhis += time.getUTCSeconds();
		}
		return ymdhis;
	}
	
	$('#fullcut').bind('show.bs.modal',function(event){
		var btn = $(event.relatedTarget);
		var action = btn.data('action');
		var modal = $(this);
		if(action == 'edit')
		{
			var id = btn.data('id');
			$('#fullcut-form').find('input[name=fid]').val(id);
			$.get('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'fullcut','a'=>'information'),$_smarty_tpl);?>
',{id:id},function(data){
				data = $.parseJSON(data);
				if(data.code == 1)
				{
					modal.find('input[name=name]').val(data.body.name);
					modal.find('input[name=max]').val(data.body.max);
					modal.find('input[name=minus]').val(data.body.minus);
					modal.find('input[name=starttime]').val(unixtotime(data.body.starttime,true,8));
					modal.find('input[name=endtime]').val(unixtotime(data.body.endtime,true,8));
				}
			});
		}
		else if(action == 'new')
		{
			$('#fullcut-form').find('input[name=fid]').val(0);
		}
	});
});
   </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
