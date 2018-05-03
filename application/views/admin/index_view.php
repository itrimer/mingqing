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
			  <div class="other-box yellow-box ui-corner-all">
					<div class="cont tooltip ui-corner-all" title="欢迎您  <?php echo $this->session->userdata('username')?>">
						<h3>欢迎您<b><?php echo $this->session->userdata('username')?></b> !</h3>
						<p><b>您已登入管理系统</b>. 请选择您的操作!</p>
					</div>
				</div>
              
			  <div class="page-title ui-widget-content ui-corner-all">
					<h1>请选择您的操作</h1>

				<div class="other">
					<ul id="dashboard-buttons">
						<li><a href="<?php echo base_url()?>admin/villager/" class="Books tooltip" title="民情档案">民情档案</a></li>
						<li><a href="<?php echo base_url()?>admin/villager/handle_task?handle_status=10,20,30,40" class="Box_recycle tooltip" title="等待处理">等待处理</a></li>
						<li><a href="<?php echo base_url()?>admin/notice/" class="Star tooltip" title="通知公告">通知公告</a></li>
						<li><a href="<?php echo base_url()?>admin/share/" class="Box_content tooltip" title="资料共享">系统网盘</a></li>
						<li><a href="<?php echo base_url()?>admin/user/" class="Monitor tooltip" title="系统设置">系统设置</a></li>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function() {
	$('.tooltip').tooltip({
		track: true,
		delay: 0,
		showURL: false,
		showBody: " - ",
		fade: 250
	});
});
</script>
<?php $this->load->view('admin/common/footer.php'); ?>
</body>
</html>