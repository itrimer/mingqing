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
				当前位置： <a href="<?php echo base_url('admin/villager/')?>" title="民情信息">民情信息</a> &gt; 入党进度说明
			</div>
			<div class="bar_block scrool_block" style="height: 35px;">
			<?php $max_step = count($steps); $per = $max_step*100/15; echo $row['village_name'] . ' - ' .$row['villager_name'];?> 
				入党进度：
        		<span class="scrool_gray"></span>
                <span class="scrool_green" style="width:100%"><img src="<?php echo base_url('images/scrool_green.jpg')?>" width="<?php echo $per?>%" height="15px"></span>
                <a class="scrool_page" href="#<?php echo $max_step?>" style="left:<?php echo $per?>%;"><?php echo $max_step?></a>
    		</div>
    		<script type="text/javascript">
				var villager_id = <?php echo $row['villager_id']?>;
				var max_step = <?php echo $max_step;?>;
			</script>
      		<div>
          		<div class="title title-spacing">
              		<h2>入党手续十五步及有关重点问题说明</h2>
              	</div>
                  
                    <ul class="rd_tree">
                        <li class="<?php echo isset($steps['1'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="1"></a>1</span> 要求入党的申请人向党组织提出入党申请；
                            <?php if(isset($steps['1'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['1']['record_time']?>" readonly>
                            <?php } else if($max_step == 0){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['1'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）入党申请人"十不准"。</li>
                            <li>（2）收到入党申请书<b>一个月</b>内，党组织派人谈话，谈话情况要形成书面记录并签名盖章。</li>
                            <li>（3）入党申请人名单要报上级党委（乡镇党委、街道党工委或县有关部门党委，下同）<b>备案</b>。</li>
                            <li>（4）党支部负责《入党申请人员公示》。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['2'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="2"></a>2</span>
                            采取党员推荐或群团组织推优等方式产生入党积极分子人选，由支委会研究确定，并报上级党委备案；
                            <?php if(isset($steps['2'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['2']['record_time']?>" readonly>
                            <?php } else if($max_step == 1){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['2'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）一般情况下，入党申请人递交入党申请书六个月以上，才可被确定为入党积极分子。</li>
                            <li>（2）确定入党积极分子必须召开党员大会票决。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['3'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="3"></a>3</span>
                            党组织指定一至两名正式党员作为入党积极分子的培养联系人；
                            <?php if(isset($steps['3'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['3']['record_time']?>" readonly>
                            <?php } else if($max_step == 2){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['3'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）确定入党积极分子后一个月内，党组织应指定培养联系人。</li>
                            <li>（2）党支部负责《入党积极分子公示》。</li>
                            <li>（3）入党积极分子培养考察实行考学考绩"三步准入"。</li>
                        </ul>
                        
                        
                        <li class="<?php echo isset($steps['4'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="4"></a>4</span>
                            党组织对入党积极分子进行一年以上的培养教育和考察，对基本具备党员条件的，在听取党小组、培养联系人、党员和群众意见的基础上，结合考学考绩情况，经支部委员会讨论同意并报上级党委备案后，可列为发展对象；
                            <?php if(isset($steps['4'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['4']['record_time']?>" readonly>
                            <?php } else if($max_step == 3){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['4'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）未通过考学考绩"三步准入"的取消入党积极分子资格。</li>
                            <li>（2）党委备案意见应书面通知党支部。</li>
                            <li>（3）党委备案同意时间即为确定发展对象的时间。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['5'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="5"></a>5</span>
                            党支部指定两名正式党员作发展对象入党介绍人；
                          	<?php if(isset($steps['5'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['5']['record_time']?>" readonly>
                            <?php } else if($max_step == 4){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        
                        <li class="<?php echo isset($steps['6'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="6"></a>6</span>
                            党组织对发展对象进行政治审查；
                          	<?php if(isset($steps['6'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['6']['record_time']?>" readonly>
                            <?php } else if($max_step == 5){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['6'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）确定为发展对象一个月内，党组织必须对其进行政治审查。</li>
                            <li>（2）政审必须形成书面结论性材料，政审结果一年内有效。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['7'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="7"></a>7</span>
                            对发展对象进行短期集中培训；
                            <?php if(isset($steps['7'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['7']['record_time']?>" readonly>
                            <?php } else if($max_step == 6){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['7'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）培训时间一般不少于3天或24个学时。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['8'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="8"></a>8</span>
                            支部委员会对发展对象进行严格审查，经集体讨论认为合格后，报具有审批权限的基层党委预审；
                            <?php if(isset($steps['8'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['8']['record_time']?>" readonly>
                            <?php } else if($max_step == 8){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['8'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）上级党委预审应该在一个月内完成。</li>
                            <li>（2）预审原则上党委会讨论，也可由组织员负责把关。</li>
                            <li>（3）对农村发展党员，应开展联合审查。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['9'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="9"></a>9</span>
                            基层党委预审后，审查结果书面通知党支部，并向审查合格的发展对象发放《中国共产党入党志愿书》；
                            <?php if(isset($steps['9'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['9']['record_time']?>" readonly>
                            <?php } else if($max_step == 8){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['9'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）上级党委负责对发展对象进行公示。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['10'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="10"></a>10</span>
                            支部委员会将上级党委预审合格的发展对象提交支部大会讨论，作出决议，并报上级党委审批；
                            <?php if(isset($steps['10'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['10']['record_time']?>" readonly>
                            <?php } else if($max_step == 9){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['10'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）党支部应在上级党委预审合格后一个月内提交支部大会讨论接收预备党员事宜。</li>
                            <li>（2）支部大会讨论接收预备党员表决时，党员一般不宜弃权。</li>
                            <li>（3）支部大会讨论接收预备党员必须票决。</li>
                            <li>（4）支部大会决议后，超过三个月上报上级党委的，党支部应重新复议；超过六个月上报上级党委的，要退回党支部重新办理入党手续。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['11'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="11"></a>11</span>
                            上级党委指派党委委员或组织员同发展对象谈话，作进一步的了解；
                            <?php if(isset($steps['11'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['11']['record_time']?>" readonly>
                            <?php } else if($max_step == 10){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        
                        <li class="<?php echo isset($steps['12'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="12"></a>12</span>
                            上级党委集体讨论和表决，将审批意见通知报批的党支部，并报上级党委组织部门备案；
                            <?php if(isset($steps['12'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['12']['record_time']?>" readonly>
                            <?php } else if($max_step == 11){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['12'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）上级党委讨论接收预备党员必须票决。</li>
                            <li>（2）上级党委应在三个月内审批党支部上报的决议，最长不得超过六个月。</li>
                            <li>（3）上级党委在审批意见中要注明预备期的起止时间。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['13'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="13"></a>13</span>
                            被批准入党的预备党员面向党旗进行入党宣誓；
                            <?php if(isset($steps['13'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['13']['record_time']?>" readonly>
                            <?php } else if($max_step == 12){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        
                        <li class="<?php echo isset($steps['14'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="14"></a>14</span>
                            预备党员预备期满后，向党组织提出书面转正申请，经支部大会讨论和通过，报上级党委批准，转为正式党员；
                            <?php if(isset($steps['14'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['14']['record_time']?>" readonly>
                            <?php } else if($max_step == 13){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['14'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）预备党员应在预备期满前一周提出转正的书面申请，最长要在预备期满一个月内提出书面转正申请，经支部提醒仍不提出转正申请的，应取消预备党员资格，并报上级党委批准。</li>
                            <li>（2）党支部应在收到预备党员转正申请一个月内召开党员大会讨论其转正申请，最长不得超过三个月。</li>
                            <li>（3）上级党委应对拟转正的预备党员进行审查和公示。</li>
                            <li>（4）支部大会讨论预备党员转正必须票决。</li>
                            <li>（5）上级党委应在三个月内审批党支部上报的决议，且必须集体讨论和票决。审批结果须及时通知党支部书记，并在党员大会上宣布。</li>
                            <li>（6）预备党员转正、延长预备期或取消预备党员资格，都应经支部大会讨论表决和上级党委批准；对支部大会形不成决议的，上级党委应调查核实，报县委组织部批准后，直接作出决定。</li>
                        </ul>
                        
                        <li class="<?php echo isset($steps['15'])?'green_tree': 'gray_tree'?>">
                            <span class="num"><a name="15"></a>15</span>
                            预备党员转正后，党支部应及时将党员的档案材料交上级党委存入本人人事档案；无人事档案的，建立党员档案，由所在党委保存。
                            <?php if(isset($steps['15'])){?>
                            <input name="textfield" type="text" style="border:none" value="<?php echo $steps['15']['record_time']?>" readonly>
                            <?php } else if($max_step == 14){?>
                            		<input type="button" value="已完成" class='do_step'>
                            <?php }?>
                        </li>
                        <ul class="<?php echo isset($steps['15'])?'brief_text': 'brief_text_gray'?>">
                            <li>（1）党支部书记要将发展党员工作的各个程序和环节及时、准确地记录在《新昌县发展党员全程记实表》上，做到一人一表，一事一记，最后上交上级党委存档。</li>
                        </ul>
                    </ul>
       		</div>                
   			<div class="clearfix"></div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$('.do_step').click(function(){
		var params = {width:320, height:150};
		params.post_params = {"villager_id":villager_id, "party_index": (max_step + 1)}
		params.post_url = base_url_index + "admin/villager/do_join_party/",
		params.confirm_text = "你确定该村民已经执行完成第"+(max_step + 1)+"步？";
		params.success_text = "处理成功";
		do_confirm_submit(params);

		return false;
	});
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>