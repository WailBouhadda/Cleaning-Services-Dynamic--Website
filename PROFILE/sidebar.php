<!-- #section:basics/sidebar -->
<div id="sidebar" class="sidebar  responsive  ace-save-state">
				<script type="text/javascript">
					try{ace.settings.loadState('sidebar')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<!-- #section:basics/sidebar.layout.shortcuts -->
						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>

						<!-- /section:basics/sidebar.layout.shortcuts -->
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list">
					<li class="<?php if($page === "DASHBOARD"){ echo "active"; }; ?>">
						<a href="dashboard.php">
							<i class="menu-icon fa fa-tachometer"></i>
							<span class="menu-text"> Dashboard </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php if($page === "RESERVATIONS"){ echo "active"; }; ?>">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list"></i>
							<span class="menu-text"> Reservations </span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if($page === "AJOUTER RESERVATION"){ echo "active"; }; ?>">
								<a href="ajouterreservation.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Ajouter
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if($page === "LIST RESERVATIONS"){ echo "active"; }; ?>">
								<a href="listreservation.php">
									<i class="menu-icon fa fa-caret-right"></i>
									List
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>

					<li class="<?php if($page === "MES SEANCES"){ echo "active"; }; ?>">
						<a href="calendar.html">
							<i class="menu-icon fa fa-calendar"></i>

							<span class="menu-text">
								Mes Seances
							</span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="<?php if($page === "ASSISTANCE"){ echo "active"; }; ?>">
						<a href="gallery.html">
							<i class="menu-icon fa fa-headset"></i>
							<span class="menu-text"> Assistance </span>
						</a>

						<b class="arrow"></b>
					</li>

					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-user"></i>

							<span class="menu-text">
								Profile
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="<?php if($page === "PROFILE"){ echo "active"; }; ?>">
								<a href="faq.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Profile
								</a>

								<b class="arrow"></b>
							</li>

							<li class="<?php if($page === "Settings"){ echo "active"; }; ?>">
								<a href="error-404.html">
									<i class="menu-icon fa fa-caret-right"></i>
									Settings
								</a>

								<b class="arrow"></b>
							</li>
						</ul>
					</li>
				</ul><!-- /.nav-list -->

				<!-- #section:basics/sidebar.layout.minimize -->
				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<!-- /section:basics/sidebar.layout.minimize -->
			</div>

			<!-- /section:basics/sidebar -->