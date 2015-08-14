<?php /* Smarty version Smarty-3.1.16, created on 2015-08-14 14:44:52
         compiled from "D:\wamp\www\home\application\template\admin\theme_admin.html" */ ?>
<?php /*%%SmartyHeaderCode:1006255cc5f73673d96-73755248%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a3920a72e992116076bdd8c202796587a7245375' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\theme_admin.html',
      1 => 1439533644,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1006255cc5f73673d96-73755248',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55cc5f73719847_97657555',
  'variables' => 
  array (
    'VIEW_ROOT' => 0,
    'theme' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55cc5f73719847_97657555')) {function content_55cc5f73719847_97657555($_smarty_tpl) {?><!DOCTYPE html>
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
<link href="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet" type="text/css"/>
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
        	<div class="modal fade container in" id="theme" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
				<div class="modal-dialog">
					<div class="modal-content">
						<form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" action="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'theme','a'=>'create'),$_smarty_tpl);?>
" id="theme_form">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                <h4 class="modal-title">创建主题</h4>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">名称</label>
                                    <div class="col-md-9">
                                        <input type="text" name="name" class="form-control" placeholder="名称">
                                        <span class="help-block">
                                        主题名称 </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">描述</label>
                                    <div class="col-md-9">
                                        <textarea class="form-control" name="description"></textarea>
                                        <span class="help-block">
                                        主题描述 </span>
                                    </div>
                                </div>
                               <div class="form-group">
                                    <label class="col-md-2 control-label">大图</label>
                                    <div class="col-md-9">
                                        <input type="file" name="bigpic" class="form-control" placeholder="名称">
                                        <span class="help-block">
                                        主题详情显示 640x280</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">中图</label>
                                    <div class="col-md-9">
                                        <input type="file" name="middlepic" class="form-control" placeholder="名称">
                                        <span class="help-block">
                                        首页大图 320x260</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">小图</label>
                                    <div class="col-md-9">
                                        <input type="file" name="smallpic" class="form-control" placeholder="名称">
                                        <span class="help-block">
                                        首页小图 320x130</span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn blue btn-circle">创建</button>
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
			静态页 <small>活动主题</small>
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
						<a href="#">静态页</a>
						<i class="fa fa-angle-right"></i>
					</li>
					<li>
						<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'theme','a'=>'admin'),$_smarty_tpl);?>
">主题管理</a>
					</li>
				</ul>
			</div>
			<!-- END PAGE HEADER-->
			<!-- BEGIN PAGE CONTENT-->
			<div class="row">
				<div class="col-md-12">
                    <div class="text-align-reverse margin-bottom-10">
                        <a class="btn green" href="#theme" data-toggle="modal">
                        <i class="fa fa-share"></i> 创建主题 </a>
                    </div>
                    <div class="row">
                        <div id="tab_images_uploader_filelist" class="col-md-6 col-sm-12">
                        </div>
                    </div>
                    <table class="table table-bordered table-hover" >
                    <thead>
                    <tr role="row" class="heading">
                        <th width="5%">
                             大图像
                        </th>
                        <th width="5%">
                             中图像
                        </th>
                        <th width="5%">
                             小图像
                        </th>
                        <th width="10%">
                             标题
                        </th>
                        <th width="30%">
                        	描述
                        </th>
                        <th width="5%">
                             操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (isset($_smarty_tpl->tpl_vars['smarty']->value['section']['theme'])) unset($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']);
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['name'] = 'theme';
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['loop'] = is_array($_loop=$_smarty_tpl->tpl_vars['theme']->value) ? count($_loop) : max(0, (int) $_loop); unset($_loop);
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['show'] = true;
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['max'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['loop'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['step'] = 1;
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['start'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['step'] > 0 ? 0 : $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['loop']-1;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['show']) {
    $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['total'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['loop'];
    if ($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['total'] == 0)
        $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['show'] = false;
} else
    $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['total'] = 0;
if ($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['show']):

            for ($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['index'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['start'], $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['iteration'] = 1;
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['iteration'] <= $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['total'];
                 $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['index'] += $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['step'], $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['iteration']++):
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['rownum'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['iteration'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['index_prev'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['index'] - $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['index_next'] = $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['index'] + $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['step'];
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['first']      = ($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['iteration'] == 1);
$_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['last']       = ($_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['iteration'] == $_smarty_tpl->tpl_vars['smarty']->value['section']['theme']['total']);
?>
                    <tr>
                    	<td name=bigpic>
                        	
                        	<a href="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['bigpic'];?>
" class="fancybox-button" data-rel="fancybox-button"><img src="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['bigpic'];?>
" width="80" height="80"></a>
                            <button class="btn btn-xs red serverside display-none">点击上传</button>
                            <input type="file" data-id="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['id'];?>
" name="bigpic" class="hide upload">
                        
                        </td>
                            
                    	<td name=middlepic><a href="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['middlepic'];?>
" class="fancybox-button" data-rel="fancybox-button"><img src="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['middlepic'];?>
" width="80" height="80"></a><button class="btn btn-xs red serverside display-none">点击上传</button>
                            <input type="file" name="middlepic" data-id="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['id'];?>
" class="hide upload"></td>
                        <td name=smallpic><a href="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['smallpic'];?>
" class="fancybox-button" data-rel="fancybox-button"><img src="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['smallpic'];?>
" width="80" height="80"></a><button class="btn btn-xs red serverside display-none">点击上传</button>
                            <input type="file" name="smallpic" data-id="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['id'];?>
" class="hide upload"></td>
                        <td name=name><?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['name'];?>
</td>
                        <td name=description><?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['description'];?>
</td>
                        <td>
                        	<div class="btn-group btn-group-circle btn-group-justified">
                                <a data-id="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['id'];?>
" class="btn btn-sm red removeBtn">
                                移除 </a>
                                <a data-id="<?php echo $_smarty_tpl->tpl_vars['theme']->value[$_smarty_tpl->getVariable('smarty')->value['section']['theme']['index']]['id'];?>
" class="btn btn-sm blue editBtn">
                                编辑 </a>
                            </div>
                        </td>
                    </tr>
                    <?php endfor; endif; ?>
                    </tbody>
                    </table> 
                   
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
<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['VIEW_ROOT']->value;?>
/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>

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
	$('#theme_form').on('submit',function(){
		var name = $(this).find('input[name=name]').val();
		if($.trim(name).length == 0)
		{
			alert('主题名称不得为空');
			return false;
		}
	});
	
	$('img').error(function(e) {
        e.currentTarget.src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgdmlld0JveD0iMCAwIDE0MCAxNDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjwhLS0KU291cmNlIFVSTDogaG9sZGVyLmpzLzE0MHgxNDAKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGYyNjk0N2JiMSB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZjI2OTQ3YmIxIj48cmVjdCB3aWR0aD0iMTQwIiBoZWlnaHQ9IjE0MCIgZmlsbD0iI0VFRUVFRSIvPjxnPjx0ZXh0IHg9IjQ1LjUiIHk9Ijc0LjUiPjE0MHgxNDA8L3RleHQ+PC9nPjwvZz48L3N2Zz4=";
    });
	
	$('.removeBtn').on('click',function(event){
		var id = $(this).data(id);
		var ths = $(this);
		$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'theme','a'=>'remove'),$_smarty_tpl);?>
',{id:id},function(data){
			if(data.code == 1)
			{
				ths.parents('tr').remove();
			}
		});
	});
	
	$('.editBtn').on('click',function(event){
		var ths = $(this);
		var id = ths.data('id');
		ths.parents('tr').find('upload').removeClass('display-none');
	});
	
	$('.editBtn').on('click',function(){
		var id = $(this).data('id');
		var td = $('td[name=name]');
		var tdtextarea = $('td[name=description]');
		if($.trim($(this).html()) == '编辑')
		{
			$('.serverside').removeClass('display-none');
			$(this).html('完成');
			var input = $('<input type="text">');
			var textarea = $('<textarea></textarea>');
			var old = $.trim(td.html());
			var oldtextarea = $.trim(tdtextarea.html());
			//alert(oldtextarea);
			input.val(old);
			textarea.html(oldtextarea);
			td.html('');
			tdtextarea.html('');
			td.append(input);
			tdtextarea.append(textarea);
			input.show();
		}
		else
		{
			input = td.find('input');
			$(this).html('编辑');
			$('.serverside').addClass('display-none');
			td.html($.trim(input.val()));
			$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'theme','a'=>'save'),$_smarty_tpl);?>
',{id:id,name:input.val()},function(){
			});
			textarea = tdtextarea.find('textarea');
			tdtextarea.html(textarea.val());
			$.post('<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'theme','a'=>'save'),$_smarty_tpl);?>
',{id:id,description:textarea.val()},function(){
			});
		}
	});
	
	$('.serverside').on('click',function(){
		$(this).next().click();
	});
	
	$('.upload').on('change',function(){
		var ths = $(this);
		var formData = new FormData();//文件上传通道  
		var fileReader = new FileReader();
		var filesize = this.files[0].size;
		var getFileType = function(filename){  
            var extStart  = filename.lastIndexOf(".")+1;  
            return filename.substring(extStart,filename.length).toUpperCase();  
        };
		if(filesize>10*1024*1024)
		{
			alert('文件大小不得超出10MB');
			return false;
		}
		var type = getFileType(this.files[0].name)
		if(type == 'JPEG' || type=='JPG' || type=='GIF' || type=='PNG' || type=='BMP')
		{
			formData.append($(this).attr('name'),this.files[0]);
			formData.append('id',$(this).data('id'));
			var xhr = new XMLHttpRequest();
			xhr.open('POST','<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'theme','a'=>'save'),$_smarty_tpl);?>
',true);
			xhr.onload = function(){  
				if(xhr.status == 200 && xhr.readyState == 4)  
				{
					var response = xhr.response;
					response = $.parseJSON(response);
					ths.parent().find('img').attr('src',response.body);
					ths.parent().find('a').attr('href',response.body);
				}
				else
				{
					alert('通信失败:'+xhr.status);
				}  
			};  
			xhr.send(formData); 
		}
		else
		{
			alert('文件类型错误');
		}
		
	});
});
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html><?php }} ?>
