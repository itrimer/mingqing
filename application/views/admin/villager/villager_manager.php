<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('admin/common/meta.php'); ?>
<script type="text/javascript">
$(function(){
calaMainWrapperWidth();
});
</script>
</head>
<body>
<?php $this->load->view('admin/common/header.php'); ?>
<div id="page-wrapper">
	<?php $this->load->view('admin/villager/left.php'); ?>
	
	<div id="main-wrapper">
		<div id="main-content">
			<div class="path">
				当前位置： <a href="<?php echo base_url('')?>/admin/villager/" title="民情信息">民情信息</a> > 所有民情信息
			</div>
			<div class="bar_block">
				<div class="float-left">
				<form name="formSearch" action="" method="get">
					<input name="handle_status" type="hidden" value="<?php echo isset($handle_status)? $handle_status:''?>">
                   	查询:<select name="village_id"  title="村庄" class="width_100">
	        					<option value="">--村庄--</option>
			        			<?php foreach($villages as $key => $r) { ?>
		        				<option value="<?php echo $key?>" <?php if($key==$village_id) {echo "selected";}?>><?php echo $r;?></option>
		        			<?php }?>
        					</select>
                   	<input type="text" name="villager_name" class="width_100" value="<?php echo $villager_name?>" placeholder="姓名">
                   	<select name="sex" title="性别" class="width_50">
	        					<option value="">性别</option>
			        			<?php foreach($dict_map['sex'] as $key => $r) { ?>
		        				<option value="<?php echo $key?>" <?php if($key==$sex) {echo "selected";}?>><?php echo $r;?></option>
		        			<?php }?>
        					</select>
        					<select name="identity_dy" title="是否党员" class="width_100">
	        					<option value="">是否党员</option>
			        			<?php foreach($dict_map['yes_or_no'] as $key => $r) { ?>
		        				<option value="<?php echo $key?>" <?php if($key==$identity_dy) {echo "selected";}?>><?php echo $r;?></option>
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
						<th width="35">家庭<br/>人数</th>
						<th width="60">姓名</th>
						<th width="70">与户主关系</th>
						<th width="100">身份证号码</th>
						<th width="40">性别</th>
						<th width="70">出生日期</th>
						<th width="35">年龄</th>
						<th width="70">村庄</th>
						<th width="40">门牌号</th>
						<th width="66">和谐指标</th>
						<th width="65">经济指标</th>
						<th width="65">健康指标</th>
						<th width="66">政治面貌</th>
						<th width="50">是否党员</th>
						<th width="50">身高(cm)</th>
						<th width="66">文化程度</th>
						<th width="60">婚姻状况</th>
						<th width="66">职业</th>
						<th width="66">固定电话</th>
						<th width="66">手机号</th>
						<th width="66">健康状况</th>
						<th width="66">外出人员</th>
						<th>户籍地址</th>
						<th>工作地址</th>
						<th width="100">操作</th>
					</tr>
				</thead>
				<tbody>
<?php $i = 0; foreach($query as $key => $row) { ++ $i; $err_class = ($row['harmony_code'] != 10 || $row['economy_code'] != 10 || $row['health_code'] != 10)?'error_info':''; ?>
					<tr class="<?php echo $err_class; echo $i % 2 == 0?' odd':' even'?>">
						<td class="center"><input type="checkbox" value="<?php echo $row["villager_id"];?>" name="ids" class="checkbox" /></td>
						<td><span class="slide_ ui-icon ui-icon-triangle-1-e"></span><?php echo count($row['families']) + 1?></td>
						<td><?php echo $row["villager_name"]?></td>
						<td><?php echo $row['relation_ship_value']?></td>
						<td><?php echo $row["identity_card"]?></td>
						<td><?php echo $row['sex_value']?></td>
						<td><?php echo $row["birth_day"]?></td>
						<td>
							<?php echo $row["age"]?>
						</td>
						<td><?php echo $row['village_name']?></td>
						<td><?php echo $row["house_no"]?></td>
						<td title="<?php echo get_dict_value($dict_map, 'harmony_code', $row['harmony_code'])?>"><a href="#"><div class="<?php echo $row['harmony_code'] == 10?'green_icon':'red_icon'?>"> </div></a></td>
						<td title="<?php echo get_dict_value($dict_map, 'economy_code', $row['economy_code'])?>"><div class="<?php echo $row['economy_code'] == 10?'green_icon':'red_icon'?>"> </div></td>
						<td title="<?php echo get_dict_value($dict_map, 'health_code', $row['health_code'])?>"><div class="<?php echo $row['health_code'] == 10?'green_icon':'red_icon'?>"> </div></td>
						<td>
							<?php echo get_dict_value($dict_map, 'identity_property', $row['identity_property'])?>
						</td>
						<td>
							<?php echo get_dict_value($dict_map, 'yes_or_no', $row['identity_dy'])?>
						</td>
						<td>
							<?php echo $row["height"]?>
						</td>
						<td><?php echo get_dict_value($dict_map, 'education_degree', $row['education_degree'])?></td>
						<td><?php echo get_dict_value($dict_map, 'marital_status', $row['marital_status'])?></td>
						<td><?php echo get_dict_value($dict_map, 'industry', $row['industry'])?></td>
						<td><?php echo $row["phone"]?></td>
						<td><?php echo $row["mobile"]?></td>
						<td><?php echo get_dict_value($dict_map, 'health_condition', $row['health_condition'])?></td>
						<td><?php echo get_dict_value($dict_map, 'yes_or_no', $row['is_work_out'])?></td>
						<td><?php echo $row["address"]?></td>
						<td><?php echo $row["work_address"]?></td>
						<td>
							<?php if($row['identity_property'] == 80){?>
							<a href="./party_step/<?php echo $row['villager_id']?>" target="_blank">入党进度</a>
							<?php }?>
						</td>
					</tr>
<?php if(isset($row['families']) && count($row['families'])>0) { ?>
					<tr class='slide_next hidden'>
						<td colspan="26">
							<table style="margin-bottom: 10px;" width="100%">
								<thead>
									<tr>
										<th width="60">姓名</th>
										<th width="80">与户主关系</th>
										<th width="100">身份证号</th>
										<th width="60">性别</th>
										<th width="70">出生日期</th>
										<th width="40">年龄</th>
										<th width="80">文化程度</th>
										<th width="60">婚姻状况</th>
										<th width="80">政治面貌</th>
										<th width="50">是否党员</th>
										<th width="50">身高(cm)</th>
										<th width="80">职业</th>
										<th width="60">联系电话</th>
										<th width="60">手机号码</th>
										<th width="66">健康状况</th>
										<th width="66">外出人员</th>
										<th>工作地址</th>
										<th width="60">操作</th>
									</tr>
								</thead>
								<tbody>						
	<?php foreach($row['families'] as $f_key => $f_row) { ?>
									<tr>
										<td>
											<input type="checkbox" value="<?php echo $f_row["villager_id"];?>" name="ids" class="hidden" />
											<?php echo $f_row["villager_name"]?>
										</td>
										<td><?php echo get_dict_value($dict_map, 'relation_ship', $f_row['relation_ship'])?></td>
										<td><?php echo $f_row["identity_card"]?></td>
										<td><?php echo $f_row['sex_value']?></td>
										<td><?php echo $f_row["birth_day"]?></td>
										<td><?php echo $f_row["age"]?></td>
										<td><?php echo get_dict_value($dict_map, 'education_degree', $f_row['education_degree'])?></td>
										<td><?php echo get_dict_value($dict_map, 'marital_status', $f_row['marital_status'])?></td>
										<td><?php echo get_dict_value($dict_map, 'identity_property', $f_row['identity_property'])?></td>
										<td><?php echo get_dict_value($dict_map, 'yes_or_no', $f_row['identity_dy'])?></td>
										<td><?php echo $f_row["height"]?></td>
										<td><?php echo get_dict_value($dict_map, 'industry', $f_row['industry'])?></td>
										<td><?php echo $f_row["phone"]?></td>
										<td><?php echo $f_row["mobile"]?></td>
										<td><?php echo get_dict_value($dict_map, 'health_condition', $f_row['health_condition'])?></td>
										<td><?php echo get_dict_value($dict_map, 'yes_or_no', $f_row['is_work_out'])?></td>
										<td><?php echo $f_row["work_address"]?></td>
										<td>
											<?php if($f_row['identity_property'] == 80){?>
											<a href="./party_step/<?php echo $f_row['villager_id']?>" target="_blank">入党进度</a>
											<?php } else {echo '&nbsp;';}?>
										</td>
										
									</tr>
	<?php }?>
								</tbody>
							</table>
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
$.datepicker.regional["zh-CN"] = { closeText: "关闭", prevText: "&#x3c;上月", nextText: "下月&#x3e;", currentText: "今天", monthNames: ["一月", "二月", "三月", "四月", "五月", "六月", "七月", "八月", "九月", "十月", "十一月", "十二月"], monthNamesShort: ["一", "二", "三", "四", "五", "六", "七", "八", "九", "十", "十一", "十二"], dayNames: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"], dayNamesShort: ["周日", "周一", "周二", "周三", "周四", "周五", "周六"], dayNamesMin: ["日", "一", "二", "三", "四", "五", "六"], weekHeader: "周", dateFormat: "yy-mm-dd", firstDay: 1, isRTL: !1, showMonthAfterYear: !0, yearSuffix: "年" }
$.datepicker.setDefaults($.datepicker.regional["zh-CN"]);
function init_tabs(){
	$('#tabs').tabs();
	$('#formEdit .datepicker').datepicker({
		"dateFormat": 'yy-mm-dd',
		changeYear: true,
		changeMonth: true,
		inline: true,
		showOtherMonths: true,
		selectOtherMonths: true,
		yearRange:"-100:+10",
		showButtonPanel: true
	});
}
$(function(){
	$('#villager_add').click(function(){
		var params = {width:860, height:550, fn:init_tabs};
		params.template_url = base_url_index + "admin/villager/add";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$('#villager_edit').click(function(){
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

		var params = {width:860, height:550, fn:init_tabs};
		params.template_url = base_url_index + "admin/villager/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	$('#villager_delete').click(function(){
		var ref = get_selected_id($("input[name='ids']:checked"));
		if(ref.length == 0){
			showMsg( "请选择一条数据！", "提示");
			return false;
		}

		var params = {width:300, height:160};
		params.post_url = base_url_index + "admin/villager/delete/" + ref,
		params.confirm_text = "你确定要删除选中通知？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});

	$('#record_exception').click(function(){
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

		var params = {width:860, height:500, fn:init_tabs};
		params.template_url = base_url_index + "admin/villager/record_exception/" + ref,
		params.success_text = "保存成功";
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

		var params = {width:450, height:350};
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

	$('#deal_exception').click(function(){
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
		
		params.template_url = base_url_index + "admin/villager/for_deal_exception/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	$('#import').click(function(){
		var params = {width:450, height:250};
		params.template_url = base_url_index + "admin/villager/import";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$('#export_bak').click(function(){
		var params = {width:450, height:250};
		params.template_url = base_url_index + "admin/villager/import";
		params.success_text = "成功";
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