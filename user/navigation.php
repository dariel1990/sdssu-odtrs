
<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-info navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
    </ul>

   
	<ul class="navbar-nav ml-auto">
		<li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
			<?php 
					$usercname = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$user->data()->employee_id."'");		
					foreach($usercname->results() as $usercname){?>
						<?php echo $usercname->fname." ".substr($usercname->mname, 0, 1).". ".$usercname->lname." ".$usercname->suffix; ?>	
				<?php }?> &nbsp;
			<img src="admin/uploads/avatar/<?php echo $user->data()->avatar?>" class="user-image img-circle" alt="User Image">
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- User image -->
          <li class="user-header bg-default">
            <img src="admin/uploads/avatar/<?php echo $user->data()->avatar?>" class="img-circle elevation-2" alt="User Image">

            <p>
				<?php 
					$usercname = DB:: getInstance()->query("SELECT * FROM employee WHERE employee_id = '".$user->data()->employee_id."'");		
					foreach($usercname->results() as $usercname){
						$emp_dep = DB:: getInstance()->query("SELECT * FROM emp_department WHERE employee_id = '".$user->data()->employee_id."'");		
						foreach($emp_dep->results() as $emp_dep){?>
						<?php echo $usercname->fname." ".substr($usercname->mname, 0, 1).". ".$usercname->lname." ".$usercname->suffix; ?>	
						<small><?php echo $emp_dep->position; ?></small>
				<?php 
						}
					}?>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <a href="index.php?action=settings" class="btn btn-default btn-flat">Profile</a>
            <a href="logout.php" class="btn btn-default btn-flat float-right">Sign out</a>
          </li>
        </ul>
      </li>
	</ul>

    
  </nav>
  <!-- /.navbar -->
  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-info elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <span class="brand-text font-weight-light">SDSSU ODTRS</span>
    </a>
	
    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="index.php" class="nav-link <?php if (!isset($_GET['action'])){echo 'active';}else{ echo '';} ?>">
              <i class="nav-icon fas fa-check"></i>
              <p>Attendance</p>
            </a>
          </li>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
