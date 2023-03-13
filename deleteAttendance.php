
<?php
    require_once 'core/init.php'; 
    if (Input::exists()) {
		$attend_id = Input::get('attend_id');
        $attendance = DB:: getInstance()->delete('attendance', array('id','=',$attend_id));
        echo json_encode(['success' => true]);
        
    }
    
?>