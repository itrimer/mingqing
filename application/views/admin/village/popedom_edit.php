<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="popedom_id" type="hidden" value="<?php echo $row['popedom_id'];?>"/>
	<table class="formTable">
		<tbody>
		<tr height="30">
			<td class="inputTitle" width="80">辖区名称:</td>
			<td>
				<input name="popedom_name" class="required maxLength width_200" type="text" value="<?php echo $row['popedom_name'];?>" maxLength="200" title="辖区名称">
			</td>
		</tr>
		<tr height="30">
			<td class="inputTitle">备注:</td>
			<td class="inputArea">
				<textarea name="remark" class="maxLength form_area" maxLength="250" title="描述"><?php echo $row['remark'];?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
</form>
</div>