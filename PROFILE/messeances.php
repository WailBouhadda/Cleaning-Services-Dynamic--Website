<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "MES SEANCES";

$DB = new DBconnection;

session_start();

$client = new client;

$client = $_SESSION['client'];

if($client != null){

  $idclient = $client->getId();
  $nom = $client->getNom();
  $prenom = $client->getPrenom();
  $adresse = $client->getAdresse();

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


    <!-- page specific plugin styles -->
		<link rel="stylesheet" href="components/_mod/jquery-ui.custom/jquery-ui.custom.css" />
		<link rel="stylesheet" href="components/fullcalendar/dist/fullcalendar.css" />


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

							<li class="active">Mes Seances</li>
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
                                Mes Seances
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->

             

						<!-- /section:settings.box -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                <div>
									<ul class="ace-thumbnails clearfix">
										<!-- #section:pages/gallery -->
                                        
                                            <?php
                                                $today = date('Y-m-d');
                                                $inserclientSQL = "SELECT * FROM reservation WHERE idclient = ".$idclient." AND dateseance < '".$today."'";
                                                                        
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
                                                       
                                                    
                                                        if($i % 2 === 0){
                                            ?>

                                        <!-- #section:pages/gallery.caption -->
										<li>
											<a href="" data-rel="colorbox">
												<img width="150" height="150" alt="150x150" src="../images/seance1.jpg" />
												<div class="text">
													<div class="inner"><?php echo $typemenage; ?></div>
												</div>
											</a>

											<div class="tools tools-bottom">
                                                <a style="font-size: 12px;" href="#">
                                                    <?php echo $ville; ?>
												</a>
                                                <a style="font-size: 12px;" href="#">
                                                    <?php echo $datemenage; ?>
												</a>
											</div>
										</li>
                                        <?php
                                                        }else{
                                        ?>
                                        <!-- #section:pages/gallery.caption -->
										<li>
											<a href="" data-rel="colorbox">
												<img width="150" height="150" alt="150x150" src="../images/seance2.jpg" />
												<div class="text">
													<div class="inner"><?php echo $typemenage; ?></div>
												</div>
											</a>

											<div class="tools tools-bottom">
                                                <a style="font-size: 12px;" href="#">
                                                    <?php echo $ville; ?>
												</a>
                                                <a style="font-size: 12px;" href="#">
                                                    <?php echo $datemenage; ?>
												</a>
											</div>
										</li>

                                        <?php
                                                        }
                                                    }
                                                }
                                        ?>
                                    </ul>
                                </div>
								<!-- PAGE CONTENT ENDS -->
							</div>
                            <!-- /.col -->
						</div><!-- /.row -->
						<hr>								
                        <!-- /section:settings.box -->
                        <div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                <div class="row">
									<div class="col-sm-12">
										<div class="space"></div>

										<!-- #section:plugins/data-time.calendar -->
										<div id="calendar"></div>

										<!-- /section:plugins/data-time.calendar -->
									</div>
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div>
                            <!-- /.col -->
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
		<script src="components/_mod/jquery-ui.custom/jquery-ui.custom.js"></script>
		<script src="components/jqueryui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="components/moment/moment.js"></script>
		<script src="components/fullcalendar/dist/fullcalendar.js"></script>
		<script src="components/bootbox.js/bootbox.js"></script>

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

/* initialize the external events
	-----------------------------------------------------------------*/

	$('#external-events div.external-event').each(function() {

		// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
		// it doesn't need to have a start or end
		var eventObject = {
			title: $.trim($(this).text()) // use the element's text as the event title
		};

		// store the Event Object in the DOM element so we can get to it later
		$(this).data('eventObject', eventObject);

		// make the event draggable using jQuery UI
		$(this).draggable({
			zIndex: 999,
			revert: true,      // will cause the event to go back to its
			revertDuration: 0  //  original position after the drag
		});
		
	});




	/* initialize the calendar
	-----------------------------------------------------------------*/

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();


	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		//firstDay: 1,// >> change first day of week 
		
		buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
	
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: 'load.php'
		,
		
		/**eventResize: function(event, delta, revertFunc) {

			alert(event.title + " end is now " + event.end.format());

			if (!confirm("is this okay?")) {
				revertFunc();
			}

		},*/
		
		selectable: true,
		
	});


})
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