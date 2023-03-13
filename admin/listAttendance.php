<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" href="styles/plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="styles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="styles/dist/css/adminlte.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<!-- Editor CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.0/css/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.3/css/select.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.1/css/dataTables.dateTime.min.css">
	<link rel="stylesheet" type="text/css" href="editor/css/editor.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="styles/plugins/select2/css/select2.min.css">
	<!-- SweedAlert -->
	<link href="styles/plugins/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
	<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
	<style>
		.select2-container--default .select2-selection--single{
			padding:6px;
			height: 37px;
			font-size: 1.2em;  
			position: relative;
		}
	</style>
	<title>SDSSU Lianga Online DTR System</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

	<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
		<div class="wrapper">
			<!-- header logo: style can be found in header.less -->
			<?php include_once('navigation.php'); ?>
			<!-- Content Wrapper. Contains page content -->
			<div class="content-wrapper">
				<!-- Content Header (Page header) -->
				<div class="content-header">
					<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1 class="m-0 text-dark">SDSSU Lianga Online DTR 	System</h1>
							</div><!-- /.col -->
							<div class="col-sm-2">
							</div>
						</div><!-- /.row -->
					</div><!-- /.container-fluid -->
				</div>
				<!-- /.content-header -->

				<!-- Main content -->
				<section class="content">
					<div class="container-fluid">

						<div class="row">
							<div class="col-md-12 d-flex">
								<div class="card flex-fill">
									<div class="card-header">
										<h3 class="text-center">Daily Attendance Sheet</h3>
									</div>
									<!-- /.card-header -->
									<div class="card-body">
										<div class="row">
											<div class="col-md-4">
												<form method="post">
													<select class='form-control employee-select' id='employee' name="employee" required>
														<option value="">Select Employee</option>
														<?php
														$employees = DB:: getInstance()->query("SELECT * FROM employee ORDER BY lname asc");
														foreach($employees->results() as $employee){?>
															<option
																value="<?php echo $employee->employee_id;?>">
																<?php echo $employee->lname.", ".$employee->fname." ".$employee->mname ; ?>
															</option>
														<?php }?>
													</select>

													<div class="card card-widget widget-user flex-fill mt-3">
														<!-- Add the bg color to the header using any of the bg-* classes -->
														<div class="widget-user-header bg-info">
															<h2 class="widget-user-username mt-3 ">
																
															</h2>
															<h4 class="widget-user-desc mt-2"></h4>
														</div>
														<div class="card-footer flex-fill pt-3">
															<div class="row">
																<div class="col-lg-6">
																<select class="form-control" name="attend_month" id="attend_month">
																	<option value="">SELECT MONTH</option>
																	<?php
																		
																		for ($i = 1; $i <= 12; $i++) {
																			$timestamp = mktime(0, 0, 0, $i+1, 0, 0);
																			$label = date("F", $timestamp);
																			
																			if($i == intval(date("m"))){
																				$selected = 'selected';
																			}else{
																				$selected = '';
																			}
																			echo '<option value="' . $label . '" ' . $selected . ' >' . $label . '</option>';;
																		}
																	?>
																</select>
																</div>
																<div class="col-lg-6">
																<select class="form-control" name="attend_year" id="attend_year" required>
																	<option hidden value=""> SELECT YEAR </option>
																	<?php
																		$starting_year  =date('Y', strtotime('-10 year'));
																		$ending_year = date('Y', strtotime('+10 year'));
																		$current_year = date('Y');
																		for($starting_year; $starting_year <= $ending_year; $starting_year++) {
																			echo '<option value="'.$starting_year.'"';
																			if( $starting_year ==  $current_year ) {
																				echo ' selected="selected"';
																			}
																			echo ' >'.$starting_year.'</option>';
																		}               
																	?>
																</select>
																</div>
															</div>
																	<!-- /.description-block -->
															<!-- /.row -->
														</div>
													</div>
												</form>
											</div>
											<div class="col-md-8">
												<div class="card ">
													<div class="card-body p-0 m-0">
														<div class="box-body table-responsive">
															<table class="table table-sm table-bordered" cellspacing="0" width="100%">
																<thead>
																	<tr>
																		<th class="text-center" width="10%">Day</th>
																		<th class="text-center" width="20%">AM OUT</th>
																		<th class="text-center" width="20%">AM IN</th>
																		<th class="text-center" width="20%">PM IN</th>
																		<th class="text-center" width="20%">PM OUT</th>
																		<th class="text-center" width="10%">ACTION</th>
																	</tr>
																</thead>
																<tbody id='attendance'>
                                               		 			</tbody>
															</table>
														</div><!-- /.box-body -->
													</div>
												</div>
											</div>
											<!-- /.row -->
										</div>
										<!-- ./card-body -->
									</div>
									<!-- /.card -->
								</div>
								<!-- /.col -->
							</div>
							<!-- /.row -->
						</div>
					</div>
				</section>

				<!-- Control Sidebar -->
				<aside class="control-sidebar control-sidebar-dark">
					<!-- Control sidebar content goes here -->
				</aside>
				<!-- /.control-sidebar -->

				<!-- Main Footer -->
				<footer class="main-footer">
					<strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
					All rights reserved.
					<div class="float-right d-none d-sm-inline-block">
						<b>Version</b> 3.0.5
					</div>
				</footer>
			</div>
		</div>

		<!-- jQuery -->
		<script src="styles/plugins/jquery/jquery.min.js"></script>
		<!-- Bootstrap -->
		<script src="styles/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
		<!-- overlayScrollbars -->
		<script src="styles/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
		<!-- AdminLTE App -->
		<script src="styles/dist/js/adminlte.js"></script>

		<!-- OPTIONAL SCRIPTS -->
		<script src="styles/dist/js/demo.js"></script>

		<!-- PAGE PLUGINS -->
		<!-- jQuery Mapael -->
		<script src="styles/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
		<script src="styles/plugins/raphael/raphael.min.js"></script>
		<script src="styles/plugins/jquery-mapael/jquery.mapael.min.js"></script>
		<script src="styles/plugins/jquery-mapael/maps/usa_states.min.js"></script>
		<!-- PAGE SCRIPTS -->
		<script src="styles/dist/js/pages/dashboard2.js"></script>
		<!-- SweetAlert -->
		<script src="styles/libs/sweetalert2/sweetalert.min.js"></script>
		<!-- page script -->
		<!-- jquery-validation -->
		<script src="styles/plugins/jquery-validation/jquery.validate.min.js"></script>
		<script src="styles/plugins/jquery-validation/additional-methods.min.js"></script>

		<script src="styles/plugins/select2/js/select2.min.js"></script>
		<script src="styles/dist/js/moment.js"></script>
		<!-- Plugins js -->
		<script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
		<script>
			$(function () {
				var isLoading = false;

				$('.employee-select').select2({
					placeholder: 'SELECT EMPLOYEE'
				});

				$('.employee-select').change(function (e) {
					$("#attendance").html('');
					let selectedEmployee = $(this).val();
					let selectedMonth =  $('#attend_month').val();
					let selectedYear =  $('#attend_year').val();
					let attendanceDate = "";
					$.ajax({
						method:"POST",
						url: `getEmployee.php`,
						dataType: "json",
						data: {employeeID:selectedEmployee, month:selectedMonth, year:selectedYear},
						success: function (response) {
							let employeeID = response.employee_id;
							let fullname = response.employee_name;
							$(".widget-user-username").html(fullname);
							$(".widget-user-desc").html(employeeID);
							
							response.mydays.forEach((dates, index) => {
								day = index + 1;
								attendanceDate = $("#attend_month").val() + " " + day + " " + $("#attend_year").val();  
								formattedDate = moment(attendanceDate, 'MMMM D YYYY').format('YYYY-MM-DD');
								if(dates.login_am == "" && dates.logout_am == "" && dates.login_pm == "" && dates.logout_pm == ""){
									
									$("#attendance").append(`
										<tr>
												<td class="text-center">
													${day}
												</td>
												<td class="text-center" contenteditable="true" id="login_am_${employeeID + day}"></td>
												<td class="text-center" contenteditable="true" id="logout_am_${employeeID + day}"></td>
												<td class="text-center" contenteditable="true" id="login_pm_${employeeID + day}"></td>
												<td class="text-center" contenteditable="true" id="logout_pm_${employeeID + day}"></td>
												<td class="text-center">
													<button class="btn btn-primary pt-0 pb-0 shadow addAttendance" data-empID="${employeeID}" data-adate="${formattedDate}" data-day="${day}">
														<i class="fa fa-plus fa-xs"></i>
													</button>
												</td>
										</tr>
									`);
								}else{
									button = '<button class="btn btn-danger pt-0 pb-0 shadow deleteAttendance"><i class="fa fa-trash fa-xs"></i></button>';
									$("#attendance").append(`
										<tr data-row="${day}" id="attendance">
											<td class="text-center">
												${day}
											</td>
											<td class="text-center login_am" contenteditable="true" data-day="${day}" data-edit="0" id="login_am_${day}">${dates.login_am == '' ? '----' : dates.login_am}</td>
											<td class="text-center logout_am" contenteditable="true" data-day="${day}" data-edit="0" id="logout_am_${day}">${dates.logout_am == '' ? '----' : dates.logout_am}</td>
											<td class="text-center login_pm" contenteditable="true" data-day="${day}" data-edit="0" id="login_pm_${day}">${dates.login_pm == '' ? '----' : dates.login_pm}</td>
											<td class="text-center logout_pm" contenteditable="true" data-day="${day}" data-edit="0" id="logout_pm_${day}">${dates.logout_pm == '' ? '----' : dates.logout_pm}</td>
											<td class="text-center">
												<button class="btn btn-danger pt-0 pb-0 shadow deleteAttendance${day}" id="deleteAttendance" data-attend_id="${dates.attend_id}">
													<i class="fa fa-trash fa-xs"></i>
												</button>
												<div class="d-none editButtons${day}">
													<button class="btn btn-success pt-0 pb-0 shadow saveAttendance" data-attend_id="${dates.attend_id}" data-day="${day}">
														<i class="fa fa-save fa-xs"></i>
													</button>
												</div>
											</td>
										</tr>
									`);
								}
							});
						},
					});
				});

				$('#attend_month').change(function (e) {
					$('.employee-select').trigger('change');
				});

				$('#attend_year').change(function (e) {
					$('.employee-select').trigger('change');
				});

				$(document).on('click', '.addAttendance', function () {
					
					let employee_id = $(this).attr("data-empID");
					let attendance_date = $(this).attr("data-adate");
					let day = $(this).attr("data-day");
					let am_login = $(`#login_am_${employee_id + day}`).text();
					let am_logout = $(`#logout_am_${employee_id + day}`).text();
					let pm_login = $(`#login_pm_${employee_id + day}`).text();
					let pm_logout = $(`#logout_pm_${employee_id + day}`).text();
					
					

					if(am_login == "" && am_logout == "" && pm_login == "" && pm_logout == "") {
						swal("Warning!", "Please input the required fields!", "warning", {
							closeOnClickOutside: false,
							button: false,
							timer: 1500,
						});
						
					}else{
						if (!isLoading) {
							isLoading = true;
							$.ajax({
								method: "POST",
								url: `saveAttendance.php`,
								dataType: "json",
								data: {am_login:am_login, am_logout:am_logout, pm_login:pm_login, pm_logout:pm_logout, employee_id:employee_id, attendance_date:attendance_date},
								success: function (response) {
									if(response.success){
										swal("Good job!", "Successfully added!", "success", {
											closeOnClickOutside: false,
											button: false,
											timer: 1000,
										});
										setTimeout(function () {
											$('.employee-select').trigger('change');
											isLoading = false;
										}, 1000);
									}
								},
							});
						}
					}
					
					console.log(isLoading);
				});

				$(document).on('click', '#deleteAttendance', function () {
					let attend_id = $(this).attr("data-attend_id");

					swal({
						title: "EXCLUDE",
						text: "Are you sure you want to delete this attendance?",
						icon: "warning",
						buttons: true,
						dangerMode: true,
						closeOnClickOutside: false,
					}).then((willDelete) => {
						if (willDelete) {
							$.ajax({
								method: "POST",
								url: `deleteAttendance.php`,
								dataType: "json",
								data: {attend_id:attend_id},
								success: function (response) {
									if(response.success){
										swal("Good job!", "Successfully deleted!", "success", {
											closeOnClickOutside: false,
											button: false,
											timer: 1000,
										});
										setTimeout(function () {
											$('.employee-select').trigger('change');
										}, 1000);
									}
								},
							});
						}
					});
				});

				$(document).on('click', '.login_am', function () {
					$('.login_am').not(this).attr('data-edit', 0); 
					$(this).attr('data-edit', 1);// Except the clicked tile all are restored to default data

					$('.login_am').each(function(){
						let day = $(this).attr('data-day');
						let editable = $(this).attr('data-edit');
						if(day && editable == 1){
							$(`.deleteAttendance${day}`).fadeOut().addClass('d-none');
							$(`.editButtons${day}`).fadeIn().removeClass('d-none');
						}else{
							$(`.deleteAttendance${day}`).fadeIn().removeClass('d-none');
							$(`.editButtons${day}`).fadeOut().addClass('d-none');
						}
					});
				});

				$(document).on('click', '.logout_am', function () {
					$('.logout_am').not(this).attr('data-edit', 0); 
					$(this).attr('data-edit', 1);// Except the clicked tile all are restored to default data

					$('.logout_am').each(function(){
						let day = $(this).attr('data-day');
						let editable = $(this).attr('data-edit');
						if(day && editable == 1){
							$(`.deleteAttendance${day}`).fadeOut().addClass('d-none');
							$(`.editButtons${day}`).fadeIn().removeClass('d-none');
						}else{
							$(`.deleteAttendance${day}`).fadeIn().removeClass('d-none');
							$(`.editButtons${day}`).fadeOut().addClass('d-none');
						}
					});
				});

				$(document).on('click', '.login_pm', function () {
					$('.login_pm').not(this).attr('data-edit', 0); 
					$(this).attr('data-edit', 1);// Except the clicked tile all are restored to default data

					$('.login_pm').each(function(){
						let day = $(this).attr('data-day');
						let editable = $(this).attr('data-edit');
						if(day && editable == 1){
							$(`.deleteAttendance${day}`).fadeOut().addClass('d-none');
							$(`.editButtons${day}`).fadeIn().removeClass('d-none');
						}else{
							$(`.deleteAttendance${day}`).fadeIn().removeClass('d-none');
							$(`.editButtons${day}`).fadeOut().addClass('d-none');
						}
					});
				});

				$(document).on('click', '.logout_pm', function () {
					$('.logout_pm').not(this).attr('data-edit', 0); 
					$(this).attr('data-edit', 1);// Except the clicked tile all are restored to default data

					$('.logout_pm').each(function(){
						let day = $(this).attr('data-day');
						let editable = $(this).attr('data-edit');
						if(day && editable == 1){
							$(`.deleteAttendance${day}`).fadeOut().addClass('d-none');
							$(`.editButtons${day}`).fadeIn().removeClass('d-none');
						}else{
							$(`.deleteAttendance${day}`).fadeIn().removeClass('d-none');
							$(`.editButtons${day}`).fadeOut().addClass('d-none');
						}
					});
				});

				$(document).on('click', '.saveAttendance', function () {
					let attend_id = $(this).attr("data-attend_id");
					let day = $(this).attr("data-day");
					let am_login = $(`#login_am_${day}`).text();
					let am_logout = $(`#logout_am_${day}`).text();
					let pm_login = $(`#login_pm_${day}`).text();
					let pm_logout = $(`#logout_pm_${day}`).text();

					$.ajax({
						method: "POST",
						url: `editAttendance.php`,
						dataType: "json",
						data: {attend_id:attend_id, am_login:am_login, am_logout:am_logout, pm_login:pm_login, pm_logout:pm_logout},
						success: function (response) {
							if(response.success){
								swal("Good job!", "Successfully deleted!", "success", {
									closeOnClickOutside: false,
									button: false,
									timer: 1000,
								});
								setTimeout(function () {
									$('.employee-select').trigger('change');
								}, 1000);
							}
						},
					});
				});

			})
		</script>
	</body>

</html>