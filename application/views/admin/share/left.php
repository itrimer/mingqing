	<div id="sidebar">
		<div class="side-col ui-sortable">
			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
				<div class="portlet-header ui-widget-header">系统网盘</div>
				<div class="portlet-content">
					<ul class="side-menu">
						<li><a href="<?php echo base_url()?>admin/share/shares" title="资料共享">
                     	<?php echo $page_type == 'share_other' ? '<b>资料共享</b>' : '资料共享'?>
                     	</a></li>
                     	<li><a href="<?php echo base_url()?>admin/share/" title="私人空间">
                     	<?php echo $page_type == 'share_me' ? '<b>私人空间</b>' : '私人空间'?>
                     	</a></li>
               		</ul>
				</div>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
