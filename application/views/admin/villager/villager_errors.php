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
					当前位置： <a href="<?php echo base_url('')?>/admin/villager/" title="民情信息">民情信息</a> > 异常民情
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
                   	姓名：<input name="villager_name" type="text" class="width_100" value="<?php echo $villager_name?>" placeholder="姓名">
                 	<input type="submit" value="搜索">
                  	</form>
					</div>
					<div class="float-right">
						<input id="set_families" type="button" value="家庭关系"> 
						<input id="assign_exception" type="button" value="处理异常">
					</div>
				</div>


				<div class="hastable">
				<form name="myform" class="pager-form" method="post" action="">
						<table id="sort-table" style="width:1300px;">
							<thead>
								<tr>
									<th width="10"><input type="checkbox" id="ch_box" onclick="check_rows(this, this.form.ids)" class="submit" /></th>
									<th width="35">家庭<br/>人数</th>
									<th width="60">姓名</th>
									<th width="70">异常处理状态</th>
									<th width="60">关系</th>
									<th width="100">身份证号码</th>
									<th width="40">性别</th>
									<th width="60">出生日期</th>
									<th width="60">村庄</th>
									<th width="40">门牌号</th>
									<th width="66">和谐指标</th>
									<th width="65">经济指标</th>
									<th width="65">健康指标</th>
									<th>户籍地址</th>
									<th style="width: 100px">操作</th>
								</tr>
							</thead>
							<tbody>
