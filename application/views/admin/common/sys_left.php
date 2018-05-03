	<div id="sidebar">
		<div class="side-col ui-sortable">
			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
            	<div class="portlet-header ui-widget-header">系统管理</div>
				<div class="portlet-content">
					<ul class="side-menu">
                     	<li><a href="<?php echo base_url()?>admin/user/" title="用户管理">
                     	<?php echo $page_type == 'user' ? '<b>用户管理</b>' : '用户管理'?>
                     	</a></li>
						<li><a href="<?php echo base_url()?>admin/department/" title="部门管理">
						<?php echo $page_type == 'department' ? '<b>部门管理</b>' : '部门管理'?>
						</a></li>
						<li><a href="<?php echo base_url()?>admin/village/" title="村庄管理">
						<?php echo $page_type == 'village' ? '<b>村庄管理</b>' : '村庄管理'?>
						</a></li>
						<li><a href="<?php echo base_url()?>admin/popedom/" title="辖区管理">
						<?php echo $page_type == 'popedom' ? '<b>辖区管理</b>' : '辖区管理'?>
						</a></li>
						<li><a href="<?php echo base_url()?>admin/menu/" title="菜单管理">
						<?php echo $page_type == 'menu' ? '<b>菜单管理</b>' : '菜单管理'?>
						</a></li>
						<li><a href="<?php echo base_url()?>admin/menu/role" title="角色管理">
						<?php echo $page_type == 'role' ? '<b>角色管理</b>' : '角色管理'?>
						</a></li>
						</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>