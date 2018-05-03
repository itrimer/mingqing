<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save_menu" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="menu_id" type="hidden" value="<?php echo $row['menu_id'];?>"/>
	<table class="formTable">
		<tbody>
		<tr height="50">
			<th width="80" align="left">菜单名称：</th>
			<td class="inputArea">
				<input name="menu_name" class="required maxLength width_200" type="text" value="<?php echo $row['menu_name'];?>" maxLength="200" title="菜单名称">
			</td>
		</tr>
		<tr height="50">
			<th>菜单地址：</th>
			<td class="inputArea">
				<input name="page_url" class="required maxLength width_200" type="text" value="<?php echo $row['page_url'];?>" maxLength="200" title="菜单地址">
			</td>
		</tr>
		</tbody>
	</table>
</form>
</div>