<?php

$connect = new PDO("mysql:host=localhost;dbname=dtr", "root", "");

date_default_timezone_set('Asia/Manila');
    $time = date("h:i A");
    //$time = "04:00 PM";
    $hour = date("H");
    //$hour = 16;
    $min = date("i");
    //$min = 00;
    $date = date("Y-m-d");
    $year_m = date("Y-m");
	
	$str_date = strval($date);
	$column = array('ID Number','Employee Name', 'AM - Login', 'AM - Logout', 'PM - Login', 'PM - Logout');

$query = "
SELECT * FROM attendance 
";

if(isset($_POST['attendance_date']) && $_POST['attendance_date'] === '')
{
	$query .= '
	WHERE attendance_date = "'.$str_date.'" 
	';
	 
}else{
	$query .= '
	WHERE attendance_date = "'.$_POST['attendance_date'].'" 
	';
}

$query .= 'ORDER BY am_in ASC';

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$number_filter_row = $statement->rowCount();

$statement = $connect->prepare($query . $query1);

$statement->execute();

$result = $statement->fetchAll();


$query = "
SELECT * FROM attendance 
";

$data = array();

foreach($result as $row){
	$employee_id = $row['employee_id'];
	$am_in = $row['am_in'];
	$am_out = $row['am_out'];
	$pm_in = $row['pm_in'];
	$pm_out = $row['pm_out'];
		$employee = "SELECT * FROM employee WHERE employee_id = '".$employee_id."'";
		$employeestatement = $connect->prepare($employee);
		$employeestatement->execute();
		$employeeresult = $employeestatement->fetchAll();
		foreach($employeeresult as $employeeresult){
			$userlogin = "SELECT * FROM userlogin WHERE employee_id = '".$employee_id."' AND permission IN (2,3,5)";
			$userloginstatement = $connect->prepare($userlogin);
			$userloginstatement->execute();
			$userloginresult = $userloginstatement->fetchAll();
			foreach($userloginresult as $userloginresult){
				$sub_array = array();
				$sub_array[] = $employee_id;
				$sub_array[] = $employeeresult['fname'].' '.substr($employeeresult['mname'], 0, 1).'. '.$employeeresult['lname'].' '.$employeeresult['suffix'];
				$sub_array[] = $am_in;
				$sub_array[] = $am_out;
				$sub_array[] = $pm_in;
				$sub_array[] = $pm_out;
				$data[] = $sub_array;
			}
		}
}

function count_all_data($connect)
{
 $query = "SELECT * FROM attendance";
 $statement = $connect->prepare($query);
 $statement->execute();
 return $statement->rowCount();
}

$output = array(
 "draw"       =>  intval($_POST["draw"]),
 "recordsTotal"   =>  count_all_data($connect),
 "recordsFiltered"  =>  $number_filter_row,
 "data"       =>  $data
);

echo json_encode($output);

?>