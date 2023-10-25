<?php
//All connections to the database
	$engine_path = dirname(__FILE__);
	require_once $engine_path."/include/config.inc.php";
	require_once $engine_path."/include/class_mysql.php";

	require_once $engine_path."/include/template.php";
	require_once $engine_path."/include/processes.php";
	$about = new process();
		$about->manage_process($conn);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>..::The FIFO Algorithm</title>
			<script type = "text/javascript" src = "js/requirements.js"></script>
			<script type = "text/javascript" src = "js/startTime.js"></script>
			<script type = "text/javascript" src = "js/tablerowh.js"></script>
			<script type = "text/javascript" src = "js/popup.js"></script>
			<script type = "text/javascript" src = "js/print.js"></script>
			<link type = "text/css" rel = "stylesheet" href = "css/fifo.css"></link>
	</head>
<?php if (isset($_GET["required_numeric"])){ ?> <body OnLoad = "alert('You are required to enter a numeric value.\nPlease try again.\nThank you!');startTime();document.fifo2.no_processes.focus();"> <?php }else { ?>
<body OnLoad = "startTime();document.fifo2.no_processes.focus();"> <?php } ?>
	<form name = "fifo2" method = "POST" action = "">
		<table border = "0" align = "center" cellpadding = "0" cellspacing = "1" id = "main_table" onMouseOut="javascript:highlightTableRowVersionA(0);">
			<tr>
				<td colspan = "7" id = "header">
					process monitor<br /><a href = "index.php"><span style = "font-size: 2.0em; color: #000000;">dashboard</span></a>  
				</td>									
			</tr>
			<?php 
				$about = new frame();
				$about->operations(); ?>
			<?php
				$about = new frame();
				$about->lables(); ?>
			<?php
				$about = new frame();
				$about->engine($conn); ?>
			<?php
			if (isset($_GET["execute"]) || isset($_GET["paused"]) || isset($_GET["done"])){
				$about = new frame();
				$about->progressBar($conn);
				}
				?>
			<?php
			if (isset($_GET["statistics"])){
				$about = new frame();
				$about->statistics($conn); 
				}
				?>
			<?php
				$about = new frame();
				$about->footer(); ?>
		</table>
	</form>
</body>
</html>