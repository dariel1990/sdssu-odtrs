<div class="row">
	<div class="col-lg-4">
	</div>
    <div class="col-lg-4">
   
		<h2>Signup</h2><hr/>
		
         <?php if(Session::exists('registerSuccess')){?>
				 <div class="alert alert-success">
					<i class="glyphicon glyphicon-ok"></i> &nbsp;<?php echo Session::flash('registerSuccess'); ?>
				 </div>
		<?php }?>
		 <?php if(Session::exists('registerFailed')){?>
				 <div class="alert alert-danger">
					<i class="glyphicon glyphicon-warning-sign"></i> &nbsp;<?php echo Session::flash('registerFailed'); ?>
				 </div>
		<?php }?>
            <form id="register" action="" method="post">
					<div class="form-group">
						<input class="user" name="permission" value="1" type="radio" checked><font style="font-size:18px;"> As CUSTOMER or TOURIST</font><br>
					</div>
					<div class="form-group">
						<input class="user" name="permission" value="3" type="radio" ><font style="font-size:18px;"> As HOTEL OWNER or MANAGER</font>
					</div>
					<hr/>
					
					<h3>Personal Information</h3><hr/>
					
					<div class="form-group">
                        <label class="control-label" for="fname">First Name <font color="#EC0003">*</font></label>
                        <input type="text" class="form-control" id="fname" name="fname" placeholder="First Name" required>
                    </div>
					<div class="form-group">
                        <label class="control-label" for="mname">Middle Name - <font color="#a8abad">Optional</font></label>
                        <input type="text" class="form-control" id="mname" name="mname" placeholder="Middle Name">
                    </div>
					<div class="form-group">
                        <label class="control-label" for="lname">Last Name <font color="#EC0003">*</font></label>
                        <input type="text" class="form-control" id="lname" name="lname" placeholder="Last Name" required>
                    </div>
					<div class="form-group">
                        <label class="control-label" for="address">Address <font color="#EC0003">*</font></label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Address" required>
                    </div>
					<div class="form-group">
                        <label class="control-label" for="contact">Contact <font color="#EC0003">*</font></label>
                        <input type="text" class="form-control" id="contact" name="contact" placeholder="Contact Number" required>
                    </div>
					<hr/>
					<h3>LOGIN Information</h3><hr/>
					
                    <div class="form-group">
                        <label class="control-label" for="emailAdd">Email Address <font color="#EC0003">*</font></label>
                        <input type="text" class="form-control" id="emailAdd" name="emailAdd" placeholder="Email Address" required>
                         <span id="emailAvailable"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="username">Username <font color="#EC0003">*</font></label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Your desired username." required>
                        <span id="userAvailable"></span>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="password">Password <font color="#EC0003">*</font></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Your desired password." required>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="confirmpassword">Confirm Password <font color="#EC0003">*</font></label>
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password" required>
                    </div>
                <hr />
                <div class="form-group">
                    <input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
                    <button type="submit" class="btn btn-block btn-success">
                        <i class="glyphicon glyphicon-ok "></i>&nbsp;Register
                    </button>
                </div>
                <br />
            </form>               
			<p>
				Already have an account? Click <a href="login.php">here</a> to Login.
			</p>
    </div>
	<div class="col-lg-4">
	</div>
</div>