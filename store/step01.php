<?php
	@mysql_connect("localhost","root","") or die(mysql_error());
	@mysql_select_db("fifo") or die(mysql_error());
function mysql_prep( $value ) {
	$magic_quotes_active = get_magic_quotes_gpc();
	$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
	if( $new_enough_php ) { // PHP v4.3.0 or higher
		// undo any magic quote effects so mysql_real_escape_string can do the work
		if( $magic_quotes_active ) { $value = stripslashes( $value ); }
		$value = mysql_real_escape_string( $value );
	} else { // before PHP v4.3.0
		// if magic quotes aren't already on then add slashes manually
		if( !$magic_quotes_active ) { $value = addslashes( $value ); }
		// if magic quotes are active, then the slashes already exist
	}
	return $value;
}
if (isset ($_POST['abort']))
{
$status = 'Running';
$spot_abort = @mysql_query("SELECT * FROM processes WHERE status = '$status' LIMIT 1") or die(mysql_error());

$abort_row = @mysql_fetch_array($spot_abort);
$abort_processeId = $abort_row["processeId"];
$abort_status = 'Aborted';
$abort_burst_time = $abort_row["burst_time"];
$abort_p_finish_time = $abort_row["p_finish_time"];

@mysql_query("UPDATE processes SET status = '$abort_status', p_finish_time = date_add(now(), INTERVAL $abort_burst_time SECOND) WHERE processeId = '$abort_processeId' LIMIT 1") or die(mysql_error());

@header("Location: index.php?aborted");
exit ();
}else if (isset ($_GET['processeId']))
{
	$pId_cont = $_GET["processeId"];

		if(isset($_GET["resume"]))
		{
		$status = 'Aborted';
		$processeId_cont = $pId_cont;
		}else{
		$done_status = 'Done';
		@mysql_query("UPDATE processes SET status = '$done_status' WHERE processeId = '$pId_cont' LIMIT 1") or die(mysql_error());
		$processeId_cont = $pId_cont + 1;
		$status = 'Waiting';
		}

		$spot_run = @mysql_query("SELECT * FROM processes WHERE status = '$status' AND processeId = $processeId_cont ORDER by arrival_time ASC LIMIT 1") or die(mysql_error());		
	if(mysql_num_rows($spot_run))
	{
	$ruw_row = @mysql_fetch_array($spot_run);
	$run_processeId = $ruw_row["processeId"];
	$run_status = 'Running';
	$run_burst_time = $ruw_row["burst_time"];
	$run_p_finish_time = $ruw_row["p_finish_time"];
	
	@mysql_query("UPDATE processes SET status = '$run_status', p_finish_time = date_add(now(), INTERVAL $run_burst_time SECOND) WHERE processeId = '$run_processeId' LIMIT 1") or die(mysql_error());
	}
	else
	{
@header("Location: index.php?failed");
exit ();
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>..::The FIFO Algorithm</title>
			<script language = "JavaScript" type = "text/javascript" src = "js/requirements.js"></script>
			<link type = "text/css" rel = "stylesheet" href = "fifo.css"></link>
	<head/>
<body>
	<form method = "POST" action = "">
		<table border = "1" align = "center" cellpadding = "6" cellspacing = "0" style = "border-collapse: collapse; border: solid #373737 1px;">
			<tr>
				<td colspan = "5" style = "text-align: center; vertical-align: middle;">
					<span style = "font-size: 1.1em; letter-spacing: 0.04em;">
						The FIFO Algorithm
					</span>
				</td>
			</tr>
			<tr>
				<td colspan = "5" style = "text-align: center; vertical-align: middle;">
					<span style = "font-size: 1.1em; letter-spacing: 0.04em;">
						Step 1
					</span>
				</td>
			</tr>

			<tr>
				<td id = "in_labels">Processes</td>
				<td id = "in_labels">CPU Burst</td>
				<td id = "in_labels">Arrival Time</td>
				<td id = "in_labels">Status</td>
			</tr>
			<?php
				$query = @mysql_query("SELECT * FROM processes ORDER by arrival_time ASC") or die(mysql_error());
				while ($row = @mysql_fetch_array($query))
				{
				$processeId = $row["processeId"];
				$burst_time = $row["burst_time"];
				$arrival_time = $row["arrival_time"];
				$status = $row["status"];
				$p_finish_time = $row["p_finish_time"];
			?>
				<tr>
					<td id = "in_values">P<?php echo $processeId; ?></td>
					<td id = "in_values"><?php echo $burst_time; ?></td>
					<td id = "in_values"><?php echo $arrival_time; ?></td>
					<td id = "in_values"><?php echo $status;
if ($status == 'Running')
{
echo '
<SCRIPT language = "JavaScript" SRC = "countdown/countdown.php?timezone=Africa/Nairobi&countto='.$p_finish_time.'&do=r&data=step01.php?processeId='.$processeId.'&&continue"></SCRIPT>
';
}
					?>
					</td>
				</tr>
			<?php
				}
				$q = @mysql_query("SELECT * FROM processes") or die(mysql_error());
				$ta_row = @mysql_fetch_array($q);
				$ta_time = $ta_row["ta_time"];
			?>

			<tr>
				<td colspan = "5" style = "text-align: center; vertical-align: middle; padding: 3px;">
					<input type = "submit" name = "abort" value = "Abort" >
				</td>
			</tr>
		</table>
	</form>
</body>
</html>