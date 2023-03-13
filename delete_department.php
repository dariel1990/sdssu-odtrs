<?php
	require 'core/init.php';
	
	$department_id = strval($_GET['id']);
	$department = DB:: getInstance()->delete('department', array('id','=',$department_id));
	
	Session::flash('Deleted', 'Record has been successfully deleted.');
	Redirect::to('index.php?action=listDepartments');
?>