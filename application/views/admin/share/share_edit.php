<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" enctype="multipart/form-data">
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="share_id" type="hidden" value="<?php echo $row['share_id'];?>"/>
  	<input name="is_directory" type="hidden" value="<?php echo $row['is_directory'];?>"/>
  	<input name="parent_id" type="hidden" value="<?php echo $row['parent_id'];?>"/>
  	<table class="formTable">
		<tbody>
		<tr height="30">
			<th width="80">名称：</th>
			<td>
				<input name="share_name" class="required maxLength" type="text" value="<?php echo $row['share_name'];?>" maxLength="200" title="名称">
			</td>
		</tr>
		<?php if($row['is_directory'] != 1 && $act == 'insert'){?>
		<tr height="30">
			<th>文件地址：</th>
			<td>
				<input name="file" type="file" onchange="on_file_change(this)">
			</td>
		</tr>
		<?php }?>
		</tbody>
	</table>
</form>
</div>
<script type="text/javascript">
function on_file_change(file){
	var shareNameText = file.form.share_name; 
	if(shareNameText.value == ""){
		var name = file.value;
		if(name.indexOf('.') > -1){
			name = name.substring(0, name.indexOf('.'));
		}
		shareNameText.value=name;
	}
}
</script>