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
            <h1 class="m-0 text-dark">My Daily Accomplishments</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<!-- Main content -->
    <section class="content">
      <div class="container-fluid">
						<?php if(Session::exists('Deleted')){ ?>
							<div class="flash-data-deleted" data-flashdata="<?php echo Session::flash('Deleted'); ?>"></div>
						<?php }?> 
						<?php if(Session::exists('Added')) { ?>
							<div class="flash-data-added" data-flashdata="<?php echo Session::flash('Added'); ?>"></div>
						<?php }?>
						<?php if(Session::exists('Updated')) { ?>
							<div class="flash-data-updated" data-flashdata="<?php echo Session::flash('Updated'); ?>"></div>
						<?php }?>
						<?php if(Session::exists('Weekend')){ ?>
							<div class="flash-data-weekend" data-flashdata="<?php echo Session::flash('Weekend'); ?>"></div>
						<?php }?> 
						<?php if(Session::exists('AcommError')){ ?>
							<div class="flash-accom-error" data-flashdata="<?php echo Session::flash('AcommError'); ?>"></div>
						<?php }?> 
        <div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title">My Accomplishments</h3>
						<div class="card-tools">
							<div class="btn-group btn-group-sm">
								<a href="#" class="btn btn-default btn-xs" data-toggle="modal" data-target="#add_data_Modal"><i class="fas fa-plus"></i>  Add Accomplishment</a>
							</div>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example2" class="table table-responsive table-bordered">
							<thead>
								<tr>
									<th width="10%" class="text-center">Date</th>
									<th width="10%" class="text-center">Day</th>
									<th width="15%" class="text-center">Actual Time Log</th>
									<th width="40%" class="text-center">Actual Accomplishment</th>
									<th width="15%" class="text-center">Remarks</th>
									<th width="10%" class="text-center">Actions</th>
								</tr>
							</thead>
							<tbody>
									<?php 	
												$accom = DB:: getInstance()->query("SELECT * FROM accomplishment WHERE employee_id = '".$user->data()->employee_id."'");		
												foreach($accom->results() as $accom){
													$getdate = $accom->accomplished_date;
													$unixTimestamp = strtotime($getdate);
													$dayOfWeek = date("l", $unixTimestamp);
													?>
															<tr>
																<td class="text-center"><?php echo $accom->accomplished_date;?></td>
																<td class="text-center"><?php echo $dayOfWeek;?></td>
																<?php $att = DB:: getInstance()->query("SELECT * FROM attendance WHERE employee_id = '".$accom->employee_id."' AND attendance_date = '".$accom->accomplished_date."'");		
																foreach($att->results() as $att){?>
																	<td><?php echo $att->am_in." - ".$att->am_out." / ".$att->pm_in." - ".$att->pm_out;?></td>
																<?php }?>
																<td><?php echo $accom->accomplishment;?></td>
																<td class="text-center"><?php echo $accom->remarks;?></td>
																<td class="text-center">
																	<div class="btn-group btn-group-sm">
																		<a href="#" class="btn btn-primary edit_data" data-toggle="modal" data-target="#add_data_Modal<?php echo $accom->id; ?>"><i class="fas fa-edit"></i></a>
																		<a href="delete_accomplishment.php?id=<?php echo $accom->id;?>" class="btn btn-danger btn-del"><i class="fas fa-trash"></i></a>
																	</div>
																</td>
															</tr>
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
																						<label>Your Accomplishment</label>
																						<textarea class="form-control" rows="3" name="accomplishment" required><?php echo $accom->accomplishment; ?></textarea>
																					</div>
																				</div>
																				<div class="col-lg-12 col-md-12">
																					<div class="form-group">
																						<label>Remarks</label>
																						<textarea class="form-control" rows="2" name="remarks" required><?php echo $accom->remarks; ?></textarea>
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
												<?php 	}?>
							</tbody>
						</table>
					</div>
									<!-- Modal -->
									<div class="modal fade" id="add_data_Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
														<div class="col-lg-12 col-md-12">
															<div class="form-group">
																<label>Accomplishment Today</label>
																<textarea class="form-control" rows="3" placeholder="Enter your accomplishments today" required name="accomplishment"></textarea>
															</div>
														</div>
														<div class="col-lg-12 col-md-12">
															<div class="form-group">
																<label>Remarks</label>
																<textarea class="form-control" rows="2" placeholder="Enter remarks" required name="remarks"></textarea>
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
      "info": false,
      "autoWidth": false,
      "responsive": true,
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
  
  const flashdata_weekend = $('.flash-data-weekend').data('flashdata')
	if (flashdata_weekend) {
		Swal.fire({
			icon: 'warning',
			text: 'Happy weekend! Have a restful day.',
			confirmButtonColor: '#17a2b8',
		})
	}
	
	const flashdata_accom_error = $('.flash-accom-error').data('flashdata')
	if (flashdata_accom_error) {
		Swal.fire({
			icon: 'info',
			text: 'You should have an attendance to create your accomplishment.',
			confirmButtonColor: '#17a2b8',
		})
	}
  
</script>

</body>

</html>
