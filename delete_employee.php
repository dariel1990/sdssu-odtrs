<?php
	require 'core/init.php';
	
	$employee_id = strval($_GET['id']);
	$employee = DB:: getInstance()->delete('employee', array('employee_id','=',$employee_id));
	$userlogin = DB:: getInstance()->delete('userlogin', array('employee_id','=',$employee_id));
	$emp_department = DB:: getInstance()->delete('emp_department', array('employee_id','=',$employee_id));
	Session::flash('Deleted', 'Record has been successfully deleted.');
	Redirect::to('index.php?action=listEmployees');
?>