<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
		$employee_id = Input::get('employee_id');
		$fname = Input::get('fname');
		$mname = Input::get('mname');
		$lname = Input::get('lname');
		$gender = Input::get('gender');
		$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE fname = '".$fname."' and mname = '".$mname."' and lname = '".$lname."'");		
		$employeecount = DB:: getInstance()->count($employee);
		$dupid = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$employee_id."'");		
		$dupidcount = DB:: getInstance()->count($dupid);
		if ($dupidcount==0){
			if ($employeecount==0){
				$newemployee = new Employee();
				$newuser = new UserLogin();
				$newempdepartment = new Empdepartment();
				
				$avatar = '';
				
				if ($gender === 'male') { $avatar = 'male.png';}
				if ($gender === 'female') { $avatar = 'female.png';}
				try {
					$newemployee->create(array(
						'employee_id' => Input::get('employee_id'),
						'fname' => Input::get('fname'),
						'mname' => Input::get('mname'),
						'lname' => Input::get('lname'),
						'suffix' => Input::get('suffix'),
						'gender' => Input::get('gender')
					));
					
					$newuser->create(array(
						'permission' => Input::get('permission'),
						'employee_id' => Input::get('employee_id'),
						'username' => str_replace(' ', '', strtolower(Input::get('fname'))),
						'password' => Hash::make(str_replace(' ', '', strtolower(Input::get('fname')))),
						'avatar' => $avatar,
						'joined' => date('Y-m-d H:i:s')
					));
					
					$newempdepartment->create(array(
						'department_id' => Input::get('department'),
						'employee_id' => Input::get('employee_id'),
						'group_id' => Input::get('permission'),
						'position' => Input::get('position')
					));
					
					Session::flash('Added', 'Added.');
					Redirect::to('index.php?action=listEmployees');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
				
			}else{
				Session::flash('Duplicated', 'Duplicated Entry.');
				Redirect::to('index.php?action=listEmployees');
			}
		}else{
			Session::flash('Duplicated_id', 'Duplicated_id');
			Redirect::to('index.php?action=listEmployees');
		}
}
ob_end_flush();