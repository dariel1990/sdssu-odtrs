<?php
$mydate = 'September 2020';
	$selmonth = date("m",strtotime($mydate));
	$selyear = date("Y",strtotime($mydate));
	$end_day = cal_days_in_month(CAL_GREGORIAN, $selmonth, $selyear);
 echo $selmonth.' '.$selyear.' '.$end_day;