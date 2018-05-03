<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('admin/common/meta.php'); ?>
<script charset="utf-8" src="<?php echo base_url()?>js/ckeditor/ckeditor.js"></script>
</head>
<body>
<?php $this->load->view('admin/common/header.php'); ?>
<div id="page-wrapper">
	<?php $this->load->view('admin/notice/left.php'); ?>

	<div id="main-wrapper">
		<div id="main-content">
	 		<div class="path">
	 			当前位置： <a href="<?php echo base_url()?>admin/notice/">通知公告</a> >  部门通知
	 		</div>
			<div class="bar_block">
				<div class="float-left">
				<form name="formSearch" action="" method="get">
			   	<select name="department_id"  title="部门" class="width_100 required">
					<option value="">--部门--</option>
					<?php foreach($dep_map as $key => $r) { ?>
						<option value="<?php echo $key?>" <?php if($key == $department_id) {echo "selected";}?>><?php echo $r;?></option>
					<?php }?>
				</select>
				<input name="notice_title" type="text" class="width_100" value="<?php echo $notice_title?>" placeholder="标题">
			 		<input type="submit" value="搜索">
			  	</form>
			 	</div>
			  	<div class="float-right">
			  		<?php echo show_auth_buttons($page_buttons);?>
				</div>
			</div>   
						
			<div class="hastable">
			<form action="">
				<table cellspacing="0">
				<thead>
					<tr>
						<td width="25"><input type="checkbox" class="checkbox" onclick="check_rows(this, this.form.ids)"/></td>
						<td>通知标题</td>
						<td width="100">部门</td>
						<td width="110">发布时间</td>
					  	<td width="90">发布人</td>
					  	<td width="40">已读</td>
					</tr>
				</thead>
				<tbody>
<?php
foreach($query as $key => $row) {
?>			
				<tr>
					<td height="30">
						<input name="ids" type="checkbox" value="<?php echo $row["notice_id"]?>" />
					</td>
					<td title="<?php echo $row["notice_title"]?>"><?php echo $row["notice_title"]?></td>
					<td><?php echo $row["department_name"]?></td>
					<td><?php echo $row["create_date"]?></td>
					<td><?php echo $row["create_user_name"]?></td>
					<td><b><?php echo $row["is_read"] == 1?'已读':'未读'?></b></td>
			   	</tr>
<?php
}
?>
				</tbody>
				</table>
			</div>					 
			<?php echo $paginaton_bar?>
			<div class="clearfix"></div>
		</form>
		</div>
	</div>	   
</div>
<script type="text/javascript">
$(function(){
	$('#notice_add').click(function(){
		var params = {width:900, height:550};
		params.template_url = base_url_index + "admin/notice/add";
		params.success_text = "保存成功";

		params.onsubmit=function(){$("textarea[name='content']").val(CKEDITOR.instances.content.getData());}
		do_template(params);
		return false;
	});

	$('#notice_edit').click(function(){
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

		var params = {width:900, height:550};
		params.template_url = base_url_index + "admin/notice/edit/" + ref,
		params.success_text = "保存成功";
		params.onsubmit=function(){$("textarea[name='content']").val(CKEDITOR.instances.content.getData());}
		do_template(params);
		return false;
	});
	$('#notice_delete').click(function(){
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
		params.post_url = base_url_index + "admin/notice/delete/" + ref,
		params.confirm_text = "你确定要删除选中通知？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});
	$('#notice_view').click(function(){
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

		var params = {width:900, height:550};
		params.template_url = base_url_index + "admin/notice/view/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>