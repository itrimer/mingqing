<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="do_add_villages" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
  	<input name="popedom_id" type="hidden" value="<?php echo $row['popedom_id'];?>"/>
	<table class="formTable" width="100%">
		<tbody>
		<tr height="50">
			<td colspan="3">辖区名称 ：<b><?php echo $row['popedom_name'];?></b></td>
		</tr>
		<tr>
			<td>所有村庄<br/>
				<select name="src_village" multiple="multiple" style="height:250px; width:200px;">
					<?php foreach($villages as $key => $v_row) { ?>
					<?php if(!$v_row['popedom_id']) {?>
			     		<option value="<?php echo $v_row['village_id']?>"><?php echo $v_row['village_name'];?></option>
			     	<?php }}?>
				</select>
			</td>
			<td width="70" style="vertical-align:middle;text-align: center;">
				<input name="move2add" value=">>" type="button"/>
				<br/>
				<input name="move2del" value="<<" type="button"/>
			</td>
			<td>
				辖区选中村庄<br/>
				<select name="dest_village[]" multiple="multiple" class='required' style="height:250px; width:200px;" title="村庄">
					<?php foreach($villages as $key => $v_row) { 
					 if($v_row['popedom_id']==$row['popedom_id']) {?>
			     		<option value="<?php echo $v_row['village_id']?>"><?php echo $v_row['village_name'];?></option>
			     	<?php }
					}?>
				</select>
			</td>
		</tr>
	</table>
</form>
</div>