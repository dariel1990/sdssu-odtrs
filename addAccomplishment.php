<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current
if (Input::exists()) {
			$newaccom = new Accomplishment();
			try {
				$newaccom->create(array(
					'employee_id' => Input::get('employee_id'),
					'target' => Input::get('target'),
					'accomplishment' => Input::get('accomplishment'),
					'accomplished_date' => Input::get('accom_date'),
					'remarks' => Input::get('remarks'),
				));
					
				Session::flash('Added', 'Added');
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