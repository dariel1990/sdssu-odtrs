						<div class="topbar">
							<div class="content-topbar container h-100">
								<?php if($user->isLoggedIn()) {
										if($user->isAdmin()) {?>
											<div class="left-topbar">
												<a href="index.php" class="left-topbar-item">Home</a>
												<a href="about.php" class="left-topbar-item">About</a>
												<a href="contact.php" class="left-topbar-item">Contact</a>
											</div>
											<div class="right-topbar">
												<a href="admin.php?action=settings" class="right-topbar-item"> <i class="fa fa-user-circle"></i> <?php echo $user->data()->username;?></a>
												<a href="admin.php" class="right-topbar-item">Admin Page</a>
												<a href="logout.php" class="right-topbar-item"> Logout</a>
											</div>
										<?php }else{ ?>
											<div class="left-topbar">
												<a href="index.php" class="left-topbar-item">Home</a>
												<a href="about.php" class="left-topbar-item">About</a>
												<a href="contact.php" class="left-topbar-item">Contact</a>
											</div>
											<?php if($user->isElStudent()) {?>
												<div class="right-topbar">
													<a href="elearning.php" class="right-topbar-item"> <i class="fa fa-user-circle"></i> <?php echo $user->data()->username;?></a>
													<a href="logout.php" class="right-topbar-item"> Logout</a>
												</div>
											<?php }?>
											<?php if($user->isOjtStudent()) {?>
												<div class="right-topbar">
													<a href="profile.php" class="right-topbar-item"> <i class="fa fa-user-circle"></i> <?php echo $user->data()->username;?></a>
													<a href="messages.php" class="right-topbar-item">Messages</a>
													<a href="logout.php" class="right-topbar-item"> Logout</a>
												</div>
											<?php }?>
										<?php }?>
								<?php }else{ ?>
								<div class="left-topbar">
									<a href="index.php" class="left-topbar-item">Home</a>
									<a href="about.php" class="left-topbar-item">About</a>
									<a href="contact.php" class="left-topbar-item">Contact</a>
									<a href="login.php" class="left-topbar-item">Log in</a>
								</div>

								<div class="right-topbar">
									
								</div>
								<?php }?>
							</div>
						</div>

						<!-- Header Mobile -->
						<div class="wrap-header-mobile">
							<!-- Logo moblie -->		
							<div class="logo-mobile">
								<a href="index.php"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
							</div>

							<!-- Button show menu -->
							<div class="btn-show-menu-mobile hamburger hamburger--squeeze m-r--8">
								<span class="hamburger-box">
									<span class="hamburger-inner"></span>
								</span>
							</div>
						</div>

						<!-- Menu Mobile -->
						<div class="menu-mobile">
							<ul class="topbar-mobile">
								<?php if($user->isLoggedIn()) {
										if($user->isAdmin()) {?>
											<div class="left-topbar">
												<a href="index.php" class="left-topbar-item">Home</a>
												<a href="about.php" class="left-topbar-item">About</a>
												<a href="contact.php" class="left-topbar-item">Contact</a>
											</div>
											<div class="right-topbar">
												<a href="admin.php?action=settings" class="right-topbar-item"> <i class="fa fa-user-circle"></i> <?php echo $user->data()->username;?></a>
												<a href="admin.php" class="right-topbar-item">Admin Page</a>
												<a href="logout.php" class="right-topbar-item"> Logout</a>
											</div>
										<?php }else{ ?>
											<div class="left-topbar">
												<a href="index.php" class="left-topbar-item">Home</a>
												<a href="about.php" class="left-topbar-item">About</a>
												<a href="contact.php" class="left-topbar-item">Contact</a>
											</div>
											<div class="right-topbar">
												<a href="profile.php" class="right-topbar-item"> <i class="fa fa-user-circle"></i> <?php echo $user->data()->username;?></a>
												<a href="messages.php" class="right-topbar-item">Messages</a>
												<a href="logout.php" class="right-topbar-item"> Logout</a>
											</div>
										<?php }?>
								<?php }else{ ?>
								<div class="left-topbar">
									<a href="index.php" class="left-topbar-item">Home</a>
									<a href="about.php" class="left-topbar-item">About</a>
									<a href="contact.php" class="left-topbar-item">Contact</a>
									<a href="login.php" class="left-topbar-item">Log in</a>
								</div>

								<div class="right-topbar">
									
								</div>
								<?php }?>
							</ul>

							<ul class="main-menu-m">
								<li>
									<a href="index.php">Home</a>
								</li>
							</ul>
						</div>
						
						<!--  -->
						<div class="wrap-logo container">
							<!-- Logo desktop -->	
								<div class="logo">
									<a href="index.php"><img src="images/icons/logo-01.png" alt="LOGO"></a>
								</div>	
								<!-- Banner -->
								<div class="banner-header">
									<a href="#"><img src="images/banner-01.jpg" alt="IMG"></a>
								</div>
						</div>
						<hr style="border:.5px solid #0067a9; padding: 0; margin:0 0 1px 0;">