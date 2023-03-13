<?php
ob_start();
require_once 'core/init.php';
if (Input::exists()) {
		$dname = Input::get('dname');
		$parent_id = Input::get('parent_id');
		$department = DB:: getInstance()->query("SELECT * FROM department WHERE name = '".$dname."' AND parent_id = '$parent_id'");		
		$departmentcount = DB:: getInstance()->count($department);
			
		if ($departmentcount==0){
            $newdepartment = new Department();

            try {
                $newdepartment->create(array(
					'parent_id' => Input::get('parent_id'),
					'name' => Input::get('dname'),
                ));
				
				
			Session::flash('Added', 'Added');
			Redirect::to('index.php?action=listDepartments');
            } catch(Exception $e) {
                echo $error, '<br>';
            }
			
		}else{
			Session::flash('Duplicated', 'Duplicated Entry.');
			Redirect::to('index.php?action=listDepartments');
		}
}
ob_end_flush();