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
			<script type = "text/javascript" src = "js/requirements.js"></script>
			<script type = "text/javascript" src = "js/startTime.js"></script>
			<script type = "text/javascript" src = "js/tablerowh.js"></script>
			<script type = "text/javascript" src = "js/popup.js"></script>
			<link type = "text/css" rel = "stylesheet" href = "css/fifo.css"></link>
	</head>
<body style = "background-color: #999999;">
<table border = "0" width = "100%" align = "center" cellpadding = "0" cellspacing = "0" style = "border-collapse: collapse; border: solid #ffffff 0px;">
	<tr style = "height: 50px;">
		<td id = "header">
	<span style = "font-size: 2.0em; color: #000000;">FIRST IN FIRST OUT ALGORITHM</span>
		</td>
	</tr>
	<tr>
		<td style = "width: 100%; padding: 0px 20px 0px 20px; vertical-align : top;">
			<p class="style2">Fifo Algorithim </p>
			<p align = "justify">
			Also known as <strong><em>F</em></strong><em>irst&shy; <strong>C</strong>ome, <strong>F</strong>irst &shy;<strong>S</strong>erved</em> (FCFS), is the simplest scheduling  algorithm, FIFO simply queues processes in the order that they arrive in the  ready queue. <strong>FIFO</strong> is an acronym  for <strong>First In, First Out</strong>, an abstraction in ways of organizing and  manipulation of data relative to time and prioritization. This expression  describes the principle of a queue processing technique or servicing  conflicting demands by ordering process by first-come, first-served (<strong>FCFS</strong>)  behavior: what comes in first is handled first, what comes in next waits until  the first is finished, etc.<br />
			Thus  it is analogous to the behavior of persons standing in line, where the persons  leave the queue in the order they arrive, or waiting one's turn at a traffic control  signal. FCFS is also the shorthand name (see <a href="http://en.wikipedia.org/wiki/Jargon" title="Jargon">Jargon</a> and  acronym) for the FIFO operating system scheduling algorithm, which gives every  process CPU time in the order they come. In the broader sense, the abstraction  LIFO, or Last-In-First-Out is the opposite of the abstraction FIFO  organization, the difference perhaps is clearest with considering the less  commonly used synonym of LIFO, FILO&mdash;meaning First-In-Last-Out. In essence, both  are specific cases of a more generalized list (which could be accessed  anywhere). The difference is not in the list (data), but in the rules for  accessing the content. One sub-type adds to one end, and takes off from the  other, its opposite takes and puts things only on one end.</p>
				<ul>
					<li>Since  context switches only occur upon process termination, and no reorganization of  the process queue is required, scheduling overhead is minimal.</li>
					<li>Throughput  can be low, since long processes can hog the CPU</li>
					<li>Turnaround  time, waiting time and response time can be high for the same reasons above</li>
					<li>No  prioritization occurs, thus this system has trouble meeting process deadlines.</li>
					<li>The  lack of prioritization means that as long as every process eventually  completes, there is no starvation. In an environment where some processes might  not complete, there can be starvation.</li>
				</ul>
			<p align = "justify">A priority queue is a  variation on the queue which does not qualify for the name FIFO, because it is  not accurately descriptive of that data structure's behavior. <a href="http://en.wikipedia.org/wiki/Queueing_theory" title="Queueing theory">Queuing  theory</a> encompasses the more general concept of queue, as well as  interactions between strict-FIFO queues.<br />
			<strong>Data structure</strong><br />
			In computer science this term refers  to the way data stored in a queue is processed. Each item in the queue is  stored in a queue (<em>simpliciter</em>) data structure. The first data to be  added to the queue will be the first data to be removed, then processing  proceeds sequentially in the same order. <br />
			A typical data structure will look  like<br />
			struct fifo_node <br />
			{<br />
			&nbsp; struct fifo_node * next;<br />
			&nbsp; value_type value;<br />
			};<br />
			&nbsp;<br />
			class fifo<br />
			{<br />
			&nbsp; fifo_node * front;<br />
			&nbsp; fifo_node * back;<br />
			&nbsp;<br />
			&nbsp; fifo_node  * dequeue(void)<br />
			&nbsp; {<br />
			&nbsp;&nbsp;&nbsp; fifo_node * tmp =  front;<br />
			&nbsp;&nbsp;&nbsp; front =  front-&gt;next;<br />
			&nbsp;&nbsp;&nbsp; return tmp;<br />
			&nbsp; }<br />
			&nbsp;<br />
			&nbsp; queue(value)<br />
			&nbsp; {<br />
			&nbsp;&nbsp;&nbsp; fifo_node  * tempNode = new fifo_node;<br />
			&nbsp;&nbsp;&nbsp; tempNode-&gt;value  = value;<br />
			&nbsp;&nbsp;&nbsp; back-&gt;next =  tempNode;<br />
			&nbsp;&nbsp;&nbsp; back = tempNode;<br />
			&nbsp; }<br />
			};</p>    
			<a name="How to use the system "></a><p class="style2"><a href = "slide_show.php" onClick = "return slide_show(this)">How to use the system</a></p>
			<a name="Version"></a><p class="style2">Version : g3 1.O
		</td>
	</tr>
	<tr>
		<td width = "100%" height = "30px" style = "background-color: #ffffff;">
		</td>
	</tr>
	<tr>
		<td align = "center" id = "footer" style = "color: #ffffff;">
Copyright &copy; <?php echo date("Y"); ?>, MIT 8101 Advanced Information Technology Concepts - FIFO	
		</td>
	</tr>
		<tr>
			<td colspan = "2" align = "center" valign = "top">
				<script language="javascript" type="text/javascript">
					document.write('<a href="#" onclick="javascript:window.close();">Close Window</a>');
				</script>
			</td>
		</tr>
	<tr>
		<td height="6px" style = "background-color: #999999;"></td>
	</tr>
</table>
</body>
</html>