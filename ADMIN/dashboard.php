<?php

require_once("tools/DBconnection.php");
require("entities/admin.php");

$page = "DASHBOARD";

$DB = new DBconnection;

session_start();

$admin = new admin;

$admin = $_SESSION['admin'];

if($admin != null){

	$idadmin = $admin->getId();
	$nom = $admin->getNom();
	$prenom = $admin->getPrenom();
	$email = $admin->getEmail();
  
  }else{
  
	header("Location:login.php");
  
  }





  $today = date('Y-m-d');



  /* nbrseances */
  $seancesSQL = "SELECT count(*) FROM reservation WHERE dateseance < '".$today."'";
						  
  $seances = $DB->executeSQL($seancesSQL);
		  
	  
  if($seances->num_rows > 0){

	  	if($row = $seances->fetch_assoc()){
			$nbrseances = $row['count(*)'];
		}

	} 


  /* /.nbrseances */


    /* nbrreservations */
	$reservationsSQL = "SELECT count(*) FROM reservation";
						  
	$reservations = $DB->executeSQL($reservationsSQL);
			
		
	if($reservations->num_rows > 0){
  
			if($row = $reservations->fetch_assoc()){
			  $nbrreservations = $row['count(*)'];
		  }
  
	  } 
  
  
	/* /.nbrreservations */

    /* nbrclients */
	$clientsSQL = "SELECT count(*) FROM users";
						  
	$clients = $DB->executeSQL($clientsSQL);
			
		
	if($clients->num_rows > 0){
  
			if($row = $clients->fetch_assoc()){
			  $nbrclients = $row['count(*)'];
		  }
  
	  } 
  
  
	/* /.nbrclients */




	/* menage normale */

	$MNSQL = "SELECT count(*) FROM reservation WHERE  typemenage LIKE 'Menage Normale'";
						  
	$MN = $DB->executeSQL($MNSQL);
			
		
	if($MN->num_rows >= 0){
  
			if($row = $MN->fetch_assoc()){
			  $nbrMN = $row['count(*)'];
		  }
  
	  } 


	  $MN100 = ($nbrMN / $nbrreservations) * 100;


	/* /.menage normale */
		/* grand menage */

		$GMSQL = "SELECT count(*) FROM reservation WHERE  typemenage LIKE 'Grand Ménage'";
						  
		$GM = $DB->executeSQL($GMSQL);
				
			
		if($GM->num_rows >= 0){
	  
				if($row = $GM->fetch_assoc()){
				  $nbrGM = $row['count(*)'];
			  }
	  
		  } 
	
		  $GM100 = ($nbrGM / $nbrreservations) * 100;

		/* /.menage normale */

	/* Nettoyage Vitres */

	$NVSQL = "SELECT count(*) FROM reservation WHERE  typemenage LIKE 'Nettoyage Vitres'";
						  
	$NV = $DB->executeSQL($NVSQL);
			
		
	if($NV->num_rows >= 0){
  
			if($row = $NV->fetch_assoc()){
			  $nbrNV = $row['count(*)'];
		  }
  
	  } 

	  $NV100 = ($nbrNV / $nbrreservations) * 100;

	/* /.Nettoyage Vitres */
		/* Nettoyage Des Bureaux */

		$NDBSQL = "SELECT count(*) FROM reservation WHERE typemenage LIKE 'Nettoyage Des Bureaux'";
						  
		$NDB = $DB->executeSQL($NDBSQL);
				
			
		if($GM->num_rows >= 0){
	  
				if($row = $NDB->fetch_assoc()){
				  $nbrNDB = $row['count(*)'];
			  }
	  
		  } 
	$NDB100 = ($nbrNDB / $nbrreservations) * 100;
	
		/* /.Nettoyage Des Bureaux */

		/* Nettoyage Avant Déménagement */

		$NADSQL = "SELECT count(*) FROM reservation WHERE typemenage LIKE 'Nettoyage Avant Déménagement'";
						  
		$NAD = $DB->executeSQL($NADSQL);
				
			
		if($NAD->num_rows >= 0){
	  
				if($row = $NAD->fetch_assoc()){
				  $nbrNAD = $row['count(*)'];
			  }
	  
		  } 
		  $NAD100 = ($nbrNAD / $nbrreservations) * 100;
	
		/* /.Nettoyage Avant Déménagement */




