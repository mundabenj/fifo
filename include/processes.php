<?php
class process
	{
	function manage_process($conn)
		{
//All about loading the disered number of processes
if (isset ($_POST['load'])){
	$no_processes = $_POST['no_processes'];
	// variable verification for numeric values
	if(!is_numeric($no_processes)){
		@header("Location: index.php?required_numeric");
		exit ();
		}
		else{
		@mysqli_query($conn, "TRUNCATE processes");
		@mysqli_query($conn, "TRUNCATE statistics");
		for ($np=1; $np<=$no_processes; $np++){
			$process_name = 'P-'.$np;
			$cpu_burst_time = (substr(rand(), 1, 1))+1;
			$arrage_order = (substr(rand(), 1, 1))+1;
			$status = 'Requesting';
			@mysqli_query($conn, "INSERT INTO processes(`process_name`, `arrival_time`, `cpu_burst_time`, `status`, `arrage_order`) VALUES('$process_name', date_add(now(), INTERVAL $np SECOND), '$cpu_burst_time', '$status', '$arrage_order')");
			}
			@mysqli_query($conn, "INSERT INTO statistics(`no_processes`) VALUES('$no_processes')");
		@header("Location: index.php?loaded");
		exit ();
		}
	}else
//All about executing the first process
if (isset ($_POST['execute'])){
	$pId_cont = $_GET["processId"];
	$processId_cont = $pId_cont + 1;
	$status = 'Requesting';
	$spot_run = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' AND processId = $processId_cont ORDER by arrival_time ASC LIMIT 1");		
	if(mysqli_num_rows($spot_run)){
		$ruw_row = @mysqli_fetch_array($spot_run);
		$run_processId = $ruw_row["processId"];
		$request_status = 'Requesting';
		$run_status = 'Executing';
		$wait_status = 'Waiting';
		$run_cpu_burst_time = $ruw_row["cpu_burst_time"];
		@mysqli_query($conn, "UPDATE processes SET status = '$run_status', start_time = now(), end_time = date_add(now(), INTERVAL $run_cpu_burst_time SECOND) WHERE processId = '$run_processId' ORDER BY processId ASC LIMIT 1");
		@mysqli_query($conn, "UPDATE processes SET status = '$wait_status' WHERE status = '$request_status'");
		@mysqli_query($conn, "UPDATE statistics SET avg_start_time = now() WHERE avgId = 1 LIMIT 1");
		}
		else{
		@header("Location: index.php?statistics");
		exit ();
		}
	@header("Location: index.php?processId=1&execute");
	exit ();
	}else
// All about gettting the next process to be executed
if(isset($_GET["continue"])){
	$pId_cont = $_GET["processId"];
	$done_status = 'Completed';
	@mysqli_query($conn, "UPDATE processes SET status = '$done_status' WHERE processId = '$pId_cont' LIMIT 1");
	$processId_cont = $pId_cont + 1;
	$status = 'Waiting';
	$spot_run = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' AND processId = $processId_cont ORDER by arrival_time ASC LIMIT 1");		
	if(mysqli_num_rows($spot_run)){
		$ruw_row = @mysqli_fetch_array($spot_run);
		$run_processId = $ruw_row["processId"];
		$run_status = 'Executing';
		$run_cpu_burst_time = $ruw_row["cpu_burst_time"];
		@mysqli_query($conn, "UPDATE processes SET status = '$run_status', start_time = now(), end_time = date_add(now(), INTERVAL $run_cpu_burst_time SECOND) WHERE processId = '$run_processId' LIMIT 1");
		}
		else{
@mysqli_query($conn, "UPDATE statistics SET avg_end_time = now() WHERE avgId = 1 LIMIT 1");
		@header("Location: index.php?done");
		exit ();
		}
	@header("Location: index.php?processId=".$run_processId."&execute");
	exit ();
	}else
//All about process abortion
if (isset ($_POST['abort'])){
	$status = 'Executing';
	$spot_abort = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' LIMIT 1");
	$abort_row = @mysqli_fetch_array($spot_abort);
	$abort_processId = $abort_row["processId"];
	$abort_status = 'Paused';
	$abort_cpu_burst_time = $abort_row["cpu_burst_time"];
	$end_time = $abort_row["end_time"];
	date_default_timezone_set("Africa/Nairobi");
	$full_local_static = date("Y-m-d H:i:s", time());
	$t1 = strtotime( $full_local_static );
	$t2 = strtotime( $end_time );
	$abort_rem_time = ($t2 - $t1);		
	@mysqli_query($conn, "UPDATE processes SET status = '$abort_status', abort_rem_time = '$abort_rem_time' WHERE processId = '$abort_processId' LIMIT 1");
	@header("Location: index.php?paused");
	exit ();
	}else
//All about resuming from an abortion
if (isset ($_POST['resume'])){
	$status = 'Paused';
	$spot_resume = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' ORDER by arrival_time ASC LIMIT 1");		
	if(mysqli_num_rows($spot_resume)){
		$resume_row = @mysqli_fetch_array($spot_resume);
		$resume_processId = $resume_row["processId"];
		$resume_status = 'Executing';
		$resume_cpu_burst_time = $resume_row["cpu_burst_time"];
		$abort_rem_time = $resume_row["abort_rem_time"];
		@mysqli_query($conn, "UPDATE processes SET status = '$resume_status', end_time = date_add(now(), INTERVAL $abort_rem_time SECOND) WHERE processId = '$resume_processId' LIMIT 1");
		}
	@header("Location: index.php?processId=".$resume_processId."&execute");
	exit ();
	}else
//All about Canceling all executions
if (isset ($_POST['exit'])){
	@mysqli_query($conn, "TRUNCATE processes");
	@header("Location: ./");
	exit ();
	}else
//All about bout viewing the statistics
if (isset ($_POST['statistics'])){
	@header("Location: index.php?statistics");
	exit ();
	}
		}
	}