<?php /* Smarty version Smarty-3.1.16, created on 2015-08-12 00:19:55
         compiled from "D:\wamp\www\home\application\template\admin\product_edit.html" */ ?>
<?php /*%%SmartyHeaderCode:2754655b8878e9b8403-56204090%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4acedb3d29c9feaec7e9352736eb1db6c7d44d53' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\product_edit.html',
      1 => 1439309881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2754655b8878e9b8403-56204090',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55b8878eb135a5_12022357',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'product' => 0,
    'category' => 0,
    'brand' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b8878eb135a5_12022357')) {function content_55b8878eb135a5_12022357($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wamp\\www\\home\\extends\\smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | eCommerce - Product Edit</title>
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
/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datepicker/css/datepicker.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
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
/assets/umeditor/themes/default/css/umeditor.min.css" rel="stylesheet" type="text/css"/>
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
			商品详情 <small>创建 & 编辑商品</small>
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
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'edit'),$_smarty_tpl);?>
">商品添加</a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div id="alert">
                   
                    </div>
					<form class="form-horizontal form-row-seperated" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'save'),$_smarty_tpl);?>
" method="post" id="form">
                    	<input type="hidden" name="id" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['id'])===null||$tmp==='' ? "0" : $tmp);?>
">
                        
						<div class="portlet">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-shopping-cart"></i><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['name'])===null||$tmp==='' ? "添加商品" : $tmp);?>

								</div>
								<div class="actions btn-set">
									<button type="button" name="back" class="btn default"><i class="fa fa-angle-left"></i> 后退</button>
									<button type="submit" class="btn green"><i class="fa fa-check-circle"></i> 保存并应用</button>
									<div class="btn-group">
										<a class="btn yellow" href="#" data-toggle="dropdown">
										<i class="fa fa-share"></i> 更多 <i class="fa fa-angle-down"></i>
										</a>
										<ul class="dropdown-menu pull-right">
											<li>
												<a href="#">
												复制 </a>
											</li>
											<li>
												<a href="#">
												删除 </a>
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
								<div class="tabbable">
									<ul class="nav nav-tabs">
										<li class="active">
											<a href="#tab_general" data-toggle="tab">
											通用属性 </a>
										</li>
                                        <li>
											<a href="#tab_extra" data-toggle="tab">
											附加属性 </a>
										</li>
										<li>
											<a href="#tab_meta" data-toggle="tab">
											元属性 </a>
										</li>
										<li>
											<a href="#tab_images" data-toggle="tab">
											图像 </a>
										</li>
										<li>
											<a href="#tab_reviews" data-toggle="tab">
											评论
											</a>
										</li>
										<li>
											<a href="#tab_history" data-toggle="tab">
											历史 </a>
										</li>
									</ul>
									<div class="tab-content no-space">
										<div class="tab-pane active" id="tab_general">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-2 control-label">名称: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="name" placeholder="" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['name'])===null||$tmp==='' ? '' : $tmp);?>
">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">编码: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="sku" placeholder="" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['sku'])===null||$tmp==='' ? '' : $tmp);?>
">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">分类: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<select name="category" class="form-control form-filter input-sm">
                                                            <option value="0" selected="selected">请选择</option>
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
" <?php if (isset($_smarty_tpl->tpl_vars['product']->value['category'])&&$_smarty_tpl->tpl_vars['category']->value[$_smarty_tpl->getVariable('smarty')->value['section']['category']['index']]['id']==$_smarty_tpl->tpl_vars['product']->value['category']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['category']->value[$_smarty_tpl->getVariable('smarty')->value['section']['category']['index']]['name'];?>
</option>
                                                            <?php endfor; endif; ?>
                                                        </select>
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">品牌: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<select name="bid" class="form-control form-filter input-sm">
                                                            <option value="0" selected="selected">请选择</option>
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
                                                            <option value="<?php echo $_smarty_tpl->tpl_vars['brand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['brand']['index']]['id'];?>
" <?php if (isset($_smarty_tpl->tpl_vars['product']->value['bid'])&&$_smarty_tpl->tpl_vars['brand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['brand']['index']]['id']==$_smarty_tpl->tpl_vars['product']->value['bid']) {?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['brand']->value[$_smarty_tpl->getVariable('smarty')->value['section']['brand']['index']]['name'];?>
</option>
                                                            <?php endfor; endif; ?>
                                                        </select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">销售时间: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<div class="input-group input-large date-picker input-daterange" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control" name="starttime" value="<?php echo (($tmp = @smarty_modifier_date_format($_smarty_tpl->tpl_vars['product']->value['time'],"Y-m-d"))===null||$tmp==='' ? '' : $tmp);?>
">
															<span class="input-group-addon">
															到 </span>
															<input type="text" class="form-control" name="endtime" value="<?php echo (($tmp = @smarty_modifier_date_format($_smarty_tpl->tpl_vars['product']->value['time'],"Y-m-d"))===null||$tmp==='' ? '' : $tmp);?>
">
														</div>
														<span class="help-block">
														有效日期范围. </span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-md-2 control-label">标价: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="price" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['price'])===null||$tmp==='' ? '' : $tmp);?>
" placeholder="">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">市场价: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="oldprice" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['oldprice'])===null||$tmp==='' ? '' : $tmp);?>
" placeholder="">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">库存: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="stock" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['stock'])===null||$tmp==='' ? '' : $tmp);?>
" placeholder="">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">短描述: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<textarea class="form-control" name="short_description"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['short_description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
														<span class="help-block">
														产品列表显示 </span>
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">描述: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<!--<textarea class="form-control" name="product[description]"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>-->
                                                        <script id="description" name="description" type="text/plain" style="width:100%;">
															<?php echo htmlspecialchars_decode((($tmp = @$_smarty_tpl->tpl_vars['product']->value['description'])===null||$tmp==='' ? '' : $tmp));?>

														</script>
                                                        <span class="help-block">
														产品详情页显示 </span>
													</div>
                                                    
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">来源国: 
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="origin" placeholder="" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['origin'])===null||$tmp==='' ? '' : $tmp);?>
">
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">邮递字段: 
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="shipchar" placeholder="" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['shipchar'])===null||$tmp==='' ? '' : $tmp);?>
">						<span class="help-block">
														仅仅用于APP列表页显示 </span>
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">产品标签: 
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="label" placeholder="" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['label'])===null||$tmp==='' ? '' : $tmp);?>
">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">状态: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<select class="table-group-action-input form-control input-medium" name="status">
															<option value="1">上架</option>
															<option value="2">未上架</option>
														</select>
													</div>
												</div>
                                                <div class="form-group">
													<label class="col-md-2 control-label">排序: <span class="required">
													* </span>
													</label>
													<div class="col-md-10">
														<input type="text" class="form-control" name="orderby" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['orderby'])===null||$tmp==='' ? '' : $tmp);?>
" placeholder="数字越大越靠后">
													</div>
												</div>
											</div>
										</div>
                                        <div class="tab-pane" id="tab_extra">
                                        	<div class="alert alert-success margin-bottom-10">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												<i class="fa fa-warning fa-lg"></i> 当编辑可选值时，请先保存其他信息，防止信息丢失
											</div>
                                        	<div class="form-body">
                                            	<div class="row">
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control" style="height:38px;" name="prototype_name" placeholder="属性名">
                                                    </div>
                                                    <div class="col-md-3">
                                                    	<select class="form-control" name="prototype_type" style="height:38px;">
                                                        	<option value="text">固定值</option>
                                                            <option value="radio">可选值</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                    	<div id="prototype_text" style="display:block;">
                                                        <input type="text" class="form-control" style="height:38px;" name="prototype_value" placeholder="属性值">
                                                        </div>
                                                        <div id="prototype_radio" style="display:none;">
                                                        <input type="text" class="form-control" name="prototype_value" placeholder="属性值">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-1">
                                                    	<button class="form-contorl btn btn-circle btn-danger" name="prototype_add"><i class="fa fa-plus"></i></button>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="col-md-12">
                                                    <table class="table table-hover" id="prototype_container">
                                                    </table>
                                                </div>
                                                <div class="col-md-12" id="collection_container">
                                                </div>
                                            </div>
                                        </div>
										<div class="tab-pane" id="tab_meta">
											<div class="form-body">
												<div class="form-group">
													<label class="col-md-2 control-label">元标题:</label>
													<div class="col-md-10">
														<input type="text" class="form-control maxlength-handler" name="meta_title" maxlength="256" placeholder="" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['meta_title'])===null||$tmp==='' ? '' : $tmp);?>
">
														<span class="help-block">
														最大256个字符 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">元关键字:</label>
													<div class="col-md-10">
														<textarea class="form-control maxlength-handler" rows="8" name="meta_keywords" maxlength="512"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['meta_keyword'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
														<span class="help-block">
														最大512个字符 </span>
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-2 control-label">元描述:</label>
													<div class="col-md-10">
														<textarea class="form-control maxlength-handler" rows="8" name="meta_description" maxlength="256"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['product']->value['meta_description'])===null||$tmp==='' ? '' : $tmp);?>
</textarea>
														<span class="help-block">
														最大256个字符 </span>
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane" id="tab_images">
											<div class="alert alert-success margin-bottom-10">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												<i class="fa fa-warning fa-lg"></i> 图像只允许png,jpg,jpeg,gif,单文件大小10MB
											</div>
											<div class="alert alert-danger margin-bottom-10">
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
												<i class="fa fa-warning fa-lg"></i> 上传完毕后记得点击上面的保存，否则图像不会生效
											</div>
											<div id="tab_images_uploader_container" class="text-align-reverse margin-bottom-10">
												<a id="tab_images_uploader_pickfiles" href="javascript:;" class="btn yellow">
												<i class="fa fa-plus"></i> 选择文件 </a>
												<a id="tab_images_uploader_uploadfiles" href="javascript:;" class="btn green">
												<i class="fa fa-share"></i> 上传图像 </a>
											</div>
											<div class="row">
												<div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12">
												</div>
											</div>
											<table class="table table-bordered table-hover" >
											<thead>
											<tr role="row" class="heading">
												<th width="8%">
													 图像
												</th>
												<th width="25%">
													 标题
												</th>
												<th width="8%">
													 排序
												</th>
												
												<th width="10%">
												</th>
											</tr>
											</thead>
											<tbody id="preview">
											</tbody>
											</table>
										</div>
										<div class="tab-pane" id="tab_reviews">
											<div class="table-container">
												<table class="table table-striped table-bordered table-hover" id="datatable_reviews">
												<thead>
												<tr role="row" class="heading">
													<th width="5%">
														 ID
													</th>
													<th width="10%">
														 时间
													</th>
													<th width="10%">
														 用户名
													</th>
													<th width="20%">
														 内容
													</th>
													<th width="10%">
														 评分
													</th>
													<th width="10%">
														 操作
													</th>
												</tr>
												<tr role="row" class="filter">
													<td>
														<input type="text" class="form-control form-filter input-sm" name="id">
													</td>
													<td>
														<div class="input-group date date-picker margin-bottom-5" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="starttime" placeholder="从">
															<span class="input-group-btn">
															<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date date-picker" data-date-format="yyyy-mm-dd">
															<input type="text" class="form-control form-filter input-sm" name="endtime" placeholder="到">
															<span class="input-group-btn">
															<button class="btn btn-sm default" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="username">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="content">
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="score">
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
										<div class="tab-pane" id="tab_history">
											<div class="table-container">
												<table class="table table-striped table-bordered table-hover" id="datatable_history">
												<thead>
												<tr role="row" class="heading">
                                                	<th width="30%">
                                                    	流水号
                                                    </th>
													<th width="25%">
														 时间
													</th>
													<th width="25%">
														 用户
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
														<input type="text" class="form-control form-filter input-sm" name="swift" placeholder="流水号"/>
													</td>
													<td>
														<div class="input-group date datetime-picker margin-bottom-5" data-date-format="yyyy-mm-dd hh:ii">
															<input type="text" class="form-control form-filter input-sm" name="starttime" placeholder="从">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
														<div class="input-group date datetime-picker" data-date-format="yyyy-mm-dd hh:ii">
															<input type="text" class="form-control form-filter input-sm" name="endtime" placeholder="到">
															<span class="input-group-btn">
															<button class="btn btn-sm default date-set" type="button"><i class="fa fa-calendar"></i></button>
															</span>
														</div>
													</td>
													<td>
														<input type="text" class="form-control form-filter input-sm" name="telephone" placeholder="用户手机号"/>
													</td>
													<td>
														<select name="status" class="form-control form-filter input-sm">
															<option value="">请选择</option>
															<option value="pending">正在处理</option>
															<option value="notified">完成</option>
															<option value="failed">失败</option>
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
								</div>
							</div>
						</div>
					</form>
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
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/plupload/js/plupload.full.min.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/jquery-tags-input/jquery.tagsinput.min.js" type="text/javascript"></script>
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
/assets/admin/pages/scripts/ecommerce-products-edit.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/umeditor/umeditor.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/umeditor/umeditor.config.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/umeditor/lang/zh-cn/zh-cn.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/pages/scripts/product_edit.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/admin/pages/scripts/collection-table.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
jQuery(document).ready(function() {    
	Metronic.init(); // init metronic core components
	Layout.init(); // init current layout
	QuickSidebar.init(); // init quick sidebar
	Demo.init(); // init demo features
	EcommerceProductsEdit.init();
	ProductEditPage.init();
	collection.init();
	window.um = UM.getEditor('description');
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
