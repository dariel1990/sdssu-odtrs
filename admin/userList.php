<?php
if (Input::exists()) {
		$user = DB:: getInstance()->delete('userlogin', array('id','=',Input::get('id')));													
		Session::flash('Deleted', 'Record has been successfully deleted.');
		Redirect::to('index.php?action=userList');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<!-- bootstrap 3.0.2 -->
<link href="styles/admin/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<!-- font Awesome -->
<link href="styles/admin/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
<link href="styles/admin/css/all.css" rel="stylesheet" type="text/css" />
<!-- Ionicons -->
<link href="styles/admin/css/ionicons.min.css" rel="stylesheet" type="text/css" />
<!-- bootstrap wysihtml5 - text editor -->
<link href="styles/admin/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css" rel="stylesheet" type="text/css" />
<!-- Theme style -->
<link href="styles/admin/css/AdminLTE.css" rel="stylesheet" type="text/css" />
<!-- DATA TABLES -->
<link href="styles/admin/css/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<!-- Bootstrap Validator CSS -->
    <link href="styles/user/css/bootstrapValidator.min.css" rel="stylesheet">
    <!-- Bootstrap Validator CSS -->
    <link href="styles/user/css/formValidation.css" rel="stylesheet">
    <script type="text/javascript">
		$(document).ready(function () {
		 $("#username").blur(function () {
		 var username = $(this).val();
		 if (username == '') {
				$("#userAvailable").html("");
			 }else{
				$.ajax({
				  url: "usernameValidation.php?uname="+username
				}).done(function( data ) {
				  $("#userAvailable").html(data);
				});   
			  } 
		   });
		   
	</script>
<title>SDSSU Cantilan Campus</title>
</head>
<body class="skin-blue">
        <!-- header logo: style can be found in header.less -->
        <?php include_once('navigation.php'); ?>

            <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                        User Lists
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="index.php"><i class="fa fa-tachometer-alt"></i> Home</a></li>
                        <li class="active">User Lists</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">User Lists</h3>    
                                    <div class="pull-right box-tools">
                                        <button class="btn btn-primary btn-sm" data-widget='collapse' data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                        <button class="btn btn-primary btn-sm" data-widget='remove' data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                    </div><!-- /. tools -->                                
                                </div><!-- /.box-header -->
                                <div class="box-body table-responsive">
                                    <?php if(Session::exists('Deleted')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Deleted'); ?>
                                             </div>
                                    <?php }?> 
                                    <?php if(Session::exists('UserUpdated')){ ?>
                                             <div class="alert alert-success">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('UserUpdated'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('Error')){ ?>
                                             <div class="alert alert-danger">
                                                <i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('Error'); ?>
                                             </div>
                                    <?php }?>
									<?php if(Session::exists('UserAdded')) { ?>
                                            <div class="alert alert-success">
												<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('UserAdded'); ?>
											</div>
									<?php }?>
                                    <table class="table table-bordered table-hover" id="articles">
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>User Role</th>
												<th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$username = DB:: getInstance()->query("SELECT * FROM userlogin");							
												foreach($username->results() as $username){
													$userRole = DB:: getInstance()->query("SELECT * FROM groups WHERE id = '$username->permission'");							
													foreach($userRole->results() as $userRole){	?>
														<tr>
														
															<td><?php echo $username->username ; ?></td>
															<td><?php echo $userRole->name; ?></td>
															
															<td align="center">
																<?php require_once ('delete-confirm.php');?>
																<?php if ($username->permission == 1 && $username->username == $user->data()->username) {?>
																<form method="POST" action="index.php?action=settings" style="display:inline">
																	<button class="btn btn-xs btn-primary" type="submit">
																		<i class="glyphicon glyphicon-edit"></i> Edit
																	</button>
																</form>
																<?php }else{?>
																<form method="POST" action="" style="display:inline">
																	<input type="hidden" name="id" value="<?php echo $username->id;  ?>">
																	<button class="btn btn-xs btn-danger" type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete User" data-message="Are you sure you want to delete this?">
																		<i class="glyphicon glyphicon-trash"></i> Delete
																	</button>
																</form>
																<form method="POST" action="index.php?action=editUser&&uid=<?php echo $username->id; ?>" style="display:inline">
																	<button class="btn btn-xs btn-primary" type="submit">
																		<i class="glyphicon glyphicon-edit"></i> Edit
																	</button>
																</form>
																<?php }?>
																
															</td>
														</tr>
                                            <?php 	
													}
												}
												?>
                                        </tbody>
                                    </table>
                                </div><!-- /.box-body -->
								<div class="box-footer">
                                	<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
									Add New User
									</button>
									<!-- Modal -->
									<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h3 class="modal-title" id="exampleModalLabel">Add New User</h3>
										</div>
										<div class="modal-body">
											<form method="post" action="addUser.php">
												<label class="control-label" for="username"><font color="#EC0003">*</font> Username</label> 
												<div class="form-group">
													<input type="text" class="form-control" id="username" name="username" placeholder="Input Username" required>
													<span id="userAvailable"></span>
												</div>
												<label class="control-label" for="password"><font color="#EC0003">*</font> Password</label>
												<div class="form-group">
													<input type="password" class="form-control" id="password" name="password" placeholder="Input Password" required>
												</div>
												<label class="control-label" for="userRole"><font color="#EC0003">*</font> User Role:</label>
												<div class="form-group">
													<select class="form-control" name="userRole" id="userRole" required>
														<option hidden value="">Select Role</option>
														<?php
															$userRole = DB:: getInstance()->query("SELECT * FROM groups WHERE permission != ''");							
															foreach($userRole->results() as $userRole){
														?>
														<option value="<?php echo $userRole->id?>"><?php echo ucwords($userRole->name) ?></option>
														<?php }?>
													</select> 
												</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-success" value="save"><i class="glyphicon glyphicon-edit"></i> Save</button>
											<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
											</form>
										</div>
										</div>
									</div>
									</div>
                                </div>
                            </div><!-- /.box -->

                        </div><!-- /.col -->
                    </div><!-- /.row (main row) -->
					
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
        </div><!-- ./wrapper -->

<!-- jQuery 2.0.2 -->
<script src="styles/admin/js/jquery.min.js"></script>
<!-- jQuery UI 1.10.3 -->
<script src="styles/admin/js/jquery-ui-1.10.3.min.js" type="text/javascript"></script>
<!-- Bootstrap -->
<script src="styles/admin/js/bootstrap.min.js" type="text/javascript"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="styles/admin/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
<!-- DATA TABES SCRIPT -->
<script src="styles/admin/js/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
<script src="styles/admin/js/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<!-- AdminLTE App -->
<script src="styles/admin/js/AdminLTE/app.js" type="text/javascript"></script>
<!-- page script -->
<!-- Bootstrap Validator JS -->
<script src="styles/user/js/bootstrapValidator.min.js"></script> 
<!-- Bootstrap Validator JS -->
<script src="styles/user/js/formValidation.js"></script>
<script src="styles/user/js/framework/bootstrap.js"></script>
<script type="text/javascript">
    $(function() {
        $("#articles").dataTable();
    });
</script>
<script type="text/javascript">
  $('#confirmDelete').on('show.bs.modal', function (e) {
	  var $message = $(e.relatedTarget).attr('data-message');
	  $(this).find('.modal-body p').text($message);
	  $title = $(e.relatedTarget).attr('data-title');
	  $(this).find('.modal-title').text($title);

	  // Pass form reference to modal for submission on yes/ok
	  var form = $(e.relatedTarget).closest('form');
	  $(this).find('.modal-footer #confirm').data('form', form);
  });
  <!-- Form confirm (yes/ok) handler, submits form -->
  $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
	  $(this).data('form').submit();
  });
</script>
</body>

</html>
