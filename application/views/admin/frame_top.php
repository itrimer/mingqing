<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
a:link {
 color: #ffffff;
 text-decoration: none
}
a:visited {
 color: #ffffff;
 text-decoration: none
}
a:hover {
 color: #ff7f24;
 text-decoration: underline;
}
a:active {
 color: #ffffff;  
 text-decoration: underline;
}
</style>
<script type="text/javascript">
function LogoutConfirm(){
	if(confirm('您确定要退出管理后台吗?')){
		top.location.href='<?php echo  base_url() .'/admin/login/out'?>';
	}
}
</script>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<div style="background: url(/shuntai_ci/images/repeat_x_bg.gif); height:32px; border-bottom: #135093 0px solid; line-height: 32px; padding-right: 30px; text-align: right;">
	<p style="padding:0; margin:0; font-size:12px; color:#ffffff;">
		你好,<b><?php echo $username;?></b>
		<a href="../view_info" target="main" >管理首页</a> | 
		<a href="#" onclick="LogoutConfirm()">退出</a>
	</p>
</div>
</body>
</html>