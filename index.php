<?php
	date_default_timezone_set('Asia/Manila');
    $time = date("h:i A");
    //$time = "04:00 PM";
    $hour = date("H");
    //$hour = 16;
    $min = date("i");
    //$min = 00;
    $date = date("Y-m-d");
	$month = date("F");
    $year_m = date("Y-m");
	
require 'core/init.php';
$user = new UserLogin(); //Current

if(!$user->isLoggedIn()) {
    Redirect::to('login.php');
}else{
	if($user->isSuperAdmin() && $user->isAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		switch ( $action ) {
			case 'settings':	
				require('admin/settings.php');
			break;
			case 'listEmployees':	
				require('admin/listEmployees.php');
			break;
			case 'listDepartments':	
				require('admin/listDepartments.php');
			break;
			case 'listAttendance':	
				require('admin/listAttendance.php');
			break;
			
			default:
				require('admin/dashboard.php');
		}
	}
	
	if(!$user->isAdmin()) {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
		
		switch ( $action ) {
			case 'settings':	
				require('user/settings.php');
			break;
			
			default:
				require('user/dashboard.php');
		}
	}else{
		if (!$user->isSuperAdmin()){
			$action = isset( $_GET['action'] ) ? $_GET['action'] : "";
				
				switch ( $action ) {
					case 'settings':	
						require('admin/settings.php');
					break;
					case 'listEmployees':	
						require('admin/listEmployees.php');
					break;
					case 'attendance':	
						require('admin/attendance.php');
					break;
					
					default:
					require('admin/dashboard.php');
				}
		}				
	}
			
}
?>