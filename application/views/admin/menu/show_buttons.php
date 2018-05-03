<div id="form_div" title="<?php echo $page_title?>">
	<h5 class="title_16">按钮列表</h5>
  	<div class="hastable">
  	<table cellspacing="0">
  		<thead>
			<tr>
				<td width="140" align="center">按钮名称</td>
				<td>按钮地址</td>
				<td width="140">创建时间</td>
				<td width="50">排序</td>
			</tr>
		</thead>
		<tbody>
<?php
foreach($buttons as $key => $row) {
?>			
			<tr>
				<td title="<?php echo $row["menu_name"]?>"><?php echo $row["menu_name"]?></td>
				<td><?php echo $row["page_url"]?></td>
				<td><?php echo $row["create_time"]?></td>
				<td><?php echo $row["seq"]?></td>
		   	</tr>
<?php
}
?>
		</tbody>
	</table>
	</div>
</div>
