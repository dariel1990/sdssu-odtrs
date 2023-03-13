<?php 
require 'core/init.php';

// Perform query
$mday = DB:: getInstance()->query("
			SELECT 	cal.my_date date_field,
					COALESCE(a.am_in, 0) login_am,
					a.employee_id emp_id
			FROM 
				(SELECT 
					s.start_date + INTERVAL (days.d) DAY my_date
				FROM
					(SELECT LAST_DAY(CURRENT_DATE) + INTERVAL 1 DAY - INTERVAL 1 MONTH start_date,
							LAST_DAY(CURRENT_DATE) end_date
					) s
					JOIN days
						ON days.d <= DATEDIFF(s.end_date, s.start_date)
				) cal
				LEFT JOIN attendance a
					ON a.attendance_date = cal.my_date AND a.employee_id = 'FA-002'
					ORDER BY cal.my_date ASC;
			");
foreach($mday->results() as $mday){
	echo $mday->date_field." - ".$mday->login_am."<br>";
}
?>