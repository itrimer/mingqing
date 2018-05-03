<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="department_id" type="hidden" value="<?php echo $row['department_id'];?>"/>
	<table class="formTable">
		<tbody>
		<tr height="30">
			<th width="80" align="left">部门名称：</th>
			<td class="inputArea">
				<input name="department_name" class="required i long maxLength width_200" type="text" value="<?php echo $row['department_name'];?>" maxLength="200" title="部门名称">
			</td>
		</tr>
		<tr height="120">
			<th align="left" style="vertical-align:top">部门描述：</th>
			<td>
				<textarea name="desc" class="maxLength form_area" maxLength="500" title="部门描述"><?php echo $row['desc'];?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
</form>
</div>