?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title><?php echo $page;?></title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="vendors/images/apple-touch-icon.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="vendors/images/favicon-32x32.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="vendors/images/favicon-16x16.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script
			async
			src="https://www.googletagmanager.com/gtag/js?id=G-GBZ3SGGX85"
		></script>
		<script>
			window.dataLayer = window.dataLayer || [];
			function gtag() {
				dataLayer.push(arguments);
			}
			gtag("js", new Date());

			gtag("config", "G-GBZ3SGGX85");
		</script>
		<!-- Google Tag Manager -->
		<script>
			(function (w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({ "gtm.start": new Date().getTime(), event: "gtm.js" });
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != "dataLayer" ? "&l=" + l : "";
				j.async = true;
				j.src = "https://www.googletagmanager.com/gtm.js?id=" + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, "script", "dataLayer", "GTM-NXZMQSS");
		</script>
		<!-- End Google Tag Manager -->
	</head>
	<body>
	

		<!-- navbar -->
		<?php require_once('navbar.php'); ?>
		<!-- /.navbar -->
	
		<!-- sidebar -->
		<?php require_once('sidebar.php'); ?>
		<!-- /.sidebar -->

		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<div class="title pb-20">
					<h2 class="h3 mb-0">Dashboard</h2>
				</div>

				<div class="row pb-10">
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?php echo $nbrreservations;?></div>
									<div class="font-14 text-secondary weight-500">
										Total Reservations
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#ff5b5b">
										<i class="icon-copy dw dw-calendar1"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?php echo $nbrseances;?></div>
									<div class="font-14 text-secondary weight-500">
										Total Seances
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#00eccf">
										<i class="icon-copy bi bi-check-circle-fill"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark"><?php echo $nbrclients;?></div>
									<div class="font-14 text-secondary weight-500">
										Total Clients
									</div>
								</div>
								<div class="widget-icon">
									<div class="icon">
										<i class="icon-copy fa fa-users" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
						<div class="card-box height-100-p widget-style3">
							<div class="d-flex flex-wrap">
								<div class="widget-data">
									<div class="weight-700 font-24 text-dark">$50,000</div>
									<div class="font-14 text-secondary weight-500">Earning</div>
								</div>
								<div class="widget-icon">
									<div class="icon" data-color="#09cc06">
										<i class="icon-copy fa fa-money" aria-hidden="true"></i>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<hr>

				<div class="row">
					<div class="col-lg-4 col-md-6 mb-20">
						<div class="card-box height-100-p pd-20 min-height-200px">
							<div class="d-flex justify-content-between pb-10">
								<div class="h5 mb-0">Users</div>
								<div class="dropdown">
									<a
										class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
										data-color="#1b3133"
										href="#"
										role="button"
										data-toggle="dropdown"
									>
										<i class="dw dw-more"></i>
									</a>
									<div
										class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
									>
										<a class="dropdown-item" href="users.php"
											><i class="dw dw-eye"></i> View</a
										>
										<a class="dropdown-item" href="users.php"
											><i class="dw dw-edit2"></i> Edit</a
										>
										<a class="dropdown-item" href="users.php"
											><i class="dw dw-delete-3"></i> Delete</a
										>
									</div>
								</div>
							</div>
							<div class="user-list">
								<ul>
								<?php
                                        $today = date('Y-m-d');

										$inserclientSQL = "SELECT * FROM users";
																
										$reservations = $DB->executeSQL($inserclientSQL);
												
											
										if($reservations->num_rows > 0){

											for($i = 0 ; $i < $reservations->num_rows ; $i++){

												$row = $reservations->fetch_assoc();

												$id = $row["iduser"]; 
												$nom = $row['nom'];
												$prenom = $row['prenom'];
												$email = $row['email'];
												$telephone = $row['telephone'];
												$adresse = $row['adresse'];
											

										?>

									<li class="d-flex align-items-center justify-content-between">
										<div class="name-avatar d-flex align-items-center pr-2">
											<div class="avatar mr-2 flex-shrink-0">
												<img
													src="vendors/images/photo1.jpg"
													class="border-radius-100 box-shadow"
													width="50"
													height="50"
													alt=""
												/>
											</div>
											<div class="txt">
												<span
													class="badge badge-pill badge-sm"
													data-bgcolor="#e7ebf5"
													data-color="#265ed7"
													><?php echo $telephone;?></span
												>
												<div class="font-14 weight-600"><?php echo $nom." ".$prenom;?></div>
												<div class="font-12 weight-500" data-color="#b2b1b6">
												<?php echo $email;?>
												</div>
											</div>
										</div>
										<div class="cta flex-shrink-0">
											<a href="users.php" class="btn btn-sm btn-outline-primary"
												>Schedule</a
											>
										</div>
									</li>
									<?php
                                                     }

                                                                            
                                                    }
                                                ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 mb-20">
						<div class="card-box height-100-p pd-20 min-height-200px">
							<div class="d-flex justify-content-between">
								<div class="h5 mb-0">Reservations </div>
								<div class="dropdown">
									<a
										class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
										data-color="#1b3133"
										href="#"
										role="button"
										data-toggle="dropdown"
									>
										<i class="dw dw-more"></i>
									</a>
									<div
										class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
									>
										<a class="dropdown-item" href="reservations.php"
											><i class="dw dw-eye"></i> View</a
										>
										<a class="dropdown-item" href="reservations.php"
											><i class="dw dw-edit2"></i> Edit</a
										>
										<a class="dropdown-item" href="reservations.php"
											><i class="dw dw-delete-3"></i> Delete</a
										>
									</div>
								</div>
							</div>

							<div id="diseases-chart"></div>
						</div>
					</div>
					<div class="col-lg-4 col-md-12 mb-20">
						<div class="card-box height-100-p pd-20 min-height-200px">
							<div class="max-width-300 mx-auto">
								<img src="vendors/images/upgrade.svg" alt="" />
							</div>
							<div class="text-center">
								<div class="h5 mb-1">Upgrade to Pro</div>
								<div
									class="font-14 weight-500 max-width-200 mx-auto pb-20"
									data-color="#a6a6a7"
								>
									You can enjoy all our features by upgrading to pro.
								</div>
								<a href="#" class="btn btn-primary btn-lg">Upgrade</a>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script src="vendors/scripts/dashboard3.js"></script>
		<!-- Google Tag Manager (noscript) -->
		<noscript
			><iframe
				src="https://www.googletagmanager.com/ns.html?id=GTM-NXZMQSS"
				height="0"
				width="0"
				style="display: none; visibility: hidden"
			></iframe
		></noscript>
		<!-- End Google Tag Manager (noscript) -->
	</body>
</html>
