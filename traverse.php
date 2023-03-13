<?php
require 'core/init.php';
	
function getAttendanceofEmployeesUnderDepartmentof($department_id){
	$child_departments = DB:: getInstance()->query("SELECT * FROM department  WHERE parent_id = $department_id");
	$child_departmentscount = DB:: getInstance()->count($child_departments);
	$child_dep = '';
	if ($child_departmentscount > 0){
		foreach ($child_departments->results() as $department) {
			
			$emp_department = DB:: getInstance()->query("SELECT * FROM emp_department WHERE department_id = '$department->id'");
			foreach ($emp_department->results() as $emp_department) {
				$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$emp_department->employee_id."'");
				foreach ($attendance->results() as $attendance) {
					$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$emp_department->employee_id."'");
					foreach ($employee->results() as $employee) {
						$child_dep .= $employee->fname.'-'.$attendance->am_in.'-'.$attendance->attendance_date.'<br>';
					}
				}
			}
			$child_dep .= getAttendanceofEmployeesUnderDepartmentof($department->id);
			
		}
	}
    
	return $child_dep;
    //return $child_departments;
}


echo getAttendanceofEmployeesUnderDepartmentof(6);