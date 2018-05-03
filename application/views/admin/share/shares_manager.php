<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('admin/common/meta.php'); ?>
</head>
<body>
<?php $this->load->view('admin/common/header.php'); ?>
<div id="page-wrapper">
	<?php $this->load->view('admin/share/left.php'); ?>
	
	<div id="main-wrapper">
		<div id="main-content">
	 		<div class="path">
	 			当前位置： 系统网盘 &gt; <a href="<?php echo base_url()?>admin/share/shares">资料共享</a>
	 		</div>

			<div class="bar_block">
				<div class="float-left">
				<form name="formSearch" action="shares" method="get">
			   	标题：<input name="share_name" type="text" class="width_100" value="<?php echo $share_name?>" placeholder="标题">
			 		<input type="submit" value="搜索">
			  	</form>
			 	</div>
			  	<div class="float-right">
			  		<?php echo show_auth_buttons($page_buttons);?>
				</div>
			</div>   
			
			<div class="hastable">
			<form name="myform" class="pager-form" method="post" action="">
				<table cellspacing="0">
				<thead>
					<tr>
						<td>文件名</td>
						<td width="50">大小(kb)</td>
						<td width="110">共享时间</td>
						<td width="100">上传者</td>
					</tr>
				</thead>
				<tbody>
<?php $i = 0;
foreach($query as $key => $row) { ++ $i;
?>			
					<tr height="30" class="<?php echo $i % 2 == 0?'even':'odd'?>">
						<td>
							<a href="javascript:void(0)" name="download" ref="<?php echo $row["share_id"]?>" title="下载"><?php echo $row["share_name"]?></a>
						</td>
						<td><?php echo $row["file_size"]?$row["file_size"]:'0'?></td>
						<td><?php echo $row["update_date"]?></td>
						<td><?php echo $row["create_user_name"]?></td>
				   	</tr>
<?php
}
?>				</tbody>
				</table>
			</form>
			</div>   
			<?php echo $paginaton_bar?>
			<div class="clearfix"></div>
		</div>
	</div>	   
</div>
<iframe name="frameName" style="display: none"></iframe>
<script type="text/javascript">
$(function(){
	$('#share_add').click(function(){
		var params = {width:450, height:250};
		params.template_url = base_url_index + "admin/share/upload";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$('#share_edit').click(function(){
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

		var params = {width:450, height:250};
		params.template_url = base_url_index + "admin/share/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	$('#share_delete').click(function(){
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
		params.post_url = base_url_index + "admin/share/delete/" + ref,
		params.confirm_text = "你确定要删除选中文件？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});


	$("a[name='edit']").click(function(){
		var ref = $(this).attr("ref");
		var params = {width:450, height:250};
		params.template_url = base_url_index + "admin/share/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$("a[name='delete']").click(function(){
		var ref = $(this).attr("ref");

		var params = {width:300, height:160};
		params.post_url = base_url_index + "admin/share/delete/" + ref,
		params.confirm_text = "你确定要删除选中文件？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});
	$("a[name='share']").click(function(){
		var ref = $(this).attr("ref");

		var params = {width:300, height:160};
		params.post_url = base_url_index + "admin/share/share_file/" + ref,
		params.confirm_text = "你确定要共享选中文件？";
		params.success_text = "共享成功";
		do_confirm_submit(params);

		return false;
	});
	$("a[name='cancel_share']").click(function(){
		var ref = $(this).attr("ref");

		var params = {width:300, height:160};
		params.post_url = base_url_index + "admin/share/cancel_share/" + ref,
		params.confirm_text = "你确定要取消共享选中文件？";
		params.success_text = "取消成功";
		do_confirm_submit(params);

		return false;
	});
	$("a[name='download']").click(function(){
		var ref = $(this).attr("ref");

		window.frames["frameName"].location.href = base_url_index + "admin/share/download/" + ref;
		
		return false;
	});
	
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>