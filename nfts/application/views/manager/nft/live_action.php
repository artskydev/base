	<!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            
            <!-- section begin -->
            <section id="subheader" class="text-light" data-bgimage="url(front/images/background/subheader.jpg) top">
                    <div class="center-y relative text-center">
                        <div class="container">
                            <div class="row">
                                
                                <div class="col-md-12 text-center">
									<h1>Live Auction</h1>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </section>
        <!-- section close -->
    	 <!-- section begin -->
            <section aria-label="section">
                <div class="container">
                    <div class="row wow fadeIn">
                        <!-- nft item begin -->
                    <?php
					if(count($arr)>0)
					{
						for($i=0;$i<count($arr);$i++)
						{
							$items = $arr[$i];
							 
											if(isset($items['id']))
											{
												$avatar = "uploads/default.png";
												 
												if(!empty($items['customers']) && is_file(config_item('upload_path').$items['customers']) && file_exists(config_item('upload_path').$items['customers']))
												{
													$thumb = getThumb($items['customers'],200,200);
													$avatar =  'cache/'.$thumb;
													 
												}	
							$now = date('Y-m-d h:i:s');
					?>		
                        <div class="d-item col-lg-3 col-md-6 col-sm-6 col-xs-12">
                            <div class="nft__item nft_layout-2">                                
                                <div class="author_list_pp">
                                     <a href="<?=site_url('author/view/'.$items['uuid'])?>" data-bs-toggle="tooltip" data-bs-placement="top" title="Creator: <?=$items['name_cus']?>">                     
                                         <img class="lazy" src="<?=$avatar?>" alt="">
                                        <i class="fa fa-check"></i>
                                    </a>
                                </div>
                                <div class="nft__item_wrap">
                                    <div class="nft__item_extra">
                                        <div class="nft__item_buttons">
                                            <button onclick="location.href='item-details.php'">Buy Now</button>
                                            <div class="nft__item_share">
                                                <h4>Share</h4>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url('items/view/'.$items['tokenid'])?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                <a href="https://twitter.com/intent/tweet?url=<?=site_url('items/view/'.$items['tokenid'])?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?=site_url('items/view/'.$items['tokenid'])?>"><i class="fa fa-envelope fa-lg"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                        <img src="<?=$items['ipfs']?>" class="lazy nft__item_preview " alt=""  >
                                    </a>
                                </div>
                                <div class="nft__item_info">
                                    <div class="de_countdown" data-year="<?=floatval($items['tahun_limit'])?>" data-month="<?=floatval($items['bulan_limit'])?>" data-day="<?=floatval($items['day_limit'])?>" data-hour="8"></div>
                                    
                                   <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                                    <h4><?=$items['name']?></h4>
                                    </a>
                                    <div class="nft__item_click display-none">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                        <?php
										$text_price =  $items['price']." ".setting("token_name");
										if($items['tipe']==2)
										{
											$text_price = "Min :<span> ". $items['minimum_bid']." ".setting("token_name")."</span>"; 
										}
										?>
										<?=$text_price?> 
                                    </div>
                                    <div class="nft__item_action">
                                        <a href="<?=site_url('items/view/'.$items['tokenid'])?>">Place a bid</a>
                                    </div>
                                    <?php
													if(!empty(user_info('id')))
													{
														
												?>
                                                <div class="nft__item_like " data-id="<?=$items['id']?>">
                                                    <i class="fa fa-heart <?=($items['total_liked']>0)?'active':''?>"></i><span><?=$items['total_liked']?></span>
                                                </div>
                                                <?php
													}
									 ?>                                
                                </div> 
                            </div>
                        </div>
                  <?php
                     			}
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
                    </div>
                </div>
            </section>

        </div>
        <!-- content close -->
<script>
$(function()
{
	 	 
});
</script>