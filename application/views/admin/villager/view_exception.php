<div id="form_div" title="<?php echo $page_title;?>">
	<input name="task_id" type="hidden" value="<?php echo $row['task_id']?>" />
	<div><h5 class="title_16">异常详情</h5>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="view_exception_table">
		<tr>
       		<th width="140">姓名：</th>
         	<td width="140">
      			<?php echo $row['villager_name']?>
      		</td>
        	<th width="140">联系电话：</th>
       		<td><?php echo $row['mobile']?></td>
   		</tr>
   		<tr>
   			<th>异常类型：</th>
       		<td><?php echo $row['exception_type_value']?></td>
     		<th>异常描述：</th>
       		<td><?php $exception_title = ''; if($row['exception_code'] == '99'){$exception_title = $row['code_text'];} else {$exception_title = $code_map[$row['exception_type']][$row['exception_code']];}
       			echo $exception_title;
       		?></td>
       	</tr>
     	<tr>
       		<th>发生时间：</th>
        	<td><?php echo $row['exception_time']?></td>
        	<th>发生地点：</th>
        	<td><?php echo $row['exception_addr']?></td>
       	</tr>
      	<tr>
       		<th>事件原由：</th>
       		<td colspan="3"><?php echo $row['exception_condition']?></td>
      	</tr>
   		<tr>
       		<th>最新更新：</th>
       		<td colspan="3">
       			<?php if(count($handle_records) > 0){
				echo end($handle_records)['operation_remark'];
				} ?>
			</td>
      	</tr>
   		<tr>
        	<th>图片：</th>
          	<td colspan="3">
          		<div class="thum_img">
          		<?php if($row['exception_img']){?>
          			<a data-fancybox-group="gallery" title="<?php echo $exception_title;?>" href="<?php echo base_url($row['exception_img'])?>"><img src="<?php echo base_url($row['exception_img'])?>" width="150" height="150" onload="imgAdjust(this, 150, 150)"/></a>
          		<?php }?>
          		</div>
          	</td>
   		</tr>
   	</table>

	<div class="hastable">
	<h5 class="title_16">处理纪录</h5>
   	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  	<thead>
			<tr>
				<th width="80" style="text-align: left">处理名称</th>
				<th width="120" style="text-align: left">处理时间</th>
				<th width="100" style="text-align: left">处理人</th>
				<th width="100" style="text-align: left">接收人</th>
				<th style="text-align: left">处理内容</th>
			</tr>
		</thead>
	  	<?php foreach($handle_records as $key => $record) { ?>
	  		<tr>
				<td>
					<?php echo $record['operation_name'];?>
				</td>
				<td>
					<?php echo $record['operation_time'];?>
				</td>
				<td>
					<?php echo $record['record_user_name'];?>
				</td>
				<td>
					<?php echo $record['receive_user_name'];?>
				</td>
				<td>
					<?php echo $record['operation_remark'];?>
				</td>
			</tr>
	    <?php } 
	   	if(count($handle_records) == 0){?>
	   		<tr>
				<td colspan="5" style="text-align: center">暂未处理</td>
			</tr>
	   	<?php }?>
	    
	</table>
	</div>
</div>