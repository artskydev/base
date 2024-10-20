<?php
$directory = rtrim($this->router->directory,'/');
$class = $this->router->class;
$method = $this->router->method;
$paths = __DIR__;
include __DIR__."/chunk/header.php";

?>
<div id="wrapper" >
 	<?php
	if($class!="items")
	{
	?>
    <div <?=($class=="nft")?'id="vm"':""?>>
	<?php
	}
	?>
     <?php
            include __DIR__."/chunk/page_header.php";
                    if(isset($tpl) && is_file(__DIR__."/".$tpl.'.php') && file_exists(__DIR__."/".$tpl.'.php'))
                    {
                        include(__DIR__."/".$tpl.'.php');
                    }
                 ?>	
   <?php
	if($class!="items")
	{
	?>
    </div>
	<?php
	}
	?>           
    
 <!-- content close -->
 <a href="#" id="back-to-top"></a>
<?php
include __DIR__."/chunk/footer.php";
?>
</div>
 <script src="<?=$templates?>js/jquery.countTo.js"></script>
 <script src="<?=$templates?>js/jquery.countdown.js"></script>
 <script src="<?=$templates?>js/jquery.lazy.min.js"></script>
 <script src="<?=$templates?>js/jquery.lazy.plugins.min.js"></script>
 <script src="<?=$templates?>js/designesia.js"></script>

    <!-- COOKIES NOTICE  -->
    <script src="<?=$templates?>js/cookit.js"></script>
     <script>
      $(document).ready(function() {
        $.cookit({
          backgroundColor: '#101010',
          messageColor: '#fff',
          linkColor: '#FEF006',
          buttonColor: '#FEF006',
          messageText: "This website uses cookies to ensure you get the best experience on our website.",
          linkText: "Learn more",
          linkUrl: "index.php",
          buttonText: "I accept",
        });
		$(".nft__item_like").on("click", function() {
             var ids = $(this).data("id");
			 /*var iteration = $(this).data('iteration') || 1;
             
             switch (iteration) {
                 case 1:
				 	 alert("Yes");
                     $(this).find("i").addClass("active");
                     var val = parseInt($(this).find("span").text())+1;
                     $(this).find("span").text(val);
                     break;
                 case 2:
				 	 alert("No");
                     $(this).find("i").removeClass("active");
                     var val = parseInt($(this).find("span").text())-1;
                     $(this).find("span").text(val);                   
                     break;
             }
             iteration++;
             if (iteration > 2) iteration = 1;
             $(this).data('iteration', iteration);
			 */
			var $i = $(this).find("i");
			var $span = $(this).find("span");
			 
			var req = post('<?=site_url('nft/hearts')?>',{id:ids});
			req.done(function(out)
			{
				 $i.removeClass("active");
				 if(!out.error)
				 {
					 if(out.status==true)
					 {
						  $i.addClass("active");
					 }
					$span.text(out.heart);    
				 }
				 
			});
			req.fail(function(out)
			{
				smart_message("There Problem  With Action");
			});
         });
		
      });
    </script>
<?php
if(isset($transaksi))
{
	 include(__DIR__."/".$scripts.'.php');
}
?>
<?php
if(isset($cauthors))
{
	 include(__DIR__."/".$scripts.'.php');
}
?>              
 </body>
</html>
 