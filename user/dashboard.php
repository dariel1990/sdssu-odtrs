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
<!-- Theme style -->
<link rel="stylesheet" href="styles/dist/css/adminlte.min.css">
<!-- DataTables -->
  <link rel="stylesheet" href="styles/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="styles/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<!-- Google Font: Source Sans Pro -->
<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<style>
	.input-group>.input-group-prepend {
		flex: 0 0 30%;
	}
	.input-group .input-group-text {
		width: 100%;
	}
</style>
<title>SDSSU Lianga Online DTR System</title>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed" onload=display_ct();>
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
            <h1 class="m-0 text-dark">Dashboard - SDSSU Lianga Online DTR System</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
		<div class="row">
			<div class="col-md-6">
				<div class="info-box mb-3 bg-danger">
				  <span class="info-box-icon"><i class="fa fa-calendar"></i></span>

				  <div class="info-box-content">
					<h1 class="text-center text-default"><span id="c_date"></span></h1>
				  </div>
				  <!-- /.info-box-content -->
				</div>
			</div>
			<div class="col-md-6">
				<div class="info-box mb-3 bg-warning">
				  <span class="info-box-icon"><i class="fa fa-clock"></i></span>

				  <div class="info-box-content">
					<h1 class="text-center text-default"><span id="ct"></span></h1>
				  </div>
				  <!-- /.info-box-content -->
				</div>
			</div>
		</div>
        <div class="row">
			<div class="col-md-3 d-flex">
				<div class="card card-widget widget-user flex-fill">
					<?php if(Session::exists('LoginError')){ ?>
						<div class="flash-data-login-error" data-flashdata="<?php echo Session::flash('LoginError'); ?>"></div>
					<?php }?> 
					<?php if(Session::exists('LogoutError')){ ?>
						<div class="flash-data-logout-error" data-flashdata="<?php echo Session::flash('LogoutError'); ?>"></div>
					<?php }?>
					<?php if(Session::exists('LogoutAmError')){ ?>
						<div class="flash-data-logoutam-error" data-flashdata="<?php echo Session::flash('LogoutAmError'); ?>"></div>
					<?php }?>
					<?php if(Session::exists('LoginPmError')){ ?>
						<div class="flash-data-loginpm-error" data-flashdata="<?php echo Session::flash('LoginPmError'); ?>"></div>
					<?php }?>
					<?php if(Session::exists('LogoutPmError')){ ?>
						<div class="flash-data-logoutpm-error" data-flashdata="<?php echo Session::flash('LogoutPmError'); ?>"></div>
					<?php }?>
					<?php if(Session::exists('LoginAlready')){ ?>
						<div class="flash-data-login-already" data-flashdata="<?php echo Session::flash('LoginAlready'); ?>"></div>
					<?php }?> 
					<?php if(Session::exists('Login')){ ?>
						<div class="flash-data-login-success" data-flashdata="<?php echo Session::flash('Login'); ?>"></div>
					<?php }?> 
					<?php if(Session::exists('Logout')){ ?>
						<div class="flash-data-logout-success" data-flashdata="<?php echo Session::flash('Logout'); ?>"></div>
					<?php }?> 
					<?php if(Session::exists('Weekend')){ ?>
						<div class="flash-data-weekend" data-flashdata="<?php echo Session::flash('Weekend'); ?>"></div>
					<?php }?> 
					<?php if(Session::exists('Deleted')){ ?>
						<div class="flash-data-deleted" data-flashdata="<?php echo Session::flash('Deleted'); ?>"></div>
					<?php }?> 
					<?php if(Session::exists('Added')) { ?>
						<div class="flash-data-added" data-flashdata="<?php echo Session::flash('Added'); ?>"></div>
					<?php }?>
					<?php if(Session::exists('Updated')) { ?>
						<div class="flash-data-updated" data-flashdata="<?php echo Session::flash('Updated'); ?>"></div>
					<?php }?>
					<?php
					$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$user->data()->employee_id."'");		
					foreach($employee->results() as $employee){
						$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE employee_id = '".$employee->employee_id."'");		
						foreach($userlogin->results() as $userlogin){
							$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id = '$userlogin->permission'");		
							foreach($groups->results() as $groups){?>
								<!-- Add the bg color to the header using any of the bg-* classes -->
								<div class="widget-user-header bg-danger">
									<h3 class="widget-user-username">
										<?php echo $employee->fname." ".substr($employee->mname, 0, 1).". ".$employee->lname." ".$employee->suffix; ?>	
									</h3>
									<h5 class="widget-user-desc"><?php echo $groups->name; ?></h5>
								</div>
								<div class="widget-user-image">
									<img class="img-circle elevation-2" src="admin/uploads/avatar/<?php echo $userlogin->avatar; ?>" alt="User Avatar">
								</div>
								<div class="card-body mt-4">
									<a class="btn btn-warning btn-block disabled"><h3 class="text-center"><?php echo $employee->employee_id; ?></h3></a>
									<p class="text-center">Employee ID</p>
									<div class="row">
											  <!-- /.col -->
											  <div class="col-sm-12">
												<div class="description-block">
													<?php 
													
														$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$user->data()->employee_id."' AND attendance_date = '$date'");	
														$attendancecount = DB:: getInstance()->count($attendance);
														if ($attendancecount==0){
															if ($hour>12){?>
																<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGIN - AM | <b>Absent</b></a>
															<?php }else{?>
																<a href="amlogin.php?employee_id=<?php echo $employee->employee_id;?>" type="button" class="btn btn-block btn-info btn-md">Morning LOGIN</a>
															<?php }?>
														<?php }else{
															foreach($attendance->results() as $attendance){
																if($attendance->am_in === '' && $attendance->pm_in <> ''){?>
																	<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGIN - AM | <b>Absent</b></a>
																	<?php }else{?>
																		<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGIN - AM | <b><?php echo $attendance->am_in;?></b></a>
																	<?php }?>	
															<?php }?>
														<?php }?>
														
												</div>
												<!-- /.description-block -->
											  </div>
											  <!-- /.col -->
											  <div class="col-sm-12">
												<div class="description-block">
													<?php 
														$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$user->data()->employee_id."' AND attendance_date = '$date'");
														$attendancecount = DB:: getInstance()->count($attendance);
														if ($attendancecount==0){
															if ($hour>12){?>
																<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGOUT - AM | <b>Absent</b></a>
															<?php }else{?>
																<a href="amlogout.php?employee_id=<?php echo $employee->employee_id; ?>" type="button" class="btn btn-block btn-info btn-md">Morning LOGOUT</a>
															<?php }?>
														<?php }else{?>
															<?php foreach($attendance->results() as $attendance){
																if($attendance->am_in === '' && $attendance->pm_in <> ''){?>
																	<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGOUT - AM | <b>Absent</b></a>
																<?php }else{?>
																	<?php if ($attendance->am_out === ''){?>
																		<a href="amlogout.php?employee_id=<?php echo $employee->employee_id; ?>" type="button" class="btn btn-block btn-info btn-md">Morning LOGOUT</a>
																	<?php }else{?>
																		<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGOUT - AM | <b><?php echo $attendance->am_out;?></b></a>
																	<?php }?>
																<?php }?>
															<?php }?>
														<?php }?>
												</div>
												<!-- /.description-block -->
											  </div>
											  <div class="col-sm-12">
												<div class="description-block">
													<?php 
													$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$user->data()->employee_id."' AND attendance_date = '$date'");
													$attendancecount = DB:: getInstance()->count($attendance);
													if ($attendancecount==0){
														if ($hour>17){?>	
															<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGIN - PM | <b>Absent</b></a>
														<?php }else{?>
															<a href="pmlogin.php?employee_id=<?php echo $employee->employee_id; ?>" type="button" class="btn btn-block btn-info btn-md">Afternoon LOGIN</a>
														<?php }?>
													<?php }else{?>
														<?php foreach($attendance->results() as $attendance){?>
															<?php if ($attendance->pm_in === ''){?>
																<a href="pmlogin.php?employee_id=<?php echo $employee->employee_id; ?>" type="button" class="btn btn-block btn-info btn-md">Afternoon LOGIN</a>
															<?php }else{?>
																<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGIN - PM | <b><?php echo $attendance->pm_in;?></b></a>
															<?php }?>
														<?php }?>
													<?php }?>
												</div>
												<!-- /.description-block -->
											  </div>
											  <div class="col-sm-12">
												<div class="description-block">
												  <?php 
													$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$user->data()->employee_id."' AND attendance_date = '$date'");
													$attendancecount = DB:: getInstance()->count($attendance);
													if ($attendancecount==0){
														if ($hour>17){?>	
															<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGOUT - PM | <b>Absent</b></a>
														<?php }else{?>
															<a href="pmlogout.php?employee_id=<?php echo $employee->employee_id; ?>" type="button" class="btn btn-block btn-info btn-md">Afternoon LOGOUT</a>
														<?php }?>
													<?php }else{?>
														<?php foreach($attendance->results() as $attendance){?>
															<?php if ($attendance->pm_out === ''){?>
																<a href="pmlogout.php?employee_id=<?php echo $employee->employee_id; ?>" type="button" class="btn btn-block btn-info btn-md">Afternoon LOGOUT</a>
															<?php }else{?>
																<a type="button" class="btn btn-block btn-warning btn-md disabled">LOGOUT - PM | <b><?php echo $attendance->pm_out;?></b></a>
															<?php }?>
														<?php }?>
													<?php }?>
												</div>
												<!-- /.description-block -->
											  </div>
									  <!-- /.col -->
									</div>
								</div>
					<?php 	
							}
						}
					}?>
				</div>
			<!-- /.col -->
			</div>
			<div class="col-md-9 d-flex">
				<div class="card flex-fill">
					<div class="card-header">
						<h5 class="card-title">Attendance Sheet</h5>
						<div class="card-tools">
							<div class="btn-group btn-group-sm">
								
							</div>
									
							<div class="btn-group">
								<button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
								  <i class="fas fa-wrench"></i>
								</button>
								<div class="dropdown-menu dropdown-menu-right" role="menu">
									<a href="#" class="dropdown-item"" data-toggle="modal" data-target="#print_accom"><i class="fas fa-print"></i> &nbsp; Print Monthly Accomplishment</a>
									<a href="#" class="dropdown-item" data-toggle="modal" data-target="#print_dtr"><i class="fas fa-print"></i> &nbsp; Print DTR</a>
								</div>
							</div>
						</div>
										<!-- Modal -->
										<div class="modal fade" id="print_accom" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">Print Monthly Accomplishment</h4>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form enctype="multipart/form-data" method="post" action="empAccomplishment.php" >
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text bg-info"><i class="fa fa-calendar"></i> &nbsp Date(Month, Year) </span>
																	</div>
																	<select class="form-control" name="accom_date" id="accom_date" required>
																		<option hidden value="">Select Date</option>
																		<?php
																		$dates = DB:: getInstance()->query("SELECT DISTINCT DATE_FORMAT(accomplished_date, '%M %Y') as mdate FROM accomplishment WHERE employee_id='".$employee->employee_id."'");
																		foreach($dates->results() as $dates){?>
																			<option value="<?php echo $dates->mdate;?>"><?php echo $dates->mdate; ?></option>
																		<?php }?>
																	</select> 
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">To be Verified by</span>
																	</div>
																	<input type="text" class="form-control" id="verified_by" name="verified_by" placeholder="Enter Complete Name" required >
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">Designation</span>
																	</div>
																	<input type="text" class="form-control" id="designation" name="designation" placeholder="Enter Designation" required >
																</div>
															</div>
												</div>
												<div class="modal-footer">
														<input type="hidden" id="emp_id" name="emp_id" value="<?php echo $user->data()->employee_id; ?>">
														<input type="submit" id="insert" name="insert" class="btn btn-md btn-info" value="Print">
														<button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
													</form>
												</div>
												</div>
											</div>
										</div>
										
										<!-- Modal -->
										<div class="modal fade" id="print_dtr" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-md modal-notify modal-success modal-fluid modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h4 class="modal-title">Generate Monthly DTR</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<form enctype="multipart/form-data" method="post" action="dtr_generate.php" >
															<div class="row">
																<div class="col-lg-12 col-md-12">
																	<div class="input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text bg-info"><i class="fa fa-calendar"></i> &nbsp Month </span>
																		</div>
																		<select class="form-control" name="attend_date" id="attend_date" required>
																			<option hidden value="">Select DTR Period</option>
																			<?php
																			$dates = DB:: getInstance()->query("SELECT DISTINCT DATE_FORMAT(attendance_date, '%M %Y') as mdate FROM attendance WHERE employee_id='".$employee->employee_id."'");
																			foreach($dates->results() as $dates){?>
																				<option value="<?php echo $dates->mdate;?>"><?php echo $dates->mdate; ?></option>
																			<?php }?>
																		</select> 
																	</div>
																</div>
															</div>
															<div class="row mt-3">
																<div class="col-lg-12 col-md-12">
																	<input type="hidden" id="emp_id" name="emp_id" value="<?php echo $employee->employee_id; ?>">
																	<button type="submit" class="btn btn-info btn-block" style="margin-right: 5px;">
																		<i class="fas fa-download"></i> Generate DTR
																	</button>
																</div>
															</div>
														</form>
													</div>
													<div class="modal-footer justify-content-center">
													</div>
												</div>
											</div>
										</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body p-0">
								<div class="table-responsive">
									<table id="example2" class="table table-bordered">
										<thead>
											<tr>	
												<th rowspan="2" width="15%" class="text-center align-middle">Date</th>
												<th colspan="2" class="text-center align-middle">Target VS Accomplishment</th>
												<th rowspan="2" width="7%" class="text-center align-middle"><h3><i class="fa fa-cog"></i></h3></th>
												<th colspan="2" class="text-center">AM</th>
												<th colspan="2" class="text-center">PM</th>
											</tr>
											<tr>
												<th width="18%" class="text-center">Target</th>
												<th width="20%" class="text-center">Accomplishment</th>
												<th width="10%" class="text-center">IN</th>
												<th width="10%" class="text-center">OUT</th>
												<th width="10%" class="text-center">IN</th>
												<th width="10%" class="text-center">OUT</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$attendance = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$user->data()->employee_id."' ORDER BY MONTH(attendance_date) DESC, DAY(attendance_date) DESC");		
												foreach($attendance->results() as $attendance){?>	
													<tr>
														<td class="text-center"><?php echo $attendance->attendance_date;?></td>
														<?php 
														$accom = DB:: getInstance()->query("SELECT * FROM accomplishment WHERE employee_id = '".$user->data()->employee_id."' AND accomplished_date = '".$attendance->attendance_date."'");		
														$accomcount = DB:: getInstance()->count($accom);
														if($accomcount == 0){?>
																<td colspan="2" class="text-center"><button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#add_data_Modal<?php echo $attendance->attendance_date;?>">Add Target and Accomplishment</button></td>
																<td class="text-center"></td>
																<!-- Modal -->
																<div class="modal fade" id="add_data_Modal<?php echo $attendance->attendance_date;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog" role="document">
																		<div class="modal-content">
																		<div class="modal-header">
																			<h4 class="modal-title">Add Accomplishment</h4>
																			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																				<span aria-hidden="true">&times;</span>
																			</button>
																		</div>
																		<div class="modal-body">
																			<form enctype="multipart/form-data" method="post" action="addAccomplishment.php" >
																				<div class="row">
																					<input type="hidden" name="employee_id" value="<?php echo $user->data()->employee_id;?>" >
																					<input type="hidden" name="accom_date" value="<?php echo $attendance->attendance_date;?>" >
																					<div class="col-lg-12 col-md-12">
																						<div class="form-group">
																							<label>Target</label>
																							<textarea class="form-control" rows="3" placeholder="Enter your Target Deliverables Today" required name="target"></textarea>
																						</div>
																					</div>
																					<div class="col-lg-12 col-md-12">
																						<div class="form-group">
																							<label>Accomplishment Today</label>
																							<textarea class="form-control" rows="3" placeholder="Enter your accomplishments today" name="accomplishment"></textarea>
																						</div>
																					</div>
																					<div class="col-lg-12 col-md-12">
																						<div class="form-group">
																							<label>Remarks</label>
																							<textarea class="form-control" rows="2" placeholder="remarks" name="remarks"></textarea>
																						</div>
																					</div>
																				</div>
																		</div>
																		<div class="modal-footer">
																				<input type="submit" id="insert" name="insert" class="btn btn-md btn-info" value="Add Accomplishment">
																				<button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
																			</form>
																		</div>
																		</div>
																	</div>
																</div>
														<?php }else{ 
																foreach($accom->results() as $accom){?>
																	<td class="text-center"><?php echo mb_strimwidth($accom->target, 0, 20, '...'); ?></td>
																	<td class="text-center"><?php echo mb_strimwidth($accom->accomplishment, 0, 20, '...');?> </td>
																	<td>
																		<a href="#" class="btn btn-primary btn-xs edit_data" data-toggle="modal" data-target="#add_data_Modal<?php echo $accom->id; ?>"><i class="fas fa-eye"></i></a>
																		<!-- Modal -->
																		<div class="modal fade" id="add_data_Modal<?php echo $accom->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																			<div class="modal-dialog" role="document">
																				<div class="modal-content">
																				<div class="modal-header">
																					<h4 class="modal-title">Edit Accomplishment</h4>
																					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																						<span aria-hidden="true">&times;</span>
																					</button>
																				</div>
																				<div class="modal-body">
																					<form enctype="multipart/form-data" method="post" action="editAccomplishment.php" >
																						<div class="row">
																							<input type="hidden" name="accom_id" value="<?php echo $accom->id;?>" >
																							<div class="col-lg-12 col-md-12">
																								<div class="form-group">
																									<label>Your Target for Today</label>
																									<textarea class="form-control" rows="3" name="target" ><?php echo $accom->target; ?></textarea>
																								</div>
																							</div>
																							<div class="col-lg-12 col-md-12">
																								<div class="form-group">
																									<label>Your Accomplishment</label>
																									<textarea class="form-control" rows="3" name="accomplishment" ><?php echo $accom->accomplishment; ?></textarea>
																								</div>
																							</div>
																							<div class="col-lg-12 col-md-12">
																								<div class="form-group">
																									<label>Remarks</label>
																									<textarea class="form-control" rows="2" name="remarks"><?php echo $accom->remarks; ?></textarea>
																								</div>
																							</div>
																						</div>
																				</div>
																				<div class="modal-footer">
																						<input type="submit" id="insert" name="insert" class="btn btn-md btn-info" value="Save Changes">
																						<button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
																					</form>
																				</div>
																				</div>
																			</div>
																		</div>
																		<a href="delete_accomplishment.php?id=<?php echo $accom->id;?>" class="btn btn-danger btn-xs btn-del"><i class="fas fa-trash"></i></a>
																	</td>
																<?php } ?>
														<?php } ?>
														<td class="text-center"><?php echo $attendance->am_in;?></td>
														<td class="text-center"><?php echo $attendance->am_out;?></td>
														<td class="text-center"><?php echo $attendance->pm_in;?></td>
														<td class="text-center"><?php echo $attendance->pm_out;?></td>
													</tr>
											<?php 	
												}
											?>
										</tbody>
									</table>
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
<!-- SweetAlert2 -->
<script src="styles/plugins/sweetalert2/sweetalert2.all.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
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
<script type="text/javascript"> 

	function display_c(){
	var refresh=1000; // Refresh rate in milli seconds
	mytime=setTimeout('display_date()',refresh)
	} 
	
	function display_date() {
		var x1 = new Date()
		// date part ///
		var month=x1.getMonth()+1;
		var day=x1.getDate();
		var year=x1.getFullYear();
		if (month <10 ){month='0' + month;}
		if (day <10 ){day='0' + day;}
		var x3= month+'-'+day+'-'+year;
		
		document.getElementById('c_date').innerHTML = x3;
		display_c();
	}
	 
	function display_ct() {
	
	display_c();
	 }
	 
	function getTime( ) {
		var d = new Date( ); 
		d.setHours( d.getHours()); // offset from local time
		var h = (d.getHours() % 12) || 12; // show midnight & noon as 12
		return (
			( h < 10 ? '0' : '') + h +
			( d.getMinutes() < 10 ? ':0' : ':') + d.getMinutes() +
					// optional seconds display
			// ( d.getSeconds() < 10 ? ':0' : ':') + d.getSeconds() + 
			( d.getHours() < 12 ? ' AM' : ' PM' )
		);
		
	}

	var clock = document.getElementById('ct');
	setInterval( function() { clock.innerHTML = getTime(); }, 1000 );
