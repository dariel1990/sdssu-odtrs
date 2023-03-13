
<?php
    require_once 'core/init.php'; 
    if (Input::exists()) {
		$attendance = new Attendance();

        $attend_id = Input::get('attend_id');
        $am_login = (Input::get('am_login') == '----') ? '' : Input::get('am_login');
        $am_logout = (Input::get('am_logout') == '----') ? '' : Input::get('am_logout');
        $pm_login = (Input::get('pm_login') == '----') ? '' : Input::get('pm_login');
		$pm_logout = (Input::get('pm_logout') == '----') ? '' : Input::get('pm_logout');

		try {
            $attendance->update(array(
                'am_in' => $am_login,
				'am_out' => $am_logout,
				'pm_in' => $pm_login,
				'pm_out' => $pm_logout,
            ), $attend_id);

            echo json_encode(['success' => true]);
        } catch(Exception $e) {
            echo json_encode($error);
        }
        
    }
    
?>