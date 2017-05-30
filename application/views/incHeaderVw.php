			<!-- start: header -->

			<header class="header">
				<div class="logo-container">
					<a href="#" class="logo">
						<img src="<?php echo base_url(); ?>assets/porto/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>

				<!-- start: search & user box -->
				<div class="header-right">


					<span class="separator"></span>

					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?php echo base_url(); ?>assets/porto/images/sule2.jpg" alt="<?php echo $userName;?>" class="img-circle" data-lock-picture="<?php echo base_url(); ?>assets/porto/images/sule2.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="<?php echo $userName;?>" data-lock-email="<?php echo $fullname;?>">
								<span class="name"><?php echo $userName;?></span>
								<span class="role"><?php echo $fullname;?></span>
							</div>

							<i class="fa custom-caret"></i>
						</a>

						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
 								<li>
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>main/do_logout"><i class="fa fa-power-off"></i> Logout</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="<?php echo base_url(); ?>password/change_password"><i class="fa fa-pencil-square-o"></i> Change Password</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>


			<!-- end: header -->
