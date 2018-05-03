<div id="form_div" title="<?php echo $page_title;?>">
<style>.form_td_mid th,.form_td_mid td{ vertical-align: middle;}</style>
<form action="save" method="post" id="formEdit" name="formEdit"
		enctype="multipart/form-data" onsubmit="return validate(this);">
	<input name="act" type="hidden" value="<?php echo $act;?>"/>
	<input name="villager_id" type="hidden" value="<?php echo $row['villager_id'];?>"/>
	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">基本信息</a></li>
			<li><a href="#tabs-2">家庭关系</a></li>
		</ul>
		<div id="tabs-1">
			<div class="float-left">
				<div class="dlgHendBox">
					<div class="photo" id="photo">
					<?php $villager_img = isset($row['villager_img'])?$row['villager_img']:'';?>
						<img src="<?php echo $villager_img ? base_url($villager_img) : base_url('images/head.png')?>" onload="imgAdjust(this, 138, 175)"/>
					</div>
					<span class="fileToUpload"><input type="file" name="villager_img" value="<?php echo $villager_img?>" onchange="previewImage(this, 'photo', 138, 175)"/></span>
				</div>
			</div>

			<div class="float-left info_forms form_td_mid">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th>所属村：</td>
						<td colspan="3"><select name="village_id"  title="村庄" class="width_200 required">
							<option value="">--村庄--</option>
							<?php foreach($villages as $key => $r) { ?>
								<option value="<?php echo $r['village_id'];?>" <?php if($r['village_id']==$row['village_id']) {echo "selected";}?>><?php echo $r['village_name'];?></option>
							<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th>详细地址：</th>
						<td colspan="3">
							<input type="text" class="width_350" name="address" id="address" value="<?php echo $row['address'];?>"/>
						</td>
					</tr>
					<tr>
						<th>姓名：</th>
						<td width="180"><input name="villager_name" type="text" class="width_200" value="<?php echo $row['villager_name'];?>"/></td>
						<th>身份证号：</th>
						<td><input name="identity_card" type="text" class="width_200" value="<?php echo $row['identity_card'];?>" /></td>
					</tr>
					<tr>
						<th>门牌号：</th>
						<td><input name="house_no" type="text" class="width_200" id="house_no" value="<?php echo $row['house_no'];?>"/></td>
						<th>户主关系：</th>
						<td><span class="grid_7">
							<select name="relation_ship" id="relation_ship" class="width_200">
							<option value="">--户主关系--</option>
							<?php foreach($code_map['relation_ship'] as $key => $value) { ?>
								<option value="<?php echo $key;?>" <?php if($key==$row['relation_ship']) {echo "selected";}?>><?php echo $value;?></option>
							<?php }?>
							</select>
						</span></td>
					</tr>
					<tr>
						<th>性别：</th>
						<td>
							<select name="sex" id="sex" class="width_200">
							<option value="">--性别--</option>
							<?php foreach($code_map['sex'] as $key => $value) { ?>
								<option value="<?php echo $key;?>" <?php if($key==$row['sex']) {echo "selected";}?>><?php echo $value;?></option>
							<?php }?>
							</select>
						</td>
						<th>出生日期：</th>
						<td>
							<input name="birth_day" class="width_200 datepicker" type="text" value="<?php echo $row['birth_day'];?>" title="出生时间"/>
						</td>
					</tr>
					<tr>
						<th>身高：</th>
						<td><input name="height" type="text" class="width_100" value="<?php echo $row['height'];?>"/> CM</td>
						<th>血型：</th>
						<td><span class="grid_7">
								<select name="blood_type" class="width_200">
								<option value="">--血型--</option>
								<?php foreach($code_map['blood_type'] as $key => $value) { ?>
									<option value="<?php echo $key;?>" <?php if($key==$row['blood_type']) {echo "selected";}?>><?php echo $value;?></option>
								<?php }?>
								</select>
							</span>
						</td>
					</tr>
					<tr>
						<th>政治面貌：</th>
						<td width="100"><span class="grid_7">
						<select name="identity_property" id="identity_property" class="width_200">
							<option value="">--政治面貌--</option>
							<?php foreach($code_map['identity_property'] as $key => $value) { ?>
								<option value="<?php echo $key;?>" <?php if($key==$row['identity_property']) {echo "selected";}?>><?php echo $value;?></option>
							<?php }?>
							</select></span>
						</td>
						<th>文化程度：</th>
						<td><span class="grid_7">
							<select name="education_degree" class="width_200">
								<option value="">--学历--</option>
								<?php foreach($code_map['education_degree'] as $key => $value) { ?>
									<option value="<?php echo $key;?>" <?php if($key==$row['education_degree']) {echo "selected";}?>><?php echo $value;?></option>
								<?php }?>
								</select></span>
						</td>
					</tr>
					<tr>
						<th>联系手机：</th>
						<td><input name="mobile" type="text" class="width_200" id="mobile" value="<?php echo $row['mobile'];?>"/></td>
						<th>固定电话：</th>
						<td>
							<input name="phone" type="text" class="width_200" id="phone" value="<?php echo $row['phone'];?>"/>
						</td>
					</tr>
					<tr>
						<th>行业：</th>
						<td><span class="grid_7">
							<select name="industry" class="width_200">
								<option value="">--行业--</option>
								<?php foreach($code_map['industry'] as $key => $value) { ?>
									<option value="<?php echo $key;?>" <?php if($key==$row['industry']) {echo "selected";}?>><?php echo $value;?></option>
								<?php }?>
								</select>
							</span>
						</td>
						<th>婚姻状况：</th>
						<td><span class="grid_7"> 
							<select name="marital_status" class="width_200">
									<option value="">--婚姻状况--</option>
									<?php foreach($code_map['marital_status'] as $key => $value) { ?>
										<option value="<?php echo $key;?>" <?php if($key==$row['marital_status']) {echo "selected";}?>><?php echo $value;?></option>
									<?php }?>
									</select>
							</span>
						</td>
					</tr>
					<tr>
						<th>特长：</th>
						<td><input name="special_tech" type="text" class="width_200" value="<?php echo $row['special_tech'];?>"/></td>
						<th>健康状况：</th>
						<td><select name="health_condition" class="width_200">
							<option value="">--健康状况--</option>
							<?php foreach($code_map['health_condition'] as $key => $value) { ?>
								<option value="<?php echo $key;?>" <?php if($key==$row['health_condition']) {echo "selected";}?>><?php echo $value;?></option>
							<?php }?>
							</select>
						</td>
					</tr>
					<tr>
						<th>外出人员：</th>
						<td colspan="3">
							<input type="checkbox" name="is_work_out" value="10" <?php echo $row['is_work_out'] == '10'?'checked':'';?> />
							是&nbsp;&nbsp;&nbsp;工作地址：
							<input name="work_address" type="text" class="width_250"
							value="<?php echo $row['work_address'];?>" />
						</td>
					</tr>
					<tr>
						<th valign="top"><label for="remark">备注：</label></th>
						<td colspan="3"><textarea name="remark" class="form_area"><?php echo $row['remark'];?></textarea></td>
					</tr>
			</table>
		</div>
		<div class="clearfix"></div>
	</div>

	<div id="tabs-2" class="info_forms">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th width="80">父亲：</th>
				<td><select name="father_id"  title="父亲" class="width_200">
					<option value="">--请选择--</option>
					<?php foreach($villagers as $key => $r) { 
						if($r['sex'] == '20'){
					?>
					<option value="<?php echo $r['villager_id'];?>" <?php if($r['villager_id']==$row['father_id']) {echo "selected";}?>><?php echo $r['villager_name'];?></option>
					<?php }}?>
					</select>
				</td>
			</tr>
			<tr>
				<th>母亲：</th>
				<td><select name="mother_id"  title="母亲" class="width_200">
						<option value="">--请选择--</option>
						<?php foreach($villagers as $key => $r) { 
						if($r['sex'] == '10'){
						?>
						<option value="<?php echo $r['villager_id'];?>" <?php if($r['villager_id']==$row['mother_id']) {echo "selected";}?>><?php echo $r['villager_name'];?></option>
						<?php }}?>
					</select>
				</td>
			</tr>
			<tr>
				<th>配偶：</th>
				<td><select name="spouse_id"  title="配偶" class="width_200">
					<option value="">--请选择--</option>
					<?php foreach($villagers as $key => $r) { 
					if($r['sex'] != $row['sex']){?>
						<option value="<?php echo $r['villager_id'];?>" <?php if($r['villager_id']==$row['spouse_id']) {echo "selected";}?>><?php echo $r['villager_name'];?></option>
					<?php }}?>
					</select>
				</td>
			</tr>
		</table>
	</div>
</div>
</form>
</div>