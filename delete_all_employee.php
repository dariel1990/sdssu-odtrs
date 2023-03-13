<?php
	ob_start();
	require_once 'core/init.php';
		$employee = DB:: getInstance()->query("DELETE FROM employee");
		$employee = DB:: getInstance()->query("SELECT * FROM employee");		
		foreach($employee->results() as $employee){
			$userlogin = DB:: getInstance()->query("CREATE TRIGGER after_employee_delete
												AFTER DELETE
												   ON employee FOR EACH ROW
												BEGIN
													DELETE FROM userlogin WHERE employee_id ='".$employee->employee_id."'
												END;");
		}
		Session::flash('Deleted', 'All Record has been successfully deleted.');
		Redirect::to('index.php?action=listEmployees');
	ob_end_flush();