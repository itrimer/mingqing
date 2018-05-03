<html>
<head>
<title>管理页面</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/c.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>css/mf.css">
<script src="<?php echo base_url()?>/js/jquery-1.3.2.js" type="text/javascript"></script>    
<script src="<?php echo base_url()?>js/accordion.js" type="text/javascript"></script>

<style type=text/css>
body  { background:#eef2f7 url(<?php echo base_url()?>images/repeat_x_bg.gif) repeat-y; margin:0px; font:normal 12px 宋体; 
scrollbar-face-color: #799ae1; scrollbar-highlight-color: #799ae1; 
scrollbar-shadow-color: #799ae1; scrollbar-darkshadow-color: #799ae1; 
scrollbar-3dlight-color: #799ae1; scrollbar-arrow-color: #ffffff;
scrollbar-track-color: #aabfec; padding:0px;
}
a  { color:#000000; text-decoration:none; }
a:hover  { color:#428EFF;text-decoration:underline; }
</style>
</head>
<SCRIPT type="text/javascript">
$(document).ready(function() {
    $('#sidebar').accordion({open:true});
});

function LogoutConfirm(){
	if(confirm('退出管理界面吗？')) top.location.href='frame.php?act=logout';
}
</SCRIPT>
<BODY>
<dl id="sidebar">
<?php
for($i=0;$i<count($menu_view);$i++){
	$title=explode(",",$menu_view[$i][0]);
	if($rule>=$title[1]){
?>

		<dt class="a subMenu"><img class="mi mi_16" src="<?php echo base_url()?>images/common.png" /> <?php echo $title[0]?></dt>
		<dd>
			<ul>
<?php 
			for($j=1;$j<count($menu_view[$i]);$j++){
	  			$item=explode(",",$menu_view[$i][$j]);
?>
	  		<li class="a" ><img class="mi mi_16" src="<?php echo base_url()?>images/archive_channel.png" />
	  			<a href="<?php echo  base_url ( '/admin/' . $item[1] ) ?>" target="main"><?php echo $item[0]?></a>
	  		</li>
<?php
	  		}
?>
			</ul>
		</dd>
	
<?php
		}
	}
?>
</dl>
</BODY>
</html>
