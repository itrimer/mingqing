<!DOCTYPE html>
<html>
<head>
<?php $this->load->view('common/meta.php'); ?>
</head>
<body>
<div id="pop" style="display:none;">
	<div id="popHead">
		<a id="popClose" title="关闭">关闭</a>
     	<h2>温馨提示</h2>
    	</div>
	<div id="popContent">
		<dl>
	    	<dt id="popTitle"><a href="#" target="_blank">这里是参数</a></dt>
	      	<dd id="popIntro">这里是内容简介</dd>
		</dl>
		<p id="popMore"><a href="#" target="_blank">查看 »</a></p>
	</div>
</div>
<!--右下角pop弹窗 end-->

<?php $this->load->view('common/header.php'); ?>

<div id="page-wrapper">
		<div id="sidebar">
			<div class="side-col ui-sortable">

				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="ui-widget-header"><a href="#">所有民情信息</a></div>
				</div>
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">异常信息</div>
					<div class="portlet-content">
						<ul class="side-menu">
							<li><a href="#">等待处理</a></li>
							<li><a href="#">已处理</a></li>
							<li><a href="#">未处理</a></li>
						</ul>
					</div>
				</div>
				<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
					<div class="portlet-header ui-widget-header">下辖区民情信息</div>

					<div class="portlet-content">
						<div id="accordion">
							<div>
								<h3><a href="#">辖区一</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="#">社古村1</a></li>
										<li><a href="#">坑下村</a></li>
										<li><a href="#">丰瓦村</a></li>
									</ul>
								</div>
							</div>
							<div>
								<h3><a href="#">辖区二</a></h3>
								<div>
									<ul class="side-menu">
										<li><a href="#">社古村1</a></li>
										<li><a href="#">坑下村</a></li>
										<li><a href="#">丰瓦村</a></li>
									</ul>
								</div>
							</div>
						</div>

					</div>
				</div>
				

				
			</div>
			<div class="clearfix"></div>

		</div>
    
		<div id="main-wrapper">
			<div id="main-content">
			  <div class="other-box yellow-box ui-corner-all">
					<div class="cont tooltip ui-corner-all" title="Tooltip example - this is an example for the tooptip plugin! - You can add tooltips to any element">
						<h3>欢迎您<b>超级管理员</b> !</h3>
						<p><b>您已登入管理系统</b>. 请选择您的操作!</p>

					</div>
				</div>
              
			  <div class="page-title ui-widget-content ui-corner-all">
					<h1>请选择您的操作</h1>

					<div class="other">

						<ul id="dashboard-buttons">
							<li><a href="frame.htm" class="Books tooltip" title="民情档案">民情档案</a></li>
							<li><a href="frame.htm" class="Box_recycle tooltip" title="异常处理">异常民情</a></li>
							<li><a href="notice.htm" class="Star tooltip" title="通知公告">通知公告</a></li>
							<li><a href="share.htm" class="Box_content tooltip" title="资料共享">系统网盘</a></li>
							<li><a href="setting.htm" class="Monitor tooltip" title="系统设置">系统设置</a></li>
						</ul>
						<div class="clearfix"></div>
					</div>
					

				</div>
            </div>
	</div>
</div>
<?php $this->load->view('common/footer.php'); ?>
</body>
</html>