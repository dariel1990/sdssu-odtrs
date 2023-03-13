<?php
ob_start();
require_once 'core/init.php';

$dataArray = array();
$attendances = DB:: getInstance()->query("SELECT * FROM attendance ORDER BY attendance_date DESC ");		
foreach($attendances->results() as $attendance){
    $employees = DB:: getInstance()->query("SELECT * FROM employee  WHERE employee_id = '".$attendance->employee_id."'");		
    foreach($employees->results() as $employee){
        
        
        $dataArray[] = $employee->employee_id;
        $dataArray[] = $employee->lname;
        $dataArray[] = $attendances->am_in;

    }
}   

echo json_encode($dataArray);

?>