</script>
<script>
	$('.btn-del').on('click', function(e) {
	  e.preventDefault();
	  const href = $(this).attr('href')
	  
	  Swal.fire({
		  text: 'Record will be deleted. Continue?',
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#17a2b8',
		  cancelButtonColor: '#bdbdbd',
		  confirmButtonText: 'Yes',
		  cancelButtonText: 'No',
	  }).then((result) => {
		  if (result.value) {
			  document.location.href = href;
		  }
	  })
  })
	const flashdata_updated = $('.flash-data-updated').data('flashdata')
	  if (flashdata_updated) {
		  Swal.fire({
			  icon: 'success',
			  text: 'Record has been updated.',
			  confirmButtonColor: '#17a2b8',
		  })
	  }
	  
	  const flashdata_deleted = $('.flash-data-deleted').data('flashdata')
	  if (flashdata_deleted) {
		  Swal.fire({
			  icon: 'success',
			  text: 'Record has been deleted.',
			  confirmButtonColor: '#17a2b8',
		  })
	  }
	  
	  const flashdata_added = $('.flash-data-added').data('flashdata')
	  if (flashdata_added) {
		  Swal.fire({
			  icon: 'success',
			  text: 'New record has been added.',
			  confirmButtonColor: '#17a2b8',
		  })
	  }
  
	const flashdata_login_error = $('.flash-data-login-error').data('flashdata')
	if (flashdata_login_error) {
		Swal.fire({
			icon: 'error',
			text: 'Not Time for Logging in.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_logout_error = $('.flash-data-logout-error').data('flashdata')
	if (flashdata_logout_error) {
		Swal.fire({
			icon: 'error',
			text: 'You need to login first.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_logoutam_error = $('.flash-data-logoutam-error').data('flashdata')
	if (flashdata_logoutam_error) {
		Swal.fire({
			icon: 'error',
			text: 'Not Time for Logging out.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_logoutpm_error = $('.flash-data-logoutpm-error').data('flashdata')
	if (flashdata_logoutpm_error) {
		Swal.fire({
			icon: 'error',
			text: 'You need to login in the afternoon.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_loginpm_error = $('.flash-data-loginpm-error').data('flashdata')
	if (flashdata_loginpm_error) {
		Swal.fire({
			icon: 'error',
			text: 'You need to logout in the morning.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_login_already = $('.flash-data-login-already').data('flashdata')
	if (flashdata_login_already) {
		Swal.fire({
			icon: 'error',
			text: 'You have already login.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_login_success = $('.flash-data-login-success').data('flashdata')
	if (flashdata_login_success) {
		Swal.fire({
			icon: 'success',
			text: 'Thank you for logging in.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_logout_success = $('.flash-data-logout-success').data('flashdata')
	if (flashdata_logout_success) {
		Swal.fire({
			icon: 'success',
			text: 'You have successfully logout.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_weekend = $('.flash-data-weekend').data('flashdata')
	if (flashdata_weekend) {
		Swal.fire({
			icon: 'warning',
			text: 'Happy weekend! Have a restful day.',
			confirmButtonColor: '#17a2b8',
		})
	}
</script>
</body>

</html>
