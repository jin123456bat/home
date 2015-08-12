<?php /* Smarty version Smarty-3.1.16, created on 2015-08-11 01:28:14
         compiled from "D:\wamp\www\home\application\template\admin\userlist.html" */ ?>
<?php /*%%SmartyHeaderCode:2455055b5a3a7961bd5-95318673%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10d6e352fb5d895c46dd8525c8eefdf551c739d2' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\userlist.html',
      1 => 1439227663,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2455055b5a3a7961bd5-95318673',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55b5a3a7ba0db7_41231490',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b5a3a7ba0db7_41231490')) {function content_55b5a3a7ba0db7_41231490($_smarty_tpl) {?><!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zh-cmn-Hans">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8"/>
<title>Metronic | Data Tables - Managed Datatables</title>
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
	<!-- BEGIN SIDEBAR -->
	<div class="page-sidebar-wrapper">
		<?php echo $_smarty_tpl->getSubTemplate ('admin/public/sidebar.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	</div>
	<!-- END SIDEBAR -->
	<!-- BEGIN CONTENT -->
	<div class="page-content-wrapper">
		<div class="page-content">
			<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" role="form" id="add_user">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">添加新用户</h4>
                            </div>
                            <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">用户名</label>
                                        <div class="col-md-9">
                                            <input type="text" name="telephone" class="form-control input-inline input-medium" placeholder="手机号">
                                            <span class="help-inline">
                                            用户手机号码就是账号. </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">登陆密码</label>
                                        <div class="col-md-9">
                                            <input type="text" name="password" class="form-control input-inline input-medium" placeholder="可选，登陆密码">
                                            <span class="help-inline">
                                            为空则手机号是密码 </span>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn blue">保存</button>
                                <button type="button" class="btn default" data-dismiss="modal">取消</button>
                            </div>
                        </form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
            <div class="modal fade container in" id="email" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" role="form" id="sendemail">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">邮件群发</h4>
                            </div>
                            <div class="modal-body" style="padding:0px;">
                                <script id="email_container" name="content" type="text/plain" style="width:598px;">
									编辑邮件内容
								</script>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn blue btn-circle">发送</button>
                                <button type="button" class="btn default btn-circle" data-dismiss="modal">取消</button>
                            </div>
                        </form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
            <div class="modal fade container in" id="smssender" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" role="form" id="smssender_form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">短信群发</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group" style="padding:0px;">
                                    <div class="col-md-12">
                                        <textarea class="form-control" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn blue btn-circle">发送</button>
                                <button type="button" class="btn default btn-circle" data-dismiss="modal">取消</button>
                            </div>
                        </form>
					</div>
					<!-- /.modal-content -->
				</div>
				<!-- /.modal-dialog -->
			</div>
			<!-- /.modal -->
			<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
			<!-- BEGIN STYLE CUSTOMIZER -->
			<?php echo $_smarty_tpl->getSubTemplate ('admin/public/style.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<!-- END STYLE CUSTOMIZER -->
			<!-- BEGIN PAGE HEADER-->
			<h3 class="page-title">
			用户管理 <small>会员列表</small>
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
						<a href="#">用户管理</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'userlist'),$_smarty_tpl);?>
">会员列表</a>
					</li>
				</ul>
				
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN EXAMPLE TABLE PORTLET-->
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-user"></i>用户列表
							</div>
						</div>
						<div class="portlet-body">
							<div class="table-toolbar">
								<div class="row">
									<div class="col-md-12">
										<div class="btn-group">
											<button class="btn btn-default btn-circle" data-toggle="modal" data-target="#portlet-config">
											添加新用户 <i class="fa fa-plus"></i>
											</button>
										</div>
                                        
                                        <div class="btn-group pull-right">
											<button class="btn dropdown-toggle btn-default btn-circle" data-toggle="dropdown">工具 <i class="fa fa-angle-down"></i>
											</button>
											<ul class="dropdown-menu pull-right">
												<li>
													<a href="#" id="export">
													导出 </a>
												</li>
												<li>
													<a href="#" data-toggle="modal" data-target="#email">
													发送邮件 </a>
												</li>
												<li>
													<a href="#smssender" data-toggle="modal">
													发送短信 </a>
												</li>
											</ul>
										</div>
                                        <div class="btn-group pull-right">
											<button class="btn btn-default btn-circle btn-danger" id="removeUser">
											删除用户账户 <i class="fa fa-minus"></i>
											</button>
										</div>
									</div>
								</div>
							</div>
							<table class="table table-striped table-bordered table-hover" id="sample_1">
							<thead>
							<tr>
								<th class="table-checkbox">
									<input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"/>
								</th>
                                <th>
									 用户名
								</th>
                                <th>
									 头像
								</th>
								<th>
									 手机号
								</th>
								<th>
									 Email
								</th>
								<th>
									 注册时间
								</th>
								<th>
									 上次登录时间
								</th>
								<th>
									 余额
								</th>
                                <th>
                                	积分
                                </th>
                                <th>
                                	消费金额
                                </th>
                                <td>
                                	订单数
                                </td>
                                <th>
                                	封号
                                </th>
							</tr>
							</thead>
							<tbody>
                            	
							</tbody>
							</table>
						</div>
					</div>
					<!-- END EXAMPLE TABLE PORTLET-->
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
/assets/admin/pages/scripts/table-managed.js"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/umeditor/umeditor.js" type="text/javascript"></script>
<script src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/umeditor/umeditor.config.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/umeditor/lang/zh-cn/zh-cn.js"></script>
<script>
jQuery(document).ready(function() {    
Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
TableManaged.init();
	$.fn.urlencode = function(str){
		str = (str + '').toString();
    	return encodeURIComponent(str).replace(/!/g, '%21').replace(/'/g, '%27').replace(/\(/g, '%28').replace(/\)/g, '%29').replace(/\*/g, '%2A').replace(/%20/g, '+');
	}
	$('#add_user').on('submit',function(){
		var telephone = $(this).find('input[name=telephone]').val(),
			password = $(this).find('input[name=password]').val();
		if($.trim(telephone).length == 0)
		{
			return false;
		}
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'register'),$_smarty_tpl);?>
',{telephone:telephone,password:password},function(data){
			data = JSON.parse(data);
			if(data.code == 1)
			{
				$('#portlet-config').modal('hide');
			}
			else
			{
				alert(data.result);
			}
		});
		return false;
	});
	
	window.um = UM.getEditor('email_container');
	
	$('#sendemail').on('submit',function(data){
		if(window.um.hasContents())
		{
			
			var userid = [];
			var content = window.um.getContent();
			$.each($('.checkboxes',$('#sample_1')),function(index,value){
				if($(value).is(':checked'))
				{
					userid.push($(value).val());
				}
			});
			if(userid.length > 0)
			{
				window.um.setDisabled('fullscreen');
				$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'sendmail'),$_smarty_tpl);?>
',{uid:JSON.stringify(userid),content:$.fn.urlencode(content)},function(data){
					data = JSON.parse(data);
					if(data.code == 1)
					{
						alert('邮件发送完毕');
					}
					else
					{
						alert(data.result);
					}
					window.um.setEnabled();
				});
			}
			else
			{
				alert('请勾选接收邮件的会员');
			}
		}
		else
		{
			window.um.focus();
		}
		return false;
	});

	$('.closeuser').live('click',function(){
		if($(this).hasClass('bootstrap-switch-on'))
		{
			$(this).removeClass('bootstrap-switch-on');
			$(this).addClass('bootstrap-switch-off');
			var toggle = 0;
		}
		else
		{
			$(this).removeClass('bootstrap-switch-off');
			$(this).addClass('bootstrap-switch-on');
			var toggle = 1;
		}
		var id = $(this).parents('tr').find('input[type=checkbox]').val();
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'close'),$_smarty_tpl);?>
',{toggle:toggle,id:id});
	});
	
	$('#removeUser').on('click',function(event){
		if(!window.confirm('确定删除选择的用户账户吗？该操作无法回复'))
			return false;
		var checkbox = $('.checkboxes:checked');
		$.each(checkbox,function(index,value){
			var id = $(value).val();
			$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'remove'),$_smarty_tpl);?>
',{id:id},function(data){
				if(data.code == 1)
				{
					$(value).parents('tr').remove();
				}
				else
				{
					alert(data.result);
				}
			});
		});
	});
	
	$('#export').on('click',function(event){
		var checkbox = $('.checkboxes:checked');
		var data = [];
		if(checkbox.length>0)
		{
			if(window.confirm('确定只导出选择的数据吗?'))
			{
				$.each(checkbox,function(index,value){
					data.push($(value).val());
				});
				data = JSON.stringify(data);
				window.open('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'export'),$_smarty_tpl);?>
&data='+data,'');
			}
			else
			{
				return false;
			}
		}
		else
		{
			if(window.confirm('导出所有用户数据?'))
			{
				window.open('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'export'),$_smarty_tpl);?>
','');
			}
			else
			{
				return false;
			}
		}
		
	});
	
	$('#smssender').bind('show.bs.modal',function(event){
		var checkbox = $('.checkboxes:checked');
		if(checkbox.length==0)
		{
			alert('请先选择要发送的用户');
			return false;
		}
	});
	
	$('#smssender_form').on('submit',function(event){
		var data = [];
		var checkbox = $('.checkboxes:checked');
		$.each(checkbox,function(index,value){
			data.push($(value).val());
		});
		var content = $('#smssender_form').find('textarea').val();
		data = JSON.stringify(data);
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'message'),$_smarty_tpl);?>
',{data:data,content:content},function(data){
			if(data.code == 1)
			{
				$('#smssender').modal('hide');
			}
			else
			{
				alert(data.result);
			}
		});
		return false;
	});
});
</script>
</body>
<!-- END BODY -->
</html><?php }} ?>
