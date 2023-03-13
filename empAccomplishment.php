<?php
//index.php
	//include autoloader
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	
	//initialize dompdf class
	$document = new Dompdf();
// reference the Dompdf namespace
if(isset($_POST["emp_id"]) && isset($_POST["accom_date"]) && isset($_POST["verified_by"]) && isset($_POST["designation"])){
	
	$accom_date = $_POST["accom_date"];
	$verified_by = $_POST["verified_by"];
	$designation = $_POST["designation"];
	$range = date("Y-m-d",strtotime($accom_date));
	$month = date("F",strtotime($accom_date));
	$selmonth = date("m",strtotime($accom_date));
	$selyear = date("Y",strtotime($accom_date));
	$end_day = cal_days_in_month(CAL_GREGORIAN, $selmonth, $selyear);
	$employee_id = $_POST["emp_id"];
	$connect = mysqli_connect("localhost", "root", "", "dtr");

	$query = "SELECT * FROM employee WHERE employee_id = '".$employee_id."'";
	$result = mysqli_query($connect, $query);
		$output = '
				<style>
				* {
				  box-sizing: border-box;
				}
				
				p {
					font-family: Arial, Helvetica, sans-serif;
					font-size:12px;
				}
				p,h5 {
					font-family: Arial, Helvetica, sans-serif;
				}
				table{
					border-spacing: -1px;
				}
				table th {
				  border-collapse: collapse;
				  text-align: center;
				  font-family: Arial, Helvetica, sans-serif;
				  font-size:12px;
				}
				table td {
				  border-collapse: collapse;
				  font-family: Arial, Helvetica, sans-serif;
				  font-size:12px;
				}
				table.center {
				  margin-left: auto;
				  margin-right: auto;
				}
				</style>';
	while($row = mysqli_fetch_array($result)){
		$lastname = $row["lname"].'-'.str_replace(' ', '',$row["fname"]);
		$mday = "SELECT 	a.accomplished_date date_field,
					DAYNAME(a.accomplished_date) weekday,
					a.target target,
					a.accomplishment accomplishment,
					a.remarks remarks,
					a.employee_id emp_id
				FROM 
					accomplishment a
					WHERE MONTH(a.accomplished_date) = '".$selmonth."' AND YEAR(a.accomplished_date) = '".$selyear."' AND a.employee_id = '".$row["employee_id"]."'
					ORDER BY a.accomplished_date ASC;
					";
		$result1 = mysqli_query($connect, $mday);
		
			$output .= '
					<table width="100%" style="border: 0;">
						<tr>
							<td style="text-align: center;" width="30%">
								<img src="images/sdssulogo.png" width="120px" height="100px">
							</td>
							<td width="40%" style="text-align: center;">
									Republic of the Philippines<br>
									<strong style="font-size:13px;">SURIGAO DEL SUR STATE UNIVERSITY</strong><br>
									<strong>LIANGA CAMPUS</strong><br>
									Lianga, Surigao del Sur<br>
							</td>
							<td style="text-align: center;" width="30%" >
								<img src="images/isologo.jpg" width="120px" height="90px">
							</td>
						</tr>
					</table>
					<br>
					<p style="text-align: center;"> 
						<strong style="font-size:14px;">INDIVIDUAL MONTHLY ACCOMPLISHMENT REPORT</strong><br>
						For the Month of '.$month.' 01 to '.$end_day.', '.$selyear.'<br>
					</p>
					<br>
					<table width="30%" style="border: 0;">
						<tr>
							<td>Name of Employee:</td>
							<td><u><strong>'.strtoupper($row["fname"]).' '.strtoupper(substr($row["mname"], 0, 1)).'. '.strtoupper($row["lname"]).' '.$row["suffix"].'</strong></u></td>
						</tr>';
		$emp_department = "SELECT * FROM emp_department WHERE employee_id = '".$employee_id."'";
		$emp_departmentresult = mysqli_query($connect, $emp_department);	
		while($emp_dep = mysqli_fetch_array($emp_departmentresult)){
			$department = "SELECT * FROM department WHERE id = '".$emp_dep["department_id"]."'";
			$departmentresult = mysqli_query($connect, $department);	
			while($dep = mysqli_fetch_array($departmentresult)){
			$output .= '
						<tr>
							<td>Position:</td>
							<td><u>'.$emp_dep["position"].'</u></td>
						</tr>
						<tr>
							<td>Office/Department:</td>
							<td><u>'.$dep["name"].'</u></td>
						</tr>
						 ';
			}
		}	
			$output .= '</table><br>
					<table style="border: 1px solid #999999;" width="100%" class="center">
						<tr>
							<th style="border: 1px solid #999999;" width="10%">Date</th>
							<th style="border: 1px solid #999999;" width="10%">Day</th>
							<th style="border: 1px solid #999999;" width="25%">Target</th>
							<th style="border: 1px solid #999999;" width="35%">Accomplishment</th>
							<th style="border: 1px solid #999999;" width="20%">REMARKS</th>
						</tr>
					';
		while($row1 = mysqli_fetch_array($result1)){
			$output .='	
						<tr>
							<td style="text-align: center; border: 1px solid #999999;">'.$row1["date_field"].'</td>
							<td style="text-align: center; border: 1px solid #999999;">'.$row1["weekday"].'</td>
							<td style="text-align: center; border: 1px solid #999999;">'.$row1["target"].'</td>
							<td style="text-align: center; border: 1px solid #999999;">'.$row1["accomplishment"].'</td>
							<td style="text-align: center; border: 1px solid #999999;">'.$row1["remarks"].'</td>
						</tr>';
		}
			$output .='	</table>
					<br><br>
					<table width="100%">
						<tr>
							<td style="text-align: left;" width="25%">
								Prepared by:
							</td>
							<td width="50%">
									
							</td>
							<td style="text-align: left;" width="25%" >
								Verified by:
							</td>
						</tr>
					</table><br>
					<table  width="100%">
						<tr>
							<td style="text-align: center;" width="25%">
								<u><strong>'.strtoupper($row["fname"]).' '.strtoupper(substr($row["mname"], 0, 1)).'. '.strtoupper($row["lname"]).' '.$row["suffix"].'</strong></u>
							</td>
							<td width="50%">
									
							</td>
							<td style="text-align: center;" width="25%" >
								<u><strong>'.$verified_by.'</strong></u>
							</td>
						</tr>
						<tr>
							<td style="text-align: center;" width="25%">';
		$emp_department = "SELECT * FROM emp_department WHERE employee_id = '".$employee_id."'";
		$emp_departmentresult = mysqli_query($connect, $emp_department);
		while($emp_dep = mysqli_fetch_array($emp_departmentresult)){
			$output .= 		' '.$emp_dep["position"];			
		}					
			$output .='		</td>
							<td width="50%">
									
							</td>
							<td style="text-align: center;" width="25%" >
								'.$designation.'
							</td>
						</tr>
					</table>
			';		
	}		
	
	//echo $output;
}
	$document->loadHtml($output);

	//set page size and orientation

	$document->setPaper('A4', 'landscape');

	//Render the HTML as PDF

	$document->render();

	//Get output of generated pdf in Browser
	$filename = $lastname.'-'.$month.'-'.$selyear.'-Accomplishment';
	$document->stream($filename, array("Attachment"=>0));
	//1  = Download
	//0 = Preview

	header('index.php');
?>