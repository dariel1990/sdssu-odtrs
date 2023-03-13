<?php
//index.php
	//include autoloader
	require_once 'dompdf/autoload.inc.php';
	use Dompdf\Dompdf;
	
	//initialize dompdf class
	$document = new Dompdf();
// reference the Dompdf namespace
if(isset($_POST["emp_id"]) && isset($_POST["attend_date"])){
	
	$attend_date = $_POST["attend_date"];
	$range = date("Y-m-d",strtotime($attend_date));
	$month = date("F",strtotime($attend_date));
	$selmonth = date("m",strtotime($attend_date));
	$selyear = date("Y",strtotime($attend_date));
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

				/* Create two equal columns that floats next to each other */
				.column {
				  float: left;
				  width: 48%;
				  padding: 10px;
				}

				/* Clear floats after the columns */
				.row:after {
				  content: "";
				  display: table;
				  clear: both;
				}
				p {
					font-family: Arial, Helvetica, sans-serif;
					font-size:11px;
				}
				p,h5 {
					font-family: Arial, Helvetica, sans-serif;
				}
				table{
					width: 100%;	
					border: 1px solid #999999;
					border-spacing: -1px;
				}
				table th {
				  border: 1px solid #999999;
				  border-collapse: collapse;
				  text-align: center;
				  font-family: Arial, Helvetica, sans-serif;
				  font-size:11px;
				}
				table td {
				  border: 1px solid #999999;
				  border-collapse: collapse;
				  text-align: center;
				  font-family: Arial, Helvetica, sans-serif;
				  font-size:11px;
				}
				table.center {
				  margin-left: auto;
				  margin-right: auto;
				}
				</style>
				<div class="row">';
	while($row = mysqli_fetch_array($result)){
		$lastname = $row["lname"];
		$mday = "SELECT 	DAY(cal.my_date) date_field,
					COALESCE(a.am_in, '') login_am,
					COALESCE(a.am_out, '') logout_am,
					COALESCE(a.pm_in, '') login_pm,
					COALESCE(a.pm_out, '') logout_pm,
					COALESCE(a.mins_late, '') mins_late,
					a.employee_id emp_id
				FROM 
					(SELECT 
						s.start_date + INTERVAL (days.d) DAY my_date
					FROM
						(SELECT LAST_DAY('$range') + INTERVAL 1 DAY - INTERVAL 1 MONTH start_date,
								LAST_DAY('$range') end_date
						) s
						JOIN days
							ON days.d <= DATEDIFF(s.end_date, s.start_date)
					) cal
					LEFT JOIN attendance a
					ON a.attendance_date = cal.my_date AND a.employee_id = '".$row["employee_id"]."'
					ORDER BY cal.my_date ASC;
					";
		$result1 = mysqli_query($connect, $mday);
		
			$output .= '
					<div class="column" style="text-align:center">
					<p>
						Civil Service Form No. 48<br>
						<strong>DAILY TIME RECORD</strong>
						<h4><i>'.strtoupper($row["fname"]).' '.strtoupper(substr($row["mname"], 0, 1)).'. '.strtoupper($row["lname"]).' '.$row["suffix"].'</i></h4>
					</p>
					<p>
						For the Month of '.$month.' 01 to '.$end_day.', '.$selyear.'<br>
						OFFICIAL HOURS for Arrival and Departure<br>
						Regular days _______________________________<br>
						Saturdays/Sundays as required<br>
					</p>
					<table class="center">
						<tr>
							<th rowspan="2" width="10%">Day</th>
							<th colspan="2">AM</th>
							<th colspan="2">PM</th>
							<th rowspan="2" width="10%">MIN</th>
							<th rowspan="2" width="20%">REMARKS</th>
						</tr>
						<tr>
							<th width="15%">IN</th>
							<th width="15%">OUT</th>
							<th width="15%">IN</th>
							<th width="15%">OUT</th>
						</tr>
					';
		while($row1 = mysqli_fetch_array($result1)){
			$output .='	
						<tr>
							<td>'.$row1["date_field"].'</td>
							<td>'.$row1["login_am"].'</td>
							<td>'.$row1["logout_am"].'</td>
							<td>'.$row1["login_pm"].'</td>
							<td>'.$row1["logout_pm"].'</td>
							<td>'.$row1["mins_late"].'</td>
							<td></td>
						</tr>
			';
		}		
		$min_late = "SELECT SUM(mins_late) min_late FROM attendance WHERE employee_id='".$row["employee_id"]."' AND MONTH(attendance_date) = '$selmonth'";
		$result4 = mysqli_query($connect, $min_late);
		while($row4 = mysqli_fetch_array($result4)){
			$total_mins = $row4['min_late'];
		}
			$output .='	
					</table>
					<p>
						<strong>Total Late in Minutes <u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '.$total_mins.'  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></strong><br>
					</p>
					<br>
					<p>
						I CERTIFY on my honor that the above is true and correct<br>
						report of the hours of work performed, record of which was made<br>
						daily at the time of arrival and departure from office.
					</p>
					<br>
					<p>
						___________________________________________<br>
						Verified as to the prescribed office hours
					</p>
					<br>
					<br>
					<p>
						<u><strong style="font-size: 12px;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CYNTHIA P. SAJOT  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></u><br>
						CAMPUS DIRECTOR
					</p>
				  </div>
				  <div class="column" style="text-align:center">
					<p>
						Civil Service Form No. 48<br>
						<strong>DAILY TIME RECORD</strong>
						<h4><i>'.strtoupper($row["fname"]).' '.strtoupper(substr($row["mname"], 0, 1)).'. '.strtoupper($row["lname"]).' '.$row["suffix"].'</i></h4>
					</p>
					<p>
						For the Month of '.$month.' 01 to '.$end_day.', '.$selyear.'<br>
						OFFICIAL HOURS for Arrival and Departure<br>
						Regular days _______________________________<br>
						Saturdays/Sundays as required<br>
					</p>
					<table class="center">
						<tr>
							<th rowspan="2" width="10%">Day</th>
							<th colspan="2">AM</th>
							<th colspan="2">PM</th>
							<th rowspan="2" width="10%">MIN</th>
							<th rowspan="2" width="20%">REMARKS</th>
						</tr>
						<tr>
							<th width="15%">IN</th>
							<th width="15%">OUT</th>
							<th width="15%">IN</th>
							<th width="15%">OUT</th>
						</tr>'
						;
		$col2 = "SELECT 	DAY(cal.my_date) date_field,
					COALESCE(a.am_in, '') login_am,
					COALESCE(a.am_out, '') logout_am,
					COALESCE(a.pm_in, '') login_pm,
					COALESCE(a.pm_out, '') logout_pm,
					COALESCE(a.mins_late, '') mins_late,
					a.employee_id emp_id
				FROM 
					(SELECT 
						s.start_date + INTERVAL (days.d) DAY my_date
					FROM
						(SELECT LAST_DAY('$range') + INTERVAL 1 DAY - INTERVAL 1 MONTH start_date,
								LAST_DAY('$range') end_date
						) s
						JOIN days
							ON days.d <= DATEDIFF(s.end_date, s.start_date)
					) cal
					LEFT JOIN attendance a
					ON a.attendance_date = cal.my_date AND a.employee_id = '".$row["employee_id"]."'
					ORDER BY cal.my_date ASC;
					";
		$result2 = mysqli_query($connect, $col2);
		while($row2 = mysqli_fetch_array($result2)){
			$output .='	
						<tr>
							<td>'.$row2["date_field"].'</td>
							<td>'.$row2["login_am"].'</td>
							<td>'.$row2["logout_am"].'</td>
							<td>'.$row2["login_pm"].'</td>
							<td>'.$row2["logout_pm"].'</td>
							<td>'.$row2["mins_late"].'</td>
							<td></td>
						</tr>
			';
		}		
			$output .='	
					</table>
					<p>
						<strong>Total Late in Minutes <u>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; '.$total_mins.' &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</u></strong><br>
					</p>
					<br>
					<p>
						I CERTIFY on my honor that the above is true and correct<br>
						report of the hours of work performed, record of which was made<br>
						daily at the time of arrival and departure from office.
					</p>
					<br>
					<p>
						___________________________________________<br>
						Verified as to the prescribed office hours
					</p>
					<br>
					<br>
					<p>
						<u><strong style="font-size: 12px;"> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; CYNTHIA P. SAJOT &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</strong></u><br>
						CAMPUS DIRECTOR
					</p>
				  </div>';
	}		
		$output .= '</div>';
	
	//echo $output;
}
	$document->loadHtml($output);

	//set page size and orientation

	$document->setPaper('A4', 'portrait');

	//Render the HTML as PDF

	$document->render();

	//Get output of generated pdf in Browser
	$filename = $lastname.'-'.$month.'-'.$selyear;
	$document->stream($filename, array("Attachment"=>0));
	//1  = Download
	//0 = Preview

	header('index.php?actions=listEmployees');
?>