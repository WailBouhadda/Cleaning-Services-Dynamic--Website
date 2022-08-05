<?php

require_once("tools/DBconnection.php");
require("entities/admin.php");

$page = "SEANCES";

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
            <div class="page-header">
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<div class="title">
									<h4><?php echo $page;?></h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Seances
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				<!-- Export Datatable start -->
				<div class="card-box mb-30">
						<div class="pd-20">
							<h4 class="text-blue h4">List des seances termines</h4>
						</div>
						<div class="pb-20">
							<table
								class="table hover multiple-select-row data-table-export nowrap"
							>
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">ID</th>
										<th>Type Menage</th>
										<th>Ville</th>
										<th>Date Reservation</th>
										<th>Date Seance</th>
										<th>Frequence</th>
									</tr>
								</thead>
								<tbody>
								<?php
                                        $today = date('Y-m-d');

										$inserclientSQL = "SELECT * FROM reservation WHERE dateseance > ".$today;
																
										$reservations = $DB->executeSQL($inserclientSQL);
												
											
										if($reservations->num_rows > 0){

											for($i = 0 ; $i < $reservations->num_rows ; $i++){

												$row = $reservations->fetch_assoc();

												$id = $row["idreservation"]; 
												$typemenage = $row['typemenage'];
												$duree = $row['duree'];
												$ville = $row['ville'];
												$nbrpersonne = $row['nbrpersonne'];
												$datemenage = $row['dateseance'];
												$datereservation = $row['datereservation'];
												$frequence = $row['frequence'];
												$autre = $row['autre'];
												$adresse = $row['adresse'];
												$tools = $row['outils'];
											

										?>

									<tr>
										<td class="table-plus"><?php echo $id;?></td>
										<td><?php echo $typemenage;?></td>
										<td><?php echo $ville;?></td>
										<td><?php echo $datereservation;?></td>
										<td><?php echo $datemenage;?></td>
										<td><?php echo $frequence;?></td>
									</tr>
									<?php
                                                     }

                                                                            
                                                    }
                                                ?>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Export Datatable End -->

			</div>
		</div>
		<!-- welcome modal end -->
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<!-- buttons for Export datatable -->
		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>
		<!-- Datatable Setting js -->
		<script src="vendors/scripts/datatable-setting.js"></script>
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
