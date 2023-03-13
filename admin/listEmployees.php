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
		.rTable {
			display: table;
			width: 100%;
		}

		.rTableRow {
			display: table-row;
		}

		.rTableHeading {
			display: table-header-group;
			background-color: #ddd;
		}

		.rTableCell,
		.rTableHead {
			display: table-cell;
			padding: 3px 10px;
			border: 1px solid #999999;
		}

		.rTableHeading {
			display: table-header-group;
			background-color: #ddd;
			font-weight: bold;
		}

		.rTableFoot {
			display: table-footer-group;
			font-weight: bold;
			background-color: #ddd;
		}

		.rTableBody {
			display: table-row-group;
		}

		.input-group>.input-group-prepend {
			flex: 0 0 30%;
		}

		.input-group .input-group-text {
			width: 100%;
		}

		th:first-child,
		td:first-child {
			position: sticky;
			left: 0px;
			background-color: grey;
		}
	</style>
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
							<h1 class="m-0 text-dark">List Of Employees</h1>
						</div><!-- /.col -->
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
									<h5 class="card-title">Employee Lists </h5>

									<div class="card-tools">
										<div class="btn-group btn-group-sm">
											<a href="#" class="btn btn-default btn-xs" data-toggle="modal"
												data-target="#add_data_Modal"><i class="fas fa-plus"></i> &nbsp; Add
												Employee</a>
										</div>
									</div>
								</div>
								<?php if(Session::exists('Deleted')){ ?>
								<div class="flash-data-deleted"
									data-flashdata="<?php echo Session::flash('Deleted'); ?>"></div>
								<?php }?>
								<?php if(Session::exists('Added')) { ?>
								<div class="flash-data-added" data-flashdata="<?php echo Session::flash('Added'); ?>">
								</div>
								<?php }?>
								<?php if(Session::exists('Duplicated')) { ?>
								<div class="flash-data-duplicated"
									data-flashdata="<?php echo Session::flash('Duplicated'); ?>"></div>
								<?php }?>
								<?php if(Session::exists('Duplicated_id')) { ?>
								<div class="flash-data-duplicated-id"
									data-flashdata="<?php echo Session::flash('Duplicated_id'); ?>"></div>
								<?php }?>
								<?php if(Session::exists('Updated')) { ?>
								<div class="flash-data-updated"
									data-flashdata="<?php echo Session::flash('Updated'); ?>"></div>
								<?php }?>
								<?php if(Session::exists('passwordChanged')) { ?>
								<div class="flash-data-update-emp-pass"
									data-flashdata="<?php echo Session::flash('passwordChanged'); ?>"></div>
								<?php }?>
								<!-- /.card-header -->
								<div class="card-body">
									<div class="row">
										<div class="col-md-12">
											<!-- Button trigger modal -->
											<div class="box-body table-responsive">
												<table id="example2" class="table table-bordered table-hover table-sm">
													<thead>
														<tr>
															<th width="10%">Emp ID</th>
															<th width="25%">Employee Name</th>
															<th width="25%">Department</th>
															<th width="25%">Designation</th>
															<th width="15%" class="text-center">Actions</th>
														</tr>
													</thead>
													<tbody>
														<?php
												$employee = DB:: getInstance()->query("SELECT * FROM employee ORDER BY lname ASC");		
												foreach($employee->results() as $employee){
													$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE employee_id = '".$employee->employee_id."'");		
													foreach($userlogin->results() as $userlogin){
														$emp_department = DB:: getInstance()->query("SELECT e.position position, g.name des, e.department_id dep_id FROM emp_department e LEFT JOIN groups g ON g.id = e.group_id WHERE employee_id = '".$employee->employee_id."'");		
														foreach($emp_department->results() as $emp_department){
															$department = DB:: getInstance()->query("SELECT * FROM department WHERE id = '".$emp_department->dep_id."'");		
															foreach($department->results() as $department){?>
														<tr>
															<td class="text-nowrap">
																<?php echo $employee->employee_id; ?></td>
															<td class="text-nowrap">
																<?php echo $employee->lname.", ".$employee->fname." ".$employee->suffix." ".substr($employee->mname, 0, 1); ?>
															</td>
															<td class="text-nowrap"><?php echo $department->name; ?>
															</td>
															<td class="text-nowrap">
																<?php echo $emp_department->position; ?></td>
															<td class="text-center text-nowrap">
																<div class="btn-group btn-group-sm">
																	<a href="#" class="btn btn-primary edit_data"
																		data-toggle="modal"
																		data-target="#add_data_Modal<?php echo $employee->employee_id; ?>"><i
																			class="fas fa-edit"></i></a>
																	<a href="#" class="btn btn-info view_data"
																		data-toggle="modal"
																		data-target="#view_data_Modal<?php echo $employee->employee_id; ?>"><i
																			class="fas fa-eye"></i></a>
																	<a href="delete_employee.php?id=<?php echo $employee->employee_id;?>"
																		class="btn btn-danger btn-del"><i
																			class="fas fa-trash"></i></a>
																</div>
															</td>
														</tr>
														<!-- Modal -->
														<div class="modal fade"
															id="add_data_Modal<?php echo $employee->employee_id; ?>"
															tabindex="-1" role="dialog"
															aria-labelledby="exampleModalLabel" aria-hidden="true">
															<div class="modal-dialog modal-dialog-centered"
																role="document">
																<div class="modal-content">
																	<div class="modal-header bg-primary">
																		<h5 class="modal-title">EMPLOYEE -
																			<small>Edit</small></h5>
																		<button type="button" class="close"
																			data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form enctype="multipart/form-data"
																			method="post" action="editEmployeeID.php">
																			<input type="hidden" name="emp_id"
																				value="<?php echo $employee->id; ?>">
																			<input type="hidden" name="old_empid"
																				value="<?php echo $employee->employee_id; ?>">
																			<div class="row">
																				<div class="col-lg-12 col-md-12">
																					<div class="input-group mb-3">
																						<div
																							class="input-group-prepend">
																							<span
																								class="input-group-text"><i
																									class="fa fa-id-card"></i>&nbsp;
																								EMPLOYEE ID</span>
																						</div>
																						<input type="text"
																							class="form-control"
																							id="employee_id"
																							name="employee_id"
																							value="<?php echo $employee->employee_id; ?>"
																							required>
																						<div
																							class="input-group-prepend">
																							<input
																								class="btn btn-primary w-100"
																								type="submit"
																								value="Update ID">
																						</div>
																					</div>
																				</div>
																		</form>
																		<form enctype="multipart/form-data"
																			method="post" action="editEmployee.php">
																			<input type="hidden" name="emp_id"
																				value="<?php echo $employee->id; ?>">

																			<div class="col-lg-12 col-md-12">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">First
																							Name</span>
																					</div>
																					<input type="text"
																						class="form-control" id="fname"
																						name="fname"
																						placeholder="Firstname"
																						value="<?php echo $employee->fname; ?>"
																						required>
																				</div>
																			</div>
																			<div class="col-lg-12 col-md-12">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Middle
																							Name</span>
																					</div>
																					<input type="text"
																						class="form-control" id="mname"
																						name="mname"
																						placeholder="Middle Name"
																						value="<?php echo $employee->mname; ?>"
																						required>
																				</div>
																			</div>
																			<div class="col-lg-12 col-md-12">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Last
																							Name</span>
																					</div>
																					<input type="text"
																						class="form-control" id="lname"
																						name="lname"
																						placeholder="Lastname"
																						value="<?php echo $employee->lname; ?>"
																						required>
																				</div>
																			</div>
																			<div class="col-lg-6 col-md-6">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Name
																							Extension</span>
																					</div>
																					<?php
																							$suffix =array	(		'Sr' => 'Sr',
																													'Jr' => 'Jr',
																													'III' => 'III',
																													'IV' => 'IV',
																													'V' => 'V',
																												);?>
																					<select name="suffix"
																						class="form-control"
																						id="suffix">
																						<option value="">None</option>
																						<?php
																								foreach($suffix as $value => $key):
																									if ($value == $employee->suffix){
																										$selected = 'selected';
																									}else{
																										$selected = '';
																									}?>
																						<option
																							value="<?php echo $value; ?>"
																							<?php echo $selected; ?>>
																							<?php echo $key; ?></option>
																						<?php endforeach;?>
																					</select>
																				</div>
																			</div>
																			<div class="col-lg-6 col-md-6">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Gender:</span>
																					</div>
																					<?php
																							$gender =array	(		'male' => 'Male',
																													'female' => 'Female',
																												);?>
																					<select name="gender"
																						class="form-control"
																						id="gender">
																						<option value="">None</option>
																						<?php
																								foreach($gender as $value => $key):
																									if ($value == $employee->gender){
																										$selected = 'selected';
																									}else{
																										$selected = '';
																									}?>
																						<option
																							value="<?php echo $value; ?>"
																							<?php echo $selected; ?>>
																							<?php echo $key; ?></option>
																						<?php endforeach;?>
																					</select>
																				</div>
																			</div>
																			<div class="col-lg-12 col-md-12">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Department</span>
																					</div>
																					<select class="form-control"
																						name="department"
																						id="department" required>
																						<option hidden value="">Select
																							One</option>
																						<?php
																									$emp_dep = DB:: getInstance()->query("SELECT * FROM emp_department WHERE employee_id = '".$employee->employee_id."'");	
																											foreach($emp_dep->results() as $emp_dep){
																												if($emp_dep->group_id == 2){
																													$department = DB:: getInstance()->query("SELECT * FROM department WHERE id NOT IN (0) ORDER BY id ASC ");							
																													foreach($department->results() as $department){
																														if ($department->id == $emp_dep->department_id){
																															$selected = 'selected';
																														}else{
																															$selected = '';;
																														}?>
																						<option
																							value="<?php echo $department->id?>"
																							<?php echo $selected; ?>>
																							<?php echo $department->name;  ?>
																						</option>
																						<?php }?>
																						<?php }else{
																													$department = DB:: getInstance()->query("SELECT * FROM department WHERE parent_id NOT IN (0) ORDER BY id ASC ");							
																													foreach($department->results() as $department){
																														if ($department->id == $emp_dep->department_id){
																															$selected = 'selected';
																														}else{
																															$selected = '';;
																														}?>
																						<option
																							value="<?php echo $department->id?>"
																							<?php echo $selected; ?>>
																							<?php echo $department->name;  ?>
																						</option>
																						<?php }?>
																						<?php }?>
																						<?php }?>
																					</select>
																				</div>
																			</div>
																			<div class="col-lg-12 col-md-12">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Position</span>
																					</div>
																					<select class="form-control"
																						name="permission"
																						id="permission" required>
																						<option hidden value="">Select
																							One</option>
																						<?php
																									$emp_dep = DB:: getInstance()->query("SELECT * FROM emp_department WHERE employee_id = '".$employee->employee_id."'");	
																											foreach($emp_dep->results() as $emp_dep){
																												if($emp_dep->group_id == 2){
																													$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id NOT IN (1) ORDER BY is_admin DESC ");							
																													foreach($groups->results() as $groups){
																														if ($groups->id == $userlogin->permission){
																															$selected = 'selected';
																														}else{
																															$selected = '';;
																														}?>
																						<option
																							value="<?php echo $groups->id?>"
																							<?php echo $selected; ?>>
																							<?php echo $groups->name;  ?>
																						</option>
																						<?php }?>
																						<?php }else{
																													$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id NOT IN (0,1) ORDER BY is_admin DESC ");							
																													foreach($groups->results() as $groups){
																														if ($groups->id == $userlogin->permission){
																															$selected = 'selected';
																														}else{
																															$selected = '';;
																														}?>
																						<option
																							value="<?php echo $groups->id?>"
																							<?php echo $selected; ?>>
																							<?php echo $groups->name;  ?>
																						</option>
																						<?php }?>
																						<?php }?>
																						<?php }?>
																					</select>
																				</div>
																			</div>
																			<div class="col-lg-12 col-md-12">
																				<div class="input-group mb-3">
																					<div class="input-group-prepend">
																						<span
																							class="input-group-text">Designation</span>
																					</div>
																					<input type="text"
																						class="form-control"
																						id="position" name="position"
																						placeholder="Job Position"
																						value="<?php echo $emp_department->position; ?>"
																						required>
																				</div>
																			</div>
																	</div>
																	<hr class="p-0">
																	<div class="row">
																		<div class="col-lg-12 col-md-12">
																			<div class="input-group mb-3">
																				<div class="input-group-prepend">
																					<span
																						class="input-group-text">Username</span>
																				</div>
																				<input type="text" class="form-control"
																					id="username" name="username"
																					placeholder="Job Position"
																					value="<?php echo $userlogin->username; ?>"
																					required>
																			</div>
																		</div>
																		<div class="col-lg-12 col-md-12">
																			<a href="editEmployeePass.php?uid=<?php echo $userlogin->id; ?>"
																				class="btn btn-md btn-primary btn-block">Revert
																				Password</a>
																		</div>
																	</div>

																</div>
																<div class="modal-footer">
																	<input type="submit" class="btn btn-md btn-primary"
																		value="Save Changes">
																	<button type="button" class="btn btn-md btn-danger"
																		data-dismiss="modal">Cancel</button>
																	</form>
																</div>
															</div>
														</div>
											</div>

											<!-- Modal -->
											<div class="modal fade"
												id="view_data_Modal<?php echo $employee->employee_id; ?>" tabindex="-1"
												role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-md modal-notify modal-success modal-fluid modal-dialog-centered"
													role="document">
													<div class="modal-content">
														<div class="modal-header">
															<h4 class="modal-title">Employee Info</h4>
															<button type="button" class="close" data-dismiss="modal"
																aria-label="Close">
																<span aria-hidden="true">&times;</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="row">
																<div class="col-lg-12 col-md-12 d-flex">
																	<div class="card card-widget widget-user flex-fill">
																		<!-- Add the bg color to the header using any of the bg-* classes -->
																		<div class="widget-user-header bg-info">
																			<h3 class="widget-user-username">
																				<?php echo $employee->fname." ".substr($employee->mname, 0, 1).". ".$employee->lname." ".$employee->suffix; ?>
																			</h3>
																			<?php $emp_dep = DB:: getInstance()->query("SELECT * FROM emp_department WHERE employee_id = '$userlogin->employee_id'");		
																					foreach($emp_dep->results() as $emp_dep){?>
																			<h5 class="widget-user-desc">
																				<?php echo $emp_dep->position; ?></h5>
																			<?php }?>
																		</div>
																		<div class="widget-user-image">
																			<img class="img-circle elevation-2"
																				src="admin/uploads/avatar/<?php echo $userlogin->avatar;?>"
																				alt="User Avatar">
																		</div>
																		<div class="card-footer flex-fill">
																			<div class="row">
																				<div class="col-sm-12">
																					<div class="description-block">
																						<h3><?php echo $employee->employee_id; ?>
																						</h3>
																						<span
																							class="description-text">Employee
																							ID</span>
																					</div>
																					<hr>
																					<div class="description-block">
																						<?php 
																							$min_late = DB:: getInstance()->query("SELECT SUM(mins_late) min_late FROM attendance WHERE employee_id='".$employee->employee_id."'");
																							foreach($min_late->results() as $min_late){?>
																						<h3><?php echo $min_late->min_late; ?>
																						</h3>
																						<?php }?>
																						<span
																							class="description-text">Total
																							Late in Minutes</span>
																					</div>
																					<hr>
																					<div class="description-block">
																						<h4>Generate Monthly DTR</h4>
																						<form
																							enctype="multipart/form-data"
																							method="post"
																							action="dtr_generate.php">
																							<div class="row">
																								<div
																									class="col-lg-12 col-md-12">
																									<div
																										class="input-group">
																										<div
																											class="input-group-prepend">
																											<span
																												class="input-group-text bg-info"><i
																													class="fa fa-calendar"></i>
																												&nbsp
																												Month
																											</span>
																										</div>
																										<select
																											class="form-control"
																											name="attend_date"
																											id="attend_date"
																											required>
																											<option
																												hidden
																												value="">
																												Select
																												DTR
																												Period
																											</option>
																											<?php
																													$dates = DB:: getInstance()->query("SELECT DISTINCT DATE_FORMAT(attendance_date, '%M %Y') as mdate FROM attendance WHERE employee_id='".$employee->employee_id."'");
																													foreach($dates->results() as $dates){?>
																											<option
																												value="<?php echo $dates->mdate;?>">
																												<?php echo $dates->mdate; ?>
																											</option>
																											<?php }?>
																										</select>
																									</div>
																								</div>
																							</div>
																							<div class="row mt-3">
																								<div
																									class="col-lg-12 col-md-12">
																									<input type="hidden"
																										id="emp_id"
																										name="emp_id"
																										value="<?php echo $employee->employee_id; ?>">
																									<button
																										type="submit"
																										class="btn btn-info btn-block"
																										style="margin-right: 5px;">
																										<i
																											class="fas fa-download"></i>
																										Generate DTR
																									</button>
																								</div>
																							</div>
																						</form>
																					</div>
																					<hr>
																					<!-- /.description-block -->
																				</div>
																				<!-- /.col -->
																			</div>
																			<!-- /.row -->
																		</div>
																	</div>
																</div>

															</div>
															<div class="modal-footer justify-content-center">
															</div>
														</div>
													</div>
												</div>
											</div>


											<?php 	
															}
														}
													}
												}
												?>
											</tbody>
											</table>
										</div><!-- /.box-body -->
									</div>
									<!-- /.row -->
									<!-- Modal -->
									<div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog"
										aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h4 class="modal-title">EMPLOYEE</h4>
													<button type="button" class="close" data-dismiss="modal"
														aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													<form enctype="multipart/form-data" method="post"
														action="addEmployee.php">
														<div class="row">
															<div class="col-lg-12 col-md-12">
																<h5>Employee Information<h5>
																		<hr>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text"><i
																				class="fa fa-id-card"></i>&nbsp;
																			EMPLOYEE ID</span>
																	</div>
																	<input type="text" class="form-control"
																		id="employee_id" name="employee_id"
																		placeholder="Enter Employee ID" required>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text"><i
																				class="fa fa-user"></i>&nbsp; First
																			Name</span>
																	</div>
																	<input type="text" class="form-control" id="fname"
																		name="fname" placeholder="Firstname" required>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text"><i
																				class="fa fa-user"></i>&nbsp; Middle
																			Name </span>
																	</div>
																	<input type="text" class="form-control" id="mname"
																		name="mname" placeholder="Middle Name" required>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text"><i
																				class="fa fa-user"></i>&nbsp; Last
																			Name</span>
																	</div>
																	<input type="text" class="form-control" id="lname"
																		name="lname" placeholder="Lastname" required>
																</div>
															</div>
															<div class="col-lg-6 col-md-6">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">Name
																			Extension</span>
																	</div>
																	<select class="form-control" name="suffix"
																		id="suffix">
																		<option value="">None</option>
																		<option value="Sr">Sr</option>
																		<option value="Jr">Jr</option>
																		<option value="III">III</option>
																		<option value="IV">IV</option>
																		<option value="V">V</option>
																	</select>
																</div>
															</div>
															<div class="col-lg-6 col-md-6">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">Gender:</span>
																	</div>
																	<select class="form-control" name="gender"
																		id="gender">
																		<option hidden value="">Select One</option>
																		<option value="male">Male</option>
																		<option value="female">Female</option>
																	</select>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">Department</span>
																	</div>
																	<select class="form-control" name="department"
																		id="department" required>
																		<option hidden value="">Select One</option>
																		<?php
																		$emp_dep = DB:: getInstance()->query("SELECT * FROM emp_department WHERE group_id = 2");	
																		$emp_depcount = DB:: getInstance()->count($emp_dep);	
																			if(($emp_depcount == 0)){
																				$department = DB:: getInstance()->query("SELECT * FROM department ORDER BY id ASC ");							
																				foreach($department->results() as $department){?>
																		<option value="<?php echo $department->id?>">
																			<?php echo $department->name;  ?></option>
																		<?php }?>
																		<?php }else{
																				$department = DB:: getInstance()->query("SELECT * FROM department WHERE parent_id NOT IN (0) ORDER BY id ASC ");							
																				foreach($department->results() as $department){?>
																		<option value="<?php echo $department->id?>">
																			<?php echo $department->name;  ?></option>
																		<?php }?>
																		<?php }?>
																	</select>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span class="input-group-text">Position</span>
																	</div>
																	<select class="form-control" name="permission"
																		id="permission" required>
																		<option hidden value="">Select One</option>
																		<?php
																		$emp_dep = DB:: getInstance()->query("SELECT * FROM emp_department WHERE group_id = 2");	
																		$emp_depcount = DB:: getInstance()->count($emp_dep);	
																			if(($emp_depcount == 0)){
																				$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id NOT IN (1) ORDER BY is_admin DESC ");							
																				foreach($groups->results() as $groups){?>
																		<option value="<?php echo $groups->id?>">
																			<?php echo $groups->name;  ?></option>
																		<?php }?>
																		<?php }else{
																				$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id NOT IN (1,2) ORDER BY is_admin DESC ");							
																				foreach($groups->results() as $groups){?>
																		<option value="<?php echo $groups->id?>">
																			<?php echo $groups->name;  ?></option>
																		<?php }?>
																		<?php }?>
																	</select>
																</div>
															</div>
															<div class="col-lg-12 col-md-12">
																<div class="input-group mb-3">
																	<div class="input-group-prepend">
																		<span
																			class="input-group-text">Designation</span>
																	</div>
																	<input type="text" class="form-control"
																		id="position" name="position"
																		placeholder="Job Position" required>
																</div>
															</div>

														</div>
												</div>
												<div class="modal-footer">
													<input type="submit" id="insert" name="insert"
														class="btn btn-md btn-info" value="Add Employee">
													<button type="button" class="btn btn-md btn-danger"
														data-dismiss="modal">Cancel</button>
													</form>
												</div>
											</div>
										</div>
									</div>


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
	<!-- jquery-validation -->
	<script src="styles/plugins/jquery-validation/jquery.validate.min.js"></script>
	<script src="styles/plugins/jquery-validation/additional-methods.min.js"></script>
	<script>
		$(function () {
			$("#example1").DataTable({
				"responsive": true,
				"autoWidth": false,
				"ordering": false,
			});
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": true,
				"ordering": false,
				"info": true,
				"autoWidth": false,
				"responsive": false,
			});
		});
	</script>
	<script>
		$('.btn-del').on('click', function (e) {
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

		$('.btn-del-all').on('click', function (e) {
			e.preventDefault();
			const href = $(this).attr('href')

			Swal.fire({
				text: 'All records will be deleted. Continue?',
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

		const flashdata_duplicated = $('.flash-data-duplicated').data('flashdata')
		if (flashdata_duplicated) {
			Swal.fire({
				icon: 'error',
				text: 'Employee already exists.',
				confirmButtonColor: '#17a2b8',
			})
		}

		const flashdata_duplicated_id = $('.flash-data-duplicated-id').data('flashdata')
		if (flashdata_duplicated_id) {
			Swal.fire({
				icon: 'error',
				text: 'Employee ID already exists.',
				confirmButtonColor: '#17a2b8',
			})
		}

		const flashdata_update_emp_pass = $('.flash-data-update-emp-pass').data('flashdata')
		if (flashdata_update_emp_pass) {
			Swal.fire({
				icon: 'success',
				text: 'Employee password reverted.',
				confirmButtonColor: '#17a2b8',
			})
		}
	</script>
	<script type="text/javascript">
		$(document).ready(function () {

			function fill_datatable(attendance_date = '') {
				var emp_id = $('#emp_id').val();
				$.ajax({
					url: "employee_attendance.php",
					type: "post",
					data: {
						attendance_date: attendance_date,
						emp_id: emp_id
					},
					dataType: "text",
					success: function (data) {
						$("#reportAttendance").html(data);
						$("#errorReport").html('');
					}
				});
			}

			$('#attend_date').change(function () {
				var attend_date = $('#attend_date').val();
				var attendance = document.getElementById("reportAttendance");
				if (attend_date != '') {
					attendance.remove();
				} else {
					//nothing	
				}
			});
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function () {
			$('#changepassword').validate({
				rules: {
					currentPassword: {
						required: true,
						minlength: 6
					},
					newPassword: {
						required: true,
						minlength: 6
					},
					confirmNewPassword: {
						required: true,
						minlength: 6,
						equalTo: newPassword,
					},
				},
				messages: {
					currentPassword: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long"
					},
					newPassword: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long"
					},
					confirmNewPassword: {
						required: "Please provide a password",
						minlength: "Your password must be at least 6 characters long",
						equalTo: "This must be the same as the password"
					},
				},
				errorElement: 'span',
				errorPlacement: function (error, element) {
					error.addClass('invalid-feedback');
					element.closest('.form-group').append(error);
				},
				highlight: function (element, errorClass, validClass) {
					$(element).addClass('is-invalid');
				},
				unhighlight: function (element, errorClass, validClass) {
					$(element).removeClass('is-invalid');
				}
			});
		});
	</script>
	<script>
		$(document).ready(function () {
			$("#cancelPass").click(function () {
				$("#change").show();
				$("#changePass").hide();
				$("#changepassmessage").show();
			});

			$("#change").click(function () {
				$("#change").hide();
				$("#changePass").show();
				$("#changepassmessage").hide();
			});

			$("#cancelUsername").click(function () {
				$("#editUsername").show();
				$("#changeUname").hide();
				$("#changeUsernameMessage").show();
			});

			$("#editUsername").click(function () {
				$("#editUsername").hide();
				$("#changeUname").show();
				$("#changeUsernameMessage").hide();
			});
		});
	</script>
</body>

</html>