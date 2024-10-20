<?php
include __DIR__."/chunk/header.php";
?>
<body>

    <?php
    	if(isset($tpl) && is_file(__DIR__."/".$tpl.'.php') && file_exists(__DIR__."/".$tpl.'.php'))
		{
				include(__DIR__."/".$tpl.'.php');
		}
	?>
    <script src="assets/scripts/main.js"></script>
</body>
 