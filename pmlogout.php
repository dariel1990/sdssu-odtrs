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
			if($hour>=17 && $hour<=22){
				$log_am=strtotime("5:00 PM");
				$login_am=strtotime($time);
				
				$employee_id = strval($_GET['employee_id']);
				$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$employee_id."' AND attendance_date = '".$date."'");	$attendancecount = DB:: getInstance()->count($attendance);
				if ($attendancecount==0){
					Session::flash('LogoutError', 'amLogin');
					if(!$user->isAdmin()){
						Redirect::to('index.php');
					}else{
						Redirect::to('index.php?action=attendance');
					}
				}else{
					foreach($attendance->results() as $attendance){
						if($attendance->pm_out === ''){
							if($attendance->am_in <> '' && $attendance->pm_in === ''){
								Session::flash('LogoutPmError', 'amLogin');
								if(!$user->isAdmin()){
									Redirect::to('index.php');
								}else{
									Redirect::to('index.php?action=attendance');
								}
							}else{
								$newAttendance = new Attendance();
								try {
									$newAttendance->update(array(
										'pm_out' => $time,
									), $attendance->id);
									
								Session::flash('Logout', 'pmLogin');
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
			}else{
				Session::flash('LogoutAmError', 'amLogin');
				if(!$user->isAdmin()){
					Redirect::to('index.php');
				}else{
					Redirect::to('index.php?action=attendance');
				}
			}
		//}
	}
ob_end_flush();