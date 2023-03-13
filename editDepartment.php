<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
	$newdep = new Department();

    try {
		$newdep->update(array(
			'parent_id' => Input::get('parent_id'),
			'name' => Input::get('dname'),
        ), Input::get('dep_id'));
				
		Session::flash('Updated', 'Updated');
		Redirect::to('index.php?action=listDepartments');
    } catch(Exception $e) {
		echo $error, '<br>';
    }
}
ob_end_flush();