<div id="form_div" title="<?php echo $page_title?>">
<form action="do_sub_handle_task" method="post" id="formEdit" name="formEdit"
	enctype="multipart/form-data" onsubmit="return validate(this);">
	<input name="task_id" type="hidden" value="<?php echo $row['task_id'];?>"/>
	<div name="handle_end" class="info_forms" style="height:350px; width:55%; float:left; ">
		<h2 class="title_16">处理异常</h2>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="60">
				<td width="80">处理结果：</td>
				<td>
					<textarea name="exception_result" class="form_area"><?php echo $row['exception_result'];?></textarea>
				</td>
			</tr>
	  	</table>
	</div>
  	
	<div name="handle_record_info" class="info_forms" style="height:350px; width:35%; float:left">
		<h2 class="title_16">异常详情</h2>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="60">发生地点：</td>
				<td>
					<?php echo $row['exception_addr'];?>
				</td>
			</tr>
			<tr>
				<td>发生时间：</td>
				<td>
					<?php echo $row['exception_time'];?>
				</td>
			</tr>
			<tr>
				<td>事件原由：</td>
				<td>
					<?php echo $row['exception_condition'];?>
				</td>
			</tr>
			<tr>
				<td>最新跟进：</td>
				<td>
					<?php if(count($handle_records) > 0){
						echo end($handle_records)['operation_remark'];
					}
					?>
				</td>
			</tr>
	  	</table>
	  	<div class="hastable">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  	<thead>
			<tr>
				<th width="80" style="text-align: left">处理名称</th>
				<th width="110" style="text-align: left">处理时间</th>
				<th style="text-align: left">处理人</th>
			</tr>
		</thead>
	  	<?php foreach($handle_records as $key => $record) { ?>
	  		<tr>
				<td>
					<?php echo $record['operation_name'];?>
				</td>
				<td>
					<?php echo $record['operation_time'];?>
				</td>
				<td>
					<?php echo $record['record_user_name'];?>
				</td>
			</tr>
	    <?php }?>
	  	</table>
	  	</div>
	</div>
</form>	
</div>
