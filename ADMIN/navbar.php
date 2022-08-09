<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
				<div
					class="search-toggle-icon bi bi-search"
					data-toggle="header_search"
				></div>
				<div class="header-search">
					<form>
						<div class="form-group mb-0">
							<i class="dw dw-search2 search-icon"></i>
							<input
								type="text"
								class="form-control search-input"
								placeholder="Search Here"
							/>
							<div class="dropdown">
								<a
									class="dropdown-toggle no-arrow"
									href="#"
									role="button"
									data-toggle="dropdown"
								>
									<i class="ion-arrow-down-c"></i>
								</a>
								<div class="dropdown-menu dropdown-menu-right">
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>From</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label">To</label>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-sm-12 col-md-2 col-form-label"
											>Subject</label
										>
										<div class="col-sm-12 col-md-10">
											<input
												class="form-control form-control-sm form-control-line"
												type="text"
											/>
										</div>
									</div>
									<div class="text-right">
										<button class="btn btn-primary">Search</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="header-right">
				<div class="user-notification">
					<div class="dropdown">
						<a
							class="dropdown-toggle no-arrow"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<i class="icon-copy dw dw-notification"></i>
							<span class="badge notification-active"></span>
						</a>
						<div class="dropdown-menu dropdown-menu-right">
							<div class="notification-list mx-h-350 customscroll">
								<ul>

								<?php


									$getusers = "SELECT DISTINCT u.iduser, u.idcard, u.nom, u.prenom, u.email, u.telephone FROM users as u, message as m
												WHERE u.iduser = m.idfrom AND m.idto = ".$idadmin." AND type like 'u' AND m.statut = 0";

									$users = $DB->executeSQL($getusers);

									$idcard = null;

									if($users->num_rows > 0){

										for($i = 0 ; $i < $users->num_rows ; $i++){
										
											$row = $users->fetch_assoc();

											$idcard = $row["idcard"];

											$nbrnewmsgsSQL = "SELECT count(*) FROM message WHERE idfrom = ".$row['iduser']." AND idto = ".$idadmin." AND type like 'u' AND  statut = 0";
											
											$nbrmsgsresult = $DB->executeSQL($nbrnewmsgsSQL);
											
											if($nbrmsgsresult->num_rows > 0){
												
												if($rowmsgs = $nbrmsgsresult->fetch_assoc()){
										
													$nbrmsgs = $rowmsgs['count(*)'];
												}

											}

									?>

									<li>
										<a href="reclamations.php?idcon=<?php echo $row['iduser'];?>">
											<img src="../idcards/<?php echo $idcard;?>" alt="" />
											<h3><?php echo $row["nom"]." ".$row["prenom"];?></h3>
											<p>
												<i class="fa fa-circle text-light-green"></i> <?php if($nbrmsgs > 0){ echo $nbrmsgs." Nouveaux message";}?>
											</p>
										</a>
									</li>
									<?php
										}
									}
									?>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<img src="vendors/images/photo1.jpg" alt="" />
							</span>
							<span class="user-name"><?php echo $prenom.' '.$nom;?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-user1"></i> Profile</a
							>
							<a class="dropdown-item" href="profile.html"
								><i class="dw dw-settings2"></i> Setting</a
							>
							<a class="dropdown-item" href="logout.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>
