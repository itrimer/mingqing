<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="do_mkdir" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" enctype="multipart/form-data">
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="share_id" type="hidden" value="<?php echo $row['share_id'];?>"/>
  	<input name="parent_id" type="hidden" value="<?php echo $row['parent_id'];?>"/>
  	<table class="formTable">
		<tbody>
		<tr height="30">
			<th width="80">文件夹：</th>
			<td>
				<input name="share_name" class="required maxLength" type="text" value="<?php echo $row['share_name'];?>" maxLength="200" title="文件夹名称">
			</td>
		</tr>
		</tbody>
	</table>
</form>
</div>