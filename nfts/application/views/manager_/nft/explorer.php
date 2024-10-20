<!-- content begin -->
        <div class="no-bottom" id="content">
            <div id="top"></div>

            <!-- section begin -->
			<section aria-label="section">
                <div class="container">
                    <div class="row wow fadeIn">
                        <aside class="col-md-3">
                          <form id="form-explorer" class="form-border" method="get" action="javascript:void(0);">
                            <div class="item_filter_group">
                                <h4>Select Properties</h4>
                                <div class="de_form">
                                    <?php
									for($i=0;$i<count($cats);$i++)
									{
									?>
                                    <div class="de_checkbox">
                                        <input id="<?=$cats[$i]['id']?>_cate" <?php if($params==$cats[$i]['id']){?> checked="checked" <?php }?> name="id[]" class="checkv" type="checkbox" value="<?=$cats[$i]['id']?>">
                                        <label for="<?=$cats[$i]['id']?>_cate"><?=$cats[$i]['name']?></label>
                                    </div>
                                    <?php
									}
									?>

                                     

                                </div>
                            </div>

                            <!-- <div class="item_filter_group">
                                <h4>Status</h4>
                                <div class="de_form">
                                    <div class="de_checkbox">
                                        <input id="tipe_1" name="tipe[]" type="checkbox" class="checkv" value="0">
                                        <label for="tipe_1">Buy Now</label>
                                    </div>

                                  
                                    <div class="de_checkbox">
                                        <input id="tipe_2" name="tipe[]" type="checkbox" class="checkv" value="2">
                                        <label for="tipe_2">On Auction</label>
                                    </div>
                                   
 
                                </div>
                            </div>
                             -->
                            <!--
                            <div class="item_filter_group">
                                <h4>Items Type</h4>
                                <div class="de_form">
                                    <div class="de_checkbox">
                                        <input id="check_item_type_1" name="check_item_type_1" type="checkbox" value="check_item_type_1">
                                        <label for="check_item_type_1">Single Items</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="check_item_type_2" name="check_item_type_2" type="checkbox" value="check_item_type_2">
                                        <label for="check_item_type_2">Bundles</label>
                                    </div>
                                </div>
                            </div>

                            <div class="item_filter_group">
                                <h4>Collections</h4>
                                <div class="de_form">
                                    <div class="de_checkbox">
                                        <input id="check_coll_1" name="check_coll_1" type="checkbox" value="check_coll_1">
                                        <label for="check_coll_1">Abstraction</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="check_coll_2" name="check_coll_2" type="checkbox" value="check_coll_2">
                                        <label for="check_coll_2">Patternlicious</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="check_coll_3" name="check_coll_3" type="checkbox" value="check_coll_3">
                                        <label for="check_coll_3">Skecthify</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="check_coll_4" name="check_coll_4" type="checkbox" value="check_coll_4">
                                        <label for="check_coll_4">Cartoonism</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="check_coll_5" name="check_coll_5" type="checkbox" value="check_coll_5">
                                        <label for="check_coll_5">Virtuland</label>
                                    </div>

                                    <div class="de_checkbox">
                                        <input id="check_coll_6" name="check_coll_6" type="checkbox" value="check_coll_6">
                                        <label for="check_coll_6">Papercut</label>
                                    </div>
                                </div>
                            </div>
                            -->
                            <input type="hidden" value="0" name="page" id="page" />
                            </form>
                        </aside>

                        <div class="col-md-9">
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
		});
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
</style>        