<?php
ob_start();
require_once 'core/init.php';

$user = new UserLogin(); //Current

if(Input::exists()) {
	$user = new UserLogin(); //Current
	$currentPass = Hash::make(Input::get('currentPassword'));
	if($user->data()->password === $currentPass) {
		$user->update(array(
			'password' => Hash::make(Input::get('newPassword')),
		));
		Session::flash('passwordChanged', 'passwordChanged');
		Redirect::to('index.php?action=settings');
	} else {
		Session::flash('wrongPassword', 'wrongPassword');
		Redirect::to('index.php?action=settings');
	}
}
	
ob_end_flush();