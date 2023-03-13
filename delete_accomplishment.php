<?php
	require 'core/init.php';
	$user = new UserLogin(); //Current
	
	$id = $_GET['id'];
	$accomplishment = DB:: getInstance()->delete('accomplishment', array('id','=',$id));
	Session::flash('Deleted', 'Record has been successfully deleted.');
	if(!$user->isAdmin()){
		Redirect::to('index.php');
	}else{
		Redirect::to('index.php?action=attendance');
	}
?>