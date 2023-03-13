<?php
ob_start();
require_once 'core/init.php';
$user = new UserLogin(); //Current
if (Input::exists()) {
	if($user->isSuperAdmin() && $user->isAdmin()) {
		$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE id = '".Input::get('user_id')."'");		
		foreach($userlogin->results() as $userlogin){
			$newuser = new UserLogin();

            try {
				$newuser->update(array(
					'username' => Input::get('username'),
                ), $userlogin->id);
				
			Session::flash('UsernameUpdated', 'Usernameupdated');
			Redirect::to('index.php?action=settings');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}
	}
	if(!$user->isAdmin()) {
		$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE id = '".Input::get('user_id')."'");		
		foreach($userlogin->results() as $userlogin){
			$newuser = new UserLogin();

            try {
				$newuser->update(array(
					'username' => Input::get('username'),
                ), $userlogin->id);
				
			Session::flash('UsernameUpdated', 'Usernameupdated');
			Redirect::to('index.php?action=settings');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
		}
	}else{	
		if (!$user->isSuperAdmin()){
			$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE id = '".Input::get('user_id')."'");		
			foreach($userlogin->results() as $userlogin){
				$newuser = new UserLogin();

				try {
					$newuser->update(array(
						'username' => Input::get('username'),
					), $userlogin->id);
					
				Session::flash('UsernameUpdated', 'Usernameupdated');
				Redirect::to('index.php?action=settings');
				} catch(Exception $e) {
					echo $error, '<br>';
				}
			}
		}
	}
}	
ob_end_flush();