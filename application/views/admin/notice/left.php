	<div id="sidebar">
		<div class="side-col ui-sortable">
			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
				<div class="portlet-header ui-widget-header">通知公告</div>
				<div class="portlet-content">
					<ul class="side-menu">
						<li><a href="<?php echo base_url()?>admin/notice/" title="部门通知">
                     	<?php echo $page_type == 'notice' ? '<b>部门通知</b>' : '部门通知'?>
                     	</a></li>
                     	<li><a href="<?php echo base_url()?>admin/notice/system_notice" title="系统通知">
                     	<?php echo $page_type == 'system_notice' ? '<b>系统通知</b>' : '系统通知'?>
                     	</a></li>
			   		</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>