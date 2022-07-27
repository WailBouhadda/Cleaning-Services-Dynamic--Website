<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "PROFILE";

$DB = new DBconnection;

session_start();

$client = new client;

$client = $_SESSION['client'];

if($client != null){

  $idcard = $client->getIDcard();
  $nom = $client->getNom();
  $prenom = $client->getPrenom();
  $email = $client->getEmail();
  $telephone = $client->getTelephone();
  $adresse = $client->getAdresse();

  $today = date('Y-m-d');
  /* get nbr seances */
  $seancesSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$client->getId()." AND dateseance < '".$today."'";

  $seances = $DB->executeSQL($seancesSQL);
                                                        
                                                    
  if($seances->num_rows > 0){

      if($row = $seances->fetch_assoc()){

        $nbrseances = $row['count(*)'];
        }
    }

/* /.get nbr seances */



  /* get nbr reservations */
  $reservationsSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$client->getId()." AND dateseance > '".$today."'";

  $reservations = $DB->executeSQL($reservationsSQL);
                                                        
                                                    
  if($reservations->num_rows > 0){

      if($row = $reservations->fetch_assoc()){

        $nbrreservations = $row['count(*)'];
        }
    }

/* /.get nbr reservations */



}else{

  header("Location:../login.php");

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page;?></title>


    <meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


		   <!-- fonts awesome -->
		   <script src="https://kit.fontawesome.com/e2991dfebd.js" crossorigin="anonymous"></script>   
    <!-- /.fonts awesome -->

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="components/font-awesome/css/font-awesome.css" />

		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="components/_mod/jquery-ui.custom/jquery-ui.custom.css" />
		<link rel="stylesheet" href="components/jquery.gritter/css/jquery.gritter.css" />
		<link rel="stylesheet" href="components/select2/dist/css/select2.css" />
		<link rel="stylesheet" href="components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" href="components/_mod/x-editable/bootstrap-editable.css" />

    
		<!-- text fonts -->
		<link rel="stylesheet" href="assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->
		<link rel="stylesheet" href="assets/css/ace-skins.css" />
		<link rel="stylesheet" href="assets/css/ace-rtl.css" />

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="assets/js/ace-extra.js"></script>


    
     
</head>
<body class="no-skin">
    
<!-- navbar -->
<?php include("navbar.php"); ?>
<!-- /.navbar -->


<!-- main-container -->

<div class="main-container ace-save-state" id="main-container">
	
    <script type="text/javascript">
		try{ace.settings.loadState('main-container')}catch(e){}
	</script>

            <!-- sidebar -->
            <?php include("sidebar.php"); ?>
            <!-- /.sidebar -->

            <!-- main-content -->
           
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Home</a>
							</li>

							<li class="active">Profile</li>
						</ul><!-- /.breadcrumb -->

						<!-- #section:basics/content.searchbox -->
						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->

						<!-- /section:basics/content.searchbox -->
					</div>

					<!-- /section:basics/content.breadcrumbs -->
					<div class="page-content">
						<!-- /section:settings.box -->
						<div class="page-header">
							<h1>
								Profile
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->
                        <div class="space-30"></div>
						<!-- /section:settings.box -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="">
									<div id="user-profile-2" class="user-profile">
										<div class="tabbable">
											<ul class="nav nav-tabs padding-18">
												<li class="active">
													<a data-toggle="tab" href="#home">
														<i class="green ace-icon fa fa-user bigger-120"></i>
														Profile
													</a>
												</li>
											</ul>

											<div class="tab-content no-border padding-24">
												<div id="home" class="tab-pane in active">
													<div class="row">
														<div class="col-xs-12 col-sm-3 center">
															<span class="profile-picture">
																<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="../idcards/<?php echo $idcard;?>" />
															</span>

															<div class="space space-4"></div>

															<a href="settings.php" class="btn btn-sm btn-block btn-success">
																<i class="ace-icon fa fa-square-pen bigger-120"></i>
																<span class="bigger-110">Modifier Profile</span>
															</a>
														</div><!-- /.col -->

														<div class="col-xs-12 col-sm-9">
															<h4 class="blue">
																<span class="middle"><?php echo "MR.".$prenom." ".$nom; ?></span>
															</h4>

															<div class="profile-user-info">
																<div class="profile-info-row">
																	<div class="profile-info-name"> Nom </div>

																	<div class="profile-info-value">
																		<span><?php echo $nom; ?></span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Prenom </div>

																	<div class="profile-info-value">
																		<span><?php echo $prenom; ?></span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Adresse </div>

																	<div class="profile-info-value">
																		<i class="fa fa-map-marker light-orange bigger-110"></i>
																		<span><?php echo $adresse; ?></span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Email </div>

																	<div class="profile-info-value">
																		<span><?php echo $email; ?></span>
																	</div>
																</div>

																<div class="profile-info-row">
																	<div class="profile-info-name"> Telephone </div>

																	<div class="profile-info-value">
																		<span><?php echo $telephone; ?></span>
																	</div>
																</div>
                                                                <div class="profile-info-row">
																	<div class="profile-info-name"> Seances </div>

																	<div class="profile-info-value">
                                                                        <span class="label label-success arrowed-in  arrowed-in-right">
																	        <?php echo $nbrseances; ?>
																        </span>
																	</div>
																</div>
                                                                <div class="profile-info-row">
																	<div class="profile-info-name"> Reservations </div>

																	<div class="profile-info-value">
                                                                        <span class="label label-info arrowed-in  arrowed-in-right">
																	        <?php echo $nbrreservations; ?>
																        </span>
																	</div>
																</div>
															</div>



                                                            

															<div class="hr hr-8 dotted"></div>

														
														</div><!-- /.col -->
													</div><!-- /.row -->	
												</div><!-- /#home -->
											</div>
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div>

            <!-- /.main-content -->

</div>
<!-- /.main-container -->


			<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="components/jquery/dist/jquery.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="components/jquery.1x/dist/jquery.js"></script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='components/_mod/jquery.mobile.custom/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="components/bootstrap/dist/js/bootstrap.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="components/ExplorerCanvas/excanvas.js"></script>
		<![endif]-->
		<script src="components/_mod/jquery-ui.custom/jquery-ui.custom.js"></script>
		<script src="components/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="components/jquery.gritter/js/jquery.gritter.js"></script>
		<script src="components/bootbox.js/bootbox.js"></script>
		<script src="components/_mod/easypiechart/jquery.easypiechart.js"></script>
		<script src="components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
		<script src="components/jquery.hotkeys/index.js"></script>
		<script src="components/_mod/bootstrap-wysiwyg/bootstrap-wysiwyg.js"></script>
		<script src="components/select2/dist/js/select2.js"></script>
		<script src="components/fuelux/js/spinbox.js"></script>
		<script src="components/_mod/x-editable/bootstrap-editable.js"></script>
		<script src="components/_mod/x-editable/ace-editable.js"></script>
		<script src="components/jquery.maskedinput/dist/jquery.maskedinput.js"></script>

		<!-- ace scripts -->
		<script src="assets/js/src/elements.scroller.js"></script>
		<script src="assets/js/src/elements.colorpicker.js"></script>
		<script src="assets/js/src/elements.fileinput.js"></script>
		<script src="assets/js/src/elements.typeahead.js"></script>
		<script src="assets/js/src/elements.wysiwyg.js"></script>
		<script src="assets/js/src/elements.spinner.js"></script>
		<script src="assets/js/src/elements.treeview.js"></script>
		<script src="assets/js/src/elements.wizard.js"></script>
		<script src="assets/js/src/elements.aside.js"></script>
		<script src="assets/js/src/ace.js"></script>
		<script src="assets/js/src/ace.basics.js"></script>
		<script src="assets/js/src/ace.scrolltop.js"></script>
		<script src="assets/js/src/ace.ajax-content.js"></script>
		<script src="assets/js/src/ace.touch-drag.js"></script>
		<script src="assets/js/src/ace.sidebar.js"></script>
		<script src="assets/js/src/ace.sidebar-scroll-1.js"></script>
		<script src="assets/js/src/ace.submenu-hover.js"></script>
		<script src="assets/js/src/ace.widget-box.js"></script>
		<script src="assets/js/src/ace.settings.js"></script>
		<script src="assets/js/src/ace.settings-rtl.js"></script>
		<script src="assets/js/src/ace.settings-skin.js"></script>
		<script src="assets/js/src/ace.widget-on-reload.js"></script>
		<script src="assets/js/src/ace.searchbox-autocomplete.js"></script>

		
</body>
</html>