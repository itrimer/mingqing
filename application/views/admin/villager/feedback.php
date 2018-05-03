<div id="form_div" title="跟踪回访">
<form action="save_feedback" method="post" id="formEdit" name="formEdit"
		enctype="multipart/form-data" onsubmit="return validate(this);">
	<input name="villager_id" type="hidden" value="<?php echo $row['villager_id'];?>"/>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="80">发生地点：</td>
				<td>
					<input name="exception_addr" type="text" class="width_350" value="<?php echo $row['exception_addr'];?>"disabled="disabled"/>
				</td>
			</tr>
			<tr>
				<td>发生时间：</td>
				<td>
					<input name="exception_time" class="width_200 datepicker" type="text" value="<?php echo $row['exception_time'];?>" title="发生时间" disabled="disabled"/>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top">事件原由：</td>
				<td>
					<textarea name="exception_condition" cols="60" rows="4"disabled="disabled"><?php echo $row['exception_condition'];?></textarea>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top">经过：</td>
				<td>
					<textarea name="exception_process" cols="60" rows="4" disabled="disabled"><?php echo $row['exception_process'];?></textarea>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top">结果：</td>
				<td>
					<textarea name="exception_result" cols="60" rows="4" disabled="disabled"><?php echo $row['exception_result'];?></textarea>
				</td>
			</tr>
			<tr>
				<td style="vertical-align: top">跟踪回访：</td>
				<td>
					<textarea name="exception_feedback" cols="60" rows="4"><?php echo $row['exception_feedback'];?></textarea>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
</div>