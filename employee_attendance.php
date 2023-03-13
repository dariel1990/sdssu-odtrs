<?php
require 'core/init.php';
date_default_timezone_set('Asia/Manila');
    $time = date("h:i A");
    //$time = "04:00 PM";
    $hour = date("H");
    //$hour = 16;
    $min = date("i");
    //$min = 00;
    $date = date("Y-m-d");
    $year_m = date("Y-m");
	
	$str_date = strval($date);
	$emp_id = $_POST['emp_id'];
	$output = '<div class="rTable">
				<div class="rTableRow">
					<div class="rTableHead" style="width :5%">
						<strong>Day</strong>
					</div>
					<div class="rTableHead" style="width :15%">
						<strong>AM-IN</strong>
					</div>
					<div class="rTableHead" style="width :15%">
						<strong>AM-OUT</strong>
					</div>
					<div class="rTableHead" style="width :15%">
						<strong>PM-IN</strong>
					</div>
					<div class="rTableHead" style="width :15%">
						<strong>PM-OUT</strong>
					</div>
					<div class="rTableHead" style="width :5%">
						<strong>MIN</strong>
					</div>
					<div class="rTableHead" style="width :30%">
						<strong>REMARKS</strong>
					</div>
				</div>';
		
	$attendance = DB:: getInstance()->query("SELECT DAY(attendance_date) as daynum,DAYNAME(attendance_date) as dayname, am_in, am_out, pm_in, pm_out, mins_late FROM attendance WHERE employee_id='".$emp_id."'");
	foreach($attendance->results() as $attendance){
		$day = 0;
		for($i = 1; $i<=31; $i++) {
		$day = $day + 1;
			$output .= '<div class="rTableRow">
							<div class="rTableCell">';
								echo $day;
			$output .= '	</div>
							<div class="rTableCell">';
								if($day == $attendance->daynum){echo $attendance->am_in;}
			$output .= '	</div>
							<div class="rTableCell">';
								if($day == $attendance->daynum){echo $attendance->am_out;}
			$output .= '	</div>
							<div class="rTableCell">';
								if($day == $attendance->daynum){echo $attendance->pm_in;}
			$output .= '	</div>
							<div class="rTableCell">';
								if($day == $attendance->daynum){echo $attendance->pm_out;}
			$output .= '	</div>
							<div class="rTableCell">';
								if($day == $attendance->daynum){echo $attendance->mins_late;}
			$output .= '	</div>
							<div class="rTableCell">
							
							</div>
						</div>';
		}
	}
			$output .= '</div>';
		
	echo $output;
?>