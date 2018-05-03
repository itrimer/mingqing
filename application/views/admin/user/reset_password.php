<div class="info_forms" title="<?php echo $page_title;?>">
<form action="do_reset_password" method="post" id="formEdit" name="formEdit">
<input name="user_id" type="hidden" value="<?php echo $row['user_id']?>"/>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr height="40">
  	   		<th width="60" align="left">登录名：</th>
  		 	<td width="200"><?php echo $row['user_name'];?></td>
	      	<th width="80">姓名：</th>
	      	<td><?php echo $row['full_name']?></td>
        </tr>
        <tr height="40">
			<th  align="left">新密码：</th>
			<td>
				<input name="password" class="required minLength maxLength width_200" type="password" value="" minLength="5" maxLength="20" title="新密码">
				<span class="fc_r">*</span>
			</td>
			<th align="left">重复密码：</th>
			<td>
				<input name="re_password" class="required maxLength width_200 match" type="password" value="" maxLength="20" title="重复密码" match="password"/>
				<span class="fc_r">*</span>
			</td>
		</tr>
	</table>
</form>
</div>