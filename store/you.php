<td width="162" valign="top">
<p class="style2"><a href="#Group members ">Group members</a></p>
<p class="style2"><a href="#Introduction">Introduction</a></p>
<p class="style2"><a href="#Fifo Algorithim">Fifo Algorithim</a></p>
<p class="style2"><a href="#How to use the system ">How to use the system</a></p>
<p class="style2"><a href="#Version">Version</p>
</td>

<a name="Group Members"></a><p class="style2">Group Members</p>
<a name="Introduction"></a><p class="style2">Introduction</p>

print("<?php
$to_time=strtotime("2008-12-13 10:42:00");
$from_time=strtotime("2008-12-13 10:21:00");
echo round(abs($to_time - $from_time) / 60,2)." minute";
?>");

<?php

//getMyTimeDiff($t1,$t2)
function getMyTimeDiff($t1,$t2)
{
$a1 = explode(":",$t1);
$a2 = explode(":",$t2);
$time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
$time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
$diff = abs($time1-$time2);
$hours = floor($diff/(60*60));
$mins = floor(($diff-($hours*60*60))/(60));
$secs = floor(($diff-(($hours*60*60)+($mins*60))));
$result = $hours.":".$mins.":".$secs;
return $result;
}
echo "<br>";
// $cool = getMyTimeDiff($mytime1,$mytime2);

$mytime1 = "03:23:08";
$mytime2 = "03:22:54";
$cool = getMyTimeDiff($mytime1,$mytime2);
echo "ici<br>";
echo $cool;
echo "<br>";
// strtotime

$t1 = strtotime('2011-07-24 15:27:24');
$t2 = strtotime('2011-07-24 15:28:26');

$delta_T = ($t2 - $t1);

$days = round(($delta_T % 604800) / 86400, 2); 
$hours = round((($delta_T % 604800) % 86400) / 3600, 2); 
$minutes = round(((($delta_T % 604800) % 86400) % 3600) / 60, 2); 
$seconds = round((((($delta_T % 604800) % 86400) % 3600) % 60), 2);

echo $delta_T ;

echo "<br>up";
echo $days.'days '.$hours.'h '.$minutes.'m '.$seconds.'s ' ;

echo "<br>";
// My take on a function to find the differences between a timestamp and current time.
// Format: findTime($sometime['stamp'], '%d Days, %h Hours, %m Minutes');
// Always use plural it will auto correct on singular results.  You don't have to include all %d,%m,%h you may include only one.  To get Total Hours remaining(including days) use %ho.  To get Total Minutes remaining(including hours and days) use %mo.  Take a look at the format I assumed to make any changes.

function findTime($timestamp, $format) {
			$timestamp = '12:27:24';
        $difference = $timestamp - time();
        if($difference < 0)
            return false;
        else{
       
            $min_only = intval(floor($difference / 60));
            $hour_only = intval(floor($difference / 3600));
           
            $days = intval(floor($difference / 86400));
            $difference = $difference % 86400;
            $hours = intval(floor($difference / 3600));
            $difference = $difference % 3600;
            $minutes = intval(floor($difference / 60));
            if($minutes == 60){
                $hours = $hours+1;
                $minutes = 0;
            }
           
            if($days == 0){
                $format = str_replace('Days', '?', $format);
                $format = str_replace('Ds', '?', $format);
                $format = str_replace('%d', '', $format);
            }
            if($hours == 0){
                $format = str_replace('Hours', '?', $format);
                $format = str_replace('Hs', '?', $format);
                $format = str_replace('%h', '', $format);
            }
            if($minutes == 0){
                $format = str_replace('Minutes', '?', $format);
                $format = str_replace('Mins', '?', $format);
                $format = str_replace('Ms', '?', $format);       
                $format = str_replace('%m', '', $format);
            }
           
            $format = str_replace('?,', '', $format);
            $format = str_replace('?:', '', $format);
            $format = str_replace('?', '', $format);
           
            $timeLeft = str_replace('%d', number_format($days), $format);       
            $timeLeft = str_replace('%ho', number_format($hour_only), $timeLeft);
            $timeLeft = str_replace('%mo', number_format($min_only), $timeLeft);
            $timeLeft = str_replace('%h', number_format($hours), $timeLeft);
            $timeLeft = str_replace('%m', number_format($minutes), $timeLeft);
               
            if($days == 1){
                $timeLeft = str_replace('Days', 'Day', $timeLeft);
                $timeLeft = str_replace('Ds', 'D', $timeLeft);
            }
            if($hours == 1 || $hour_only == 1){
                $timeLeft = str_replace('Hours', 'Hour', $timeLeft);
                $timeLeft = str_replace('Hs', 'H', $timeLeft);
            }
            if($minutes == 1 || $min_only == 1){
                $timeLeft = str_replace('Minutes', 'Minute', $timeLeft);
                $timeLeft = str_replace('Mins', 'Min', $timeLeft);
                $timeLeft = str_replace('Ms', 'M', $timeLeft);           
            }
               
          return $timeLeft;
        }
    }
echo "<br>";
// To accurately calculate the difference between the current time and a time in the future I use the following.

function time_difference($endtime){
    $days= (date("j",$endtime)-1);
    $months =(date("n",$endtime)-1);
    $years =(date("Y",$endtime)-1970);
    $hours =date("G",$endtime);
    $mins =date("i",$endtime);
    $secs =date("s",$endtime);
    $diff="'day': ".$days.",'month': ".$months.",'year': ".$years.",'hour': ".$hours.",'min': ".$mins.",'sec': ".$secs;
    return $diff;
}   
$end_time = $future_date - time();
$difference = time_difference($end_time);
echo $difference;
echo "<br>";
//sample output
// 'day': 2,'month': 1,'year': 0,'hour': 2,'min': 05,'sec': 41

// The documentation should have this info. The function time() returns always timestamp that is timezone independent (=UTC).

date_default_timezone_set("UTC");
echo "UTC:".time();
echo "<br>";

date_default_timezone_set("Africa/Nairobi");
echo "Africa/Nairobi:".time();
echo "<br>";
?>