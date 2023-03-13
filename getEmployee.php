
<?php
    require_once 'core/init.php'; 
    if (Input::exists()) {
        $employeeID = Input::get('employeeID');
        $attend_month = Input::get('month');
        $attend_year = Input::get('year');
        $attend_date = $attend_month." ".$attend_year;
        $range = date("Y-m-d",strtotime($attend_date));

        $employee = DB::getInstance()->query("SELECT * FROM employee WHERE employee_id='".$employeeID."'");
        foreach($employee->results() as $emp){
            $employee_fullname = $emp->lname.", ".$emp->fname." ".$emp->mname;
            $employee_id = $emp->employee_id;
        }
        $mday = DB::getInstance()->query("SELECT DAY(cal.my_date) date_field,
					COALESCE(a.am_in, '') login_am,
					COALESCE(a.am_out, '') logout_am,
					COALESCE(a.pm_in, '') login_pm,
					COALESCE(a.pm_out, '') logout_pm,
					a.employee_id emp_id,
					a.id attend_id
				FROM 
					(SELECT 
						s.start_date + INTERVAL (days.d) DAY my_date
					FROM
						(SELECT LAST_DAY('$range') + INTERVAL 1 DAY - INTERVAL 1 MONTH start_date,
								LAST_DAY('$range') end_date
						) s
						JOIN days
							ON days.d <= DATEDIFF(s.end_date, s.start_date)
					) cal
					LEFT JOIN attendance a
					ON a.attendance_date = cal.my_date AND a.employee_id = '".$employeeID."'
					ORDER BY cal.my_date ASC;
					");

        echo json_encode(['employee_name' => $employee_fullname, 'employee_id' => $employee_id, 'mydays' => $mday->results()]);
        
    }
    
?>