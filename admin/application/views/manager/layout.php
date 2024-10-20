<?php
include __DIR__."/chunk/header.php";
include __DIR__."/chunk/page_header.php";
?>
<?php
		include __DIR__."/chunk/sidebar.php";
	?>
    <div class="page-content">
                <div class="main-wrapper">
                	<?php
								if(isset($tpl) && is_file(__DIR__."/".$tpl.'.php') && file_exists(__DIR__."/".$tpl.'.php'))
								{
										include(__DIR__."/".$tpl.'.php');
								}
							?>
                </div>
     </div>           	
 
 </body>
</html>
 