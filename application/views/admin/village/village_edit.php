<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="village_id" type="hidden" value="<?php echo $row['village_id'];?>"/>
	<table class="formTable">
		<tbody>
		<tr height="60">
			<td class="inputTitle" width="80">村庄名称:</td>
			<td class="inputArea">
				<input name="village_name" class="required maxLength width_200" type="text" value="<?php echo $row['village_name'];?>" maxLength="200" title="村庄名称">
			</td>
		</tr>
		<tr height="60">
			<td class="inputTitle">详细地址</td>
			<td class="inputArea">
				<input name="address" class="width_350" type="text" value="<?php echo $row['address'];?>" title="地址">
			</td>
		</tr>
		</tbody>
	</table>
</form>
</div>