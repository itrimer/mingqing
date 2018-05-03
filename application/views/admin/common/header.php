<div id="header">
	<div id="top-menu">
		<span style="float:left;">欢迎您 <b style="font-weight: bold;"><?php echo $this->session->userdata('username')?>(<?php echo $this->session->userdata('full_name')?>)</b>,<small id="showtime"></small></span>
		<a href="<?php echo base_url()?>admin/indexAction/" title="首页">首页</a> |
		<a href="<?php echo base_url()?>admin/user/" title="设置">设置</a> |
		<a href="<?php echo base_url()?>admin/login/logout" title="退出">退出</a>
	</div>
	<div id="sitename">
		<a href="<?php echo base_url()?>admin/indexAction/" class="logo float-left" title="<?php echo $website_name?>"><?php echo $website_name?></a>
	</div>
	<ul id="navigation" class="sf-navbar">
		<li><a href="<?php echo base_url()?>admin/villager/">民情档案</a></li>
		<li><a href="<?php echo base_url()?>admin/notice/">通知公告</a></li>
		<li><a href="<?php echo base_url()?>admin/share/">系统网盘</a></li>
		<li><a href="<?php echo base_url()?>admin/user/">系统设置</a></li>
	</ul>
</div>