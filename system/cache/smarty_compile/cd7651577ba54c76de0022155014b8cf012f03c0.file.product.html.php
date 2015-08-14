<?php /* Smarty version Smarty-3.1.16, created on 2015-08-13 17:45:39
         compiled from "/Library/WebServer/Documents/www/ourhome/application/template/admin/product.html" */ ?>
<?php /*%%SmartyHeaderCode:85683757155cc6743785f51-78138807%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cd7651577ba54c76de0022155014b8cf012f03c0' => 
    array (
      0 => '/Library/WebServer/Documents/www/ourhome/application/template/admin/product.html',
      1 => 1439438780,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '85683757155cc6743785f51-78138807',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'fullcut' => 0,
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cc6743952425_49556435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cc6743952425_49556435')) {function content_55cc6743952425_49556435($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | eCommerce - Products</title>
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
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/select2/select2.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
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
        	<div class="modal fade bs-example-modal-lg" id="sale-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
                    	<form class="form-horizontal" role="form" id="sale-config-form">
                        	<input type="hidden" name="id">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
							<h4 class="modal-title">推送到限时折扣</h4>
						</div>
						<div class="modal-body">
							<div class="form-body">
                            	<div class="form-group">
                                    <label class="col-md-2 control-label">活动类型</label>
                                    <div class="radio-list col-md-9">
                                        <label class="radio-inline">
                                        <input type="radio" name="activity" value="seckill" checked>秒杀</label>
                                        <label class="radio-inline">
                                        <input type="radio" name="activity" value="sale">限时折扣</label>
                                        <label class="radio-inline">
                                        <input type="radio" name="activity" value="fullcut">满减</label>
                                        <!--<label class="radio-inline">
                                        <input type="radio" name="activity" value="combine">组合购买</label>-->
                                    </div>
                                </div>
                                <div class="activity_form seckill sale">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">产品名称</label>
                                        <div class="col-md-9">
                                            <input type="text" name="pname" class="form-control" placeholder="" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-2">开始时间</label>
										<div class="col-md-9">
											<div class="input-group date form_datetime">
												<input type="text" size="16" name="starttime" class="form-control">
												<span class="input-group-btn">
												<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												</span>
												<span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
											</div>
											<!-- /input-group -->
										</div>
									</div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">结束时间</label>
                                        <div class="col-md-9">
                                            <div class="input-group date form_datetime">
                                                <input type="text" size="16" class="form-control" name="endtime">
                                                <span class="input-group-btn">
												<button class="btn default date-reset" type="button"><i class="fa fa-times"></i></button>
												</span>
												<span class="input-group-btn">
												<button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
												</span>
                                            </div>
                                            <!-- /input-group -->
                                            <span class="help-block">
                                            活动结束时间，注意要在商品上架期间内
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">售价</label>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <i class="fa"></i>
                                                <input type="number" class="form-control" name="price"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">排序</label>
                                        <div class="col-md-9">
                                            <div class="input-icon right">
                                                <input type="text" class="form-control" name="orderby" placeholder="1">
                                                <span class="help-block">
                                                数字越大越靠后
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="activity_form fullcut display-none">
                                	<div class="form-group">
                                        <label class="col-md-2 control-label">满减类型</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="fullcut">
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
												<option value="<?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['fullcut']->value[$_smarty_tpl->getVariable('smarty')->value['section']['fullcut']['index']]['name'];?>
</option>
                                                <?php endfor; endif; ?>
											</select>
                                        </div>
                                    </div>
                                </div>
                        	</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn blue">开始推送</button>
							<button type="button" class="btn default" data-dismiss="modal">取消</button>
						</div>
                        </form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- BEGIN STYLE CUSTOMIZER -->
			<?php echo $_smarty_tpl->getSubTemplate ('admin/public/style.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			商品管理 <small>商品列表</small>
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
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'listview'),$_smarty_tpl);?>
">商品列表</a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div class="col-md-12" id="alert-msg">
                    </div>
					<!-- Begin: life time stats -->
					<div class="portlet">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>商品列表
							</div>
							<div class="actions">
								<div class="btn-group">
									<a class="btn default yellow-stripe" href="#" data-toggle="dropdown">
									<i class="fa fa-share"></i> 工具 <i class="fa fa-angle-down"></i>
									</a>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#" id="export">
											导出 </a>
										</li>
										<li class="divider">
										</li>
										<li>
											<a href="#">
											打印 </a>
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-container">
								<div class="table-actions-wrapper">
									<span>
									</span>
									<select class="table-group-action-input form-control input-inline input-small input-sm">
										<option value="0" selected="selected">请选择</option>
										<option value="1">上架</option>
										<option value="2">下架</option>
										<option value="3">删除</option>
									</select>
									<button class="btn btn-sm yellow table-group-action-submit"><i class="fa fa-check"></i>提交</button>
								</div>
								<table class="table table-striped table-bordered table-hover" id="datatable_products">
								<thead>
								<tr role="row" class="heading">
									<th width="1%">
										<input type="checkbox" class="group-checkable">
									</th>
									<th width="10%">
										 SKU
									</th>
									<th width="15%">
										 产品名称
									</th>
									<th width="15%">
										 类别
									</th>
									<th width="10%">
										 价格
									</th>
									<th width="10%">
										 库存
									</th>
									<th width="15%">
										 创建日期
									</th>
									<th width="10%">
										 状态
									</th>
									<th width="10%">
										 操作
									</th>
								</tr>
								<tr role="row" class="filter">
									<td>
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="product_sku">
									</td>
									<td>
										<input type="text" class="form-control form-filter input-sm" name="product_name">
									</td>
									<td>
										<select name="product_category" class="form-control form-filter input-sm">
											<option value="0" selected>请选择</option>
                                            <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['category'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['category']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['name'] = 'category';
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['category']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['category']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['category']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['category']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['category']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['category']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['category']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['category']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['category']['total']);
?>
                                            <option value="<?php echo $_smarty_tpl->tpl_vars['category']->value[$_smarty_tpl->getVariable('smarty')->value['section']['category']['index']]['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value[$_smarty_tpl->getVariable('smarty')->value['section']['category']['index']]['name'];?>
</option>
                                            <?php endfor; endif; ?>
										</select>
									</td>
									<td>
										<div class="margin-bottom-5">
											<input type="text" class="form-control form-filter input-sm" name="product_price_from" placeholder="从"/>
										</div>
										<input type="text" class="form-control form-filter input-sm" name="product_price_to" placeholder="到"/>
									</td>
									<td>
										<div class="margin-bottom-5">
											<input type="text" class="form-control form-filter input-sm" name="product_stock_from" placeholder="从"/>
										</div>
										<input type="text" class="form-control form-filter input-sm" name="product_stock_to" placeholder="到"/>
									</td>
									<td>
										<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="product_time_from" placeholder="从">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
										<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
											<input type="text" class="form-control form-filter input-sm" name="product_time_to " placeholder="到">
											<span class="input-group-btn">
											<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
											</span>
										</div>
									</td>
									<td>
										<select name="product_status" class="form-control form-filter input-sm">
											<option value="0" selected>请选择</option>
											<option value="1">已上架</option>
											<option value="2">未上架</option>
										</select>
									</td>
									<td>
										<div class="margin-bottom-5">
											<button class="btn btn-sm yellow filter-submit margin-bottom"><i class="fa fa-search"></i> 搜索</button>
										</div>
										<button class="btn btn-sm red filter-cancel"><i class="fa fa-times"></i> 重置</button>
									</td>
								</tr>
								</thead>
								<tbody>
								</tbody>
								</table>
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
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
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
/assets/global/scripts/datatable.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/pages/scripts/ecommerce-products.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	EcommerceProducts.init();
	
	$(".form_datetime").datetimepicker({
		autoclose: true,
		isRTL: Metronic.isRTL(),
		format: "yyyy-mm-dd hh:ii",
		todayBtn: true,
		minuteStep: 5,
		pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left")
	});
	
	$('body').removeClass("modal-open");
	
	$('input[name=activity]').on('click',function(){
		$('input[name=activity]').attr('checked',false);
		$(this).attr('checked',true);
		var idname = $(this).val();
		$('.activity_form').addClass('display-none');
		$('.'+idname).removeClass('display-none');
	});
	
	$('#sale-config').on('show.bs.modal', function (event) {
		var button = $(event.relatedTarget);
		var pid = button.data('pid');
		var pname = button.data('pname');
		var price = button.data('price');
		if(pid != undefined)
		{
			var modal = $(this);
			modal.find('input[name=pname]').attr('placeholder',pname);
			modal.find('input[name=id]').val(pid);
			modal.find('input[name=price]').val(price);
		}
	});
	
	$('#sale-config-form').on('submit',function(){
		var modal = $('#sale-config-form');
		var pid = modal.find('input[name=id]').val();
		var starttime = modal.find('input[name=starttime]').val();
		var endtime = modal.find('input[name=endtime]').val();
		var price = modal.find('input[name=price]').val();
		var activities = modal.find('input[name=activity]');
		var fullcut = modal.find('select[name=fullcut]').val();
		var activity = 'seckill';
		$.each(activities,function(index,value){
			if($(value).is(':checked'))
			{
				activity = $(value).val();
			}
		});
		modal.find('input[name=price]').parents('div:eq(2)').removeClass('has-error');
		if(price.length == 0)
		{
			modal.find('input[name=price]').parents('div:eq(2)').addClass('has-error');
			return false;
		}
		var orderby = modal.find('input[name=orderby]').val();
		var url = '';
		switch(activity)
		{
			case 'seckill':url = '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'seckill','a'=>'create'),$_smarty_tpl);?>
';
					parameter = {pid:pid,starttime:starttime,endtime:endtime,price:price,orderby:orderby};
					break;
			case 'sale':url = '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'sale','a'=>'create'),$_smarty_tpl);?>
';
					parameter = {pid:pid,starttime:starttime,endtime:endtime,price:price,orderby:orderby};
					break;
			case 'fullcut':url = '<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'fullcutdetail','a'=>'create'),$_smarty_tpl);?>
';
					parameter = {pid:pid,fid:fullcut};
					break;
			default:Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: '请选择推送方式',
                    container: $('#alert-msg'),
                    place: 'prepend',
					closeInSeconds: 5,
                });break;
		}
		$.post(url,parameter,function(data){
			data = $.parseJSON(data);
			if(data.code == 1)
			{
				$('#sale-config').modal('hide');
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
		return false;
	});
	
	$('#export').on('click',function(event){
		var checkbox = $('input[type=checkbox]',$('tbody'));
		var data = [];
		$.each(checkbox,function(index,value){
			data.push($(value).val());
		});
		if(data.length == 0)
		{
			if(window.confirm('您确定要导出所有商品数据?'))
			{
				window.open('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'export'),$_smarty_tpl);?>
','');
			}
		}
		else
		{
			if(window.confirm('您确定要导出选择的商品数据?'))
			{
				window.open('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'export'),$_smarty_tpl);?>
&data='+JSON.stringify(data),'');
			}
		}
	});
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
