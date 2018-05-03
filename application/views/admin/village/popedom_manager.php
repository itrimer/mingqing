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
	 			当前位置： <a href="<?php echo base_url()?>admin/user/">系统设置</a> &gt; 辖区管理
	 		</div>
			<div class="bar_block">
				<div class="float-left">
			  	<form name="formSearch" action="." method="get">
					辖区：<input name="popedom_name" type="text" placeholder="辖区名称" value="<?php echo $popedom_name?>" class="width_100">
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
						<td width="25"><input type="checkbox" class="checkbox" value="" onclick="check_rows(this, this.form.ids)"/></td>
						<td width="140">辖区名称</td>
						<td width="80">村庄数量</td>
						<td>备注</td>
					</tr>
				</thead>
				<tbody>
<?php
foreach($query as $key => $row) {
?>			
				<tr>
					<td height="30">
						<input name="ids" type="checkbox" value="<?php echo $row["popedom_id"]?>" />
					</td>
					<td title="<?php echo $row["popedom_name"]?>"><?php echo $row["popedom_name"]?></td>
					<td><?php echo $row["village_num"]?$row["village_num"]:0?></td>
					<td><?php echo $row["remark"]?></td>
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
$(function(){
	$('#popedom_add').click(function(){
		var params = {width:450, height:300};
		params.template_url = base_url_index + "admin/popedom/add";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$('#popedom_edit').click(function(){
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

		var params = {width:450, height:300};
		params.template_url = base_url_index + "admin/popedom/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$("a[name='edit']").click(function(){
		var ref = $(this).attr("ref");
		var params = {width:450, height:300};
		params.template_url = base_url_index + "admin/popedom/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$("#popedom_delete").click(function(){
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
	
		var params = {width:300, height:150};
		params.post_url = base_url_index + "admin/popedom/delete/" + ref,
		params.confirm_text = "你确定要删除选中辖区？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});
	$("#set_villages").click(function(){
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
		var params = {width:550, height:450};
		params.fn = bind_event_add;
		params.onsubmit = function(){
			$("select[name='dest_village[]'] option").attr("selected","selected");
		};
		
		params.template_url = base_url_index + "admin/popedom/add_village/" + ref,
		params.success_text = "设置成功";
		do_template(params);
		return false;
	});
});

function move(src, dest){
	var items = $("option:selected", src).remove();  
	$(dest).append(items);  
	$("option", dest).attr("selected", false); //清除option移动到右侧的自动选中的状态				  
};

function select_all(src){
	var items = $("option:selected", src).remove();  
	$(dest).append(items);  
	$("option", dest).attr("selected", false); //清除option移动到右侧的自动选中的状态				  
};

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
// 	$("#movealltoright").click(function () {  
// 		var items = $("#select1 option").remove();  
// 		$("#select2").append(items);  
// 		$("#select2 option").attr("selected", false); //清除option移动到右侧的自动选中的状态  
// 	});  
	  
// 	$("#movealltoleft").click(function () {  
// 		var items = $("#select2 option").remove();  
// 		$("#select1").append(items);  
// 		$("#select1 option").attr("selected", false); //清除option移动到右侧的自动选中的状态  
// 	}); 
}
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>