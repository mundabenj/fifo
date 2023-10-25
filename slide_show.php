<?php
//All connections to the database
	$engine_path = dirname(__FILE__);
	require_once $engine_path."/include/config.inc.php";
	require_once $engine_path."/include/class_mysql.php";
	$CLASS["db"] = new fifodb_sql;
	$CLASS["db"]->connect();
	require_once $engine_path."/include/template.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>..::The FIFO Algorithm - Help</title>
			<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
			<script type = "text/javascript" src = "js/requirements.js"></script>
			<script type = "text/javascript" src = "js/startTime.js"></script>
			<script type = "text/javascript" src = "js/tablerowh.js"></script>
			<script type = "text/javascript" src = "js/popup.js"></script>
			<script type = "text/javascript" src = "js/swfobject.js"></script>
<style type="text/css">	
	/* hide from ie on mac \*/
	html {
		height: 100%;
		overflow: hidden;
	}	
	#flashcontent {
		height: 100%;
	}
	/* end hide */
	body {
		height: 100%;
		margin: 0;
		padding: 0;
		background-color: #181818;
		color:#ffffff;
		font-family:sans-serif;
		font-size:40;
	}	
	a {	
		color:#cccccc;
	}
</style>
	</head>
<body style = "background-color: #999999;">
	<div id="flashcontent">AutoViewer requires JavaScript and the Flash Player. <a href="http://www.macromedia.com/go/getflashplayer/">Get Flash here.</a></div>	
	<script type="text/javascript">
		var fo = new SWFObject("flash/autoviewer.swf", "flash/autoviewer", "100%", "100%", "8", "#181818");		
				
		//Optional Configuration
		//fo.addVariable("langOpenImage", "Open Image in New Window");
		//fo.addVariable("langAbout", "About");	
		fo.addVariable("xmlURL", "xml/gallery.xml");					
		
		fo.write("flashcontent");
	</script>
	<script language="javascript" type="text/javascript">
		document.write('<a href="#" onclick="javascript:window.close();"><font color = "#ffffff">Close Window</font></a>');
	</script>
</body>
</html>