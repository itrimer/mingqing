<div id="form_div" title="Excel导入">
<form action="do_import" method="post" id="formEdit" name="formEdit"
		enctype="multipart/form-data" onsubmit="return validate(this);">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td width="80">选择文件：</td>
				<td>
					<input name="excel" type="file" class="width_350" />
					<br/>
					<a href="<?php echo base_url('/')?>admin/villager/download_template?type=villager" target="_blank">下载模板</a>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
</div>