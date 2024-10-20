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
 <div class="modal fade" id="transfer_now" tabindex="-1" aria-labelledby="buy_now" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered de-modal">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="modal-body">
                <form id="form-transfer" class="form-border" method="post" action="javascript:void(0);">
                <div class="p-3 form-border buy_div">
                    <div class="messages">
                    
                    </div>
                    <h6>Enter Wallet Address For Transfer </h6>
                    <input type="text" name="wallet_to" id="wallet_to"  class="form-control" value="" required="" />
                    <div class="alert alert-warning message-single xhide"></div>
                     
                    <input type="hidden" name="tokenid" id="tokenid" value=""/>
                    
                    <input type="hidden" name="type" id="type" value="2"/> 
                    <input type="hidden" name="wallet_from" id="wallet_from" value=""/>
                    
                      
                    <button type="submit" target="_blank" class="btn-main btn-fullwidth transferbutton">Transfer</button>
                  
                </div>
                </form>   
              </div>
            </div>
          </div>
        </div>
    <?php
	if($class!="nft" || $method!="create" || ($class!="items" && $method!="view"))
	{ 
	?>
    <!-- Info Modal -->
    
    <div id="infoModal" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="infoLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center d-flex">
                    <h4 class="modal-title x-title" id="infoLabel">&nbsp;</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="float-start">
                        <i class="fs-2 bi bi-info-circle"></i>
                    </div>
                    <div class="ms-5 ps-4 float-none">
                        <p class="x-message">&nbsp;</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Loading Modal -->
    <div id="loadingModal" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="loadingLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center d-flex">
                    <h4 class="modal-title x-title" id="loadingLabel">&nbsp;</h4>
                </div>
                <div class="modal-body">
                    <div class="float-start">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div class="ms-5 ps-4 float-none">
                        <p class="x-message">&nbsp;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Modal -->
    <div id="alertModal" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="alertLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center d-flex">
                    <h4 class="modal-title x-title" id="alertLabel">&nbsp;</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="float-start">
                        <i class="fs-2 text-danger bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="ms-5 ps-4 float-none">
                        <p class="x-message">&nbsp;</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div> 
    <div id="FinishModal" class="modal fade" role="dialog" aria-hidden="true" aria-labelledby="alertLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center d-flex">
                    <h4 class="modal-title x-title" id="alertLabel">&nbsp;</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="float-start">
                        <i class="fs-2 text-danger bi bi-exclamation-triangle"></i>
                    </div>
                    <div class="ms-5 ps-4 float-none">
                        <p class="x-message">&nbsp;</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-primary" data-bs-dismiss="modal" aria-label="Close">OK</button>
                </div>
            </div>
        </div>
    </div>    
   <!-- end modaled -->  
   <?php
	}
   ?>
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
		 $("#form-transfer").validate({
				ignore:[],
				onkeyup:false,
				errorClass: 'help-block text-right animated fadeInDown errors',
				errorElement: 'div',
				submitHandler:function(){
					$("#transfer_now").modal("hide"); 
					window.vm.connectWallet();
					 
					window.vm.owneroF(tokenid_ps);
					setTimeout(function()
					{
						window.vm.transfer(tokenid_ps);
					},500);
					
					 
				}
				
			});	
		 $(".btn-follow").on("click", function() {
             var ids = $(this).data("id");
			 var req = post('<?=site_url('author/follows')?>',{id:ids});
				req.done(function(out)
				{
					  $(".sp-follow").text(out.follow);
					  $(".btn-follow").text("Follow");
					  if(out.status==true)
					  {
						  $(".btn-follow").text("Unfollow");
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
<?php
if(isset($nftcreate))
{
	 include(__DIR__."/".$scripts.'.php');
}
?>              
 </body>
</html>
 