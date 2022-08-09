<?php

require_once("tools/DBconnection.php");
require("entities/admin.php");

$page = "PROFILE";

$DB = new DBconnection;

session_start();

$admin = new admin;

$admin = $_SESSION['admin'];

if($admin != null){

	$idadmin = $admin->getId();
	$nom = $admin->getNom();
	$prenom = $admin->getPrenom();
	$email = $admin->getEmail();
	$password = $admin->getPassword();
  
  }else{
  
	header("Location:login.php");
  
  }



  
if(isset($_POST['informations'])){


	$a = new admin;

				  /* client infos */
				  $a->setId($idadmin);  
				  $anom = $_POST['nom'];
				  $a->setNom($anom);
				  $aprenom = $_POST['prenom'];
				  $a->setPrenom($aprenom);
				  $aemail = $_POST['email'];
				  $a->setEmail($aemail);
	
	
				  $adminSQL = "UPDATE admin SET  nom = '".$anom."',
				  prenom = '".$aprenom."', email = '".$aemail."' WHERE idadmin = ".$idadmin;
						 
				  $result = $DB->executeSQL($adminSQL); 
	
				  $_SESSION['admin'] = $a;
              
}



if(isset($_POST['password'])){



	$Apass = $_POST['amdp'];
	$Npass = $_POST['nmdp'];

	if(strcmp($Apass,$password) === 0){

		$adminSQL = "UPDATE admin SET password = '".$Npass."' WHERE idadmin = ".$idadmin;

		$result = $DB->executeSQL($adminSQL); 

		$admin->setPassword($Npass);

		$_SESSION['admin'] = $admin;

		$error = 0;
	}else{
		$error = -1; 
	}
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
			href="src/plugins/cropperjs/dist/cropper.css"
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
			<div class="pd-ltr-20 xs-pd-20-10">
				<div class="min-height-200px">
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
											Profile
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-30">
							<div class="pd-20 card-box height-100-p">
								<div class="profile-photo">
									<img
										src="vendors/images/photo1.jpg"
										alt=""
										class="avatar-photo"
									/>
									<div
										class="modal fade"
										id="modal"
										tabindex="-1"
										role="dialog"
										aria-labelledby="modalLabel"
										aria-hidden="true"
									>
										<div
											class="modal-dialog modal-dialog-centered"
											role="document"
										>
											<div class="modal-content">
												<div class="modal-body pd-5">
													<div class="img-container">
														<img
															id="image"
															src="vendors/images/photo2.jpg"
															alt="Picture"
														/>
													</div>
												</div>
												<div class="modal-footer">
													<input
														type="submit"
														value="Update"
														class="btn btn-primary"
													/>
													<button
														type="button"
														class="btn btn-default"
														data-dismiss="modal"
													>
														Close
													</button>
												</div>
											</div>
										</div>
									</div>
								</div>
								<h5 class="text-center h5 mb-0"><?php echo $prenom." ".$nom; ?></h5>
								<p class="text-center text-muted font-14">
									<?php echo $password;?>
								</p>
								<div class="profile-info">
									<h5 class="mb-20 h5 text-blue">Contact Information</h5>
									<ul>
										<li>
											<span>Email Address:</span>
											<?php echo $email; ?>
										</li>
										<li>
											<span>Phone Number:</span>
											619-229-0054
										</li>
										<li>
											<span>Country:</span>
											Maroc
										</li>
										<li>
											<span>Address:</span>
											1807 Holden Street<br />
											San Diego, CA 92115
										</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-30">
							<div class="card-box height-100-p overflow-hidden">
								<div class="profile-tab height-100-p">
									<div class="tab height-100-p">
										<ul class="nav nav-tabs customtab" role="tablist">
											<li class="nav-item">
												<a
													class="nav-link"
													
													href="#"
													>Settings</a
												>
											</li>
										</ul>
										<div class="tab-content">
											<!-- Setting Tab start -->
											<div
												class="tab-pane fade height-100-p active show"
												id="setting"
												role="tabpanel"
											>
												<div class="profile-setting">
													<form method="post">
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-6">
																<h4 class="text-blue h5 mb-20">
																	Edit Your Personal Setting
																</h4>
																<div class="form-group">
																	<label>Nom</label>
																	<input
																		class="form-control form-control-lg"
																		name="nom"
																		value="<?php echo $nom; ?>"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Prenom</label>
																	<input
																		class="form-control form-control-lg"
																		name="prenom"
																		value="<?php echo $prenom; ?>"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Email</label>
																	<input
																		class="form-control form-control-lg"
																		name="email"
																		value="<?php echo $email; ?>"
																		type="email"
																	/>
																</div>
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn btn-primary"
																		name="informations"
																		value="Modifier Informations"
																	/>
																</div>
															</li>
															<li class="weight-500 col-md-6">
																<h4 class="text-blue h5 mb-20">
																	Edit Social Media links
																</h4>
																<div class="form-group">
																	<label>Ancien Mot De Passe</label>
																	<input
																		class="form-control form-control-lg"
																		name="amdp"
																		type="password"
																		placeholder="Votre mot de passe"
																	/>
																</div>
																<div class="form-group">
																	<label>Nouveau Mot De Passe</label>
																	<input
																		class="form-control form-control-lg"
																		name="nmdp"
																		type="password"
																		placeholder="Entrez un nouveau mot de passe"
																	/>
																</div>
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn btn-primary"
																		name="password"
																		value="Sauvgarder & Modifier"
																	/>
																</div>
															</li>
														</ul>
													</form>
												</div>
											</div>
											<!-- Setting Tab End -->
										</div>
									</div>
								</div>
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
		<script src="src/plugins/cropperjs/dist/cropper.js"></script>
		<script>
			window.addEventListener("DOMContentLoaded", function () {
				var image = document.getElementById("image");
				var cropBoxData;
				var canvasData;
				var cropper;

				$("#modal")
					.on("shown.bs.modal", function () {
						cropper = new Cropper(image, {
							autoCropArea: 0.5,
							dragMode: "move",
							aspectRatio: 3 / 3,
							restore: false,
							guides: false,
							center: false,
							highlight: false,
							cropBoxMovable: false,
							cropBoxResizable: false,
							toggleDragModeOnDblclick: false,
							ready: function () {
								cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
							},
						});
					})
					.on("hidden.bs.modal", function () {
						cropBoxData = cropper.getCropBoxData();
						canvasData = cropper.getCanvasData();
						cropper.destroy();
					});
			});
		</script>
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
