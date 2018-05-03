<div id="form_div" title="<?php echo $page_title;?>">
<form action="save_families" method="post" id="formEdit" name="formEdit" class="info_forms"
		enctype="multipart/form-data" onsubmit="return validate(this);">
	<input name="villager_id" type="hidden" value="<?php echo $row['villager_id'];?>"/>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<th width="80">户主：</th>
			<td><select name="house_holder_id"  title="户主" class="width_200">
				<option value="">--请选择--</option>
				<?php foreach($villagers as $key => $r) { 
					if($r['sex'] == '20'){
				?>
				<option value="<?php echo $r['villager_id'];?>" <?php if($r['villager_id']==$row['house_holder_id']) {echo "selected";}?>><?php echo $r['villager_name'];?></option>
				<?php }}?>
				</select>
			</td>
		</tr>
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
</form>
</div>