<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current
if (Input::exists()) {
	if($user->isSuperAdmin() && $user->isAdmin()) {
		$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE id = '".Input::get('user_id')."'");		
		foreach($userlogin->results() as $userlogin){
			$newuser = new UserLogin();

            try {
				$newuser->update(array(
					'username' => Input::get('username'),
                ), $userlogin->id);
				
			Session::flash('UsernameUpdated', 'Usernameupdated');
			Redirect::to('index.php?action=settings');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}
	}
	if(!$user->isAdmin()) {
		$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".Input::get('employee_id')."'");		
		foreach($employee->results() as $employee){
			$newemployee = new Employee();

            try {
				$newemployee->update(array(
					'fname' => Input::get('fname'),
					'mname' => Input::get('mname'),
					'lname' => Input::get('lname'),
                ), $employee->id);
				
			Session::flash('UserInfoUpdated', 'UserInfoUpdated');
			Redirect::to('index.php?action=settings');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}
	}else{	
		if (!$user->isSuperAdmin()){
			$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".Input::get('employee_id')."'");		
			foreach($employee->results() as $employee){
				$newemployee = new Employee();

				try {
					$newemployee->update(array(
						'fname' => Input::get('fname'),
						'mname' => Input::get('mname'),
						'lname' => Input::get('lname'),
					), $employee->id);
					
				Session::flash('UserInfoUpdated', 'UserInfoUpdated');
				Redirect::to('index.php?action=settings');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
			}
		}
	}
}	
ob_end_flush();