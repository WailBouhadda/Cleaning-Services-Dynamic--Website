	<!-- #section:basics/navbar.layout -->
    <div id="navbar" class="navbar navbar-default          ace-save-state">
			<div class="navbar-container ace-save-state" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="#" class="navbar-brand">
						<small>
                        <i class="fa-solid fa-broom"></i>
							ALLOMENAGE
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

					<?php

						$nbrmsg = 0;
						  
						$getidadminSQL = "SELECT DISTINCT idto FROM message WHERE idfrom = ".$idclient." AND type like 'u'";

						$getidadmin = $DB->executeSQL($getidadminSQL);
						

						if($getidadmin->num_rows > 0){

							if($row = $getidadmin->fetch_assoc()){
						
								$idadmin = $row["idto"];

								$getadmin = "SELECT  nom, prenom FROM admin WHERE idadmin = ".$idadmin;

								$admin = $DB->executeSQL($getadmin);

								if($admin->num_rows > 0){

									if($row = $admin->fetch_assoc()){
									
										$nomadmin = $row['nom'];
										$prenomadmin = $row['prenom'];

									}
								}

							}

									$getmessagesSQL = "SELECT * FROM message WHERE  (idfrom = ".$idadmin." AND idto = ".$idclient." AND type like 'a') AND statut = 0 ORDER BY date";

								$messages = $DB->executeSQL($getmessagesSQL);

								$nbrmsg =  $messages->num_rows;


						}

						
						
					
					?>

						<li class="green dropdown-modal">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success"><?php echo $nbrmsg?></span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									<?php echo $nbrmsg." "?> Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<?php
										
											if($messages->num_rows > 0){

												for($i = 0 ; $i < $user->num_rows ; $i++){
					
													$row = $messages->fetch_assoc();
					
													$date = strtotime($row['date']);

													$msgtime = date('H:i',$date);
											
										?>
										<li>
											<a href="assistance.php" class="clearfix">
												<img src="assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue"><?php echo $prenomadmin." ".$nomadmin;?></span>
														<?php echo $row['message'];?>
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span><?php echo $msgtime;?></span>
													</span>
												</span>
											</a>
										</li>

										<?php
										
												}
											}
										?>

									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="assistance.php">
										Voir tous les messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue dropdown-modal">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?php echo$nom." ".$prenom; ?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="settings.php">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.php">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="logout.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>

		<!-- /section:basics/navbar.layout -->