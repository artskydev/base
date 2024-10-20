 <!-- nft item begin -->
 <?php
 if(count($auction)>0)
 {
	 for($i=0;$i<count($auction);$i++)
	 {
		 $items = $auction[$i];
 ?>
 		<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        		<?php
					include __DIR__."/items.php";
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