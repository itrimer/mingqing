<div id="form_div" title="<?php echo $page_title?>">
	<h5 class="title_16">选择异常流向</h5>
	<form action="do_assign_exception" method="post" id="formEdit"
		name="formEdit" enctype="multipart/form-data"
		onsubmit="return validate(this);">
		<input name="task_id" type="hidden"
			value="<?php echo $row['task_id'];?>" /> <input name="villager_id"
			type="hidden" value="<?php echo $row['villager_id'];?>" />
		<table width="100%" border="0" cellspacing="1" cellpadding="0"
			class="handling_exception" style="border: 1px solid #ccc;">
			<tr>
  		<?php foreach($code_map['handle_type'] as $key => $value) { ?>
		<td width="20"><input type="radio" name="handle_type"
					value="<?php echo $key;?>" id="handle_type_<?php echo $key;?>" /></td>
				<td><label for="handle_type_<?php echo $key;?>"><?php echo $value;?></label></td>
		<?php }?>
	</tr>
		</table>
		<div class="clearfix"></div>

		<div name="handle_end" class="info_forms"
			style="height: 200px; width: 55%; float: left; border-bottom: 1px solid #ccc;">
			<h2 class="title_16">处理方式：</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="handle_type hidden" id="dir_90">
				<tr height="60">
					<td width="80">结果：</td>
					<td><textarea name="exception_result" class="form_area"></textarea>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="handle_type hidden" id="dir_10">
				<tr>
					<td width="80">选择查阅人：</td>
					<td><select name="read_handle_user_id" title="查阅人"
						class="width_200">
							<option value="">请选择</option>
		        		<?php foreach($users as $key => $r) { ?>
	        				<option value="<?php echo $r['user_id'];?>"><?php echo $r['user_name'];?></option>
	        			<?php }?>
        			</select></td>
				</tr>
				<tr>
					<td>查阅意见：</td>
					<td><textarea name="read_handle_remark" class="form_area"></textarea>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="handle_type hidden" id="dir_20">
				<tr>
					<td width="80">选择承办人：</td>
					<td><select name="deal_handle_user_id" title="处理人"
						class="width_200">
							<option value="">请选择</option>
		        		<?php foreach($users as $key => $r) { ?>
	        				<option value="<?php echo $r['user_id'];?>"><?php echo $r['user_name'];?></option>
	        			<?php }?>
        			</select></td>
				</tr>
				<tr>
					<td width="80">承办意见：</td>
					<td><textarea name="deal_handle_remark" class="form_area"></textarea>
					</td>
				</tr>
			</table>
			<table width="100%" border="0" cellspacing="0" cellpadding="0"
				class="handle_type hidden" id="dir_40">
				<tr>
					<td width="80">挂起原因：</td>
					<td><textarea name="suspend_reason" class="form_area"></textarea></td>
				</tr>
			</table>
		</div>

		<div name="handle_record_info" class="info_forms"
			style="height: 200px; width: 40%; float: left; border-bottom: 1px solid #ccc;">
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
					<?php
					if (count ( $handle_records ) > 0) {
						$handle_record = end($handle_records);
						if($handle_record)
							echo $handle_record['operation_remark'];
					}
					?>
				</td>
				</tr>
			</table>
		</div>
		<div class="clearfix"></div>
		<div class="hastable">
			<h2 class="title_16">异常纪录</h2>
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<thead>
					<tr>
						<th width="80" style="text-align: left">处理名称</th>
						<th width="120" style="text-align: left">处理时间</th>
						<th width="100" style="text-align: left">处理人</th>
						<th width="100" style="text-align: left">接收人</th>
						<th style="text-align: left">处理内容</th>
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
					<td>
					<?php echo $record['receive_user_name'];?>
				</td>
					<td>
					<?php echo $record['operation_remark'];?>
				</td>
				</tr>
	    <?php }?>
	  	</table>

		</div>
	</form>
</div>
<script type="text/javascript">
$(function(){
	$("#formEdit input[name='handle_type']").change(function(){
		$("div[name='handle_end'] .handle_type").addClass("hidden");
		$("div[name='handle_end'] #dir_"+$(this).val()).removeClass("hidden");
	})
})
</script>
