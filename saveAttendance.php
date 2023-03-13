
<?php
    require_once 'core/init.php'; 
    if (Input::exists()) {
		$attendance = new Attendance();

        $am_login = Input::get('am_login');
        $am_logout = Input::get('am_logout');
        $pm_login = Input::get('pm_login');
		$pm_logout = Input::get('pm_logout');
		$employee_id = Input::get('employee_id');
		$attendance_date = Input::get('attendance_date');
        
		try {
            $attendance->create(array(
                'employee_id' => $employee_id,
                'am_in' => $am_login,
				'am_out' => $am_logout,
				'pm_in' => $pm_login,
				'pm_out' => $pm_logout,
				'status_am' => 'NOT LATE',
				'status_pm' => 'NOT LATE',
				'mins_late' => '',
				'attendance_date' => $attendance_date,
            ));

			echo json_encode(['success' => true]);

        } catch(Exception $e) {
            echo json_encode($error);
        }
        
    }
    
?>