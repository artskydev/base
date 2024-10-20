<!-- content begin -->
        <div class="no-bottom" id="content">
            <div id="top"></div>

            <!-- section begin -->
			<section aria-label="section" style="min-height:700px;">
                <div class="container">
                    <div class="row wow fadeIn">
                         
                        <!-- -->
                        <div class="col-lg-12">



                            <div class="items_filter">

                                <form action="javascript:void(0);" class="row form-dark" id="form_quick_search" mARTSod="post" name="form_quick_search">

                                    <div class="col text-center">

                                        <input class="form-control" id="name_1" name="name_1" placeholder="search item here..." type="text" value="<?=$qq?>"/> <a href="javascript:void(0);" id="btn-submit"><i class="fa fa-search bg-color-secondary"></i></a>

                                        <div class="clearfix"></div>

                                    </div>

                                </form>
                                 
                                <div id="item_category" class="dropdown">
                                   <?php
								   	$catall = "All categories";
									if(!empty($catname))
									{
										$catall = $catname;	
									}
								   ?>
                                   <a href="#" class="btn-selector"><?=$catall?></a>

                                    <ul>
                                    	 <li class="active"><span>All categories</span></li>
										<?php
										for($i=0;$i<count($cats);$i++)
										{
											$actived = "";
											if($cats[$i]['name']==$catname)
											{
												$actived = 'class="active"';
											}
										?>

                                       		 <li <?=$actived?>><span><?=$cats[$i]['name']?></span></li>
                                        <?php
										}
										?>

                                        

                                    </ul>
 

                                </div>
                                <div id="items_type" class="dropdown">

                                    <a href="#" class="btn-selector">All Brand</a>

                                    <ul>

                                        <li class="active"><span>All Brand</span></li>

                                       <?php
										for($i=0;$i<count($brand);$i++)
										{
										?>

                                       		 <li><span><?=$brand[$i]['name']?></span></li>
                                        <?php
										}
										?>

                                    </ul>

                                </div>

                                 
                                
                                <form id="form-explorer"  method="get" action="javascript:void(0);">
                                 	 <input type="hidden" value="0" name="page" id="page" />
                                     <input type="hidden" value="" name="category" id="category" />
                                     <input type="hidden" value="" name="brand" id="brand" />
                                     <input type="hidden" value="" name="q" id="q" />
                                     
                                 </form>



                                



                            </div>

                        </div>  
                        <!-- -->
                        <div class="col-md-12">
                            
                            <div class="row"  >
                               			 <!-- nft item begin -->
                               
                                	 
                                    	<div class="row" id="itemsnft">
                                        	
                                        </div>
                                    
                                   
                                      
                                             
                              
								 <div class="col-md-12 text-center">
                                    <a href="javascript:void(0);" id="cloadmore" class="btn-main wow fadeInUp lead">Load more</a>
                                </div> 
                                
                            </div>
                            
                        </div>   
                        
                                          
                    </div>
                </div>
            </section>

        </div>
        <!-- content close -->
        <script>
		var xpages = 0;
		var loadmore = false;
		$(function()
		{
			loadmored();
			$("#cloadmore").click(function()
			{
				loadmore = true;
				xpages += 1;
				loadmored();
			});
			$(".checkv").on("click",function()
			{
				xpages = 0;
				loadmored();
			});
			insert_form();
		});
		function insert_form()
		{
			var ccat = $('#item_category a.btn-selector').text();
			$("#form-explorer #category").val(ccat);
			var item_brand = $('#items_type a.btn-selector').text();
			$("#form-explorer #brand").val(item_brand);
			
			var qq = $("#form_quick_search #name_1").val();
			$("#form-explorer #q").val(qq);
			loadmored();
			
		}
		function loadmored()
		{
			//var cpages = $("#page").val();
			//cpages = parseFloat(cpages);
			$("#page").val(xpages); 
			var data = new FormData($("#form-explorer")[0]);
			var req = postFile('<?=site_url("explorer/exs")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					$("#cloadmore").removeClass("cvis");
					console.log(out);
					if(loadmore==true)
					{
						$("#itemsnft").append(out.temps);
						
						
						loadmore = false;
					}else
					{
						$("#itemsnft").html(out.temps);
						  
					}
					
					if(out.data.length==0)
					{
						$("#cloadmore").addClass("cvis");
					}
					setTimeout(function()
					{
						jQuery('.nft__item_wrap').each(function() {
							 w = jQuery(this).css('width');
							 jQuery(this).css('height',w);
						 });
				
						  $(".nft__item_preview").on("load", function() {
							}).each(function() {
							  if(this.complete) {
								 
									var width = $(this).width(); //jQuery width method
									var height = $(this).height(); //jQuery height method
				
									if(width < height){
										$(this).addClass('portrait');
										$(this).parent().addClass('portrait');
									}
				
							  }
							});
					},600);
				}
				else
				{
					 
				}
			});
			return false;
		}
		$("#form_quick_search").submit(function()
		{
			insert_form();
		});
		$("#btn-submit").click(function()
		{
			$("#form_quick_search").trigger("submit");
		});
		$('#item_category').click(function()
		{
			 xpages = 0;
			 insert_form();
		});
		$('#items_type').click(function()
		{
			 xpages = 0;
			 insert_form();
		});
		</script>
<style type="text/css">
#cloadmore {
    display: inline-block !important;
    margin-top: 10px;
}
#cloadmore.cvis
{
	visibility:hidden !important;
}
 
.select2-container--default .select2-selection--single {
    background-color: transparent;
     
}
.select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #fff;
}
</style>    