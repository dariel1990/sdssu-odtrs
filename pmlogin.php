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
			if($hour>=12 && $hour<=22){
				$log_am=strtotime("1:00 PM");
				$login_am=strtotime($time);

				$min=($login_am-$log_am)/60;
				$minval = intval($min);
				
				$employee_id = strval($_GET['employee_id']);
				$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$employee_id."' AND attendance_date = '".$date."'");	$attendancecount = DB:: getInstance()->count($attendance);
				if ($attendancecount==0){
					
					$newAttendance = new Attendance();
					if($minval > 0){
						try {
							$newAttendance->create(array(
								'employee_id' => $employee_id,
								'am_in' => '',
								'am_out' => '',
								'pm_in' => $time,
								'pm_out' => '',
								'status_am' => '',
								'status_pm' => 'LATE',
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
								'am_in' => '',
								'am_out' => '',
								'pm_in' => $time,
								'pm_out' => '',
								'status_am' => '',
								'status_pm' => 'NOT LATE',
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
					foreach($attendance->results() as $attendance){
						if($attendance->pm_in === ''){
							$totalmin= intval($min) + intval($attendance->mins_late);
							$newAttendance = new Attendance();
							if($attendance->am_in <> '' && $attendance->am_out === ''){
								Session::flash('LoginPmError', 'amLogin');
								if(!$user->isAdmin()){
									Redirect::to('index.php');
								}else{
									Redirect::to('index.php?action=attendance');
								}
							}else{
								if($minval > 0){	
									try {
										$newAttendance->update(array(
											'pm_in' => $time,
											'mins_late' => $totalmin,
											'status_pm' => 'LATE',
										), $attendance->id);
										
									Session::flash('Login', 'pmLogin');
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
										$newAttendance->update(array(
											'pm_in' => $time,
											'mins_late' => '',
											'status_pm' => 'NOT LATE',
										), $attendance->id);
										
									Session::flash('Login', 'pmLogin');
										if(!$user->isAdmin()){
											Redirect::to('index.php');
										}else{
											Redirect::to('index.php?action=attendance');
										}
									} catch(Exception $e) {
										echo $error, '<br>';
									}
								}
							}
						}
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