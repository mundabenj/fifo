<?php
//All connections to the database
	$engine_path = dirname(__FILE__);
	require_once $engine_path."/include/config.inc.php";
	require_once $engine_path."/include/class_mysql.php";
	require_once $engine_path."/include/template.php";
?>
<?php

if (isset ($_GET["order"])){
	$avg_arrage_order = $_GET["order"];
	$status = 'Executing';
	$spot_abort = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' LIMIT 1");
	if(mysqli_num_rows($spot_abort)){
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
		@mysqli_query($conn, "UPDATE statistics SET avg_arrage_order = '$avg_arrage_order' WHERE avgId = 1 LIMIT 1");

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
		@header("Location: index.php?processId=".$resume_processId."&&execute");
		exit ();
		}else{
			$status = 'Paused';
			$spot_abort = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' LIMIT 1");
			if(mysqli_num_rows($spot_abort)){
			@mysqli_query($conn, "UPDATE statistics SET avg_arrage_order = '$avg_arrage_order' WHERE avgId = 1 LIMIT 1");
				@header("Location: index.php?paused");
				exit ();
				}else{
					$status = 'Requesting';
					$spot_abort = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' LIMIT 1");
					if(mysqli_num_rows($spot_abort)){
					@mysqli_query($conn, "UPDATE statistics SET avg_arrage_order = '$avg_arrage_order' WHERE avgId = 1 LIMIT 1");
						@header("Location: index.php?loaded");
						exit ();
						}else{
							$status = 'Completed';
							$spot_abort = @mysqli_query($conn, "SELECT * FROM processes WHERE status = '$status' LIMIT 1");
							if(mysqli_num_rows($spot_abort)){
							@mysqli_query($conn, "UPDATE statistics SET avg_arrage_order = '$avg_arrage_order' WHERE avgId = 1 LIMIT 1");
								@header("Location: index.php?statistics");
								exit ();
								}else{
									@header("Location: index.php");
									exit ();	
								}
						}
				}
		}
	}else{
		$processId = $_GET["processId"];
		@header("Location: index.php?processId=$processId&&continue");
		exit ();	
	}
?>