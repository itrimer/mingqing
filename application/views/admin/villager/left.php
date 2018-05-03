<div id="sidebar">
	<div class="side-col ui-sortable">
			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
				<div class="portlet-header ui-widget-header">民情档案</div>
                
				<div class="portlet-content">
					<ul class="side-menu">
                      <li><a href="<?php echo base_url()?>admin/villager/"><?php echo isset($page_type) && $page_type == 'villager'?'<b>公民信息</b>':'公民信息'?></a></li>
					</ul>
				</div>
			</div>
			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
				<div class="portlet-header ui-widget-header">异常信息</div>
				<div class="portlet-content">
					<ul class="side-menu">
                      <li><a href="<?php echo base_url()?>admin/villager/handle_task?handle_status=10,20,30,40"><?php echo isset($page_type) && $page_type == 'wait_handle_task'?'<b>等待处理</b>':'等待处理'?></a></li>
                      <li><a href="<?php echo base_url()?>admin/villager/finished_handle_task?handle_status=50"><?php echo isset($page_type) && $page_type == 'finished_handle_task'?'<b>已处理</b>':'已处理'?></a></li>
					</ul>
				</div>
			</div>
			<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
				<div class="portlet-header ui-widget-header">下辖区民情信息</div>

				<div class="portlet-content">
					<div id="accordion">
						<div>
						<?php if(isset($popedoms))foreach ($popedoms as $key => $popedom){?>	
						<h3><a href="#"><?php echo $popedom['popedom_name']?></a></h3>
						<div>
						<ul class="side-menu">
						<?php if(isset($popedom['villages']))foreach ($popedom['villages'] as $v_key => $village){?>
						<li><a href="<?php echo base_url('')?>/admin/villager/?village_id=
						<?php echo $village['village_id'] ?>"><?php echo $village['village_name'] ?></a></li>
						<?php }?>
						</ul>
						</div>
							<?php }?>
						</div>
					</div>
				</div>
			</div>
	</div>
	<div class="clearfix"></div>
</div>