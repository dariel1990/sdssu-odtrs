<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="styles/plugins/fontawesome-free/css/all.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="styles/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<!-- daterange picker -->
	<link rel="stylesheet" href="styles/plugins/daterangepicker/daterangepicker.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="styles/dist/css/adminlte.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="styles/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="styles/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
	<title>SDSSU Lianga Online DTR System</title>
</head>

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
							<h1 class="m-0 text-dark">SDSSU Lianga Online DTR System</h1>
						</div><!-- /.col -->
						<div class="col-sm-2">
						</div>
						<div class="col-sm-4">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text bg-danger"><i class="fa fa-calendar"></i> &nbsp Date
									</span>
								</div>
								<select class="form-control" name="attend_date" id="attend_date" required>
									<option hidden value="">Select One</option>
									<?php
									$dates = DB:: getInstance()->query("SELECT DISTINCT attendance_date FROM attendance ORDER BY YEAR(attendance_date) DESC, MONTH(attendance_date) DESC, DAY(attendance_date) DESC;");
									foreach($dates->results() as $dates){
										$getdate = $dates->attendance_date;
										$unixTimestamp = strtotime($getdate);
										$completedate = date("F j, Y", $unixTimestamp);
										if($dates->attendance_date === $date){
											$selected = 'selected';
										}else{
											$selected = '';
										}?>
									<option value="<?php echo $dates->attendance_date;?>" <?php echo $selected; ?>>
										<?php echo $completedate; ?></option>
									<?php }?>
								</select>
							</div>
						</div><!-- /.col -->
					</div><!-- /.row -->
				</div><!-- /.container-fluid -->
			</div>
			<!-- /.content-header -->

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-6 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h3 class="text-center">FACULTY</h3>
									<h6 class="text-center">Daily Attendance Sheet</h6>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="box-body table-responsive">
												<table id="faculty" class="table table-bordered table-hover table-sm">
													<thead>
														<tr>
															<th rowspan="2" width="10%"
																style="vertical-align: middle; text-align: center;">ID
																NUMBER </th>
															<th rowspan="2" width="30%"
																style="vertical-align: middle; text-align: center;">
																EMPLOYEE NAME </th>
															<th colspan="2"
																style="vertical-align: middle; text-align: center;">AM
															</th>
															<th colspan="2"
																style="vertical-align: middle; text-align: center;">PM
															</th>
														</tr>
														<tr>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">IN
															</th>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">OUT
															</th>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">IN
															</th>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">OUT
															</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div><!-- /.box-body -->
										</div>
										<!-- /.row -->
									</div>
									<!-- ./card-body -->
								</div>
								<!-- /.card -->
							</div>
							<!-- /.col -->
						</div>
						<div class="col-md-6 d-flex">
							<div class="card flex-fill">
								<div class="card-header">
									<h3 class="text-center">STAFF</h3>
									<h6 class="text-center">Daily Attendance Sheet</h6>
								</div>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<div class="box-body table-responsive">
												<table id="staff" class="table table-bordered table-hover table-sm">
													<thead>
														<tr>
															<th rowspan="2" width="10%"
																style="vertical-align: middle; text-align: center;">ID
																NUMBER </th>
															<th rowspan="2" width="40%"
																style="vertical-align: middle; text-align: center;">
																EMPLOYEE NAME </th>
															<th colspan="2"
																style="vertical-align: middle; text-align: center;">AM
															</th>
															<th colspan="2"
																style="vertical-align: middle; text-align: center;">PM
															</th>
														</tr>
														<tr>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">IN
															</th>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">OUT
															</th>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">IN
															</th>
															<th width="15%"
																style="vertical-align: middle; text-align: center;">OUT
															</th>
														</tr>
													</thead>
													<tbody>
													</tbody>
												</table>
											</div><!-- /.box-body -->
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
	<!-- ./wrapper -->
	<!-- REQUIRED SCRIPTS -->
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
	<!-- ChartJS -->
	<script src="styles/plugins/chart.js/Chart.min.js"></script>
	<!-- DataTables -->
	<script src="styles/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="styles/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="styles/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="styles/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<!-- PAGE SCRIPTS -->
	<script src="styles/dist/js/pages/dashboard2.js"></script>
	<!-- date-range-picker -->
	<script src="styles/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- page script -->
	<script>
		$(function () {
			$("#example1a").DataTable({
				"responsive": true,
				"autoWidth": false,
			});
			$('#example2a').DataTable({
				"paging": false,
				"lengthChange": false,
				"searching": false,
				"ordering": false,
				"info": false,
				"autoWidth": false,
				"responsive": false,
			});
		});
	</script>
	<script type="text/javascript" language="javascript">
		$(document).ready(function () {

			fill_datatable();

			function fill_datatable(attendance_date = '') {
				var dataTable = $('#faculty').DataTable({
					"processing": true,
					"serverSide": true,
					"ordering": false,
					"searching": false,
					"info": false,
					"autoWidth": false,
					"paging": false,
					"language": {
						processing: '<div class="spinner-border text-info" role="status"><span class="sr-only">Loading...</span></div>'
					},
					"ajax": {
						url: "fetchfaculty.php",
						type: "POST",
						data: {
							attendance_date: attendance_date
						}
					}
				});

				var dataTable = $('#staff').DataTable({
					"processing": true,
					"serverSide": true,
					"ordering": false,
					"searching": false,
					"info": false,
					"autoWidth": false,
					"paging": false,
					"language": {
						processing: '<i style="color:#FF9B44" i class="fa fa-spinner fa-spin fa-2x fa-fw"></i><span class="sr-only">Loading...</span> '
					},
					"ajax": {
						url: "fetchstaff.php",
						type: "POST",
						data: {
							attendance_date: attendance_date
						}
					}
				});
			}

			$('#attend_date').change(function () {
				var attend_date = $('#attend_date').val();
				if (attend_date != '') {
					$('#faculty').DataTable().destroy();
					$('#staff').DataTable().destroy();
					fill_datatable(attend_date);
				} else {
					//nothing
				}
			});


		});
	</script>
</body>

</html>