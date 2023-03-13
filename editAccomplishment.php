<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current
if (Input::exists()) {
	$newaccom = new Accomplishment();

    try {
		$newaccom->update(array(
			'target' => Input::get('target'),
			'accomplishment' => Input::get('accomplishment'),
			'remarks' => Input::get('remarks'),
        ), Input::get('accom_id'));
				
		Session::flash('Updated', 'Updated');
		if(!$user->isAdmin()){
			Redirect::to('index.php');
		}else{
			Redirect::to('index.php?action=attendance');
		}
    } catch(Exception $e) {
		echo $error, '<br>';
    }
}
ob_end_flush();