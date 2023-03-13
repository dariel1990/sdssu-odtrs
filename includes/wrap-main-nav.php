<div class="wrap-main-nav">
				<div class="main-nav">
					<!-- Menu desktop -->
					<nav class="menu-desktop">
						<a class="logo-stick" href="index.html">
							<img src="images/icons/logo-01.png" alt="LOGO">
						</a>

						<ul class="main-menu">
							<li class="mega-menu-item">
								<a href="#">Articles</a>

								<div class="sub-mega-menu">
									<div class="nav flex-column nav-pills" role="tablist">
										<?php
										$category = DB:: getInstance()->query("SELECT * FROM category LIMIT 5");							
										foreach($category->results() as $category){?>
											<a class="nav-link" data-toggle="pill" href="#category-<?php echo $category->id ; ?>" role="tab"><?php echo $category->category ; ?></a>
										<?php }?>
											<a class="nav-link" href="articleArchive.php">View All</a>
									</div>

									<div class="tab-content">
										<?php
											$category = DB:: getInstance()->query("SELECT * FROM category LIMIT 5");		
											foreach($category->results() as $category){?>
										<div class="tab-pane show" id="category-<?php echo $category->id ; ?>" role="tabpanel">
											<div class="row">
												<?php 
												$articles = DB:: getInstance()->query("SELECT * FROM articles WHERE article_category=$category->id LIMIT 4");		
												foreach($articles->results() as $articles){?>
												<div class="col-3">
													<!-- Item post -->	
													<div>
														<a href="viewArticle.php?id=<?php echo $articles->id;?>" class="wrap-pic-w hov1 trans-03">
															<img src="admin/uploads/articleImage/<?php echo $articles->article_image ; ?>" alt="IMG">
														</a>

														<div class="p-t-10">
															<h5 class="p-b-5">
																<a href="viewArticle.php?id=<?php echo $articles->id;?>" class="f1-s-5 cl3 hov-cl10 trans-03">
																	<?php echo $articles->article_title ; ?>
																</a>
															</h5>
															<span class="cl8">
																<a href="categoryList.php?id=<?php echo $category->id; ?>" class="f1-s-6 cl8 hov-cl10 trans-03">
																	<?php echo $category->category ; ?>
																</a>

																<span class="f1-s-3 m-rl-3">
																	-
																</span>

																<span class="f1-s-3">
																	<?php echo date("M d, Y", strtotime($articles->date_published)); ?>
																</span>
															</span>
														</div>
													</div>
												</div>
												<?php }?>
											</div>
										</div>
										<?php }?>
									</div>
								</div>
							</li>
							<?php if($user->isLoggedIn()) {
								if($user->isElStudent()) {?>
									<li>
									<a href="#">E-Learning</a>
									<ul class="sub-menu">
										<li><a href="elearning.php">Elearning Home</a></li>
									</ul>
								</li>
								<?php }else{ ?>
									<!-- Nothing Here -->
								<?php }?>
							<?php }else{ ?>
								<li>
									<a href="#">E-Learning</a>
									<ul class="sub-menu">
										<li><a href="el_login.php">Login</a></li>
										<li><a href="el_register.php">Register</a></li>
									</ul>
								</li>
							<?php }?>
							<li>
								<a href="#">On-The-Job Training</a>
								<ul class="sub-menu">
									<li><a href="ojtprocedure.php">Procedures for OJT Application</a></li>
									<?php if($user->isLoggedIn()) {
										if($user->isOjtStudent()) {?>
											<li><a href="ojt_downloadables.php">Requirement Forms</a></li>
										<?php }else{ ?>
											<!-- Nothing Here -->
										<?php }?>
									<?php }else{ ?>
										<li><a href="trainee_register.php">Register as Trainee</a></li>
									<?php }?>
								</ul>
							</li>
							<li>
								<a href="#">Quality Assurance</a>
								<ul class="sub-menu">
									<li><a href="programs.php">Programs Offered</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Research</a>
								<ul class="sub-menu">
									<li><a href="researchList.php">Researches</a></li>
									<li><a href="research_downloadables.php">Downloadables</a></li>
								</ul>
							</li>
							<li>
								<a href="#">Extension</a>
								<ul class="sub-menu">
									<li><a href="extensionList.php">Extension Services</a></li>
									<li><a href="extension_downloadables.php">Downloadables</a></li>
								</ul>
							</li>
						</ul>
					</nav>
				</div>
			</div>
			<hr style="border:.5px solid #0067a9; padding: 0; margin: 1px 0 10px 0;">
			