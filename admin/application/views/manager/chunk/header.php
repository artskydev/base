<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?=config_item('site_name')?> Admin">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="<?=config_item('site_name')?>">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title><?=config_item('site_name')?> Admin</title>
		 <base href="<?=base_url()?>">
  		<meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token">
        
        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="assets/_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/_assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="assets/_assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
		 
         
        <!-- Theme Styles -->
        <link href="assets/_assets/css/main.min.css" rel="stylesheet">
        <link href="assets/_assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <!-- select2 -->
        <script src="assets/_assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <!--
        <script src="assets/_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        -->
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="assets/_assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="assets/_assets/plugins/DataTables/datatables.min.js"></script>
        <script src="assets/_assets/js/main.min.js"></script>
        
        
        <link href="assets/plugins/DataTables/datatables.min.css" rel="stylesheet">  
		<script src="assets/plugins/DataTables/datatables.min.js"></script>
        <!-- -->
         <link rel="stylesheet" href="assets/datatable/buttons.dataTables.min.css">
  		<script src="assets/datatable/dataTables.buttons.min.js"></script>
		<script src="assets/datatable/buttons.flash.min.js"></script>
		<script src="assets/datatable/jszip.min.js"></script>
		<script src="assets/datatable/pdfmake.min.js"></script>
		<script src="assets/datatable/vfs_fonts.js"></script>
		<script src="assets/datatable/buttons.html5.min.js"></script>
		<script src="assets/datatable/buttons.print.min.js"></script>
        <script src="assets/datatable/buttons.colVis.min.js"></script>  
        <!-- -->
         <link href="assets/datetimepicker/build/jquery.datetimepicker.min.css" rel="stylesheet">  
		<script src="assets/datetimepicker/build/jquery.datetimepicker.full.js"></script>
        <!-- -->
        <link href="assets/plugins/select2/css/select2.css" rel="stylesheet">  
       <link href="assets/js/select2/select2-bootstrap.css" rel="stylesheet">   
        <script src="assets/plugins/select2/js/select2.js"></script>
        <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
     	<script src="assets/plugins/jquery-validation/additional-methods.js"></script>
		 <script src="assets/bootbox.min.js"></script>
         <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>  
        <script src="assets/smart.js"></script>
        <style type="text/css">
		 
		.pull-right
		{
			float:right;	
		}
		.pull-left
		{
			float:left;	
		}
		.accordion-menu li ul
		{
			margin:20px;	
		}
		.hide, .hidden, .configuration.layout-column.flex.hidden-sm-down
		{
			display:none !important;	
		}
		
		.page-header .navbar .navbar-brand {
    		background-image:url("assets/logo.png");
			 			
		}
		</style>
        <script>
		$(function()
		{
			$(".btn-reset").click(function()
			{
				window.location.href=window.location;
			});
			
		});
		</script>
        
    </head>
  <body>
      <div class='loader'>
        <div class='spinner-grow text-primary' role='status'>
          <span class='sr-only'>Loading...</span>
        </div>
      </div>  
 