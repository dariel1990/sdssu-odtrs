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
            <h1 class="m-0 text-dark">Account Settings</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
		<?php if(Session::exists('UsernameUpdated')){ ?>
			<div class="flash-username-updated" data-flashdata="<?php echo Session::flash('UsernameUpdated'); ?>"></div>
		<?php }?> 
		<?php if(Session::exists('passwordChanged')){ ?>
			<div class="flash-password-changed" data-flashdata="<?php echo Session::flash('passwordChanged'); ?>"></div>
		<?php }?> 
		<?php if(Session::exists('wrongPassword')){ ?>
			<div class="flash-wrong-password" data-flashdata="<?php echo Session::flash('wrongPassword'); ?>"></div>
		<?php }?> 
		<?php if(Session::exists('UserInfoUpdated')){ ?>
			<div class="flash-userinfo-updated" data-flashdata="<?php echo Session::flash('UserInfoUpdated'); ?>"></div>
		<?php }?> 
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-3 d-flex">
					<div class="card card-widget widget-user flex-fill">
						<?php
						if($user->isSuperAdmin() && $user->isAdmin()) {
								$permission = $user->data()->permission;
									$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id = '$permission'");		
									foreach($groups->results() as $groups){?>
										<!-- Add the bg color to the header using any of the bg-* classes -->
										<div class="widget-user-header bg-danger">
											<h3 class="widget-user-username">
												<?php echo 'DARIEL C. BONGABONG'; ?>	
											</h3>
											<h5 class="widget-user-desc"><?php echo $groups->name; ?></h5>
										</div>
										<div class="widget-user-image">
											<?php if($user->data()->avatar == ""){?>
												<img class="img-circle elevation-2" src="admin/uploads/avatar/1581677259.jpg" alt="User Avatar">
											<?php }else{?>
												<img class="img-circle elevation-2" src="admin/uploads/avatar/1581677259.jpg" alt="User Avatar">
											<?php }?>	
										</div>
										<div class="card-body">
											<hr>
											<a class="btn btn-warning btn-block disabled"><b>ABOUT ME</b></a>
											<hr>
											<strong><i class="fas fa-book mr-1"></i> Education</strong>

											<p class="text-muted">
											  B.S. in Computer Science from the Surigao del Sur State University
											</p>

											<hr>

											<strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

											<p class="text-muted">
											  <span class="tag text-danger">UI Design</span>
											  <span class="tag text-success">Coding</span>
											  <span class="tag text-info">Javascript</span>
											  <span class="tag text-warning">PHP</span>
											</p>
										</div>
						<?php					
								}
						}else{
							$employee = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$user->data()->employee_id."'");		
							foreach($employee->results() as $employee){
								$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE employee_id = '".$employee->employee_id."'");	
								foreach($userlogin->results() as $userlogin){
									$groups = DB:: getInstance()->query("SELECT * FROM groups WHERE id = '$userlogin->permission'");		
									foreach($groups->results() as $groups){?>
										<div class="widget-user-header bg-danger">
											<h3 class="widget-user-username">
												<?php echo $employee->fname." ".substr($employee->mname, 0, 1).". ".$employee->lname." ".$employee->suffix; ?>
											</h3>
											<h5 class="widget-user-desc"><?php echo $groups->name; ?></h5>
										</div>	
										<div class="widget-user-image">
											<img class="img-circle elevation-2" src="user/uploads/avatar/<?php echo $userlogin->avatar; ?>" alt="User Avatar">
										</div>
										<div class="card-body mt-2">
											<hr>
											<a class="btn btn-warning btn-block disabled"><h3 class="text-center"><?php echo $employee->employee_id; ?></h3></a>
											<p class="text-center">
											  Employee ID
											</p>
											<hr>
										</div>
						<?php					
									}
								}
							}
						}?>
						
					</div>
				<!-- /.col -->
				</div>
				<div class="col-md-9 d-flex">
					<div class="card flex-fill">
						<div class="card-header p-2">
							<h4>Account Settings </h4>
						</div><!-- /.card-header -->
						<?php 
						if($user->isSuperAdmin() && $user->isAdmin()) {
							$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE id = '".$user->data()->id."'");		
							foreach($userlogin->results() as $userlogin){?>
							<div class="card-body">
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-2">
											</div>
											<div class="col-md-10">
												<h5>Login Details</h5>
												<hr>
											</div>
										</div>
										<form enctype="multipart/form-data" method="post" action="editusername.php">
											<div class="row">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Username</label>
												</div>
												<div class="col-md-7 form-group">
													<input type="hidden" name="user_id" value="<?php echo $userlogin->id;?>" >
													<input type="text" class="form-control" name="username" id="username" value="<?php echo $userlogin->username;?>">
												</div>
												<div class="col-md-3">
													<button type="submit" class="btn btn-danger btn-md btn-block">Save Changes</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
									  <div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
										<div class="col-sm-10">
											<a class="btn btn-default" id="change">Change Your Password Here</a>
											<div id="changePass" style="display: none">
												<b>Change your password here</b><hr>
												<form role="form" id="changepassword" method="post" action="change_password.php">
													<div class="form-group">
														<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password">
													</div>        
													<div class="form-group">
														<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" >
													</div>
													<div class="form-group">
														<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" >
													</div>
													<button type="submit" class="btn btn-default">Save Changes</button>	
													<button id="cancelPass" type="button" class="btn btn-danger">Cancel</button>	
												</form>
											</div>
										</div>
									  </div>
									</div>  								
								</div>
								<div class="row mt-3">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-2">
											</div>
											<div class="col-md-10">
												<h5>User Information</h5>
												<hr>
											</div>
										</div>
										<form enctype="multipart/form-data" method="post">
											<div class="row">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Firstname</label>
												</div>
												<div class="col-md-10">
													<input type="email" class="form-control" id="inputName" value="Dariel" readonly>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Middle Name</label>
												</div>
												<div class="col-md-10">
													<input type="email" class="form-control" id="inputName" value="Cuartero" readonly>
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Lastname</label>
												</div>
												<div class="col-md-10">
													<input type="email" class="form-control" id="inputName" value="Bongabong" readonly>
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php }}?>
						<?php 
						if($user->isAdmin() && !$user->isSuperAdmin()) {
							$userlogin = DB:: getInstance()->query("SELECT * FROM userlogin  WHERE id = '".$user->data()->id."'");		
							foreach($userlogin->results() as $userlogin){?>
							<div class="card-body">
								<div class="row">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-2">
											</div>
											<div class="col-md-10">
												<h5>Login Details</h5>
												<hr>
											</div>
										</div>
										<form enctype="multipart/form-data" method="post" action="editusername.php">
											<div class="row">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Username</label>
												</div>
												<div class="col-md-7">
													<input type="hidden" name="user_id" value="<?php echo $userlogin->id;?>" >
													<input type="text" class="form-control" name="username" id="username" value="<?php echo $userlogin->username;?>">
												</div>
												<div class="col-md-3">
													<button type="submit" class="btn btn-danger btn-md btn-block">Save Changes</button>
												</div>
											</div>
										</form>
									</div>
								</div>
								<div class="row mt-3">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
									  <div class="form-group row">
										<label for="inputEmail" class="col-sm-2 col-form-label">Password</label>
										<div class="col-sm-10">
											<a class="btn btn-default" id="change">Change Your Password Here</a>
											<div id="changePass" style="display: none">
												<b>Change your password here</b><hr>
												<form role="form" id="changepassword" method="post" action="change_password.php">
													<div class="form-group">
														<input type="password" class="form-control" id="currentPassword" name="currentPassword" placeholder="Current Password">
													</div>        
													<div class="form-group">
														<input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="New Password" >
													</div>
													<div class="form-group">
														<input type="password" class="form-control" id="confirmNewPassword" name="confirmNewPassword" placeholder="Confirm New Password" >
													</div>
													<button type="submit" class="btn btn-default">Save Changes</button>	
													<button id="cancelPass" type="button" class="btn btn-danger">Cancel</button>	
												</form>
											</div>
										</div>
									  </div>
									</div>  								
								</div>
								<div class="row mt-3">
									<div class="col-md-1">
									</div>
									<div class="col-md-10">
										<div class="row">
											<div class="col-md-2">
											</div>
											<div class="col-md-10">
												<h5>User Information</h5>
												<hr>
											</div>
										</div>
										<form enctype="multipart/form-data" method="post" action="edituserinfo.php">
											<input type="hidden" name="employee_id" value="<?php echo $userlogin->employee_id;?>" >
											<div class="row">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Firstname</label>
												</div>
												<div class="col-md-10">
													<input type="text" class="form-control" name="fname" id="fname" value="<?php echo $employee->fname;?>">
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Middle Name</label>
												</div>
												<div class="col-md-10">
													<input type="text" class="form-control" name="mname" id="mname" value="<?php echo $employee->mname;?>">
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-2">
													<label for="inputName" class="col-form-label">Lastname</label>
												</div>
												<div class="col-md-10">
													<input type="text" class="form-control" name="lname" id="lname" value="<?php echo $employee->lname;?>">
												</div>
											</div>
											<div class="row mt-3">
												<div class="col-md-2">
												</div>
												<div class="col-md-10">
													<button type="submit" class="btn btn-danger">Save Changes</button>	
												</div>
											</div>
										</form>
									</div>
								</div>
							</div>
						<?php }}?>
						<!-- /.tab-content -->
					</div><!-- /.card-body -->
				</div>
				<!-- /.col -->
			</div>
		</div>
		<!-- /.row -->
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
<!-- jquery-validation -->
<script src="styles/plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="styles/plugins/jquery-validation/additional-methods.min.js"></script>
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
<script>
  const flashdata_username_updated = $('.flash-username-updated').data('flashdata')
  if (flashdata_username_updated) {
	  Swal.fire({
		  icon: 'success',
		  text: 'Username updated.',
		  confirmButtonColor: '#17a2b8',
	  })
  }
  
  const flashdata_password_changed = $('.flash-password-changed').data('flashdata')
  if (flashdata_password_changed) {
	  Swal.fire({
		  icon: 'success',
		  text: 'Password has been changed.',
		  confirmButtonColor: '#17a2b8',
	  })
  }
  
  const flashdata_wrong_password = $('.flash-wrong-password').data('flashdata')
  if (flashdata_wrong_password) {
	  Swal.fire({
		  icon: 'error',
		  text: 'Current password is incorrect.',
		  confirmButtonColor: '#17a2b8',
	  })
  }
  
  const flashdata_userinfo_updated = $('.flash-userinfo-updated').data('flashdata')
  if (flashdata_userinfo_updated) {
	  Swal.fire({
		  icon: 'success',
		  text: 'User information updated.',
		  confirmButtonColor: '#17a2b8',
	  })
  }
  
</script>
<script>
$(document).ready(function(){
	$("#cancelPass").click(function(){
		$("#change").show();
		$("#changePass").hide();
		$("#changepassmessage").show();				
	});
	
	$("#change").click(function(){
		$("#change").hide();
		$("#changePass").show();
		$("#changepassmessage").hide();			
	});
	
	$("#cancelUsername").click(function(){
		$("#editUsername").show();
		$("#changeUname").hide();
		$("#changeUsernameMessage").show();			
	});
	
	$("#editUsername").click(function(){
		$("#editUsername").hide();
		$("#changeUname").show();
		$("#changeUsernameMessage").hide();			
	});
});
</script>
<script type="text/javascript">
$(document).ready(function () {
  $('#changepassword').validate({
    rules: {
      currentPassword: {
        required: true
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
        required: "Please provide a password"
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
</body>

</html>
