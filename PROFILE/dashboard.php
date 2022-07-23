<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "DASHBOARD";

$DB = new DBconnection;

session_start();

$client = new client;

$client = $_SESSION['client'];

if($client != null){

  $nom = $client->getNom();
  $prenom = $client->getPrenom();

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
    <title>Document</title>


    <meta name="description" content="overview &amp; stats" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="assets/css/bootstrap.css" />
		<link rel="stylesheet" href="components/font-awesome/css/font-awesome.css" />

		<!-- page specific plugin styles -->

        <!-- fonts awesome -->
    <script src="https://kit.fontawesome.com/e2991dfebd.js" crossorigin="anonymous"></script>   
    <!-- /.fonts awesome -->
    
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
						<!-- #section:settings.box -->
						<div class="ace-settings-container" id="ace-settings-container">
							<div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
								<i class="ace-icon fa fa-cog bigger-130"></i>
							</div>

							<div class="ace-settings-box clearfix" id="ace-settings-box">
								<div class="pull-left width-50">
									<!-- #section:settings.skins -->
									<div class="ace-settings-item">
										<div class="pull-left">
											<select id="skin-colorpicker" class="hide">
												<option data-skin="no-skin" value="#438EB9">#438EB9</option>
												<option data-skin="skin-1" value="#222A2D">#222A2D</option>
												<option data-skin="skin-2" value="#C6487E">#C6487E</option>
												<option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
											</select>
										</div>
										<span>&nbsp; Choose Skin</span>
									</div>

									<!-- /section:settings.skins -->

									<!-- #section:settings.navbar -->
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
										<label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
									</div>

									<!-- /section:settings.navbar -->

									<!-- #section:settings.sidebar -->
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
										<label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
									</div>

									<!-- /section:settings.sidebar -->

									<!-- #section:settings.breadcrumbs -->
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
										<label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
									</div>

									<!-- /section:settings.breadcrumbs -->

									<!-- #section:settings.rtl -->
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
										<label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
									</div>

									<!-- /section:settings.rtl -->

									<!-- #section:settings.container -->
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
										<label class="lbl" for="ace-settings-add-container">
											Inside
											<b>.container</b>
										</label>
									</div>

									<!-- /section:settings.container -->
								</div><!-- /.pull-left -->

								<div class="pull-left width-50">
									<!-- #section:basics/sidebar.options -->
									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
										<label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
										<label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
									</div>

									<div class="ace-settings-item">
										<input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
										<label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
									</div>

									<!-- /section:basics/sidebar.options -->
								</div><!-- /.pull-left -->
							</div><!-- /.ace-settings-box -->
						</div><!-- /.ace-settings-container -->

						<!-- /section:settings.box -->
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

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
		<script src="components/_mod/easypiechart/jquery.easypiechart.js"></script>
		<script src="components/jquery.sparkline/index.js"></script>
		<script src="components/Flot/jquery.flot.js"></script>
		<script src="components/Flot/jquery.flot.pie.js"></script>
		<script src="components/Flot/jquery.flot.resize.js"></script>

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