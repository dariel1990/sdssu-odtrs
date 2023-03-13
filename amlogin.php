<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

	date_default_timezone_set('Asia/Manila');
    $time = date("h:i A");
    //$time = "04:00 PM";
    $hour = date("H");
    //$hour = 16;
    $min = date("i");
    //$min = 00;
    $date = date("Y-m-d");
    $year_m = date("Y-m");
	
	if(isset($_GET['employee_id'])){
		/*if(date('D') == 'Sat' || date('D') == 'Sun'){
			Session::flash('Weekend', 'Weekend');
			if(!$user->isAdmin()){
				Redirect::to('index.php');
			}else{
				Redirect::to('index.php?action=attendance');
			}
		}else{*/
			if($hour>=6 && $hour<=11){
				$log_am=strtotime("8:00 AM");
				$login_am=strtotime($time);

				$min=($login_am-$log_am)/60;
				$minval = intval($min);
				
				$employee_id = strval($_GET['employee_id']);
				$newAttendance = new Attendance();
				if($minval > 0){
					try {
						$newAttendance->create(array(
							'employee_id' => $employee_id,
							'am_in' => $time,
							'am_out' => '',
							'pm_in' => '',
							'pm_out' => '',
							'status_am' => 'LATE',
							'status_pm' => '',
							'mins_late' => $min,
							'attendance_date' => $date,
						));
							
						Session::flash('Login', 'amLogin');
							if(!$user->isAdmin()){
								Redirect::to('index.php');
							}else{
								Redirect::to('index.php?action=attendance');
							}
						} catch(Exception $e) {
							echo $error, '<br>';
						}
				}else{
					try {
						$newAttendance->create(array(
							'employee_id' => $employee_id,
							'am_in' => $time,
							'am_out' => '',
							'pm_in' => '',
							'pm_out' => '',
							'status_am' => 'NOT LATE',
							'status_pm' => '',
							'mins_late' => '',
							'attendance_date' => $date,
						));
							
						Session::flash('Login', 'amLogin');
							if(!$user->isAdmin()){
								Redirect::to('index.php');
							}else{
								Redirect::to('index.php?action=attendance');
							}
						} catch(Exception $e) {
							echo $error, '<br>';
						}
				}
			}else{
				Session::flash('LoginError', 'amLogin');
				if(!$user->isAdmin()){
					Redirect::to('index.php');
				}else{
					Redirect::to('index.php?action=attendance');
				}
			}
		//}
	}
ob_end_flush();