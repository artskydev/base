 <!-- content begin -->

        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

            <section id="section-hero" class="no-bottom" aria-label="section">

                <div class="d-carousel">

                    <div id="item-carousel-big" class="owl-carousel wow fadeIn">

                       <?php
					   for($i=0;$i<count($banners);$i++)
					   {
					   ?> 
                        <div class="nft_pic">                            

                            <a href="<?=site_url('items/view/'.$banners[$i]['tokenid'])?>">

                                <span class="nft_pic_info">

                                    <span class="nft_pic_title"><?=$banners[$i]['name']?></span>

                                    <span class="nft_pic_by"><?=$banners[$i]['brand']?></span>

                                </span>

                            </a>

                            <div class="nft_pic_wrap">

                                <img src="<?=$banners[$i]['ipfs']?>" class="lazy img-fluid" alt="">

                            </div>

                        </div>
                        
                        <?php
					    }
						?>



                         

                    </div>

                        <div class="d-arrow-left"><i class="fa fa-angle-left"></i></div>

                        <div class="d-arrow-right"><i class="fa fa-angle-right"></i></div>

                </div>

            </section>



            <section id="section-collections" class="pt30 pb30">

                <div class="container">
                			<div class="spacer-single"></div>
                            
                           

                            <div class="row wow fadeIn"> 

                                <div class="col-lg-12">

                                    <h2 class="style-2">New Items</h2>

                                </div>



                                <!-- nft item begin -->
                                <?php
									    $now = date('Y-m-d h:i:s');
										for($i=0;$i<count($news);$i++)
										{
											$items = $news[$i];
											$ima = $news[$i]['customers'];
											$avatars = "front/images/author_single/author_banner.jpg";
											if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
											{
												$thumb = getThumb($ima,150,150);
												$avatars =  'cache/'.$thumb;
												 
											} 
											
									   ?>
                                     <div class="d-item showing_new col-lg-3 col-md-6 col-sm-6 col-xs-12">  
                                       	<div class="nft__item">
                                             <?php
													if($items['tipe']==2)
													{
														if(strtotime($now) < strtotime($items['end_date']))
														{
														
												?>
														<div class="de_countdown" data-year="<?=floatval($items['tahun_limit'])?>" data-month="<?=floatval($items['bulan_limit'])?>" data-day="<?=floatval($items['day_limit'])?>" data-hour="8"></div>
												
												
												<?php
														}
													}
												?>
                                            
                                            <div class="author_list_pp">
                                                 
                                                <a href="<?=site_url('author/view/'.$news[$i]['uuid'])?>">                                    
                                                    <img class="lazy profileitem" src="<?=$avatars?>" alt="">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>
                                            <div class="nft__item_wrap">
                                                <div class="nft__item_extra">
                                                    <div class="nft__item_buttons">
                                                        <button onclick="location.href='<?=site_url('items/view/'.$items['tokenid'])?>'">Buy Now</button>
                                                        <div class="nft__item_share">
                                                            <h4>Share</h4>
                                                             <a href="https://www.facebook.com/sharer/sharer.php?u=<?=site_url('items/view/'.$items['tokenid'])?>" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=<?=site_url('items/view/'.$items['tokenid'])?>" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?=site_url('items/view/'.$items['tokenid'])?>"><i class="fa fa-envelope fa-lg"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                                    <img src="<?=$items['ipfs']?>" id="get_file_2" class="lazy nft__item_preview" alt="">
                                                </a>
                                            </div>
                                            <div class="nft__item_info">
                                                <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                                    <h4> <?=$items['name']?></h4>
                                                </a>
                                                <div class="nft__item_click">
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
                                                     <a href="<?=site_url('items/view/'.$items['tokenid'])?>">Buy Now</a>
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
									?>

                                <!-- end nft item begin -->

                            </div>



                            
                            <div class="spacer-single"></div>
                            
                          
                             
                            <div class="row">

                                <div class="col-lg-12">

                                    <h2 class="style-2">Hot Brands</h2>

                                </div>

                                <div id="collection-carousel-alt" class="owl-carousel wow fadeIn">
                                	
                                    
                                    <?php
										for($i=0;$i<count($hot);$i++)
										{
											$ima = $hot[$i]['image'];
											$avatars = "front/images/author_single/author_banner.jpg";
											if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
											{
												$thumb = getThumb($ima,150,150);
												$avatars =  'cache/'.$thumb;
												 
											} 
											$ima_bans = $hot[$i]['image_brand'];
											$bans = "front/images/collections/coll-1.jpg";
											if(!empty($ima_bans) && is_file(config_item('upload_path').$ima_bans) && file_exists(config_item('upload_path').$ima_bans))
											{
												$thumb = getThumb($ima_bans,1080,800);
												$bans =  'cache/'.$thumb;
												 
											} 
									?>
                                        <div class="nft_coll style-2">

                                            <div class="nft_wrap">

                                                <a href="<?=site_url("explorer/view")?>?qq=<?=urlencode($hot[$i]['brand'])?>"><img src="<?=$bans?>" class="lazy img-fluid" alt=""></a>

                                            </div>

                                            <div class="nft_coll_pp">

                                                <a href="<?=site_url("explorer/view")?>?qq=<?=urlencode($hot[$i]['brand'])?>"><img class="lazy pp-coll" src="<?=$avatars?>" alt=""></a>

                                                <i class="fa fa-check"></i>

                                            </div>

                                            <div class="nft_coll_info">

                                                <a href="<?=site_url("explorer/view")?>?qq=<?=urlencode($hot[$i]['brand'])?>"><h4><?=$hot[$i]['name']?></h4></a>

                                                <span><?=$hot[$i]['brand']?></span>

                                            </div>

                                        </div>
                                        
                                        <?php
										}
										?>

                                    

                                        

                                        

                                    </div>

                                </div>
                             
                            <!-- end slider-->

                                <div class="spacer-double"></div>



                                <div class="row">

                                    <div class="col-lg-12">

                                        <h2 class="style-2">Top Brand</h2>

                                    </div>

                                    <div class="col-md-12 wow fadeIn">

                                        <ol class="author_list">

                                            <?php
												$now = date('Y-m-d h:i:s');
												for($i=0;$i<count($tops);$i++)
												{
													$items = $tops[$i];
													$ima = $tops[$i]['image'];
													$avatars = "front/images/author_single/author_banner.jpg";
													if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
													{
														$thumb = getThumb($ima,150,150);
														$avatars =  'cache/'.$thumb;
														 
													} 
													
											   ?>
												<li>                                    
													<div class="author_list_pp">
														 <a href="<?=site_url('author/view/'.$tops[$i]['uuid'])?>">                                    
															<img class="lazy pp-author" src="<?=$avatars?>" alt="">
															<i class="fa fa-check"></i>
														</a>
													</div>                                    
													<div class="author_list_info">
														<a href="<?=site_url('author/view/'.$tops[$i]['uuid'])?>"><?=$tops[$i]['name']?></a>
														
														<span>
														<?=floatval($tops[$i]['toped'])." ".setting("token_name")?>
														
														</span>
														
													</div>
												</li>
										 <?php
												}
										 ?>   

                                        </ol>

                                    </div>

                                </div>
                              

                        </div>

            </section>

 

            

        </div>

        <!-- content close -->
 <style>
.xmir
{
	padding-left:50px;	
}
.nxms
{
	background: url(<?=$templates?>images/banner.jpg) !important;
}
.imgnft
{
	height:190px;	
}
.nft_coll_pp .profileitem 
{
	height:50px;	
}
.author_list_pp a img
{
	height:50px !important;	
}
.author_list
{
	column-count: <?=(count($tops)<5)?1:5?>;
	column-gap: 10px;
}
@media screen and (max-width: 600px) {
	.xmir
	{
		padding: 20px 0;
		
			
	}	
	.nxms
	{
		background:#212428 !important;
	}
	.author_list
	{
		column-count: 1;
		column-gap: 10px;
	}
}


</style>          