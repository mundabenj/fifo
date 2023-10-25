<?php
class frame{
	function affiliates(){
?>
	<script type="text/javascript">
		//new fadeshow(IMAGES_ARRAY_NAME, slideshow_width, slideshow_height, borderwidth, delay, pause (0=no, 1=yes), optionalRandomOrder)
		new fadeshow(fadeimages, 1058, 540, 0, 7000, 1, "R")
	</script>
<?php
	}
	function operations(){
?>
<tr>
	<td colspan = "7" align = "center">
		<table border = "0" width = "100%" align = "center" cellpadding = "4" cellspacing = "0" id = "operations">
			<tr>
			<?php
				if (isset($_GET["loaded"])){
			?>
				<td style = "text-align: right; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "exit" value = "Discard" title = "Discard Jobs" id = "exit_button" onClick = "return confirm('&nbsp;Are you sure you want to Discard Jobs?')" />
				</td>
				<td style = "text-align: left; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "execute" title = "Execute Jobs" value = "Execute" id = "execute_button" />
				</td>
			<?php
				}else if (isset($_GET["paused"])){
			?>
				<td style = "text-align: right; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "exit" value = "Discard" title = "Discard Jobs" id = "exit_button" onClick = "return confirm('&nbsp;Are you sure you want to Discard Jobs?')" />
				</td>
				<td style = "text-align: left; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "resume" value = "Resume" title = "Resume Jobs" id = "resume_button" />
				</td>
			<?php
				}else if (isset($_GET["execute"])){
			?>
				<td style = "text-align: right; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "exit" value = "Discard" title = "Discard Jobs" id = "exit_button" onClick = "return confirm('&nbsp;Are you sure you want to Discard Jobs?')" />
				</td>
				<td style = "text-align: left; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "abort" value = "Pause" title = "Pause Current Jobs" id = "abort_button" />
				</td>
			<?php
				}else if (isset($_GET["done"])){
			?>
				<td style = "text-align: right; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "exit" value = "Discard" title = "Discard Jobs" id = "exit_button" onClick = "return confirm('&nbsp;Are you sure you want to Discard Jobs?')" />
				</td>
				<td style = "text-align: left; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "statistics" value = "Statistics" title = "View Job Statistics" id = "statistics_button" />
				</td>
			<?php
				}else if (isset($_GET["statistics"])){
			?>
				<td style = "text-align: right; vertical-align: middle; width: 10%;">
					<input type = "submit" name = "exit" value = "Exit" title = "Exit Jobs" id = "exit_button" onClick = "return confirm('&nbsp;Are you sure you want to Exit Jobs?')" />
				</td>
				<td style = "text-align: left; vertical-align: middle; width: 10%;">
						<!--script for loading the print button-->
<script language = "javascript">  
var NS = (navigator.appName == "Netscape");
var VERSION = parseInt(navigator.appVersion);
if (VERSION > 3)	{
document.write('<input type = "submit" name = "print" value = "Print" title = "Print Statistics" id = "statistics_button" onClick = "printit()" />');
				}
</script>
				</td>
			<?php
				}
				else{
			?>
				<td style = "text-align: right; vertical-align: middle; width: 25%;">
					Enter # Processes: <input type = "text" name = "no_processes" maxlength = "6" style = "width: 50px;" />
				</td>
				<td style = "text-align: left; vertical-align: middle; width: 25%;">
					<input type = "submit" name = "load" value = "Load" title = "Load Process (es)" id = "load_button" onclick="MM_validateForm('no_processes','','R');return document.MM_returnValue" />
				</td>
			<?php
				}
			?>
				<td style = "text-align: right; vertical-align: middle; width: 80%; text-transform: none; color: #ffffff;">
<a href = "slide_show.php" onClick = "return slide_show(this)">Take a tour</a> | <a href = "help.php" onclick="NewWindow(this.href,'mywin','600','400','yes','right');return false" onfocus="this.blur()">About FIFO</a> | 
					<?php
						date_default_timezone_set("Africa/Nairobi");
						$local_dynamic_part_1 = date("l, d F Y", time());
						$local_dynamic_part_2 = '<span id = "txt">  </span>';
						$full_local_dynamic = $local_dynamic_part_1.'&nbsp;'.$local_dynamic_part_2;
						echo $full_local_dynamic;
					?>
				</td>
			</tr>
		</table>
	</td>
</tr>
<?php
	}
	function lables(){
?>
			<tr id = "tr_lables">
				<td id = "in_labels"><a href = "transition.php?order=process_name">Process Name</a></td>
				<td id = "in_labels"><a href = "transition.php?order=arrival_time">Arrival Time</a></td>
				<td id = "in_labels"><a href = "transition.php?order=cpu_burst_time">CPU Burst Time</a></td>
				<td id = "in_labels"><a href = "transition.php?order=status">Status</a></td>
				<td id = "in_labels"><a href = "transition.php?order=start_time">Start Time</a></td>
				<td id = "in_labels"><a href = "transition.php?order=end_time">End Time</a></td>
				<td id = "in_labels"><a href = "transition.php?order=arrage_order">Remaining Time</a></td>
			</tr>
<?php
	}
	function engine($conn){
?>
			<?php
$spot_order = @mysqli_query($conn, "SELECT * FROM statistics ORDER BY avgId ASC LIMIT 1");
$orde_row = @mysqli_fetch_array($spot_order);
$avg_arrage_order = $orde_row["avg_arrage_order"];
$query = @mysqli_query($conn, "SELECT * FROM processes ORDER BY ".$avg_arrage_order." ASC");

				while ($row = @mysqli_fetch_array($query))
				{
					$processId = $row["processId"];
					$process_name = $row["process_name"];
					$arrival_time = $row["arrival_time"];
					$cpu_burst_time = $row["cpu_burst_time"];
					$status = $row["status"];
					$abort_rem_time = $row["abort_rem_time"];
					if ($abort_rem_time < 10) { $abort_rem_time = '0'.$abort_rem_time; }				
					if ($status == 'Completed'){
						$o_blink = "<span>";
						$c_blink = "</span>";
						$in_values = 'in_completed';
						$start_time = $row["start_time"];
						$end_time = $row["end_time"];
						$remaining_time = 'Done';
					}else if ($status == 'Failed' || $status == 'Paused'){
						$o_blink = "<blink>";
						$c_blink = "</blink>";
						$in_values = 'in_failed';
						$start_time = $row["start_time"];
						$end_time = '---';
						$remaining_time = $abort_rem_time.' Sec. remaining';
					}else if ($status == 'Executing'){
						$o_blink = "<span>";
						$c_blink = "</span>";
						$in_values = 'in_executing';
						$start_time = $row["start_time"];
						$end_time = '---';
						$estim_end_time = $row["end_time"];
						$remaining_time = '<SCRIPT language = "JavaScript" SRC = "countdown/countdown.php?timezone=Africa/Nairobi&countto='.$estim_end_time.'&do=r&data=transition.php?processId='.$processId.'"></SCRIPT>';
					}else if ($status == 'Waiting'){
						$o_blink = "<span>";
						$c_blink = "</span>";
						$in_values = 'in_waiting';
						$start_time = '---';
						$end_time = '---';
						$remaining_time = '---';
						$remaining_time = '---';
					}else {
						$o_blink = "<span>";
						$c_blink = "</span>";
						$in_values = 'in_values';
						$start_time = '---';
						$end_time = '---';
						$remaining_time = '---';
					}

					$at = strtotime( $arrival_time );
					$st = strtotime( $start_time );
					$et = strtotime( $end_time );
					$waiting_time = ( $st - $at );
					$turn_around_time = ( $et - $at );
@mysqli_query($conn, "UPDATE processes SET waiting_time = '$waiting_time' WHERE processId = '$processId' LIMIT 1");
@mysqli_query($conn, "UPDATE processes SET turn_around_time = '$turn_around_time' WHERE processId = '$processId' LIMIT 1");
			?>
				<tr id = "tr_engine" onMouseOver="javascript:highlightTableRowVersionA(this, '#aeaaaa');">
				<?php echo '
					<td id = "'.$in_values.'">'.$o_blink.''.$process_name.''.$c_blink.'</td>
					<td id = "'.$in_values.'">'.$o_blink.''.$arrival_time.''.$c_blink.'</td>
					<td id = "'.$in_values.'">'.$o_blink.''.$cpu_burst_time.' Seconds'.$c_blink.'</td>
					<td id = "'.$in_values.'">'.$o_blink.''.$status.''.$c_blink.'</td>
					<td id = "'.$in_values.'">'.$o_blink.''.$start_time.''.$c_blink.'</td>
					<td id = "'.$in_values.'">'.$o_blink.''.$end_time.''.$c_blink.'</td>
					<td id = "'.$in_values.'">'.$o_blink.''.$remaining_time.''.$c_blink.'</td>
				'; ?>
				</tr>
			<?php
				}
			?>
<?php
	}
	function progressBar($conn){
?>
	<tr>
		<td colspan = "7" align = "center" id = "tr_progress">
			<table border = "0" width = "100%" align = "center" cellpadding = "4" cellspacing = "0" >
				<tr>
					<?php
						$spot_tat = @mysqli_query($conn, "SELECT SUM(cpu_burst_time) AS tat FROM processes");
						$tat_row = @mysqli_fetch_array($spot_tat);
						$tat = $tat_row["tat"];

						$spot_progress = @mysqli_query($conn, "SELECT SUM(cpu_burst_time) AS progress FROM processes WHERE status = 'Completed'");
						$progress_row = @mysqli_fetch_array($spot_progress);
						$progress = $progress_row["progress"];
						if ($tat == 0) { $unit_prog = 0; } else { $unit_prog = 100/$tat; }
						$perc = $unit_prog*$progress;
						$percentage = substr(($perc), 0, 4);
						print "<div id=\"progress-bar\" class=\"all-rounded\">\n";
						print "<div id=\"progress-bar-percentage\" class=\"all-rounded\" style=\"width: $percentage%\">";
							if ($percentage > 5) {print "$percentage%";} else {print "<div class=\"spacer\">&nbsp;</div>";}
						print "</div></div>";
					?>
				</tr>
			</table>
		</td>
	</tr>
<?php
	}
	function statistics($conn){
?>
	<tr id = "">
		<td colspan = "7" id = "title">
			process statistics
		</td>
	</tr>
<?php
$avg_time = @mysqli_query($conn, "SELECT AVG(waiting_time) AS avg_waiting_time, AVG(turn_around_time) AS avg_turn_around_time, SUM(abort_rem_time) AS avg_abort_rem_time FROM processes");
$avg_row = @mysqli_fetch_array($avg_time);
$avg_waiting_time = $avg_row["avg_waiting_time"];
$avg_turn_around_time = $avg_row["avg_turn_around_time"];
$avg_abort_rem_time = $avg_row["avg_abort_rem_time"];

@mysqli_query($conn, "UPDATE statistics SET avg_waiting_time = '$avg_waiting_time', avg_turn_around_time = '$avg_turn_around_time'  WHERE avgId = 1 LIMIT 1");

$spot_stat = @mysqli_query($conn, "SELECT * FROM statistics ORDER BY avgId ASC LIMIT 1");
$stat_row = @mysqli_fetch_array($spot_stat);
$avg_start_time = $stat_row["avg_start_time"];
$avg_end_time = $stat_row["avg_end_time"];
?>
	<tr id = "tr_statistics">
		<td colspan = "2" align = "left" style = "vertical-align: top; padding-left: 20px;">
<p style = "font-size: 1.6em; color: #000000;">SUMMARY</p>
Start time: <?php echo $avg_start_time; ?>
<br />End time: <?php echo $avg_end_time; ?>
<br />Total pause time: <?php echo substr(($avg_abort_rem_time), 0, 4); ?> Seconds
<br />Average waiting time: <?php echo substr(($avg_waiting_time), 0, 4); ?> Seconds
<br />Average turn around time: <?php echo substr(($avg_turn_around_time), 0, 4); ?> Seconds
		</td>
		<td colspan = "5" align = "center" style = "padding: 0px 10px 0px 10px; background-color: #cccccc; vertical-align: bottom;">
		<p style = "font-size: 1.6em; color: #000000;">GANTT CHART SUMMARY</p>
		<?php
			$spot_tcbt = @mysqli_query($conn, "SELECT SUM(cpu_burst_time) AS tcbt FROM processes WHERE status = 'Completed'");
			$tcbt_row = @mysqli_fetch_array($spot_tcbt);
			$tcbt = $tcbt_row["tcbt"];
			$spot_proc = @mysqli_query($conn, "SELECT * FROM processes WHERE status = 'Completed'");
			$total_proc = mysqli_num_rows($spot_proc);
		?> <div id = "gant_chart">
			<table border = "1" width = "100%" align = "center" cellpadding = "4" cellspacing = "0" style = "border-collapse: collapse; border: solid #373737 0px;">
				<tr style = "height: 20px;">
					<?php
					while ($proc_row = @mysqli_fetch_array($spot_proc))
					{
						$proc_prog = $proc_row["cpu_burst_time"];
						$process_name = $proc_row["process_name"];

						if ($tcbt == 0) { $unit_proc = 0; } else { $unit_proc = 100/$tcbt; }
						$proc_perc = $proc_prog*$unit_proc;
						$pperc = substr(($proc_perc), 0, 4);

						$bal_height = 100-$pperc;
						$width = 100/$total_proc;
						$p_col = '
							<td style = "width : '.$pperc.'%; height: 40px; text-align: center; vertical-align: bottom; color: #ffffff; background-color: #cbb600;" title = "'.$process_name.'">
							'.$proc_prog.'
							</td>
						';
						echo $p_col;
					}
					?>
				</tr>
				<tr>
					<?php
					$spot_mark = @mysqli_query($conn, "SELECT * FROM processes WHERE status = 'Completed'");
					for ($np=1; $np<=$total_proc; $np++){
					$time_mark = @mysqli_fetch_array($spot_mark);
						$mark_start_time = $time_mark["start_time"];
						$mark_end_time = $time_mark["end_time"];
						$p_col = '
							<td style = "border: 0px; height: 20px; text-align: right; vertical-align: bottom; color: #ffffff; ">'.substr(($mark_start_time), 17, 6).'~~'.substr(($mark_end_time), 17, 6).'
							</td>
						';
						echo $p_col;
					}
					?>
				</tr>
			</table>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan = "7" id = "title">
			CPU utilization statistics
		</td>
	</tr>
	<tr>
		<td colspan = "7" align = "center" style = "background-color: #cccccc;">
		<?php
			$spot_tcbt = @mysqli_query($conn, "SELECT SUM(cpu_burst_time) AS tcbt FROM processes WHERE status = 'Completed'");
			$tcbt_row = @mysqli_fetch_array($spot_tcbt);
			$tcbt = $tcbt_row["tcbt"];
			$spot_proc = @mysqli_query($conn, "SELECT * FROM processes WHERE status = 'Completed'");
			$total_proc = mysqli_num_rows($spot_proc);
		?>
		<div id = "graph_chart">
			<table border = "1" width = "100%" align = "center" cellpadding = "4" cellspacing = "0" style = "border-collapse: collapse; border: solid #ffffff 1px;">
				<tr>
					<?php
					while ($proc_row = @mysqli_fetch_array($spot_proc))
					{
						$proc_prog = $proc_row["cpu_burst_time"];
						$process_name = $proc_row["process_name"];

						if ($tcbt == 0) { $unit_proc = 0; } else { $unit_proc = 100/$tcbt; }
						$proc_perc = $proc_prog*$unit_proc;
						$pperc = substr(($proc_perc), 0, 4);

						$bal_height = 100-$pperc;
						$width = 100/$total_proc;
						$p_col = '
						<td style = "text-align: center; vertical-align: middle;">
							<table border = "0" width = "100%" height = "130px" align = "center" cellpadding = "4" cellspacing = "0" id = "">
								<tr style = "height: '.$bal_height.'%; width : '.$width.'%; ">
									<td style = "text-align: center; vertical-align: bottom;">
									'.$pperc.'%
									</td>
								</tr>
								<tr style = "height: '.$pperc.'%; background-color: #cbb600;">
									<td style = "text-align: center; vertical-align: middle;" title = "'.$process_name.'">
									</td>
								</tr>
							</table>
							<table border = "0" width = "100%"  align = "center" cellpadding = "0" cellspacing = "0" style = "border-collapse: collapse; border: solid #cccccc 3px;">

								<tr height = "7px" style = "">
									<td style = "text-align: center; vertical-align: middle; font-size: smaller; background-color: #ffffff; padding-top: 2px;" title = "'.$process_name.'">
									'.$process_name.'
									</td>
								</tr>
							</table>
						</td>
						';
						echo $p_col;
					}
					?>
				</tr>
			</table>
			</div>
		</td>
	</tr>
<?php
	}
	function footer()
	{
?>
		<tr>
			<td colspan = "7" height = "6px" style = "background-color: #ffffff;"></td>
		</tr>
		<tr>
			<td width = "100%" height = "20px" colspan = "7" style = "background-color: #999999;">
			</td>
		</tr>
		<tr>
			<td colspan = "7" align = "center" id = "footer">
	Copyright &copy; <?php echo date("Y"); ?>, MIT 8101 Advanced Information Technology Concepts - FIFO		
			</td>
		</tr>
		<tr>
			<td colspan = "7" height="6px" style = "background-color: #999999;"></td>
		</tr>
<?php
	}
}
?>