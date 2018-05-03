<div id="form_div" class="" title="<?php echo $page_title;?>">
<form action="do_save_role_auth" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
  	<input name="role_id" type="hidden" value="<?php echo $row['role_id'];?>"/>
  	<div class="hastable">
  	<h5 class="title_16">角色：<?php echo $row['role_name'];?></h5>
	<table class="formTable">
		<thead>
			<tr>
				<th width="30">
					&nbsp;
				</th>
				<th width="100">菜单名称</th>
				<th>按钮</th>
			</tr>
		</thead>
		<tbody>
<?php
foreach($menus as $key => $menu) {
?>	
		<tr height="30">
			<td class="inputArea">
				<input type="checkbox" name="menu_id[]" value="<?php echo $menu['menu_id'];?>" <?php if(isset($authed_menu[$menu['menu_id']])) echo 'checked';?>>
			</td>
			<td class="inputArea">
				<?php echo $menu['menu_name'];?>
			</td>
			<td>
			<?php foreach($menu['buttons'] as $b_key => $button) { ?>
				<input type="checkbox" name="menu_id[]" value="<?php echo $button['menu_id'];?>" <?php if(isset($authed_menu[$button['menu_id']])) echo 'checked';?>>
				<?php echo $button['menu_name'];?>
			<?php	} ?>
			</td>
		</tr>
<?php } ?>
		</tbody>
	</table>
	</div>
</form>
</div>