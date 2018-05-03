<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="sys_save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
  	<input name="notice_id" type="hidden" value="<?php echo $row['notice_id'];?>"/>
	<table class="formTable" width="100%">
		<tbody>
		<tr height="30">
			<td class="inputTitle">通知标题</td>
		</tr>
		<tr height="30">
			<td class="inputArea">
				<input name="notice_title" class="required maxLength width_350" type="text" value="<?php echo $row['notice_title'];?>" maxLength="200" title="通知名称">
			</td>
		</tr>
		
		<tr height="30">
			<td class="inputTitle">内容</td>
		</tr>
		<tr height="30">
			<td class="inputArea">
				<textarea name="content" title="内容" class="form_area" rows="6"><?php echo $row['content'];?></textarea>
			</td>
		</tr>
		</tbody>
	</table>
</form>
<script type="text/javascript">
CKEDITOR.replace("content");
</script>
</div>