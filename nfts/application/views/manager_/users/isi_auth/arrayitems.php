<?php
 if(count($data)>0)
 {
	 for($i=0;$i<count($data);$i++)
	 {
		 $items = $data[$i];
 ?>
 		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        		<?php
					include __DIR__."/vitems.php";
				?>	
        
        </div>       
  <?php
	 	}
	 }else
	 {
  ?>                                              
                                                
 <div class="col-lg-12">
 	<div class="nft__item">
    	<div class="nft__item_wrap">	
        	<h4>No Items Yet</h4>
        </div>
    </div>
 </div>
 <?php
	 }
 ?>
 <script>
 jQuery(function()
 {
	jQuery(".nft__item_click_tos").on("click", function() {
             var iteration = $(this).data('iteration') || 1;
             
             switch (iteration) {
                 case 1:
                     var cover = jQuery(this).parent().parent().find('.nft__item_extra');
                     cover.css("visibility","visible");
                     cover.css("opacity","1");
                     break;
                 case 2:
                     var cover = jQuery(this).parent().parent().find('.nft__item_extra');
                     cover.css("visibility","hidden");
                     cover.css("opacity","0");
                     break;
             }
             iteration++;
             if (iteration > 2) iteration = 1;
             $(this).data('iteration', iteration);
         }); 
 });
 </script>