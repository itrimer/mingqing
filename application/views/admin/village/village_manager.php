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
当前位置： <a href="<?php echo base_url()?>admin/user/">系统设置</a> &gt; 村庄管理
</div>
	
<div class="bar_block">
<div class="float-left">


<form name="formSearch" action="." method="get">

辖区：<select name="popedom_id"  title="辖区" class="width_100 required">
		
<option value="">--辖区--</option>
						
<?php foreach($popedom_map as $key => $r) { ?>

								
<option value="<?php echo $key?>" <?php 
if($key==$popedom_id) {
echo "selected";}?>><?php echo $r;?></option>
	
<?php }?>
					</select>  	
			
村庄：
			
<input name="village_name" type="text" placeholder="村庄名称" value="<?php echo $village_name?>" class="width_100">
		
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
						<td width="140">村庄名称</td>
						<td width="140">所属辖区</td>
						<td>地址</td>
					</tr>
				</thead>
				<tbody>
<?php
foreach($query as $key => $row) {
?>			
				<tr>
					<td height="30">
						<input name="ids" type="checkbox" value="<?php echo $row["village_id"]?>" />
					</td>
					<td title="<?php echo $row["village_name"]?>"><?php echo $row["village_name"]?></td>
					<td><?php if(isset($popedom_map[$row["popedom_id"]])) echo $popedom_map[$row["popedom_id"]]?></td>
					<td title="<?php echo $row["address"]?>"><?php echo $row["address"]?></td>
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
	$('#village_add').click(function(){
		var params = {width:450, height:300};
		params.template_url = base_url_index + "admin/village/add";
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$('#village_edit').click(function(){
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
		params.template_url = base_url_index + "admin/village/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});
	$('#village_delete').click(function(){
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

		var params = {width:320, height:150};
		params.post_url = base_url_index + "admin/village/delete/" + ref,
		params.confirm_text = "你确定要删除选中村庄？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});


	$("a[name='edit']").click(function(){
		var ref = $(this).attr("ref");
		var params = {width:450, height:350};
		params.template_url = base_url_index + "admin/village/edit/" + ref,
		params.success_text = "保存成功";
		do_template(params);
		return false;
	});

	$("a[name='delete']").click(function(){
		var ref = $(this).attr("ref");

		var params = {width:320, height:160};
		params.post_url = base_url_index + "admin/village/delete/" + ref,
		params.confirm_text = "你确定要删除选中村庄？";
		params.success_text = "删除成功";
		do_confirm_submit(params);

		return false;
	});
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>