<?php $i = 0; foreach($query as $key => $row) { ++ $i; $err_class = ($row['harmony_code'] != 10 || $row['economy_code'] != 10 || $row['health_code'] != 10)?'error_info':''; ?>
								<tr class="<?php echo $err_class; echo $i % 2 == 0?'odd':'even'?>">
									<td class="center"><input type="checkbox" value="<?php echo $row["villager_id"];?>" name="ids" class="checkbox" /></td>
									<td><span class="slide_ ui-icon ui-icon-triangle-1-e"></span><?php echo count($row['families']) + 1?></td>
									<td><?php echo $row["villager_name"]?></td>
									<td>
									<?php $handle_status_title = '';
										if(isset($dict_map['handle_status'][$row['handle_status']])) {
											$handle_status_title = $dict_map['handle_status'][$row['handle_status']];
										}
									?>
									<?php echo $handle_status_title?></td>
									<td><?php echo $dict_map['relation_ship'][$row['relation_ship']]?></td>
									<td><?php echo $row["identity_card"]?></td>
									<td><?php echo $dict_map['sex'][$row['sex']]?></td>
									<td><?php echo $row["birth_day"]?></td>
									<td><?php echo $villages[$row['village_id']]?></td>
									<td><?php echo $row["house_no"]?></td>
									<?php $harmony_code_title = '';
										if(isset($dict_map['harmony_code'][$row['harmony_code']])) {
											$harmony_code_title = $dict_map['harmony_code'][$row['harmony_code']];
										}
									?>
									<td title="<?php echo $harmony_code_title;?>"><div class="<?php echo $row['harmony_code'] == 10?'green_icon':'red_icon'?>"> </div></td>
									<?php $economy_code_title = ''; 
										if(isset($dict_map['economy_code'][$row['economy_code']])) {
											$economy_code_title = $dict_map['economy_code'][$row['economy_code']];
										}
									?>
									<td title="<?php echo $economy_code_title?>"><div class="<?php echo $row['economy_code'] == 10?'green_icon':'red_icon'?>"> </div></td>
									<?php $health_code_title = ''; 
										if(isset($dict_map['health_code'][$row['health_code']])) {
											$health_code_title = $dict_map['health_code'][$row['health_code']];
										}
									?>
									<td title="<?php echo $health_code_title?>"><div class="<?php echo $row['health_code'] == 10?'green_icon':'red_icon'?>"> </div></td>
									<td><?php echo $row["address"]?></td>
									<td>
										<a href="javascript:void(0)" name="view_exception">查看</a>
										| <a href="javascript:void(0)" name="track_visit">跟踪回访</a>
									</td>
								</tr>
<?php if(count($row['families'])>0) { ?>
								<tr class='slide_next hidden'>
									<td colspan="14" valign="top">
										<table style="margin-bottom: 10px;" width="100%">
											<thead>
												<tr>
													<th width="60">姓名</th>
													<th width="80">与户主关系</th>
													<th width="100">身份证号</th>
													<th width="60">性别</th>
													<th width="70">出生日期</th>
													<th width="80">学历</th>
													<th width="60">婚姻状况</th>
													<th width="80">政治面貌</th>
													<th width="80">行业</th>
													<th width="60">联系电话</th>
													<th width="60">手机号码</th>
													<th>工作地址</th>
												</tr>
											</thead>
											<tbody>						
	<?php foreach($row['families'] as $f_key => $f_row) { ?>
											<tr>
												<td><?php echo $f_row["villager_name"]?></td>
												<td><?php echo $dict_map['relation_ship'][$f_row['relation_ship']]?></td>
												<td><?php echo $f_row["identity_card"]?></td>
												<td><?php echo $dict_map['sex'][$f_row['sex']]?></td>
												<td><?php echo $f_row["birth_day"]?></td>
												<td><?php echo $dict_map['education_degree'][$f_row['education_degree']]?></td>
												<td><?php 
												$c_marital_status = $f_row['marital_status'];
												if(isset($dict_map['marital_status'][$c_marital_status])){
													$c_marital_status = $dict_map['marital_status'][$c_marital_status];
												}
												echo $c_marital_status?></td>
												<td><?php echo $dict_map['identity_property'][$f_row['identity_property']]?></td>
												<td><?php echo $dict_map['industry'][$f_row['industry']]?></td>
												<td><?php echo $f_row["phone"]?></td>
												<td><?php echo $f_row["mobile"]?></td>
												<td><?php echo $f_row["work_address"]?></td>
											</tr>
	<?php }?>
									</tbody></table>
									</td>
								</tr>					
<?php }
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
}
$(function(){
	$('#set_families').click(function(){
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
		params.template_url = base_url_index + "admin/villager/set_families/" + ref,
		params.success_text = "操作成功";
		do_template(params);
		return false;
	});
	

	$("a[name='view_exception']").click(function(){
		var ref = $(this).parents('tr').find("input[name='ids']").val()
		var params = {width:860, height:650};
		params.template_url = base_url_index + "admin/villager/view_exception/" + ref,
		params.success_text = "保存成功";
		do_template(params);

		return false;
	});

	$('#suspend').click(function(){
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

		var params = {width:280, height:150};
		params.post_url = base_url_index + "admin/villager/suspend/" + ref,
		params.confirm_text = "你确定要挂起选中民情？";
		params.success_text = "操作成功";
		do_confirm_submit(params);
		return false;
	});
	
	$("table .slide_").click(function() {
		if($(this).hasClass('ui-icon-triangle-1-e')){
			$(this).removeClass("ui-icon-triangle-1-e").addClass("ui-icon-triangle-1-s");
		} else {
			$(this).removeClass("ui-icon-triangle-1-s").addClass("ui-icon-triangle-1-e");
		}

		var ntr = $(this).parents("tr").next("tr.slide_next:first");
		if(!ntr) return ;
		if(ntr.css('display') != 'table-row'){
			ntr.css('display', 'table-row');
		} else {
			ntr.fadeOut('slow');
		}
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
	
	$("a[name='track_visit']").click(function(){
		var ids = $(this).parents("tr").find("input[name='ids']");
		var ref = ids.eq(0).val();

		var params = {width:750, height:550};
		params.template_url = base_url_index + "admin/villager/for_feedback/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	
	function select_all(src){
	    var items = $("option:selected", src).remove();  
	    $(dest).append(items);  
	    $("option", dest).attr("selected", false); //清除option移动到右侧的自动选中的状态                  
	}

	function bind_event_add(){
		$("input[name='move2add']").click(function () {
			move($("select[name='src_village']"), $("select[name='dest_village[]']"));
		});  
		  
		$("input[name='move2del']").click(function () {
			move($("select[name='dest_village[]']"), $("select[name='src_village']"));
		});  

		$("select[name='src_village']").dblclick(function () {
				move($(this), $("select[name='dest_village[]']"));
		}); 
//	 	$("#movealltoright").click(function () {  
//	 	    var items = $("#select1 option").remove();  
//	 	    $("#select2").append(items);  
//	 	    $("#select2 option").attr("selected", false); //清除option移动到右侧的自动选中的状态  
//	 	});  
		  
//	 	$("#movealltoleft").click(function () {  
//	 	    var items = $("#select2 option").remove();  
//	 	    $("#select1").append(items);  
//	 	    $("#select1 option").attr("selected", false); //清除option移动到右侧的自动选中的状态  
//	 	}); 
	}
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>