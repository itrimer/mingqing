<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('admin/common/meta.php'); ?>
</head>
<body>
<?php $this->load->view('admin/common/header.php'); ?>

<div id="page-wrapper">
	<?php $this->load->view('admin/common/sys_left.php'); ?>
	
	<div id="main-wrapper">
		<div id="main-content">
			<div class="path">
				当前位置： <a href="<?php echo base_url()?>admin/user/">系统设置</a> &gt;  用户管理
			</div>
			<div class="bar_block">
			  	<div class="float-left">
			  	<form name="formSearch" action="" method="get">
			 	查询: <select name="status" size="1" class="width_50">
				  	<option value="">状态</option>
				  	<option value="10" <?php if('10'==$status) echo 'selected'?>>生效</option>
				  	<option value="5" <?php if('5'==$status) echo 'selected'?>>已锁定</option>
				</select>
				<input name="full_name" type="text" value="<?php echo $full_name?>" class="width_100" placeholder="姓名">
					<input type="submit" value="搜索">
				</form>
				</div>
				<div class="float-right">
					<?php echo show_auth_buttons($page_buttons);?>
				</div>
			</div>   
						
			<div class="hastable">
			<form>
				<table cellspacing="0">
				<thead>
					<tr>
						<td><input type="checkbox" class="checkbox" value="" onclick="check_rows(this, this.form.ids)"/></td>
						<td>用户名</td>
						<td>用户姓名</td>
						<td>工作电话</td>
						<td>手机</td>
						<td>最后登录时间</td>
						<td>登录IP</td>
						<td>角色</td>
						<td>部门</td>
						<td>村庄</td>
						<td>状态</td>
					</tr>
				</thead>
				<tbody>
<?php
foreach($query as $key => $row) {
?>
				<tr>
					<td height="25">
						<input name="ids" type="checkbox" value="<?php echo $row["user_id"]?>" />
					</td>
					<td title="<?php echo $row["user_name"]?>"><?php echo $row["user_name"]?></td>
					<td align="center"><?php echo $row["full_name"];?></td>
					<td align="center"><?php echo $row["work_phone"];?></td>
					<td align="center"><?php echo $row["mobile"];?></td>
					<td align="center"><?php echo $row["last_login"]?></td>
					<td align="center"><?php echo $row["login_ip"];?></td>
					<td align="center"><?php echo $row['role_name']?></td>
					<td align="center"><?php echo $row["department_name"];?></td>
					<td align="center"><?php echo $row["village_name"];?></td>
					<td align="center"><?php echo $row["status"]==10?"生效":"锁定";?></td>
			   	</tr>
<?php } ?>								
				</tbody>
				</table>
			</form>
			</div>
			<?php echo $paginaton_bar?>
			<div class="clearfix"></div>		   
   		</div>
	</div>
</div> 
<script type="text/javascript">
$(function(){
	//修改用户
	$('#user_add').click(function(){
		var params = {width:640, height:300};
		params.template_url = base_url_index + "admin/user/add";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	
	//修改用户
	$("#edit_user").click(function(){
		var ids = $("input[name='ids']:checked");
		if(ids.length == 0){
			showMsg( "请选择一条数据！", "提示");
			return false;
		}
		if(ids.length > 1){
			showMsg( "请最多选择一条数据！", "提示");
			return false;
		}

		var ref = ids.eq(0).val();
		
		var params = {width:640, height:300};
		params.template_url = base_url_index + "admin/user/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	
	//锁定用户
	$("#lock_user").click(function(){
		var ids = $("input[name='ids']:checked");
		if(ids.length == 0){
			showMsg( "请选择一条数据！", "提示");
			return false;
		}
		if(ids.length > 1){
			showMsg( "请最多选择一条数据！", "提示");
			return false;
		}

		var ref = ids.eq(0).val();
		var params = {width:240, height:150}
		params.post_url = base_url_index + "admin/user/lock/" + ref;
		params.confirm_text = "锁定后，该用户将无法登录系统。<br/>您确定锁定该用户吗？";
		params.success_text = "锁定成功";
		
		do_confirm_submit(params);
		return false;
	});
	$("#unlock_user").click(function(){
		var ids = $("input[name='ids']:checked");
		if(ids.length == 0){
			showMsg( "请选择一条数据！", "提示");
			return false;
		}
		if(ids.length > 1){
			showMsg( "请最多选择一条数据！", "提示");
			return false;
		}

		var ref = ids.eq(0).val();
	
		var params = {width:240, height:150}
		params.post_url = base_url_index + "admin/user/unlock/" + ref;
		params.confirm_text = "你确定要解锁选中员工？";
		params.success_text = "解锁成功";
		do_confirm_submit(params);
	
		return false;
	});
	
	//修改用户
	$("#reset_password").click(function(){
		var ids = $("input[name='ids']:checked");
		if(ids.length == 0){
			showMsg( "请选择一条数据！", "提示");
			return false;
		}
		if(ids.length > 1){
			showMsg( "请最多选择一条数据！", "提示");
			return false;
		}
		
		var ref = ids.eq(0).val();
		
		var params = {width:550, height:250}
		params.template_url = base_url_index + "admin/user/reset_password/" + ref,
		params.success_text = "重置成功";
		do_template(params);
		
		return false;
	});
	$('#user_delete').click(function(){
		var ids = $("input[name='ids']:checked");
		if(ids.length == 0){
			showMsg( "请选择一条数据！", "提示");
			return false;
		}
		if(ids.length > 1){
			showMsg( "请最多选择一条数据！", "提示");
			return false;
		}

		var ref = ids.eq(0).val();

		var params = {width:320, height:160};
		params.post_url = base_url_index + "admin/user/delete/" + ref,
		params.confirm_text = "你确定要删除选中用户？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});
	
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>