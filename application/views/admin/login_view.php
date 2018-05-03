<!DOCTYPE html>
<html>
<head>
<title><?php echo $website_name?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.form.js"></script>
<link href="<?php echo base_url()?>css/forms.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/reset.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/ui/styles/default/ui.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/mine.css" rel="stylesheet" />

<!--[if IE 6]>
<link href="<?php echo base_url()?>css/ie6.css" rel="stylesheet" media="all" />

<script src="<?php echo base_url()?>js/pngfix.js"></script>
<script>
  /* EXAMPLE */
  DD_belatedPNG.fix('.logo, .other ul#dashboard-buttons li a');
</script>
<![endif]-->
<!--[if IE 7]>
<link href="<?php echo base_url()?>css/ie7.css" rel="stylesheet" media="all" />
<![endif]-->
<script type="text/javascript">
function login_submit(){
	var form = $("#formLogin");
	if(!$("input[name='username']", form).val())	{
		$("label[name='e']", form).html("请输入用户名!");
		return;
	}
	if(!$("input[name='password']", form).val())	{
		$("label[name='e']", form).html("请输入密码!");
		return;
	}

	form.ajaxSubmit({
		type: "post",
		dataType: "json",
		beforeSubmit:function(){
			$("label[name='e']", form).html("<img src='<?php echo base_url()?>images/pagination_loading.gif' width='12'/>");
		},
		error: function(data){
			$("label[name='e']", form).html("发生异常!");
		},
		success: function(data) {
			if(data.code=='success'){
				$("label[name='e']", form).html('登录成功！');
				window.location.href = '../indexAction?t=' + (new Date()).getTime();
			} else {
				$("label[name='e']", form).html(data.code);
			}
		}
	})
}
$(function(){
	$("#login_btn").click(function(){
		login_submit()
	});
	var form = $("#formLogin");
	$("input[name='username'],input[name='password']", form).focus(function(){
		$("label[name='e']", form).html('');
	});

	$("input[name='username']", form).keydown(function(e){
		e = e || window.event;
		if (e.keyCode == 13){
			$("input[name='password']", form).focus();
		}
	}).select();
	
	$("input[name='password']", form).keydown(function(e){
		e = e || window.event;
		if (e.keyCode == 13){
			$("#login_btn").click();
		}
	});
})

</script>
</head>
<body class="login_body">
<div class="login_block">
  	<div class="site_name">
	<div class="float-left"><img src="<?php echo base_url()?>images/logo_big.png"></div>
  	<div class="float-right name">
   		<h1>澄潭镇民情红绿灯系统</h1>
      	<h2>走村不漏户，  户户见干部</h2>
 	</div>
  	</div>
        
 	<div  class="login_form">
   		<form action="login_do" method="post" class="forms" name="formLogin" id="formLogin">
    	<ul>
          	<li>
          		<label for="email" class="desc">用户名:</label>
            	<div>
               		<input type="text" name="username" id="username" value="<?php echo $username;?>" class="username field text" tabindex="1" maxlength="255"/>
              	</div>
        		<label name="e" class="feedback"></label>
         	</li>
           	<li>
            	<label for="password" class="desc">密码:</label>
              	<div>
              		<input type="password" name="password" id="password" value="" class="password field text" tabindex="2" maxlength="255"/>
              	</div>
              	<label class="feedback">
          			<a href="#">忘记密码</a>
         		</label>
       		</li>
   			<li class="login_btns"><input type="button" class="login_btn" id="login_btn" value="登 录" tabindex="3"></li>
		</ul>
		</form>
	</div>
</div>
<div class="footer">
   Copyright @ 2015-2025 新昌县澄潭镇民情红绿灯系统 | 浙ICP备09012673号-2  设计：新昌微视觉 
</div>
</body>
</html>