<!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <section id="section-hero" aria-label="section" class="no-top no-bottom nxms" data-bgimage="none">
                <div class="v-center">
                    <div class="container">
                         
                    </div>
                </div>
            </section>
            <section id="section-intro" class="no-top no-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 mb-sm-30">
                            <div class="feature-box f-boxed style-3">
                                <i class="wow fadeInUp bg-color-2 i-boxed icon_wallet"></i>
                                <div class="text">
                                    <h4 class="wow fadeInUp">Connect your wallet</h4>
                                    <p class="wow fadeInUp" data-wow-delay=".25s">Use Trust Wallet or Metamask to connect to the app</p>
                                </div>
                                <i class="wm icon_wallet"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-sm-30">
                            <div class="feature-box f-boxed style-3">
                                <i class="wow fadeInUp bg-color-2 i-boxed icon_cloud-upload_alt"></i>
                                <div class="text">
                                    <h4 class="wow fadeInUp">Create your NFT
</h4>
                                    <p class="wow fadeInUp" data-wow-delay=".25s">
                                    Upload your NFTs, set the price and mint
                                    </p>
                                </div>
                                <i class="wm icon_cloud-upload_alt"></i>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 mb-sm-30">
                            <div class="feature-box f-boxed style-3">
                                <i class="wow fadeInUp bg-color-2 i-boxed icon_tags_alt"></i>
                                <div class="text">
                                    <h4 class="wow fadeInUp">Start Earning ARTSKY</h4>
                                    <p class="wow fadeInUp" data-wow-delay=".25s">Earn ARTSKY for all your NFTs that you trade</p>
                                </div>
                                <i class="wm icon_tags_alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </section>            
		<?php
		if(count($nft)>0)
		{
		?>
            <section id="section-collections" class="no-bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h2>Hot Collections</h2>
                                <div class="small-border bg-color-2"></div>
                            </div>
                        </div>
                        <div id="collection-carousel" class="owl-carousel wow fadeIn">
								<?php
								for($i=0;$i<count($nft);$i++)
								{
									$ima = $nft[$i]['customers'];
									$avatars = "front/images/author_single/author_banner.jpg";
									if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
									{
										$thumb = getThumb($ima,150,150);
										$avatars =  'cache/'.$thumb;
										 
									} 
								?>
                                <div class="nft_coll">
                                    <div class="nft__item_wrap  ">
                                        <a href="<?=site_url('items/view/'.$nft[$i]['tokenid'])?>"><img src="<?=$nft[$i]['ipfs']?>"      class="lazy img-fluid  " alt=""></a>
                                    </div>
                                    <div class="nft_coll_pp">
                                        <a href="<?=site_url('author/view/'.$nft[$i]['uuid'])?>"><img class="lazy pp-coll profileitem" src="<?=$avatars?>"  alt=""></a>
                                        <i class="fa fa-check"></i>
                                    </div>
                                    <div class="nft_coll_info">
                                        <a href="<?=site_url('items/view/'.$nft[$i]['tokenid'])?>"><h4><?=$nft[$i]['name']?></h4></a>
                                        <span><?=$nft[$i]['tokenid']?></span>
                                    </div>
                                </div>
                                <?php
								}
								?>
                                 
                                
                            </div>
                        </div>
                    </div>
                </section>
                
             <?php
			}
			 ?>   
			<?php
			if(count($news)>0)
			{
			?>
                <section id="section-items" class="no-bottom">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-center">
                                    <h2>New Items</h2>
                                    <div class="small-border bg-color-2"></div>
                                </div>
                            </div>
                            <div id="items-carousel" class="owl-carousel wow fadeIn">

                               
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
                                     <div class="d-item">  
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
									?>
                                      
                                
                            </div>
                        </div>
                    </section>
				<?php
				}
				?>
            
          <?php
		  if(count($tops)>0)
		  {
		  ?>      
            <section id="section-popular" class="pb-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h2>Top Sellers</h2>
                                <div class="small-border bg-color-2"></div>
                            </div>
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
                                                 <a href="author.php">                                    
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
            <?php
		  	}
			?>
            <?php
			if(count($cats)>0)
			{
			?>      
            <section id="section-category" class="no-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h2>Browse by Property</h2>
                                <div class="small-border bg-color-2"></div>
                            </div>
                        </div>
                        <?php
						$cols = 2;
						if(count($cats)==2)
						{
							$cols = 6;
						}
						if(count($cats)==3)
						{
							$cols = 4;
						}
						if(count($cats)==4)
						{
							$cols = 3;
						}
						if(count($cats)>5)
						{
							$cols = 2;
						}
						for($i=0;$i<count($cats);$i++)
						{
							$aimg = "";
							if(!empty($cats[$i]['image']) && is_file(config_item('upload_path').$cats[$i]['image']) && file_exists(config_item('upload_path').$cats[$i]['image']))
							{
								$thumb = getThumb($cats[$i]['image'],40,40);
								$aimg =  '<img class="img-thumbnail" src="cache/'.$thumb.'" alt="'.$cats[$i]['name'].'">';
							}
							if($i%6==0)
							{
								echo '</div><br/><div class="row">';	
							}
						?>
                        <div class="col-md-<?=$cols?> col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".6s">
                            <a href='<?=site_url("explorer/view/".$cats[$i]['id'])?>' class="icon-box style-2 rounded">
                                <?=$aimg?>
                                <span><?=strtoupper($cats[$i]['name'])?></span>
                            </a>
                        </div>
						<?php
						}
						?>
						<?php
						/*
                        <div class="col-md-2 col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".1s">
                            <a href='explore.php' class="icon-box style-2 rounded">
                                <i class="fa fa-image"></i>
                                <span>Art</span>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".2s">
                            <a href='explore.php' class="icon-box style-2 rounded">
                                <i class="fa fa-music"></i>
                                <span>Music</span>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".3s">
                            <a href='explore.php' class="icon-box style-2 rounded">
                                <i class="fa fa-search"></i>
                                <span>Domain Names</span>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".4s">
                            <a href='explore.php' class="icon-box style-2 rounded">
                                <i class="fa fa-globe"></i>
                                <span>Virtual Worlds</span>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".5s">
                            <a href='explore.php' class="icon-box style-2 rounded">
                                <i class="fa fa-vcard"></i>
                                <span>Trading Cards</span>
                            </a>
                        </div>
                        <div class="col-md-2 col-sm-4 col-6 mb-sm-30 wow fadeInRight" data-wow-delay=".6s">
                            <a href='explore.php' class="icon-box style-2 rounded">
                                <i class="fa fa-th"></i>
                                <span>Collectibles</span>
                            </a>
                        </div>
						*/ ?>
                    </div>
                </div>
            </section>     
            <?php
			}
			?>
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
	column-count: <?=(count($tops)<4)?1:4?>;
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