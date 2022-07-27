<?php

require_once("../tools/DBconnection.php");
require("../entities/client.php");

$page = "MODIFIER RESERVATION";

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


if(isset($_GET['idres'])){

    $idreservation = $_GET['idres'];
    $selectreservationSQL = "SELECT * FROM reservation WHERE idreservation = ".$idreservation;

    $reservation = $DB->executeSQL($selectreservationSQL);

    if($reservation->num_rows > 0){

        if( $row = $reservation->fetch_assoc()){


            $u_id = $row["idreservation"]; 
            $u_typemenage = $row['typemenage'];
            $u_duree = $row['duree'];
            $u_ville = $row['ville'];
            $u_nbrpersonne = $row['nbrpersonne'];
            $u_datemenage = $row['dateseance'];
            $u_datereservation = $row['datereservation'];
            $u_frequence = $row['frequence'];
            $u_autre = $row['autre'];
            $u_adresse = $row['adresse'];
            $u_tools = $row['outils'];

        }
    }
           

}else{
    header("Location:listreservation.php");
}


if(isset($_POST['MODIFIER'])){


$typemenage = $_POST['typemenage'];
$duree = $_POST['duree'];
$ville = $_POST['ville'];
$nbrpersonne = $_POST['nbrpersonne'];
$datemenage = date('y-m-d',strtotime($_POST['dateseance']));
$frequence = $_POST['frequence'];
$autre = $_POST['autre'];
$adresse = $_POST['adresse'];
$tools = false;
if(isset($_POST['outils'])){
    $tools = true;
}




$updatereservationSQL = "UPDATE reservation SET typemenage = '".$typemenage."', duree = '".$duree."', ville = '".$ville."', adresse = '".$adresse."', nbrpersonne = '".$nbrpersonne."'
                , dateseance = '".$datemenage."', frequence = '".$frequence."', idclient = '".$idclient."', autre = '".$autre."', outils =  '".$tools."' WHERE idreservation = ".$idreservation;
                
                $test = $DB->executeSQL($updatereservationSQL);

                header("Location:listreservation.php");

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
		<link rel="stylesheet" href="components/chosen/chosen.css" />
		<link rel="stylesheet" href="components/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" />
		<link rel="stylesheet" href="components/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="components/bootstrap-daterangepicker/daterangepicker.css" />
		<link rel="stylesheet" href="components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" />


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

							<li class="active">Modifier Reservation</li>
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
                                Modifier Reservation
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
								</small>
							</h1>
						</div><!-- /.page-header -->

						<!-- /section:settings.box -->
						<div class="row">
							<form method="post">
								<div class="row">
									<!-- #section:plugins/input.chosen -->
									<div class="col-sm-6">
										<label for="typemenage">Type De Menage</label>
										<br />
										<select class="chosen-select form-control" id="typemenage" name="typemenage" data-placeholder="Type De Menage...">
											<option value="<?php echo $u_typemenage;?>" selected><?php echo $u_typemenage;?></option>
											<option value="Menage Normale">Menage Normale</option>
											<option value="Nettoyage Des Bureaux">Nettoyage Des Bureaux</option>
											<option value="Nettoyage Vitres">Nettoyage Vitres</option>
											<option value="Grand Ménage">Grand Ménage</option>
											<option value="Nettoyage Avant Déménagement">Nettoyage Avant Déménagement</option>
										</select>
									</div>
									<!-- #section:plugins/input.chosen -->
									<div class="col-sm-6">
										<label for="duree">Duree De Menage</label>
										<br />
										<select class="chosen-select form-control" id="duree" name="duree" data-placeholder="Duree De Menage...">
											<option value="<?php echo $u_duree;?>" selected> <?php echo $u_duree;?> H</option>
											<option value="2">2 H</option>
											<option value="3">3 H</option>
											<option value="4">4 H</option>
											<option value="5">5 H</option>
											<option value="6">6 H</option>
											<option value="7">7 H</option>
											<option value="8">8 H</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<!-- #section:plugins/input.chosen -->
									<div class="col-sm-6">
										<label for="ville">Ville</label>
										<br />
										<select class="chosen-select form-control" id="ville" name="ville" data-placeholder="Ville...">
											<option value="<?php echo $u_ville;?>" selected> <?php echo $u_ville;?> </option>
											<option value="Casablanca">Casablanca</option>
											<option value="Mohemmadia">Mohemmadia</option>
											<option value="Bouskoura">Bouskoura</option>
											<option value="Berrchid">Berrchid</option>
											<option value="Tite Mellil">Tite Mellil</option>
											<option value="Sidi Rehal">Sidi Rehal</option>
											<option value="Deroua">Deroua</option>
										</select>
									</div>
									<!-- #section:plugins/input.chosen -->
									<div class="col-sm-6">
										<label for="nbrpersonne">Nombre de personnes</label>
										<br />
										<select class="chosen-select form-control" id="nbrpersonne" name="nbrpersonne" data-placeholder="Nombre de personnes...">
											<option value="<?php echo $u_nbrpersonne;?>" selected> <?php echo $u_nbrpersonne;?> </option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-12">
										<label for="adresse">Adresse</label>
										<br />
										<input class="form-control" type="text" name="adresse" id="adresse" value="<?php echo $u_adresse;?>">
									</div>
								</div>
								<hr>
								<div class="row">
									<!-- #section:plugins/input.chosen -->
									<div class="col-sm-6">
										<label for="ville">Ville</label>
										<br />
										<!-- #section:plugins/date-time.datepicker -->
										<div class="input-group">
											<input class="form-control date-picker" id="dateseance" name="dateseance" value="<?php echo $u_datemenage;?>" type="text" data-date-format="dd-mm-yyyy" />
											<span class="input-group-addon">
													<i class="fa fa-calendar bigger-110"></i>
											</span>
										</div>
									</div>
									<!-- #section:plugins/input.chosen -->
									<div class="col-sm-6">
										<label for="frequence">Fréquence Ses Séances</label>
										<br />
										<select class="chosen-select form-control" id="frequence" name="frequence" data-placeholder="Fréquence Ses Séances...">
											<option value="<?php echo $u_frequence;?>" selected> <?php echo $u_frequence;?> </option>
											<option value="fois">Une Fois</option>
											<option value="quotidien">Quotidien</option>
											<option value="hebdomadaire">Hebdomadaire</option>
											<option value="Mensuel">mensuel</option>
										</select>
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-12">
										<label for="autre">Autre</label>
										<br />
										<input class="form-control" type="text" name="autre" value="<?php echo $u_autre;?>" id="autre">
									</div>
								</div>
								<hr>
								<div class="row">
									<div class="col-sm-12">
										<!-- #section:custom/checkbox -->
										<div class="checkbox">
											<label>
												<input name="outils" type="checkbox" class="ace" <?php if($u_tools){ echo "checked"; }?> />
												<span class="lbl"> Produits et Outils <span style="font-size: 12px; color: green;">(+ 100 DH)</span></span>
											</label>
										</div>
									</div>
								</div>
								<hr>
								<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit" name="MODIFIER">
												<i class="ace-icon fa fa-check bigger-110"></i>
												MODIFIER
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												REANSTALISER
											</button>
										</div>
								</div>
							</form>
						</div>
                        <!-- /.row -->
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
		<script src="components/chosen/chosen.jquery.js"></script>
		<script src="components/fuelux/js/spinbox.js"></script>
		<script src="components/bootstrap-datepicker/dist/js/bootstrap-datepicker.js"></script>
		<script src="components/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="components/moment/moment.js"></script>
		<script src="components/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="components/eonasdan-bootstrap-datetimepicker/src/js/bootstrap-datetimepicker.js"></script>
		<script src="components/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.js"></script>
		<script src="components/jquery-knob/js/jquery.knob.js"></script>
		<script src="components/autosize/dist/autosize.js"></script>
		<script src="components/jquery-inputlimiter/jquery.inputlimiter.js"></script>
		<script src="components/jquery.maskedinput/dist/jquery.maskedinput.js"></script>
		<script src="components/_mod/bootstrap-tag/bootstrap-tag.js"></script>

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
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
			
				autosize($('textarea[class*=autosize]'));
				
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).attr('placeholder', '.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style: 'well',
					btn_choose: 'Drop files here or click to choose',
					btn_change: null,
					no_icon: 'ace-icon fa fa-cloud-upload',
					droppable: true,
					thumbnail: 'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
					
					
					/**
					file_input
					.off('file.preview.ace')
					.on('file.preview.ace', function(e, info) {
						console.log(info.file.width);
						console.log(info.file.height);
						e.preventDefault();//to prevent preview
					});
					*/
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//console.log($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false,
					disableFocus: true,
					icons: {
						up: 'fa fa-chevron-up',
						down: 'fa fa-chevron-down'
					}
				}).on('focus', function() {
					$('#timepicker1').timepicker('showWidget');
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				
			
				
				if(!ace.vars['old_ie']) $('#date-timepicker1').datetimepicker({
				 //format: 'MM/DD/YYYY h:mm:ss A',//use this option to display seconds
				 icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-arrows ',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				 }
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
				//$('.colorpicker').last().css('z-index', 2000);//if colorpicker is inside a modal, its z-index should be higher than modal'safe
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add/remove a tag
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
					
					var index = $tag_obj.inValues('some tag');
					$tag_obj.remove(index);
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//autosize($('#form-field-tags'));
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					autosize.destroy('textarea[class*=autosize]')
					
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
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