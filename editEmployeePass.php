<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current

$uid = intval($_GET['uid']);
	if($user->isSuperAdmin() && $user->isAdmin()) {
		$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin WHERE id = '$uid'");		
		foreach($userlogin->results() as $userlogin){
			$newuser = new UserLogin();

            try {
				$newuser->update(array(
					'password' => Hash::make($userlogin->username),
                ), $userlogin->id);
				
			Session::flash('passwordChanged', 'passwordChanged');
			Redirect::to('index.php?action=listEmployees');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}
	}
ob_end_flush();