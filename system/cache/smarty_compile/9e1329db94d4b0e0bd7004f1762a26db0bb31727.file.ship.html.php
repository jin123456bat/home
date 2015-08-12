<?php /* Smarty version Smarty-3.1.16, created on 2015-08-11 15:03:00
         compiled from "D:\wamp\www\home\application\template\admin\ship.html" */ ?>
<?php /*%%SmartyHeaderCode:2600755c993b63406f6-51337378%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e1329db94d4b0e0bd7004f1762a26db0bb31727' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\ship.html',
      1 => 1439276579,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2600755c993b63406f6-51337378',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55c993b637f3a1_70459291',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'ship' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55c993b637f3a1_70459291')) {function content_55c993b637f3a1_70459291($_smarty_tpl) {?><!DOCTYPE html>
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
			<div class="modal fade container in" id="ship" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" role="form" id="ship_form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">添加配送方案</h4>
                            </div>
                            <div class="modal-body">
                            	<div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">方案名称</label>
                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control" placeholder="只是自己看的一个东西">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">方案代码</label>
                                        <div class="col-md-9">
                                            <input type="text" name="code" class="form-control" placeholder="SF">
                                            <span class="help-block">
                                           	从官方获得.</span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">免费区间</label>
                                        <div class="col-md-9">
                                            <input type="text" name="max" class="form-control" placeholder="0">
                                             <span class="help-block">
                                            当购物费超过此费用则免费. </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">配送费用</label>
                                        <div class="col-md-9">
                                            <input type="text" name="price" class="form-control" placeholder="20.00">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn blue btn-circle">添加</button>
                                <button type="button" class="btn default btn-circle" data-dismiss="modal">取消</button>
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
			设定 <small>配送方案</small>
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
						<a href="#">设定</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'ship','a'=>'admin'),$_smarty_tpl);?>
">配送方案</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                	<div id="alert-msg">
                	</div>
                    <div class="control-form">
                		<button class="btn btn-sm purple-stripe" data-target="#ship" data-toggle="modal">添加配送方案</button>
					</div>
                    <div class="portlet box red">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs"></i>配送方案
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-scrollable">
								<table class="table table-hover">
								<thead>
								<tr>
									<th>
										 方案ID
									</th>
									<th>
										 方案名称
									</th>
									<th>
										 方案代码
									</th>
									<th>
										 免费区间
									</th>
									<th>
										 配送费用
									</th>
								</tr>
								</thead>
								<tbody id="tbody">
                                <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['ship'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['name'] = 'ship';
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['ship']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['ship']['total']);
?>
								<tr>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['ship']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ship']['index']]['id'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['ship']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ship']['index']]['name'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['ship']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ship']['index']]['code'];?>

									</td>
									<td>
										 <?php echo $_smarty_tpl->tpl_vars['ship']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ship']['index']]['max'];?>

									</td>
									<td>
                                    	<?php echo $_smarty_tpl->tpl_vars['ship']->value[$_smarty_tpl->getVariable('smarty')->value['section']['ship']['index']]['price'];?>

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
	
	$('#ship_form').on('submit',function(){
		var name = $.trim($(this).find('input[name=name]').val());
		var code = $.trim($(this).find('input[name=code]').val());
		var max = $.trim($(this).find('input[name=max]').val());
		var price  = $.trim($(this).find('input[name=price]').val());
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'ship','a'=>'create'),$_smarty_tpl);?>
',{name:name,code:code,max:max,price:price},function(data){
			if(data.code == 1)
			{
				$('#tbody').append('<tr><td></td><td>'+name+'</td><td>'+code+'</td><td>'+max+'</td><td>'+price+'</td></tr>');
				$('#ship').modal('hide');
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
});
   </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
