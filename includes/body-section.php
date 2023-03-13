			<section class="banner-area relative">
				<div class="overlay overlay-bg"></div>				
				<div class="container">
					<?php
					if($user->isLoggedIn()) {
						if($user->hasPermission('user')) {
							$user = DB::getInstance()->get('userLogin', array('id','=',Session::get(Config::get('sessions/session_name'))));
							foreach($user->results() as $user){
								$userinfo = DB::getInstance()->get('customer', array('user_uid','=',$user->user_uid));
								foreach($userinfo->results() as $userinfo){?>	
									<div class="row fullscreen align-items-center justify-content-between">
										<div class="col-md-1">
										</div>
										<div class="about-content blog-header-content col-lg-10">	
											<h6 class="text-white">Your home away from home</h6>
											<h1 class="text-white">Make your reservation</h1>
											<p class="text-white">
												This site is created for all tourist who are going to visit the beautiful Municipalities of Surigao del Sur. Specifically the CarCanMadCarLan Area.
												This site consists of different hotels where tourists can relax and have their wonderful vacation as they visit every captivating tourist spots in these towns.
											</p>
											<p class="text-white">
												This also serves as advertising tools for hotel owners to market their own hotels not just within the Province of Surigao del Sur but rather to be known in the world.
											</p>
											<a href="settings.php" class="genric-btn primary text-uppercase e-large">	
												<?php
													echo 'Welcome, ',  $userinfo->fname, ' ' , $userinfo->lname;
												?>
											</a>
										</div>
										<div class="col-md-1">
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-8 banner-right">
											<div class="tab-content" id="myTabContent">
											  <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
												
												<form class="form-wrap" action="hotelSearch.php" method="get">
													<h3 style="text-align: left; margin-bottom:5px;">Search for Hotels</h3>
													<div class="row">
														<div class="col-lg-8">
															<select class="form-control" name="municipality" required>
																<option disabled selected value="">Your Destination</option>
																<option value="carrascal">Carrascal</option>
																<option value="cantilan">Cantilan</option>
																<option value="madrid">Madrid</option>
																<option value="carmen">Carmen</option>
																<option value="lanuza">Lanuza</option>
															</select>
														</div>
														<div class="col-lg-4">
															<button type="submit" class="genric-btn primary text-uppercase">Search Now</button>		
														</div>
													</div>
												</form>
											  </div>
											</div>
										</div>
										<div class="col-md-2">
										</div>
									</div>
						<?php
								}
							}
						}else if ($user->hasPermission('manager')){	?>
									<div class="row fullscreen align-items-center justify-content-center">
										<div class="about-content blog-header-content col-lg-12">	
											<h1 class="text-white">Manage your Hotel</h1>
											<p class="text-white">
												This site is created for all tourist who are going to visit the beautiful Municipalities of Surigao del Sur. Specifically the CarCanMadCarLan Area.
												This site consists of different hotels where tourists can relax and have their wonderful vacation as they visit every captivating tourist spots in these towns.
											</p>
											<p class="text-white">
												This also serves as advertising tools for hotel owners to market their own hotels not just within the Province of Surigao del Sur but rather to be known in the world.
											</p>
											<a href="manager.php" class="primary-btn">Manage your Hotel</a>
										</div>
									</div>
						<?php 
						}else if ($user->hasPermission('admin')){?>
									<div class="row fullscreen align-items-center justify-content-center">
										<div class="about-content blog-header-content col-lg-12">	
											<h1 class="text-white">Welcome Administrator</h1>
											<a href="admin.php" class="primary-btn text-uppercase">Go to Admin Page</a>
										</div>
									</div>
						
						<?php 
						}?>
					<?php
					}else{?>
							<div class="row fullscreen align-items-center justify-content-between">
										<div class="col-md-1">
										</div>
										<div class="about-content blog-header-content col-lg-10">	
											<h6 class="text-white">Your home away from home</h6>
											<h1 class="text-white">Make your reservation</h1>
											<p class="text-white">
												This site is created for all tourist who are going to visit the beautiful Municipalities of Surigao del Sur. Specifically the CarCanMadCarLan Area.
												This site consists of different hotels where tourists can relax and have their wonderful vacation as they visit every captivating tourist spots in these towns.
											</p>
											<p class="text-white">
												This also serves as advertising tools for hotel owners to market their own hotels not just within the Province of Surigao del Sur but rather to be known in the world.
											</p>
											<a href="#" class="primary-btn text-uppercase" data-toggle="modal" data-target="#login">Login</a>
											<a href="register.php" class="primary-btn text-uppercase">Signup</a>
										</div>
										<div class="col-md-1">
										</div>
										<div class="col-md-2">
										</div>
										<div class="col-md-8 banner-right">
											<div class="tab-content" id="myTabContent">
											  <div class="tab-pane fade show active" id="flight" role="tabpanel" aria-labelledby="flight-tab">
												
												<form class="form-wrap" action="hotelSearch.php" method="get">
													<h3 style="text-align: left; margin-bottom:5px;">Search for Hotels</h3>
													<div class="row">
														<div class="col-lg-8">
															<select class="form-control" name="municipality" required>
																<option disabled selected value="">Your Destination</option>
																<option value="carrascal">Carrascal</option>
																<option value="cantilan">Cantilan</option>
																<option value="madrid">Madrid</option>
																<option value="carmen">Carmen</option>
																<option value="lanuza">Lanuza</option>
															</select>
														</div>
														<div class="col-lg-4">
															<button type="submit" class="genric-btn primary text-uppercase">Search Now</button>		
														</div>
													</div>
												</form>
											  </div>
											</div>
										</div>
										<div class="col-md-2">
										</div>
									</div>
							<!-- LOGIN MODAL -->
								<div id="login" class="modal fade">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<!-- Modal Header -->
											<div class="modal-header">
												<h4 class="modal-title">Login</h4>
												<button type="button" class="close" data-dismiss="modal">&times;</button>
											</div>
											<!-- Modal body -->
											<div class="modal-body">
												<form class="form-wrap" method="post" action="login.php">
													
													<input class="form-control" type="text" placeholder="Enter Username" style="margin:5px 0 5px 0" name="username" required>
													<input class="form-control" type="password" placeholder="Enter Password"  style="margin:5px 0 5px 0" name="password" required>     
													<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
													</div>
											<!-- Modal footer -->
												<div class="modal-footer">
													<button class="genric-btn primary text-uppercase" type="submit">Login</button>
													<button class="genric-btn danger text-uppercase" type="button" data-dismiss="modal">Cancel</button>
												</div>												
												</form>
									  </div>
								  </div>
								</div>
							<!-- LOGIN MODAL -->
							</div>
					<?php 
					}?>
				</div>					
			</section>