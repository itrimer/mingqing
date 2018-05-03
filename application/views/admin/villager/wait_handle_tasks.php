<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('admin/common/meta.php'); ?>
</head>
<body>
<?php $this->load->view('admin/common/header.php'); ?>
<div id="page-wrapper">
	<?php $this->load->view('admin/villager/left.php'); ?>
	<div id="main-wrapper">
		<div id="main-content">
			<div class="path">
				当前位置： <a href="<?php echo base_url('')?>/admin/villager/" title="民情信息">民情信息</a> > 等待处理
			</div>
			<div class="bar_block">
				<div class="float-left">
				<form name="formSearch" action="" method="get">
				<input name="handle_status" type="hidden" value="<?php echo isset($handle_status)? $handle_status:''?>">
				查询:<select name="village_id"  title="村庄" class="width_100 required">
							<option value="">--村庄--</option>
							<?php foreach($villages as $key => $r) { ?>
								<option value="<?php echo $key?>" <?php if($key==$village_id) {echo "selected";}?>><?php echo $r;?></option>
							<?php }?>
						</select>
			   	<input name="villager_name" type="text" class="width_100" value="<?php echo $villager_name?>" placeholder="姓名">
                   	<select name="exception_type" title="异常类型" class="width_100">
	        					<option value="">异常类型</option>
			        			<?php foreach($dict_map['exception_type'] as $key => $r) { ?>
		        				<option value="<?php echo $key?>" <?php if($key==$exception_type) {echo "selected";}?>><?php echo $r;?></option>
		        			<?php }?>
        					</select>
			   	<input type="submit" value="搜索">
			  	</form>
				</div>
				<div class="float-right">
					<?php echo show_auth_buttons($page_buttons);?>
				</div>
			</div>
	
			<div class="hastable">
			<form name="myform" class="pager-form" method="post" action="">
				<table id="sort-table" style="width:2000px;">
					<thead>
						<tr>
							<th width="10"><input type="checkbox" id="ch_box" onclick="check_rows(this, this.form.ids)" class="submit" /></th>
							<th width="60">姓名</th>
							<th width="60">异常类型</th>
							<th width="60">处理状态</th>
							<th width="70">处理类型</th>
							<th width="70">接收人</th>
							<th width="70">处理人</th>
							<th width="70">处理时间</th>
							<th width="70">登记人</th>
							<th width="70">登记时间</th>
							<th>安排意见</th>
							<th width="70">安排人</th>
							<th width="80">安排时间</th>
							<th width="60">性别</th>
							<th width="60">村庄</th>
							<th width="140">异常描述</th>
							<th width="200">异常详情</th>
						</tr>
					</thead>
					<tbody>
<?php $i = 0; foreach($query as $key => $row) { ++ $i; ?>
					<tr class="<?php echo $i % 2 == 0?'odd':'even'?>">
						<td class="center">
							<input type="checkbox" value="<?php echo $row["task_id"];?>" name="ids" class="checkbox" />
						</td>
						<td><?php echo $row["villager_name"]?></td>
						<td><?php echo $row["exception_type_value"]?></td>
						<td><?php echo $row['handle_status_value']?></td>
						<td><?php echo $row['handle_type_value']?$row['handle_type_value']:'未指定'?></td>
						<td><?php echo $row['receive_user_name']?$row['receive_user_name']:'未指定'?></td>
						<td><?php echo $row['handle_user_name']?$row['handle_user_name']:'未处理'?></td>
						<td><?php echo $row['handle_time']?></td>
						<td><?php echo $row["record_user_name"]?></td>
						<td><?php echo $row["record_time"]?></td>
						<td><?php echo character_limiter($row["assign_remark"], 30)?></td>
						<td><?php echo $row["assign_user_name"]?></td>
						<td><?php echo $row["assign_time"]?></td>
						<td><?php echo get_dict_value($dict_map, 'sex', $row['sex'])?></td>
						<td><?php echo $row['village_name']?></td>
						<?php $exception_title = get_dict_value($dict_map, $row['exception_type'], $row['exception_code']);?>
						<td title="<?php echo $exception_title;?>"><?php echo $exception_title;?></td>
						<td title="<?php echo $row['exception_condition'];?>"><?php echo $row['exception_condition'];?></td>
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
		</div>
	</div>
</div>
<script type="text/javascript">
function init_tabs(){
	$('#tabs').tabs();
	$(".thum_img a").fancybox();
}

$(function(){
	$("#view_exception").click(function(){
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
		
		var params = {width:860, height:650};
		params.fn = init_tabs;
		params.template_url = base_url_index + "admin/villager/view_exception/" + ref,
		params.success_text = "保存成功";
		do_template(params);

		return false;
	});
	$('#assign_exception').click(function(){
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

		var params = {width:860, height:550};
		
		params.template_url = base_url_index + "admin/villager/assign_exception/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	
	$('#sub_handle_task').click(function(){
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

		var params = {width:860, height:550};
		
		params.template_url = base_url_index + "admin/villager/sub_handle_task/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$("a[name='track_visit']").click(function(){
		var ids = $(this).parents("tr").find("input[name='ids']");
		var ref = ids.eq(0).val();

		var params = {width:750, height:550};
		params.template_url = base_url_index + "admin/villager/for_feedback/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>