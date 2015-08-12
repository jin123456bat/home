<?php /* Smarty version Smarty-3.1.16, created on 2015-08-08 22:37:55
         compiled from "D:\wamp\www\home\application\template\admin\sale.html" */ ?>
<?php /*%%SmartyHeaderCode:734255c244027122e2-54326701%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '11398f2d8e7461e003322e090aa234daede0d097' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\sale.html',
      1 => 1439044524,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '734255c244027122e2-54326701',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55c24402742146_47146510',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'product' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c24402742146_47146510')) {function content_55c24402742146_47146510($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\wamp\\www\\home\\extends\\smarty\\plugins\\modifier.date_format.php';
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
			活动中心 <small>限时折扣</small>
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
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'sale','a'=>'admin'),$_smarty_tpl);?>
">限时折扣</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div class="alert alert-success margin-bottom-10">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <i class="fa fa-warning fa-lg"></i> 商品的开始时间和结束时间记得要保证在商品上架期间
                    </div>
                    <div class="alert alert-success margin-bottom-10">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <i class="fa fa-warning fa-lg"></i> 对于拥有可选属性的商品，设置为限时活动商品后售价一律按照限时活动商品计算，可选属性对应的价格无效
                    </div>
                    <div class="alert alert-success margin-bottom-10">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                        <i class="fa fa-warning fa-lg"></i> 限时折扣中的商品，库存量按照商品自身属性中的库存计算，可选属性导致的库存变动无效
                    </div>
                    <div id="alert-msg">
                    </div>
					 <div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-book"></i>限时活动商品
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-responsive">
								<table class="table table-striped table-bordered table-hover">
								<thead>
								<tr>
									<th>
										 ID
									</th>
									<th>
										 商品名称
									</th>
									<th>
										 开始时间
									</th>
									<th>
										 结束时间
									</th>
									<th>
										 售价
									</th>
									<th>
										 排序
									</th>
									<th width="20%" style="min-width:20%;">
										 
									</th>
								</tr>
								</thead>
								<tbody>
                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['product'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['product']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['name'] = 'product';
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['product']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['product']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['product']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['product']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['product']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['product']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['product']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['product']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['product']['total']);
?>
								<tr>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['pid'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['name'];?>

									</td>
									<td class="serverside" data-type="time" data-name="starttime">
										 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['starttime'],"Y-m-d H:i:s");?>

									</td>
									<td class="serverside" data-type="time" data-name="endtime">
										 <?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['endtime'],"Y-m-d H:i:s");?>

									</td>
									<td class="serverside" data-type="text" data-name="price">
										 <?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['price'];?>

									</td>
									<td class="serverside" data-type="text" data-name="orderby">
										 <?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['orderby'];?>

									</td>
									<td>
										 <div class="btn-group btn-group-circle btn-group-justified">
                                            <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'sale','a'=>'remove'),$_smarty_tpl);?>
&id=<?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['id'];?>
" class="btn btn-sm red">
                                            移除 </a>
                                            <a href="#" data-id="<?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['id'];?>
" class="btn btn-sm blue editBtn">
                                            编辑 </a>
                                            <a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'edit'),$_smarty_tpl);?>
&action=edit&id=<?php echo $_smarty_tpl->tpl_vars['product']->value[$_smarty_tpl->getVariable('smarty')->value['section']['product']['index']]['pid'];?>
" class="btn btn-sm green">
                                            查看 </a>
                                        </div>
									</td>
								</tr>
                                <?php endfor; else: ?>
                                	<tr><td colspan="7">No Data</td></tr>
								<?php endif; ?>
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
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
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
	$('.editBtn').live('click',function(){
		var td = $(this).parents('tr').find('.serverside')
		if($.trim($(this).html()) == '编辑')
		{
			if(td.find('input').length>0)
					return;
			$.each(td,function(index,value){
				var old = $.trim($(value).html());
				var input = $('<input class="form-control" type="text" name="'+$(value).data('name')+'" value="'+old+'">');
				var type = $(value).data('type');
				if(type == 'time')
				{
					input.datetimepicker({
						autoclose: true,
						isRTL: Metronic.isRTL(),
						format: "yyyy-mm-dd hh:ii",
						todayBtn: true,
						minuteStep: 5,
						pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left")
					});
				}
				$(value).html('');
				$(value).append(input);
			});
			$(this).html('完成');
		}
		else
		{
			btn = $(this);
			var id = $(this).data('id');
			var starttime = td.parent().find('input[name=starttime]').val();
			var endtime = td.parent().find('input[name=endtime]').val();
			var orderby = td.parent().find('input[name=orderby]').val();
			var price = td.parent().find('input[name=price]').val();
			$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'sale','a'=>'save'),$_smarty_tpl);?>
',{id:id,starttime:starttime,endtime:endtime,orderby:orderby,price:price},function(data){
				data = $.parseJSON(data);
				if(data.code == 1)
				{
					$.each(td,function(index,value){
						var val = $(value).find('input').val();
						$(value).html(val);
					});
					btn.html('编辑');
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
		}
	});
	});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
