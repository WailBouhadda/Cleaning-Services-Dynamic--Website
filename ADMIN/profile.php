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
  
  }else{
  
	header("Location:login.php");
  
  }

  $today = date('Y-m-d');



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
									<a
										href="modal"
										data-toggle="modal"
										data-target="#modal"
										class="edit-avatar"
										><i class="fa fa-pencil"></i
									></a>
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
								<h5 class="text-center h5 mb-0">Ross C. Lopez</h5>
								<p class="text-center text-muted font-14">
									Lorem ipsum dolor sit amet
								</p>
								<div class="profile-info">
									<h5 class="mb-20 h5 text-blue">Contact Information</h5>
									<ul>
										<li>
											<span>Email Address:</span>
											FerdinandMChilds@test.com
										</li>
										<li>
											<span>Phone Number:</span>
											619-229-0054
										</li>
										<li>
											<span>Country:</span>
											America
										</li>
										<li>
											<span>Address:</span>
											1807 Holden Street<br />
											San Diego, CA 92115
										</li>
									</ul>
								</div>
								<div class="profile-social">
									<h5 class="mb-20 h5 text-blue">Social Links</h5>
									<ul class="clearfix">
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#3b5998"
												data-color="#ffffff"
												><i class="fa fa-facebook"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#1da1f2"
												data-color="#ffffff"
												><i class="fa fa-twitter"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#007bb5"
												data-color="#ffffff"
												><i class="fa fa-linkedin"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#f46f30"
												data-color="#ffffff"
												><i class="fa fa-instagram"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#c32361"
												data-color="#ffffff"
												><i class="fa fa-dribbble"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#3d464d"
												data-color="#ffffff"
												><i class="fa fa-dropbox"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#db4437"
												data-color="#ffffff"
												><i class="fa fa-google-plus"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#bd081c"
												data-color="#ffffff"
												><i class="fa fa-pinterest-p"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#00aff0"
												data-color="#ffffff"
												><i class="fa fa-skype"></i
											></a>
										</li>
										<li>
											<a
												href="#"
												class="btn"
												data-bgcolor="#00b489"
												data-color="#ffffff"
												><i class="fa fa-vine"></i
											></a>
										</li>
									</ul>
								</div>
								<div class="profile-skills">
									<h5 class="mb-20 h5 text-blue">Key Skills</h5>
									<h6 class="mb-5 font-14">HTML</h6>
									<div class="progress mb-20" style="height: 6px">
										<div
											class="progress-bar"
											role="progressbar"
											style="width: 90%"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<h6 class="mb-5 font-14">Css</h6>
									<div class="progress mb-20" style="height: 6px">
										<div
											class="progress-bar"
											role="progressbar"
											style="width: 70%"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<h6 class="mb-5 font-14">jQuery</h6>
									<div class="progress mb-20" style="height: 6px">
										<div
											class="progress-bar"
											role="progressbar"
											style="width: 60%"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
									<h6 class="mb-5 font-14">Bootstrap</h6>
									<div class="progress mb-20" style="height: 6px">
										<div
											class="progress-bar"
											role="progressbar"
											style="width: 80%"
											aria-valuenow="0"
											aria-valuemin="0"
											aria-valuemax="100"
										></div>
									</div>
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
													data-toggle="tab"
													href="#setting"
													role="tab"
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
													<form>
														<ul class="profile-edit-list row">
															<li class="weight-500 col-md-6">
																<h4 class="text-blue h5 mb-20">
																	Edit Your Personal Setting
																</h4>
																<div class="form-group">
																	<label>Full Name</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Title</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Email</label>
																	<input
																		class="form-control form-control-lg"
																		type="email"
																	/>
																</div>
																<div class="form-group">
																	<label>Date of birth</label>
																	<input
																		class="form-control form-control-lg date-picker"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Gender</label>
																	<div class="d-flex">
																		<div
																			class="custom-control custom-radio mb-5 mr-20"
																		>
																			<input
																				type="radio"
																				id="customRadio4"
																				name="customRadio"
																				class="custom-control-input"
																			/>
																			<label
																				class="custom-control-label weight-400"
																				for="customRadio4"
																				>Male</label
																			>
																		</div>
																		<div
																			class="custom-control custom-radio mb-5"
																		>
																			<input
																				type="radio"
																				id="customRadio5"
																				name="customRadio"
																				class="custom-control-input"
																			/>
																			<label
																				class="custom-control-label weight-400"
																				for="customRadio5"
																				>Female</label
																			>
																		</div>
																	</div>
																</div>
																<div class="form-group">
																	<label>Country</label>
																	<select
																		class="selectpicker form-control form-control-lg"
																		data-style="btn-outline-secondary btn-lg"
																		title="Not Chosen"
																	>
																		<option>United States</option>
																		<option>India</option>
																		<option>United Kingdom</option>
																	</select>
																</div>
																<div class="form-group">
																	<label>State/Province/Region</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Postal Code</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Phone Number</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Address</label>
																	<textarea class="form-control"></textarea>
																</div>
																<div class="form-group">
																	<label>Visa Card Number</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<label>Paypal ID</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																	/>
																</div>
																<div class="form-group">
																	<div
																		class="custom-control custom-checkbox mb-5"
																	>
																		<input
																			type="checkbox"
																			class="custom-control-input"
																			id="customCheck1-1"
																		/>
																		<label
																			class="custom-control-label weight-400"
																			for="customCheck1-1"
																			>I agree to receive notification
																			emails</label
																		>
																	</div>
																</div>
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn btn-primary"
																		value="Update Information"
																	/>
																</div>
															</li>
															<li class="weight-500 col-md-6">
																<h4 class="text-blue h5 mb-20">
																	Edit Social Media links
																</h4>
																<div class="form-group">
																	<label>Facebook URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Twitter URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Linkedin URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Instagram URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Dribbble URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Dropbox URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Google-plus URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Pinterest URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Skype URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group">
																	<label>Vine URL:</label>
																	<input
																		class="form-control form-control-lg"
																		type="text"
																		placeholder="Paste your link here"
																	/>
																</div>
																<div class="form-group mb-0">
																	<input
																		type="submit"
																		class="btn btn-primary"
																		value="Save & Update"
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
				<div class="footer-wrap pd-20 mb-20 card-box">
					DeskApp - Bootstrap 4 Admin Template By
					<a href="https://github.com/dropways" target="_blank"
						>Ankit Hingarajiya</a
					>
				</div>
			</div>
		</div>
		<!-- welcome modal start -->
		<div class="welcome-modal">
			<button class="welcome-modal-close">
				<i class="bi bi-x-lg"></i>
			</button>
			<iframe
				class="w-100 border-0"
				src="https://embed.lottiefiles.com/animation/31548"
			></iframe>
			<div class="text-center">
				<h3 class="h5 weight-500 text-center mb-2">
					Open source
					<span role="img" aria-label="gratitude">❤️</span>
				</h3>
				<div class="pb-2">
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-star"
						data-size="large"
						data-show-count="true"
						aria-label="Star dropways/deskapp dashboard on GitHub"
						>Star</a
					>
					<a
						class="github-button"
						href="https://github.com/dropways/deskapp/fork"
						data-color-scheme="no-preference: dark; light: light; dark: light;"
						data-icon="octicon-repo-forked"
						data-size="large"
						data-show-count="true"
						aria-label="Fork dropways/deskapp dashboard on GitHub"
						>Fork</a
					>
				</div>
			</div>
			<div class="text-center mb-1">
				<div>
					<a
						href="https://github.com/dropways/deskapp"
						target="_blank"
						class="btn btn-light btn-block btn-sm"
					>
						<span class="text-danger weight-600">STAR US</span>
						<span class="weight-600">ON GITHUB</span>
						<i class="fa fa-github"></i>
					</a>
				</div>
				<script
					async
					defer="defer"
					src="https://buttons.github.io/buttons.js"
				></script>
			</div>
			<a
				href="https://github.com/dropways/deskapp"
				target="_blank"
				class="btn btn-success btn-sm mb-0 mb-md-3 w-100"
			>
				DOWNLOAD
				<i class="fa fa-download"></i>
			</a>
			<p class="font-14 text-center mb-1 d-none d-md-block">
				Available in the following technologies:
			</p>
			<div class="d-none d-md-flex justify-content-center h1 mb-0 text-danger">
				<i class="fa fa-html5"></i>
			</div>
		</div>
		<button class="welcome-modal-btn">
			<i class="fa fa-download"></i> Download
		</button>
		<!-- welcome modal end -->
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
