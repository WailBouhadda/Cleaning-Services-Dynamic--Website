<?php

require_once("tools/DBconnection.php");
require("entities/admin.php");
require("entities/client.php");

$page = "RESERVATIONS";

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

  if(isset($_POST['send'])){

	$idto = $_GET['idcon'];
	$idfrom = $idadmin;
	$msg = $_POST['msg'];

	$sendmsgSQL = "INSERT INTO message(idfrom, idto, message, type) VALUES(".$idfrom.", ".$idto.", '".$msg."', 'a')";

	$statut = $DB->executeSQL($sendmsgSQL);

  }

?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>DeskApp - Bootstrap Admin Dashboard HTML Template</title>

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
							<div class="col-md-6 col-sm-12">
								<div class="title">
									<h4>Chat</h4>
								</div>
								<nav aria-label="breadcrumb" role="navigation">
									<ol class="breadcrumb">
										<li class="breadcrumb-item">
											<a href="index.html">Home</a>
										</li>
										<li class="breadcrumb-item active" aria-current="page">
											Chat
										</li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
					<div class="bg-white border-radius-4 box-shadow mb-30">
						<div class="row no-gutters">
							<div class="col-lg-3 col-md-4 col-sm-12">
								<div class="chat-list bg-light-gray">
									<div class="chat-search">
										<span class="ti-search"></span>
										<input type="text" placeholder="Search Contact" />
									</div>
									<div
										class="notification-list chat-notification-list customscroll"
									>
										<ul>
                                            <?php


                                                $getusers = "SELECT DISTINCT u.iduser, u.idcard, u.nom, u.prenom, u.email, u.telephone FROM users as u, message as m
															 WHERE u.iduser = m.idfrom AND m.idto = ".$idadmin." AND type like 'u'";

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
											<li class="active">
												<a href="?idcon=<?php echo $row['iduser'];?>">
													<img src="../idcards/<?php echo $idcard;?>" alt="" />
													<h3 class="clearfix"><?php echo $row["nom"]." ".$row["prenom"];?></h3>
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
							<div class="col-lg-9 col-md-8 col-sm-12">
								<div class="chat-detail">

									<?php
										if(isset($_GET['idcon'])){

											$idcon = $_GET['idcon'];

											$setvuetomsgSQL = "UPDATE message SET statut = 1 WHERE idfrom = ".$idcon." AND idto = ".$idadmin." AND type like 'u'";

											$vue = $DB->executeSQL($setvuetomsgSQL);
									?>

									<div class="chat-profile-header clearfix">
										<?php

												
											$getuser = "SELECT * FROM users WHERE iduser = ".$idcon;

											$user = $DB->executeSQL($getuser);
											
										

											if($user->num_rows > 0){

												for($i = 0 ; $i < $user->num_rows ; $i++){
												
													$row = $user->fetch_assoc();

										?>
										<div class="left">
											<div class="clearfix">
												<div class="chat-profile-photo">
													<img src="../idcards/<?php echo $row["idcard"];?>" alt="" />
												</div>
												<div class="chat-profile-name">
													<h3><?php echo $row["nom"]." ".$row["prenom"];?></h3>
													<span><?php echo $row["email"];?></span>
												</div>
											</div>
										</div>

										<?php
												}
											}
										?>

									</div>
									<div class="chat-box">
										<div class="chat-desc customscroll">
											<ul>

												<?php

													$getmessagesSQL = "SELECT * FROM message WHERE (idfrom = ".$idcon." AND idto = ".$idadmin." AND type like 'u') 
																		OR (idfrom = ".$idadmin." AND idto = ".$idcon." AND type like 'a') ORDER BY date";
												
													$messages = $DB->executeSQL($getmessagesSQL);


													if($messages->num_rows > 0){

														for($i = 0 ; $i < $messages->num_rows ; $i++){
														
															$row = $messages->fetch_assoc();

															$idto = $row['idto'];
															$idfrom = $row['idfrom'];

															$date = strtotime($row['date']);

															$msgtime = date('H:i',$date);

												?>
												
												<li class="clearfix <?php if($idto == $idcon && $idfrom == $idadmin){ echo "admin_chat"; }?> ">
													<span class="chat-img">
														<?php if($idto == $idcon && $idfrom == $idadmin){  ?>

															<img src="vendors/images/chat-img2.jpg" alt="" />

														<?php }else{?>

															<img src="../idcards/<?php echo $idcard;?>" alt="" />

														<?php		}?>
													</span>
													<div class="chat-body clearfix">
														<p>
															<?php echo $row['message'];?>
														</p>
														<div class="chat_time"><?php echo $msgtime;?></div>
													</div>
												</li>

												<?php
														}
													}
												?>
											</ul>
										</div>
										<form method="post">
										<div class="chat-footer">
											<div class="file-upload">
												<a href=""><i class="fa fa-angle-right"></i></a>
											</div>
											<div class="chat_text_area">
												<textarea placeholder="Type your message…" name="msg"></textarea>
											</div>
											<div class="chat_send">
												<button class="btn btn-link" name="send" type="submit">
													<i class="icon-copy ion-paper-airplane"></i>
												</button>
											</div>
										</div>
										</form>
									</div>

									<?php
										}else{
									?>

									<p>Selectionez un client</p>

									<?php
											}
									?>

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
