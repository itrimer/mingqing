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
	 			当前位置： <a href="<?php echo base_url()?>admin/user/"> 系统管理</a> &gt; 部门管理
	 		</div>
			<div class="bar_block">
				<div class="float-left">
				  	<form name="formSearch" action="." method="get">
				 	部门名称：<input name="department_name" type="text" value="<?php echo $department_name?>" class="width_100" placeholder="部门名称">
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
							<td width="30"><input type="checkbox" class="checkbox" value="" onclick="check_rows(this, this.form.ids)"/></td>
							<td width="140" align="center">部门名称</td>
							<td>部门描述</td>
						</tr>
					</thead>
					<tbody>
<?php
foreach($query as $key => $row) {
?>			
			<tr>
				<td height="30">
					<input name="ids" type="checkbox" value="<?php echo $row["department_id"]?>" />
				</td>
				<td title="<?php echo $row["department_name"]?>"><?php echo $row["department_name"]?></td>
				<td><?php echo $row["desc"]?></td>
		   	</tr>
<?php
}
?>
								</tbody>
							</table>
	   					</form>
						</div>  
						<?php echo $paginaton_bar?>
				<div class="clearfix"></div>   
					</td>
		</div>
	</div>   
</div>
<script type="text/javascript">
$(function(){
	$('#department_add').click(function(){
		var params = {width:450, height:350};
		params.template_url = base_url_index + "admin/department/add";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$('#department_edit').click(function(){
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
		
		var params = {width:450, height:350};
		params.template_url = base_url_index + "admin/department/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	$('#department_delete').click(function(){
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
		
		var params = {width:300, height:160};
		params.post_url = base_url_index + "admin/department/delete/" + ref,
		params.confirm_text = "你确定要删除选中部门？";
		params.success_text = "删除成功";
		do_confirm_submit(params);
		
		return false;
	});
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>