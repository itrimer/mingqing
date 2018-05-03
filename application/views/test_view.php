<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?php echo $title;?></title>

	<style type="text/css">
		body{font-size:12px;}
	</style>
</head>
<body>
<?php require_once("common/header.php"); ?>
<div id="container">
	<h1><?php echo $body_content;?></h1>
	<hr/>
	<h3>My Todo List</h3> 
<ul>
<?php foreach($todo_list as $item):?>

<li><?php echo $item;?></li>

<?php endforeach;?>
<li><?php echo anchor('http://www.baidu.com', 'My News', 'title="News title"');?></li>
<li><?php echo base_url();?></li>
<li><?php echo index_page();?></li>
<li><?php $atts = array(
              'width'      => '800',
              'height'     => '600',
              'scrollbars' => 'yes',
              'status'     => 'yes',
              'resizable'  => 'yes',
              'screenx'    => '0',
              'screeny'    => '0'
            );

echo anchor_popup('news/local/123', 'Click Me!', $atts);
?>
</li>
</ul>
<hr/>
<table> 
<?php foreach($query->result() as $row) : ?> 
    <tr> 
    <td><?php echo $row->username; ?></td> 
    <td><?php echo $row->password; ?></td> 
    </tr> 
<?php endforeach;?> 
<?php 
$result = $query->result_array();
foreach($result as $key => $row) { ?> 
    <tr> 
    <td><?php echo $row["username"]; ?></td> 
    <td><?php echo $row["password"]; ?></td> 
    </tr> 
<?php }?> 
</table> 
</div>
<?php require_once("common/footer.php"); ?>
</body>
</html>