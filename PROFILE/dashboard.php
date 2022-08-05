<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "DASHBOARD";

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




  $today = date('Y-m-d');



  /* nbrseances */
  $seancesSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND dateseance < '".$today."'";
						  
  $seances = $DB->executeSQL($seancesSQL);
		  
	  
  if($seances->num_rows > 0){

	  	if($row = $seances->fetch_assoc()){
			$nbrseances = $row['count(*)'];
		}

	} 


  /* /.nbrseances */


    /* nbrreservations */
	$reservationsSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient;
						  
	$reservations = $DB->executeSQL($reservationsSQL);
			
		
	if($reservations->num_rows > 0){
  
			if($row = $reservations->fetch_assoc()){
			  $nbrreservations = $row['count(*)'];
		  }
  
	  } 
  
  
	/* /.nbrreservations */


	/* menage normale */

	$MNSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND typemenage LIKE 'Menage Normale'";
						  
	$MN = $DB->executeSQL($MNSQL);
			
		
	if($MN->num_rows >= 0){
  
			if($row = $MN->fetch_assoc()){
			  $nbrMN = $row['count(*)'];
		  }
  
	  } 


	  $MN100 = ($nbrMN / $nbrreservations) * 100;


	/* /.menage normale */
		/* grand menage */

		$GMSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND typemenage LIKE 'Grand Ménage'";
						  
		$GM = $DB->executeSQL($GMSQL);
				
			
		if($GM->num_rows >= 0){
	  
				if($row = $GM->fetch_assoc()){
				  $nbrGM = $row['count(*)'];
			  }
	  
		  } 
	
		  $GM100 = ($nbrGM / $nbrreservations) * 100;

		/* /.menage normale */

	/* Nettoyage Vitres */

	$NVSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND typemenage LIKE 'Nettoyage Vitres'";
						  
	$NV = $DB->executeSQL($NVSQL);
			
		
	if($NV->num_rows >= 0){
  
			if($row = $NV->fetch_assoc()){
			  $nbrNV = $row['count(*)'];
		  }
  
	  } 

	  $NV100 = ($nbrNV / $nbrreservations) * 100;

	/* /.Nettoyage Vitres */
		/* Nettoyage Des Bureaux */

		$NDBSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND typemenage LIKE 'Nettoyage Des Bureaux'";
						  
		$NDB = $DB->executeSQL($NDBSQL);
				
			
		if($GM->num_rows >= 0){
	  
				if($row = $NDB->fetch_assoc()){
				  $nbrNDB = $row['count(*)'];
			  }
	  
		  } 
	$NDB100 = ($nbrNDB / $nbrreservations) * 100;
	
		/* /.Nettoyage Des Bureaux */

		/* Nettoyage Avant Déménagement */

		$NADSQL = "SELECT count(*) FROM reservation WHERE idclient = ".$idclient." AND typemenage LIKE 'Nettoyage Avant Déménagement'";
						  
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />


		   <!-- fonts awesome -->
		   <script src="https://kit.fontawesome.com/e2991dfebd.js" crossorigin="anonymous"></script>   
    <!-- /.fonts awesome -->

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

							<li class="active">Dashboard</li>
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
								Dashboard
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- /section:settings.box -->
						<div class="row">
									<div class="space-6"></div>

									<div class="col-sm-12 infobox-container">
										<!-- #section:pages/dashboard.infobox -->
										<div class="infobox infobox-green">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-comments"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number">32</span>
												<div class="infobox-content">comments + 2 reviews</div>
											</div>

											<!-- #section:pages/dashboard.infobox.stat -->
											<div class="stat stat-success">8%</div>

											<!-- /section:pages/dashboard.infobox.stat -->
										</div>

										<div class="infobox infobox-pink">
											<div class="infobox-icon">
												<i class="ace-icon fa fa-shopping-cart"></i>
											</div>

											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo $nbrreservations;?></span>
												<div class="infobox-content">Reservations</div>
											</div>
											
										</div>

										<div class="infobox infobox-orange2">
											<!-- #section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-chart">
												<span class="sparkline" data-values="196,128,202,177,154,94,100,170,224"></span>
											</div>

											<!-- /section:pages/dashboard.infobox.sparkline -->
											<div class="infobox-data">
												<span class="infobox-data-number"><?php echo $nbrseances;?></span>
												<div class="infobox-content">Seances</div>
											</div>
										</div>
									</div>

									<div class="vspace-12-sm"></div>
								</div><!-- /.row -->

						</div><!-- /.row -->
						
						<div class="space-6"></div>
						<hr>
						<div class="space-6"></div>

						<div class="row">
							<div class="col-sm-6">

									<?php
                                                $today = date('Y-m-d');
                                                $inserclientSQL = "SELECT * FROM reservation WHERE idclient = ".$idclient." AND dateseance >= '".$today."'";
                                                                        
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

								<div class="col-xs-6 col-sm-4 col-md-4">
									<!-- #section:pages/search.thumb -->
									<div class="thumbnail search-thumbnail">
										<?php if($today == $datemenage){?>
										<span class="search-promotion label label-success arrowed-in arrowed-in-right">Aujourd'hui</span>
										<?php } ?>
										<img class="media-object" data-src="holder.js/100px200?theme=gray" />
										<div class="caption">
											<div class="clearfix">
												<span class="pull-right label label-grey info-label"><?php echo $ville; ?></span>

												<div class="pull-left bigger-110">
													<?php echo $duree." H ";?>
												</div>
											</div>

											<h3 class="search-title">
												<a href="#" class="blue"><?php echo $typemenage; ?></a>
											</h3>
											<p><?php echo $adresse; ?></p>
										</div>
									</div>

									<!-- /section:pages/search.thumb -->
								</div>
										<?php
													}
												}
										?>
							</div>
							<div class="col-sm-6">
								<div class="widget-body">
									<div class="widget-main">
										<!-- #section:plugins/charts.flotchart -->
										<div id="piechart-placeholder"></div>

										<!-- /section:plugins/charts.flotchart -->
										<div class="hr hr8 hr-double"></div>
									</div>
								</div>
							</div>
						</div>
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
		<script src="components/_mod/easypiechart/jquery.easypiechart.js"></script>
		<script src="components/jquery.sparkline/index.js"></script>
		<script src="components/Flot/jquery.flot.js"></script>
		<script src="components/Flot/jquery.flot.pie.js"></script>
		<script src="components/Flot/jquery.flot.resize.js"></script>
		<script src="components/holderjs/holder.js"></script>

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
				$('.easy-pie-chart.percentage').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = $(this).data('color') || (!$box.hasClass('infobox-dark') ? $box.css('color') : 'rgba(255,255,255,0.95)');
					var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
					var size = parseInt($(this).data('size')) || 50;
					$(this).easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: parseInt(size/10),
						animate: ace.vars['old_ie'] ? false : 1000,
						size: size
					});
				})
			
				$('.sparkline').each(function(){
					var $box = $(this).closest('.infobox');
					var barColor = !$box.hasClass('infobox-dark') ? $box.css('color') : '#FFF';
					$(this).sparkline('html',
									 {
										tagValuesAttribute:'data-values',
										type: 'bar',
										barColor: barColor ,
										chartRangeMin:$(this).data('min') || 0
									 });
				});
			
			
			  //flot chart resize plugin, somehow manipulates default browser resize event to optimize it!
			  //but sometimes it brings up errors with normal resize event handlers
			  $.resize.throttleWindow = false;
			
			  var placeholder = $('#piechart-placeholder').css({'width':'90%' , 'min-height':'250px'});
			  var data = [
				{ label: "Menage Normale",  data: <?php echo $MN100;?>, color: "#68BC31"},
				{ label: "Grand Menage",  data: <?php echo $GM100;?>, color: "#2091CF"},
				{ label: "Nettoyage Des Bureaux",  data: <?php echo $NDB100;?>, color: "#AF4E96"},
				{ label: "Nettoyage Vitres",  data: <?php echo $NV100;?>, color: "#DA5430"},
				{ label: "Nettoyage Avant Déménagement",  data: <?php echo $NAD100;?>, color: "#FEE074"}
			  ]
			  function drawPieChart(placeholder, data, position) {
			 	  $.plot(placeholder, data, {
					series: {
						pie: {
							show: true,
							tilt:0.8,
							highlight: {
								opacity: 0.25
							},
							stroke: {
								color: '#fff',
								width: 2
							},
							startAngle: 2
						}
					},
					legend: {
						show: true,
						position: position || "ne", 
						labelBoxBorderColor: null,
						margin:[-30,15]
					}
					,
					grid: {
						hoverable: true,
						clickable: true
					}
				 })
			 }
			 drawPieChart(placeholder, data);
			
			 /**
			 we saved the drawing function and the data to redraw with different position later when switching to RTL mode dynamically
			 so that's not needed actually.
			 */
			 placeholder.data('chart', data);
			 placeholder.data('draw', drawPieChart);
			
			
			  //pie chart tooltip example
			  var $tooltip = $("<div class='tooltip top in'><div class='tooltip-inner'></div></div>").hide().appendTo('body');
			  var previousPoint = null;
			
			  placeholder.on('plothover', function (event, pos, item) {
				if(item) {
					if (previousPoint != item.seriesIndex) {
						previousPoint = item.seriesIndex;
						var tip = item.series['label'] + " : " + item.series['percent']+'%';
						$tooltip.show().children(0).text(tip);
					}
					$tooltip.css({top:pos.pageY + 10, left:pos.pageX + 10});
				} else {
					$tooltip.hide();
					previousPoint = null;
				}
				
			 });
			
				/////////////////////////////////////
				$(document).one('ajaxloadstart.page', function(e) {
					$tooltip.remove();
				});
			
			
			
			
				var d1 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d1.push([i, Math.sin(i)]);
				}
			
				var d2 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.5) {
					d2.push([i, Math.cos(i)]);
				}
			
				var d3 = [];
				for (var i = 0; i < Math.PI * 2; i += 0.2) {
					d3.push([i, Math.tan(i)]);
				}
				
			
				var sales_charts = $('#sales-charts').css({'width':'100%' , 'height':'220px'});
				$.plot("#sales-charts", [
					{ label: "Menage Normale", data: d1 },
					{ label: "Hosting", data: d2 },
					{ label: "Services", data: d3 }
				], {
					hoverable: true,
					shadowSize: 0,
					series: {
						lines: { show: true },
						points: { show: true }
					},
					xaxis: {
						tickLength: 0
					},
					yaxis: {
						ticks: 10,
						min: -2,
						max: 2,
						tickDecimals: 3
					},
					grid: {
						backgroundColor: { colors: [ "#fff", "#fff" ] },
						borderWidth: 1,
						borderColor:'#555'
					}
				});
			
			
				$('#recent-box [data-rel="tooltip"]').tooltip({placement: tooltip_placement});
				function tooltip_placement(context, source) {
					var $source = $(source);
					var $parent = $source.closest('.tab-content')
					var off1 = $parent.offset();
					var w1 = $parent.width();
			
					var off2 = $source.offset();
					//var w2 = $source.width();
			
					if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
					return 'left';
				}
			
			
				$('.dialogs,.comments').ace_scroll({
					size: 300
			    });
				
				
				//Android's default browser somehow is confused when tapping on label which will lead to dragging the task
				//so disable dragging when clicking on label
				var agent = navigator.userAgent.toLowerCase();
				if(ace.vars['touch'] && ace.vars['android']) {
				  $('#tasks').on('touchstart', function(e){
					var li = $(e.target).closest('#tasks li');
					if(li.length == 0)return;
					var label = li.find('label.inline').get(0);
					if(label == e.target || $.contains(label, e.target)) e.stopImmediatePropagation() ;
				  });
				}
			
				$('#tasks').sortable({
					opacity:0.8,
					revert:true,
					forceHelperSize:true,
					placeholder: 'draggable-placeholder',
					forcePlaceholderSize:true,
					tolerance:'pointer',
					stop: function( event, ui ) {
						//just for Chrome!!!! so that dropdowns on items don't appear below other items after being moved
						$(ui.item).css('z-index', 'auto');
					}
					}
				);
				$('#tasks').disableSelection();
				$('#tasks input:checkbox').removeAttr('checked').on('click', function(){
					if(this.checked) $(this).closest('li').addClass('selected');
					else $(this).closest('li').removeClass('selected');
				});
			
			
				//show the dropdowns on top or bottom depending on window height and menu position
				$('#task-tab .dropdown-hover').on('mouseenter', function(e) {
					var offset = $(this).offset();
			
					var $w = $(window)
					if (offset.top > $w.scrollTop() + $w.innerHeight() - 100) 
						$(this).addClass('dropup');
					else $(this).removeClass('dropup');
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