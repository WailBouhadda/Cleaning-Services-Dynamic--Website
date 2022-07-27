<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "SETTINGS";

$DB = new DBconnection;

session_start();

$client = new client;

$client = $_SESSION['client'];

if($client != null){

  $idclient = $client->getId();
  $idcard = $client->getIDcard();
  $nom = $client->getNom();
  $prenom = $client->getPrenom();
  $email = $client->getEmail();
  $telephone = $client->getTelephone();
  $adresse = $client->getAdresse();
  $password = $client->getPassword();

  $today = date('Y-m-d');

  /* get nbr seances */
  $seancesSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND datereservation < '".$today."'";

  $seances = $DB->executeSQL($seancesSQL);
                                                        
                                                    
  if($seances->num_rows > 0){

      if($row = $seances->fetch_assoc()){

        $nbrseances = $row['count(*)'];
        }
    }

/* /.get nbr seances */


  /* get nbr reservations */
  $reservationsSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND dateseance > '".$today."'";

  $reservations = $DB->executeSQL($reservationsSQL);
                                                        
                                                    
  if($reservations->num_rows > 0){

      if($row = $reservations->fetch_assoc()){

        $nbrreservations = $row['count(*)'];
        }
    }

/* /.get nbr reservations */



if(isset($_POST['MODIFIERINFOS'])){

$c = new client;

    /* idcard handling */
    if($_FILES['file']['error'] === 4){

        echo "<script> alert('Image ne pas trouvez');</script>";
		$newImaeName = $idcard;
    }else{

        $fileName = $_FILES['file']['name'];
        $fileSize = $_FILES['file']['size'];
        $tmpName = $_FILES['file']['tmp_name'];

        $validationImageExtension = ['jpg', 'jpeg', 'png'];
        $imageExtension = explode('.', $fileName);
        $imageExtension = strtolower(end($imageExtension));

        if(!in_array($imageExtension, $validationImageExtension)){

            echo "<script> alert('Merci d'inserer une image de type jpg, jpeg, png');</script>";
        }else if($fileSize > 1000000){
            echo "<script> alert('Image et tres grand');</script>";
        }else{
            $newImaeName = uniqid();
            $newImaeName .= "." . $imageExtension;

            move_uploaded_file($tmpName, '../idcards/' . $newImaeName);


                     

        }
         /* /.idcard handling */

    }

	
                /* get reservation data */

                /* client infos */
				$c->setIdcard($newImaeName);   
                $cnom = $_POST['nom'];
                $c->setNom($cnom);
                $cprenom = $_POST['prenom'];
                $c->setPrenom($cprenom);
                $cemail = $_POST['email'];
                $c->setEmail($cemail);
                $ctelephone = $_POST['telephone'];
                $c->setTelephone($ctelephone);
                $cadresse = $_POST['adresse'];
                $c->setAdresse($cadresse);

                

                /* /.client infos */

				$clientSQL = "";


                    if($_POST['Apassword'] == $password){

                        $cpassword = $_POST['Npassword'];
                        $c->setPassword($cpassword);

                        $clientSQL = "UPDATE users SET idcard = '".$newImaeName."', nom = '".$cnom."', prenom = '".$cprenom."', email = '".$cemail."', adresse = '".$cadresse."', telephone = '".$ctelephone."', password = '".$cpassword."'";

                    }else{

                        $clientSQL = "UPDATE users SET idcard = '".$newImaeName."', nom = '".$cnom."', prenom = '".$cprenom."', email = '".$cemail."', adresse = '".$cadresse."', telephone = '".$ctelephone."'";

                    }



				$result = $DB->executeSQL($clientSQL); 


                if($result){

					session_start();
                $_SESSION['client'] = $c;
                header("Location:settings.php");
                
                }else{

                }


}






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

							<li class="active">Settings</li>
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
                                Settings
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
									<div id="user-profile-3" class="user-profile row">
										<div class="col-sm-offset-1 col-sm-10">

											<form method="post" enctype="multipart/form-data" class="form-horizontal">
												<div class="tabbable">
													<ul class="nav nav-tabs padding-16">
														<li class="active">
															<a data-toggle="tab" href="#edit-basic">
																<i class="green ace-icon fa fa-pencil-square-o bigger-125"></i>
																Basic Info
															</a>
														</li>

														<li>
															<a data-toggle="tab" href="#edit-password">
																<i class="blue ace-icon fa fa-key bigger-125"></i>
																Password
															</a>
														</li>
													</ul>

													<div class="tab-content profile-edit-tab-content">
														<div id="edit-basic" class="tab-pane in active">
															<h4 class="header blue bolder smaller">General</h4>

															<div class="row">
																<div class="col-xs-12 col-sm-4">
																	<input type="file" id="file" name="file" />
																</div>

																<div class="vspace-12-sm"></div>

																<div class="col-xs-12 col-sm-8">
																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="nom">Nom</label>

																		<div class="col-sm-8">
																			<input class="col-xs-12 col-sm-10" type="text" id="nom" name="nom" placeholder="Nom..." value="<?php echo $nom;?>" />
																		</div>
																	</div>

																	<div class="space-4"></div>

																	<div class="form-group">
																		<label class="col-sm-4 control-label no-padding-right" for="prenom">Prenom</label>

																		<div class="col-sm-8">
                                                                            <input class="col-xs-12 col-sm-10" type="text" id="prenom" name="prenom" placeholder="Prenom..." value="<?php echo $prenom;?>" />
																		</div>
																	</div>
																</div>
															</div>

															<div class="space"></div>
															<h4 class="header blue bolder smaller">Contact</h4>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="email">Email</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input-xxlarge" type="email" id="email" name="email" value="<?php echo $email;?>" />
																		<i class="ace-icon fa fa-envelope"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="adresse">Adresse</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input-xxlarge" type="text" id="adresse" name="adresse" value="<?php echo $adresse;?>" />
																		<i class="ace-icon fa fa-location-dot"></i>
																	</span>
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="telephone">Phone</label>

																<div class="col-sm-9">
																	<span class="input-icon input-icon-right">
																		<input class="input-xxlarge"  type="text" id="telephone" name="telephone" value="<?php echo $telephone;?>" />
																		<i class="ace-icon fa fa-phone fa-flip-horizontal"></i>
																	</span>
																</div>
															</div>
														</div>

														<div id="edit-password" class="tab-pane">
															<div class="space-10"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="Apassword">Ancien Mot de passe</label>

																<div class="col-sm-9">
																	<input type="password" name="Apassword" id="Apassword" />
																</div>
															</div>

															<div class="space-4"></div>

															<div class="form-group">
																<label class="col-sm-3 control-label no-padding-right" for="Npassword">Nouveau Mot de passe</label>

																<div class="col-sm-9">
																	<input type="password" name="Npassword" id="Npassword" />
																</div>
															</div>
														</div>
													</div>
												</div>

												<div class="clearfix form-actions">
													<div class="col-md-offset-3 col-md-9">
														<button class="btn btn-info" type="submit" name="MODIFIERINFOS">
															<i class="ace-icon fa fa-check bigger-110"></i>
															Enregistrer
														</button>

														&nbsp; &nbsp;
														<button class="btn" type="reset">
															<i class="ace-icon fa fa-undo bigger-110"></i>
															Reainstaliser
														</button>
													</div>
												</div>
											</form>
										</div><!-- /.span -->
									</div><!-- /.user-profile -->
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


        <!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
			
				//editables on first profile page
				$.fn.editable.defaults.mode = 'inline';
				$.fn.editableform.loading = "<div class='editableform-loading'><i class='ace-icon fa fa-spinner fa-spin fa-2x light-blue'></i></div>";
			    $.fn.editableform.buttons = '<button type="submit" class="btn btn-info editable-submit"><i class="ace-icon fa fa-check"></i></button>'+
			                                '<button type="button" class="btn editable-cancel"><i class="ace-icon fa fa-times"></i></button>';    

				//////////////////////////////
				$('#profile-feed-1').ace_scroll({
					height: '250px',
					mouseWheelLock: true,
					alwaysVisible : true
				});
			
				$('a[ data-original-title]').tooltip();
			
				$('.easy-pie-chart.percentage').each(function(){
				var barColor = $(this).data('color') || '#555';
				var trackColor = '#E2E2E2';
				var size = parseInt($(this).data('size')) || 72;
				$(this).easyPieChart({
					barColor: barColor,
					trackColor: trackColor,
					scaleColor: false,
					lineCap: 'butt',
					lineWidth: parseInt(size/10),
					animate:false,
					size: size
				}).css('color', barColor);
				});
			  
				///////////////////////////////////////////
			
				///////////////////////////////////////////
				$('#user-profile-3')
				.find('input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Change avatar',
					btn_change:null,
					no_icon:'ace-icon fa fa-picture-o',
					thumbnail:'large',
					droppable:true,
					
					allowExt: ['jpg', 'jpeg', 'png', 'gif'],
					allowMime: ['image/jpg', 'image/jpeg', 'image/png', 'image/gif']
				})
				.end().find('button[type=reset]').on(ace.click_event, function(){
					$('#user-profile-3 input[type=file]').ace_file_input('reset_input');
				})
				.end().find('.date-picker').datepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				})
				$('.input-mask-phone').mask('(999) 999-9999');
			
				$('#user-profile-3').find('input[type=file]').ace_file_input('show_file_list', [{type: 'image', name: $('#avatar').attr('src')}]);
			
			
				////////////////////
				//change profile
				$('[data-toggle="buttons"] .btn').on('click', function(e){
					var target = $(this).find('input[type=radio]');
					var which = parseInt(target.val());
					$('.user-profile').parent().addClass('hide');
					$('#user-profile-'+which).parent().removeClass('hide');
				});
				
				
				
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					//in ajax mode, remove remaining elements before leaving page
					try {
						$('.editable').editable('destroy');
					} catch(e) {}
					$('[class*=select2]').remove();
				});
			});
		</script>

		
</body>
</html>