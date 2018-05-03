<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="keywords" content="<?php echo $keywords?>">
<meta name="description" content="<?php echo $description?>">
<title><?php echo $website_name?></title>
<link href="<?php echo base_url()?>css/forms.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/general.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/messages.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/reset.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/tables.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/ui/styles/default/ui.css" rel="stylesheet" media="all" />
<link href="<?php echo base_url()?>css/mine.css" rel="stylesheet" />
<link href="<?php echo base_url()?>css/jquery.fancybox.css" rel="stylesheet" />


<script type="text/javascript" src="<?php echo base_url()?>js/jquery-1.7.1.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.form.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/superfish.js"></script>

<script type="text/javascript" src="<?php echo base_url()?>js/ui/jquery-ui.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/tooltip.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/tablesorter.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/tablesorter-pager.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/cookie.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/pop.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/base.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.fancybox.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.fancybox-buttons.js"></script>


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
var base_url = "<?php echo base_url();?>";
var base_url_index = "<?php echo base_url('');?>";

$(function(){
	refresh_time();
	calaMainWrapperWidth();
	window.onresize=calaMainWrapperWidth;
	
	$(".hastable table tbody>tr").click(function(){
		checkOnSelectRow($(this));
	})
	<?php if(!$has_auth){?>
		showMsg( "你没有权限访问该页面！", "提示");
	<?php }?>
})

</script>