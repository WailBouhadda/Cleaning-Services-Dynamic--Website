<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "ASSISTANCE";

$DB = new DBconnection;

session_start();

$client = new client;

$client = $_SESSION['client'];

if($client != null){

	$idclient = $client->getId();
    $idcard= $client->getIdcard();
	$nom = $client->getNom();
	$prenom = $client->getPrenom();
	$adresse = $client->getAdresse();
  
  }else{
  
	header("Location:../login.php");
  
  }

  $idadmin = 2;

  
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

	  $setvuetomsgSQL = "UPDATE message SET statut = 1 WHERE idfrom = ".$idadmin." AND idto = ".$idclient." AND type like 'a'";

	  $vue = $DB->executeSQL($setvuetomsgSQL);
  }







  if(isset($_POST['send'])){

	$idto = $idadmin;
	$idfrom = $idclient;
	$msg = $_POST['msg'];

	$sendmsgSQL = "INSERT INTO message(idfrom, idto, message, type) VALUES(".$idfrom.", ".$idto.", '".$msg."', 'u')";

	$statut = $DB->executeSQL($sendmsgSQL);

  }



?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title><?php echo $page;?></title>

		<meta name="description" content="based on widget boxes with 2 different styles" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="components/font-awesome/css/font-awesome.css" />

		 

		<!-- page specific plugin styles -->

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

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="components/html5shiv/dist/html5shiv.min.js"></script>
		<script src="components/respond/dest/respond.min.js"></script>
		<![endif]-->
	</head>

	<body class="no-skin">
		<!-- #section:basics/navbar.layout -->
            <!-- navbar -->
            <?php include("navbar.php"); ?>
            <!-- /.navbar -->

		<!-- /section:basics/navbar.layout -->
		<div class="main-container ace-save-state" id="main-container">
			<script type="text/javascript">
				try{ace.settings.loadState('main-container')}catch(e){}
			</script>

			<!-- #section:basics/sidebar -->
			<!-- sidebar -->
            <?php include("sidebar.php"); ?>
            <!-- /.sidebar -->

			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<div class="main-content-inner">
					<!-- #section:basics/content.breadcrumbs -->
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="dashboard.php">Home</a>
							</li>

							<li>
								<a class="active">Assistance</a>
							</li>
							
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
                                Assistance
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									
								</small>
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12" style="max-height: 550px; overflow-y: scroll;">
								<!-- PAGE CONTENT BEGINS -->
								<div id="timeline-1">
									<div class="row">
										<div class="col-xs-12 col-sm-10 col-sm-offset-1">
											<!-- #section:pages/timeline -->
											<div class="timeline-container">
												<div class="timeline-label">
													<!-- #section:pages/timeline.label -->
													<span class="label label-primary arrowed-in-right label-lg">
														<b>Reclamations</b>
													</span>

													<!-- /section:pages/timeline.label -->
												</div>

												<div class="timeline-items">

                                                    <?php

                                                    $getmessagesSQL = "SELECT * FROM message WHERE (idfrom = ".$idclient." AND idto = ".$idadmin." AND type like 'u') 
																		OR (idfrom = ".$idadmin." AND idto = ".$idclient." AND type like 'a') ORDER BY date";
												
													$messages = $DB->executeSQL($getmessagesSQL);


													if($messages->num_rows > 0){

														for($i = 0 ; $i < $messages->num_rows ; $i++){
														
															$row = $messages->fetch_assoc();

															$idto = $row['idto'];
															$idfrom = $row['idfrom'];

															$date = strtotime($row['date']);

															$msgtime = date('H:i',$date);



                                                ?>

													<!-- #section:pages/timeline.item -->
													<div class="timeline-item clearfix">
														<!-- #section:pages/timeline.info -->
														<div class="timeline-info">
															<img alt="Susan't Avatar" src="<?php if($idto == $idclient && $idfrom == $idadmin){ echo "assets/avatars/avatar4.png";}else{ echo "../idcards/$idcard";}?>" />
															<span class="label label-info label-sm"><?php echo $msgtime;?></span>
														</div>

														<!-- /section:pages/timeline.info -->
														<div class="widget-box transparent">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title smaller">
																	<a href="#" class="blue"><?php if($idto == $idclient && $idfrom == $idadmin){ echo $prenomadmin." ".$nomadmin;}else{ echo $prenom." ".$nom;}?></a>
																	<span class="grey"><?php if($idto == $idclient && $idfrom == $idadmin){ echo "ADMIN";}?></span>
																</h5>

																<span class="widget-toolbar no-border">
																	<i class="ace-icon fa fa-clock-o bigger-110"></i>
																	<?php echo $msgtime;?>
																</span>

																<span class="widget-toolbar">
															
																	<a href="#" data-action="collapse">
																		<i class="ace-icon fa fa-chevron-up"></i>
																	</a>
																</span>
															</div>

															<div class="widget-body">
																<div class="widget-main">
                                                                <?php echo $row['message']?>
																	<div class="space-6"></div>
															
																</div>
															</div>
														</div>
													</div>


                                                <?php
                                                        
                                                        }
                                                    }
                                                ?>
												</div><!-- /.timeline-items -->
											<!-- /section:pages/timeline -->
										</div>
									</div>
								</div>
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
                    <hr>
                    <div class="row">
                        <form method="post">
                             <div class="col-xs-12">
                                <div class="input-group input-group-lg">
									<span class="input-group-addon">
										<i class="ace-icon fa fa-angle-right"></i>
									</span>

									<input type="text" name="msg" class="form-control search-query" placeholder="..." />
									<span class="input-group-btn">
										<button type="submit" name="send" class="btn btn-default btn-lg">
											<span class="ace-icon fa fa-paper-plane  bigger-110 center"></span>
                                              
										</button>
									</span>
								</div>
                             </div>   
                        </form>
                        </div>
				</div>
			</div><!-- /.main-content -->

	
			
		</div><!-- /.main-container -->

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

		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('[id*="timeline-"]').addClass('hide');
					$('#timeline-'+which).removeClass('hide');
				});
			});
		</script>

		<!-- the following scripts are used in demo only for onpage help and you don't need them -->
		<link rel="stylesheet" href="assets/css/ace.onpage-help.css" />
		<link rel="stylesheet" href="docs/assets/js/themes/sunburst.css" />

		<script type="text/javascript"> ace.vars['base'] = '..'; </script>
		<script src="assets/js/src/elements.onpage-help.js"></script>
		<script src="assets/js/src/ace.onpage-help.js"></script>
		<script src="docs/assets/js/rainbow.js"></script>
		<script src="docs/assets/js/language/generic.js"></script>
		<script src="docs/assets/js/language/html.js"></script>
		<script src="docs/assets/js/language/css.js"></script>
		<script src="docs/assets/js/language/javascript.js"></script>
	</body>
</html>
