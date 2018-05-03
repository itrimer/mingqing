<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
	<table class="formTable" style="width: 100%">
		<tbody>
		<tr height="30">
			<td style="text-align:center; font-weight: 700;"><?php echo $row['notice_title'];?></td>
		</tr>
		<tr height="30">
			<td style="text-align:center; font-weight: 700;">发布时间：<?php echo $row["create_date"]?> 
			<?php if(isset($row["department_name"])){?>来源：<?php echo $row["department_name"];}?>
			发布人：<?php echo $row["create_user_name"]?></td>
		</tr>
		<tr>
			<td> <span style="line-weight:1.5">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row['content'];?></span></td>
		</tr>
		</tbody>
	</table>
</div>