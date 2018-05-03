<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="notice_id" type="hidden" value="<?php echo $row['notice_id'];?>"/>
	<table class="formTable" width="100%">
		<tbody>
		<tr height="30">
			<td class="inputTitle" width="250">部门</td>
			<td class="inputTitle">通知标题</td>
		</tr>
		<tr height="30">
			<td>
				<select name="department_id" title="部门" class="required width_200">
        			<option value="">---请选择部门---</option>
        			<?php foreach($departments as $dkey => $dep) { ?>
        				<option value="<?php echo $dep['department_id'];?>" <?php if($dep['department_id']==$row['department_id']) {echo "selected";}?>><?php echo $dep['department_name'];?></option>
        			<?php }?>
        		</select>
        	</td>
			<td class="inputArea">
				<input name="notice_title" class="required maxLength width_350" type="text" value="<?php echo $row['notice_title'];?>" maxLength="200" title="通知名称">
			</td>
		</tr>
		<tr height="30">
			<td colspan="2">内容</td>
		</tr>
		<tr height="30">
			<td colspan="2">
				<textarea name="content" id="content" title="内容" class="form_area"><?php echo $row['content'];?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript">
CKEDITOR.replace("content");
</script>
</div>
