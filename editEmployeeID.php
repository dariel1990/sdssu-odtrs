<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$emp_id = intval(Input::get('emp_id'));
	$new_empid = Input::get('employee_id');
	$old_empid = Input::get('old_empid');
	
	if ($new_empid == $old_empid) {
		Redirect::to('index.php?action=listEmployees');
	}else{
		$dupid = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$new_empid."'");		
		$dupidcount = DB:: getInstance()->count($dupid);
		if ($dupidcount==0){
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
										$newattendance = new Attendance();
										$newaccom = new Accomplishment();
										
										try {
											$newemployee->update(array(
												'employee_id' => Input::get('employee_id'),
											), $employee->id);
											
											$newuser->update(array(
												'employee_id' => Input::get('employee_id'),
											), $userlogin->id);
											
											$newempdepartment->update(array(
													'employee_id' => Input::get('employee_id'),
											), $emp_department->id);
											
											$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$old_empid."'");		
											foreach($attendance->results() as $attendance){
												$newattendance->update(array(
														'employee_id' => Input::get('employee_id'),
												), $attendance->id);
											}
											
											$accomplishment = DB:: getInstance()->query("SELECT * FROM accomplishment WHERE employee_id = '".$employee->employee_id."'");		
											foreach($accomplishment->results() as $accomplishment){
												$newaccom->update(array(
														'employee_id' => Input::get('employee_id'),
												), $accomplishment->id);
											}
											
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
		}else{
			Session::flash('Duplicated_id', 'Duplicated_id');
			Redirect::to('index.php?action=listEmployees');
		}
	}
		
}
ob_end_flush();