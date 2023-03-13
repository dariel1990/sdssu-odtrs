<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
		$emp_id = intval(Input::get('emp_id'));
		$gender = Input::get('gender');
		$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE id = '$emp_id'");		
		foreach($employee->results() as $employee){
			$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE employee_id = '".$employee->employee_id."'");		
			foreach($userlogin->results() as $userlogin){
				$emp_department = DB:: getInstance()->query("SELECT * FROM emp_department WHERE employee_id = '".$employee->employee_id."'");		
				foreach($emp_department->results() as $emp_department){
					$group = DB:: getInstance()->query("SELECT * FROM groups WHERE id = '$emp_department->group_id'");		
					foreach($group->results() as $group){
						$department = DB:: getInstance()->query("SELECT * FROM department WHERE id = '$emp_department->department_id'");		
						foreach($department->results() as $department){
							
							$newemployee = new Employee();
							$newuser = new UserLogin();
							$newempdepartment = new Empdepartment();
							
							if ($gender === 'male') { $avatar = 'male.png';}
							if ($gender === 'female') { $avatar = 'female.png';}
							
							try {
								$newemployee->update(array(
									'fname' => Input::get('fname'),
									'mname' => Input::get('mname'),
									'lname' => Input::get('lname'),
									'suffix' => Input::get('suffix'),
									'gender' => Input::get('gender'),
								), $employee->id);
								
								$newuser->update(array(
									'username' => Input::get('username'),
									'permission' => Input::get('permission'),
									'avatar' => $avatar,
								), $userlogin->id);
								
								$newempdepartment->update(array(
									'department_id' => Input::get('department'),
									'group_id' => Input::get('permission'),
									'position' => Input::get('position'),
								), $emp_department->id);
								
							Session::flash('Updated', 'Employee Information has been Updated.');
							Redirect::to('index.php?action=listEmployees');
							} catch(Exception $e) {
								echo $error, '<br>';
							}
						}
					}
				}
			}
		}
}
ob_end_flush();