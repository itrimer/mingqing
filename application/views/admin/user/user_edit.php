<div id="form_div" class="info_forms" title="<?php echo $page_title;?>">
<form action="save" method="post" id="formEdit" name="formEdit" onsubmit="return validate(this);" >
<input name="act" type="hidden" value="<?php echo $act;?>"/>
<input name="user_id" type="hidden" value="<?php echo $row['user_id'];?>"/>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0">
    	<tr>
      		<th width="80" align="left">登录名<span class="fc_r">*</span>：</th>
  		 	<td width="250">
  		 	 	<?php if("insert" == $act){?>
  		 	 		<input name="user_name" type="text" class="required width_200" value="<?php echo $row['user_name'];?>"
  		 	 			maxLength="25" title="登录名"/>
	  		 	<?php } else {?>
	  		 		<input name="user_name" type="text" class="width_200" value="<?php echo $row['user_name'];?>" disabled="disabled"/>
	  		 	<?php }?>
  		 	 </td>
	      	<th width="80">姓名<span class="fc_r">*</span>：</th>
	      	<td width="250"><input name="full_name" type="text" class="required width_200" maxLength="25" title="姓名" value="<?php echo $row['full_name'];?>"/>
	      	</td>
        </tr>
<?php if("insert" == $act){?>
		<tr height="30">
			<th  align="left">密码<span class="fc_r">*</span>：</th>
			<td>
				<input name="password" class="required minLength maxLength width_200" type="password" value="<?php echo $row['password'];?>" minLength="5" maxLength="20" title="密码">
			</td>
			<th align="left">重复密码<span class="fc_r">*</span>：</th>
			<td>
				<input name="re_password" class="required maxLength width_200 match" type="password" value="" maxLength="100" title="重复密码" match="password"/>
			</td>
		</tr>
<?php }?>
        <tr>
			<th align="left">手机号<span class="fc_r">*</span>：</th>
	    	<td>
	    		<input name="mobile" type="text" class="width_200 required" value="<?php echo $row['mobile'];?>" title="手机号"/>
	    	</td>
	       	<th>工作电话：</th>
	       	<td><input name="work_phone" type="text" class="width_200" value="<?php echo $row['work_phone'];?>" title="工作电话"/></td>
	    </tr>
		<tr>
			<th align="left">家庭电话<span class="fc_r">*</span>：</th>
	      	<td><input name="home_phone" type="text" class="width_200" value="<?php echo $row['home_phone'];?>"/></td>
			<th>角色：</th>
	      	<td><select name="role_id" title="角色" class="required width_200">
        			<option value="">--请选择--</option>
        			<?php foreach($roles as $dkey => $drow) { ?>
        				<option value="<?php echo $drow['role_id'];?>" <?php if($drow['role_id']==$row['role_id']) {echo "selected";}?>><?php echo $drow['role_name']?></option>
        			<?php }?>
        		</select>
        	</td>
        </tr>
		<tr>
			<th>部门<span class="fc_r">*</span>：</th>
	      	<td><select name="department_id" title="部门" class="required width_200">
        			<option value="">--请选择--</option>
        			<?php foreach($departments as $dkey => $dep) { ?>
        				<option value="<?php echo $dep['department_id'];?>" <?php if($dep['department_id']==$row['department_id']) {echo "selected";}?>><?php echo $dep['department_name'];?></option>
        			<?php }?>
        		</select>
        	</td>
	      	<th align="left">村庄：</th>
	      	<td><select name="village_id"  title="村庄" class="width_200">
        			<option value="">--请选择--</option>
        			<?php foreach($villages as $dkey => $drow) { ?>
        				<option value="<?php echo $drow['village_id'];?>" <?php if($drow['village_id']==$row['village_id']) {echo "selected";}?>><?php echo $drow['village_name'];?></option>
        			<?php }?>
        		</select>
        	</td>
  		</tr>
	</table>
</form>
</div>