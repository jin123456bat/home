<?php /* Smarty version Smarty-3.1.16, created on 2015-08-05 21:49:53
         compiled from "D:\wamp\www\home\application\template\admin\public\sidebar.html" */ ?>
<?php /*%%SmartyHeaderCode:1838855b5a3a7d1e756-54879822%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c704dc4abd5d0132d75538535659ea8cb237cfb' => 
    array (
      0 => 'D:\\wamp\\www\\home\\application\\template\\admin\\public\\sidebar.html',
      1 => 1438782592,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1838855b5a3a7d1e756-54879822',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.16',
  'unifunc' => 'content_55b5a3a7df1726_57997583',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55b5a3a7df1726_57997583')) {function content_55b5a3a7df1726_57997583($_smarty_tpl) {?><!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
<!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
<div class="page-sidebar navbar-collapse collapse">
	<!-- BEGIN SIDEBAR MENU -->
	<ul class="page-sidebar-menu " data-auto-scroll="true" data-slide-speed="200">
		<!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
		<li class="sidebar-toggler-wrapper">
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class="sidebar-toggler">
			</div>
			<!-- END SIDEBAR TOGGLER BUTTON -->
		</li>
		<!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
		<li class="sidebar-search-wrapper">
			<!-- BEGIN RESPONSIVE QUICK SEARCH FORM -->
			<!-- DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box -->
			<!-- DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box -->
			<form class="sidebar-search " action="extra_search.html" method="POST">
				<a href="javascript:;" class="remove">
				<i class="icon-close"></i>
				</a>
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search...">
					<span class="input-group-btn">
					<a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
					</span>
				</div>
			</form>
			<!-- END RESPONSIVE QUICK SEARCH FORM -->
		</li>
		<li class="start<?php if ($_GET['c']=='admin'&&$_GET['a']=='dashboard') {?> active<?php }?>">
			<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'admin','a'=>'dashboard'),$_smarty_tpl);?>
">
			<i class="icon-home"></i>
			<span class="title">仪表板</span>
			<?php if ($_GET['c']=='admin'&&$_GET['a']=='dashboard') {?>
			<span class="selected"></span>
			<?php }?>
			</a>
		</li>
		<li class="<?php if (($_GET['c']=='category'&&$_GET['a']=='admin')||($_GET['c']=='product'&&$_GET['a']=='index')||($_GET['c']=='product'&&$_GET['a']=='edit')||($_GET['c']=='brand'&&$_GET['a']=='manager')) {?>active open<?php }?>">
			<a href="javascript:;">
			<i class="icon-basket"></i>
			<span class="title">商品管理</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li class="<?php if ($_GET['c']=='product'&&$_GET['a']=='index') {?>active<?php }?>">
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'index'),$_smarty_tpl);?>
">
					<i class="icon-handbag"></i>
					商品列表</a>
				</li>
				<li class="<?php if ($_GET['c']=='product'&&$_GET['a']=='edit') {?>active<?php }?>">
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'product','a'=>'edit'),$_smarty_tpl);?>
">
					<i class="icon-pencil"></i>
					添加商品</a>
				</li>
				<li class="<?php if ($_GET['c']=='category'&&$_GET['a']=='admin') {?>active<?php }?>">
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'category','a'=>'admin'),$_smarty_tpl);?>
">
					<i class="icon-list"></i>
					分类管理</a>
				</li>
                <li class="<?php if ($_GET['c']=='brand'&&$_GET['a']=='manager') {?>active<?php }?>">
                	<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'brand','a'=>'manager'),$_smarty_tpl);?>
">
                    <i class="icon-diamond"></i>
                    品牌管理
                   	</a>
                </li>
			</ul>
		</li>
		<li class="<?php if ($_GET['c']=='order'&&$_GET['a']=='orderlist') {?>active open<?php }?>">
			<a href="javascript:;">
			<i class="icon-tag"></i>
			<span class="title">订单管理</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li class="<?php if ($_GET['c']=='order'&&$_GET['a']=='orderlist') {?>active<?php }?>">
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'order','a'=>'orderlist'),$_smarty_tpl);?>
">
                    <i class="icon-tag"></i>
					订单列表</a>
				</li>
			</ul>
		</li>
		<!-- BEGIN FRONTEND THEME LINKS -->
		<li class="heading">
			<h3 class="uppercase">运营</h3>
		</li>
		
		<li>
			<a href="javascript:;">
			<i class="icon-briefcase"></i>
			<span class="title">Data Tables</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="table_basic.html">
					Basic Datatables</a>
				</li>
				<li>
					<a href="table_responsive.html">
					Responsive Datatables</a>
				</li>
				<li>
					<a href="table_managed.html">
					Managed Datatables</a>
				</li>
				<li>
					<a href="table_editable.html">
					Editable Datatables</a>
				</li>
				<li>
					<a href="table_advanced.html">
					Advanced Datatables</a>
				</li>
				<li>
					<a href="table_ajax.html">
					Ajax Datatables</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
			<i class="icon-wallet"></i>
			<span class="title">静态页</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="portlet_general.html">
					General Portlets</a>
				</li>
				<li>
					<a href="portlet_general2.html">
					<span class="badge badge-roundless badge-danger">new</span>New Portlets #1</a>
				</li>
				<li>
					<a href="portlet_general3.html">
					<span class="badge badge-roundless badge-danger">new</span>New Portlets #2</a>
				</li>
				<li>
					<a href="portlet_ajax.html">
					Ajax Portlets</a>
				</li>
				<li>
					<a href="portlet_draggable.html">
					Draggable Portlets</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
			<i class="icon-docs"></i>
			<span class="title">推广</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="extra_profile.html">
					<i class="icon-user"></i>
					o2o商户</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
			<i class="icon-present"></i>
			<span class="title">活动中心</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="page_about.html">
					限时折扣</a>
				</li>
				<li>
					<a href="page_contact.html">
					秒杀</a>
				</li>
				<li>
					<a href="extra_search.html">
					满减</a>
				</li>
				<li>
					<a href="extra_invoice.html">
					组合</a>
				</li>
				<li>
					<a href="page_portfolio.html">
					优惠券</a>
				</li>
				<li>
					<a href="extra_pricing_table.html">
					打折码</a>
				</li>
			</ul>
		</li>
		
		<li<?php if ($_GET['c']=='user'&&$_GET['a']=='userlist') {?> class="active open"<?php }?>>
			<a href="javascript:;">
			<i class="icon-user"></i>
			<span class="title">用户管理</span>
			<span class="arrow <?php if ($_GET['c']=='user'&&$_GET['a']=='userlist') {?>open<?php }?>"></span>
			</a>
			<ul class="sub-menu">
				<li<?php if ($_GET['c']=='user'&&$_GET['a']=='userlist') {?> class="active"<?php }?>>
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'user','a'=>'userlist'),$_smarty_tpl);?>
">
					会员列表</a>
				</li>
				<li>
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'admin','a'=>'adminlist'),$_smarty_tpl);?>
">
					管理员列表</a>
				</li>
				<li>
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'admin','a'=>'grouplist'),$_smarty_tpl);?>
">
					管理组
					</a>
				</li>
			</ul>
		</li>
		<li class="heading">
			<h3 class="uppercase">设定</h3>
		</li>
        <li>
			<a href="javascript:;">
			<i class="icon-settings"></i>
			<span class="title">参数设定</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="form_controls.html">
					Form Controls</a>
				</li>
				<li>
					<a href="form_layouts.html">
					Form Layouts</a>
				</li>
				<li>
					<a href="form_editable.html">
					<span class="badge badge-roundless badge-warning">new</span>Form X-editable</a>
				</li>
				<li>
					<a href="form_wizard.html">
					Form Wizard</a>
				</li>
				<li>
					<a href="form_validation.html">
					Form Validation</a>
				</li>
				<li>
					<a href="form_image_crop.html">
					<span class="badge badge-roundless badge-danger">new</span>Image Cropping</a>
				</li>
				<li>
					<a href="form_fileupload.html">
					Multiple File Upload</a>
				</li>
				<li>
					<a href="form_dropzone.html">
					Dropzone File Upload</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="javascript:;">
			<i class="icon-folder"></i>
			<span class="title">缓存管理</span>
			<span class="arrow "></span>
			</a>
			<ul class="sub-menu">
				<li>
					<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'cache','a'=>'product'),$_smarty_tpl);?>
">
					商品缓存</a>
				</li>
				<li>
					<a href="quick_sidebar_over_content.html">
					Over Content</a>
				</li>
				<li>
					<a href="quick_sidebar_over_content_transparent.html">
					Over Content & Transparent</a>
				</li>
				<li>
					<a href="quick_sidebar_on_boxed_layout.html">
					Boxed Layout</a>
				</li>
			</ul>
		</li>
		<li <?php if ($_GET['c']=='log'&&$_GET['a']=='index') {?>class="active"<?php }?>>
			<a href="<?php echo $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['url'][0][0]->url(array('c'=>'log','a'=>'index'),$_smarty_tpl);?>
">
			<i class="icon-envelope-open"></i>
			<span class="title">系统日志</span>
			</a>
		</li>
		
		<li class="last ">
			<a href="charts.html">
			<i class="icon-logout"></i>
			<span class="title">安全退出</span>
			</a>
		</li>
	</ul>
	<!-- END SIDEBAR MENU -->
</div><?php }} ?>
