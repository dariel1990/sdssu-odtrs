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
	.rTableCell, .rTableHead {
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
            <h1 class="m-0 text-dark">List Of Departments</h1>
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
						<h5 class="card-title">Departments Lists </h5>

						<div class="card-tools">
							<div class="btn-group btn-group-sm">
								<a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#add_data_Modal"><i class="fas fa-plus"></i> &nbsp; Add Department</a>
							</div>
						</div>
					</div>
						<?php if(Session::exists('Deleted')){ ?>
							<div class="flash-data-deleted" data-flashdata="<?php echo Session::flash('Deleted'); ?>"></div>
						<?php }?> 
						<?php if(Session::exists('Added')) { ?>
							<div class="flash-data-added" data-flashdata="<?php echo Session::flash('Added'); ?>"></div>
						<?php }?>
						<?php if(Session::exists('Duplicated')) { ?>
							<div class="flash-data-duplicated" data-flashdata="<?php echo Session::flash('Duplicated'); ?>"></div>
						<?php }?>
						<?php if(Session::exists('Updated')) { ?>
							<div class="flash-data-updated" data-flashdata="<?php echo Session::flash('Updated'); ?>"></div>
						<?php }?>
				  <!-- /.card-header -->
				  <div class="card-body">
					<div class="row">
						<div class="col-md-12">
							<!-- Button trigger modal -->
							<div class="box-body table-responsive">
								<table id="example1" class="table table-bordered table-hover table-sm">
									<thead>
										<tr>
											<th width="40%">Department Name</th>
											<th width="30%" class="text-center">Actions</th>
										</tr>
									</thead>
									<tbody>
										<?php
												$department = DB:: getInstance()->query("SELECT * FROM department ORDER BY parent_id ASC");		
												foreach($department->results() as $department){?>
															<tr>
																<td><?php echo $department->name; ?></td>
																<td class="text-center">
																	<?php if($department->parent_id == 0){ ?>
																		<div class="btn-group btn-group-sm">
																		</div>	
																	<?php }else{ ?>
																		<div class="btn-group btn-group-sm">
																			<a href="#" class="btn btn-primary edit_data" data-toggle="modal" data-target="#add_data_Modal<?php echo $department->id; ?>"><i class="fas fa-edit"></i></a>
																			<a href="delete_department.php?id=<?php echo $department->id;?>" class="btn btn-danger btn-del"><i class="fas fa-trash"></i></a>
																		</div>	
																	<?php } ?>
																</td>
															</tr>
															<!-- Modal -->
															<div class="modal fade" id="add_data_Modal<?php echo $department->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered" role="document">
																	<div class="modal-content">
																	<div class="modal-header">
																		<h4 class="modal-title">DEPARTMENT - <small>Edit</small></h4>
																		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
																			<span aria-hidden="true">&times;</span>
																		</button>
																	</div>
																	<div class="modal-body">
																		<form enctype="multipart/form-data" method="post" action="editDepartment.php" >
																			<input type="hidden" name="dep_id" value="<?php echo $department->id;?>" >
																			<div class="row">
																				<div class="col-lg-12 col-md-12">
																					<div class="input-group mb-3">
																						<div class="input-group-prepend">
																							<span class="input-group-text"><i class="fa fa-building"></i></span>
																						</div>
																						<input type="text" class="form-control" id="dname" name="dname" value="<?php echo $department->name; ?>" required>
																					</div>
																				</div>
																				<div class="col-lg-12 col-md-12">
																					<div class="input-group mb-3">
																						<div class="input-group-prepend">
																							<span class="input-group-text">Parent Department</span>
																						</div>
																						<select class="form-control" name="parent_id" id="parent_id" required>
																							<option hidden value="">Select One</option>
																							<?php
																								$parent_id = DB:: getInstance()->query("SELECT * FROM department");							
																								foreach($parent_id->results() as $parent_id){
																									if ($parent_id->id == $department->parent_id){
																										$selected = 'selected';
																									}else{
																										$selected = '';;
																									}
																							?>
																								<option value="<?php echo $parent_id->id;?>" <?php echo $selected; ?>><?php echo ucwords($parent_id->name); ?></option>
																							<?php }?>
																						</select> 
																					</div>
																				</div>
																			</div>
																	</div>
																	<div class="modal-footer">
																			<input type="submit" class="btn btn-md btn-info" value="Save Changes">
																			<button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
																		</form>
																	</div>
																	</div>
																</div>
															</div>
                                            <?php 	
												}
												?>
									</tbody>
								</table>
							</div><!-- /.box-body -->
						</div>
						<!-- /.row -->
									<!-- Modal -->
									<div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-dialog-centered" role="document">
											<div class="modal-content">
											<div class="modal-header">
												<h4 class="modal-title">DEPARTMENT</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												<form enctype="multipart/form-data" method="post" action="addDepartment.php" >
													<div class="row">
														<div class="col-lg-12 col-md-12">
															<div class="input-group mb-3">
																<div class="input-group-prepend">
																	<span class="input-group-text"><i class="fa fa-building"></i></span>
																</div>
																<input type="text" class="form-control" id="dname" name="dname" placeholder="Department Name" required>
															</div>
														</div>
														<div class="col-lg-12 col-md-12">
															<div class="input-group mb-3">
																<div class="input-group-prepend">
																	<span class="input-group-text">Parent Department</span>
																</div>
																<select class="form-control" name="parent_id" id="parent_id" required>
																	<option hidden value="">Select One</option>
																	<?php
																		$department = DB:: getInstance()->query("SELECT * FROM department ORDER BY id ASC ");							
																		foreach($department->results() as $department){
																	?>
																	<option value="<?php echo $department->id?>"><?php echo $department->name;  ?></option>
																	<?php }?>
																</select> 
															</div>
														</div>
													</div>
											</div>
											<div class="modal-footer">
													<input type="submit" id="insert" name="insert" class="btn btn-md btn-info" value="Add Department">
													<button type="button" class="btn btn-md btn-danger" data-dismiss="modal">Cancel</button>
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
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
	  "ordering": false,
    });
    $('#example2').DataTable({
      "paging": false,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false,
      "responsive": false,
    });
  });
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
  
  $('.btn-del-all').on('click', function(e) {
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
		  text: 'Duplicated entry.',
		  confirmButtonColor: '#17a2b8',
	  })
  }
  
</script>
<script type="text/javascript">
	$(document).ready(function(){
		
		function fill_datatable(attendance_date = ''){
			var emp_id = $('#emp_id').val();
			$.ajax({
				url: "employee_attendance.php",
				type: "post",
				data: {attendance_date:attendance_date, emp_id:emp_id},
				dataType: "text",
				success : function(data){
					$("#reportAttendance").html(data);
					$("#errorReport").html('');
				}
			});
		}
		
		$('#attend_date').change(function(){
			var attend_date = $('#attend_date').val();
			var attendance = document.getElementById("reportAttendance");
			if(attend_date != '' ){
				attendance.remove();
			}else{
				//nothing	
			}
		});
	});
</script>
</body>

</html>
