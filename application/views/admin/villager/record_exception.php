<div id="form_div" title="登记异常">
<form action="do_record_exception" method="post" id="formEdit" name="formEdit"
		enctype="multipart/form-data" onsubmit="return validate(this);">
	<input name="villager_id" type="hidden" value="<?php echo $row['villager_id'];?>"/>

	<div id="tabs-1" class="info_forms" name="handle_end" style="float: left; width:30%; height:400px; overflow:hidden;">
		<h2 class="title_16">异常类型：
			<select name="exception_type" style="font-size: 16px;width:140px;" >
				<option value="">请选择</option>
				<option value="harmony_code">和谐指标</option>
				<option value="economy_code">经济指标</option>
				<option value="health_code">健康指标</option>
			</select>
		</h2>
		
		
		<table width="100%" border="0" cellspacing="0" cellpadding="0" id="tb_harmony_code">
			<?php foreach($code_map['harmony_code'] as $key => $value) { if($key==10){continue;}?>
				<tr>
					<td width="20"><input type="radio" name="harmony_code" value="<?php echo $key;?>" id="harmony_code<?php echo $key;?>"/></td>
					<td>
						<label for="harmony_code<?php echo $key;?>"><?php echo $value;?></label>
					<?php if('99' == $key){?>
					<input name="harmony_code_text" type="text" value="" class="write_input width_200"/>
					<?php }?>
					</td>
				</tr>
			<?php }?>
			<tr>
				<td>&nbsp;</td>
				<td>上传附件 <input type="file" name="harmony_img" onchange="previewImage(this, 'harmony_img',138, 173)">
					<div id='harmony_img'><img src="<?php echo base_url('images/head.png')?>" onload="imgAdjust(this, 138, 175)"/>
					</div>
				</td>
			</tr>
		</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hidden" id="tb_economy_code">
			<?php foreach($code_map['economy_code'] as $key => $value) { if($key==10){continue;}?>
				<tr>
					<td width="20"><input type="radio" name="economy_code" value="<?php echo $key;?>" id="economy_code<?php echo $key;?>"/></td>
					<td>
						<label for="economy_code<?php echo $key;?>"><?php echo $value;?></label>
						<?php if('99' == $key){?>
						<input name="economy_code_text" type="text" value="" class="write_input width_200"/>
						<?php }?>
					</td>
				</tr>
			<?php }?>
				<tr>
					<td>&nbsp;</td>
					<td>上传附件 <input type="file" name="economy_img" onchange="previewImage(this, 'economy_img', 138, 173)">
						<div id='economy_img'>
						<img src="<?php echo base_url('images/head.png')?>" onload="imgAdjust(this, 138, 175)"/>
						</div>
					</td>
				</tr>
			</table>
		<table width="100%" border="0" cellspacing="0" cellpadding="0" class="hidden" id="tb_health_code">
			<?php foreach($code_map['health_code'] as $key => $value) { if($key==10){continue;}?>
				<tr>
					<td width="20">
						<input type="radio" name="health_code" value="<?php echo $key;?>" id="health_code<?php echo $key;?>"/>
					</td>
					<td>
					<label for="health_code<?php echo $key;?>"><?php echo $value;?></label>
					<?php if('99' == $key){?>
						<input name="health_code_text" type="text" value="" class="write_input width_200"/>
					<?php }?>
					</td>
				</tr>
			<?php }?>
			<tr>
				<td>&nbsp;</td>
				<td>上传附件 <input type="file" name="health_img" onchange="previewImage(this, 'health_img',138, 173)">
					<div id='health_img'><img src="<?php echo base_url('images/head.png')?>" onload="imgAdjust(this, 138, 175)"/>
					</div>
				</td>
			</tr>
		</table>
	</div>
	<div id="tabs-4" class="info_forms" style="float: left; width:60%;height:400px;">
	<h2 class="title_16">异常详情</h2>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr height="40">
				<td width="80">发生地点：</td>
				<td>
					<input name="exception_addr" type="text" class="width_350" value=""/>
				</td>
			</tr>
			<tr height="40">
				<td>发生时间：</td>
				<td>
					<input name="exception_time" class="width_200 datepicker" type="text" value="" title="发生时间"/>
				</td>
			</tr>
			<tr height="40">
				<td style="vertical-align: top">事件原由：</td>
				<td>
					<textarea name="exception_condition" class="form_area"></textarea>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
</div>
<script type="text/javascript">
$(function(){
	$("#formEdit select[name='exception_type']").change(function(){
		$("div[name='handle_end'] table").addClass("hidden");
		var value = $(this).val();
		$("div[name='handle_end'] #tb_" + value).removeClass("hidden");
	})
})
</script>