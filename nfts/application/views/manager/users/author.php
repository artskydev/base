 <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            
            <?php
            $banner = "front/images/author_single/author_banner.jpg";
			$bannerfull = "front/images/author_single/author_banner.jpg";
			if(!empty($data['banner']) && is_file(config_item('upload_path').$data['banner']) && file_exists(config_item('upload_path').$data['banner']))
			{
				$thumb = getThumb($data['banner'],200,200);
				$banner =  'cache/'.$thumb;
				$bannerfull =  config_item('main_site').'uploads/'.$data['banner'];
			}
			?>
             <style type="text/css">
			 .urls
			 {
				background-image:url('<?=$bannerfull?>')  !important;
				 
				 
			 }
			 </style>
            <!-- section begin -->
            <section id="profile_banner" aria-label="section" class="text-light urls"  >
                    
            </section>
            <!-- section close -->
            
			<?php
			$ima = $data['image'];
			$avatars = "front/images/author_single/author_banner.jpg";
			if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
			{
				$thumb = getThumb($ima,150,150);
				$avatars =  'cache/'.$thumb;
				 
			} 
			?>
            <section aria-label="section">
                <div class="container">
					<div class="row">
					    <div class="col-md-12">
                           <div class="d_profile de-flex">
                                <div class="de-flex-col">
                                    <div class="profile_avatar">
                                        <img src="<?=$avatars?>" alt="">
                                        <i class="fa fa-check"></i>
                                        <div class="profile_name">
                                            <h4>
                                                <?=$data['name']?>
                                                <span class="profile_username" style="color:#0FF;"> Profile ID : <?=$data['uuid']?></span>
                                                <span class="profile_username"><?=!empty($data['instagram'])?"@".$data['instagram']:""?></span>
                                                <?php
												$wallet = "";
												if(!empty($data['wallet_address']))
												{
													$wallet = $data['wallet_address'];
													
												}
												if($data['id']==user_info('id'))
												{
													$wallet = get_wallet();	
												}	
												?>
                                                <input type="hidden" id="ids_users" value="<?=$data['id']?>" />
                                                <span id="wallet" class="profile_wallet"><?=$wallet?></span>
                                                <button id="btn_copyed" onclick="javascript:copyTexted('btn_copyed','.profile_wallet');" title="Copy Text">Copy</button>
                                                 
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="profile_follow de-flex">
                                    <div class="de-flex-col">
                                        <div class="profile_follower">0 followers</div>
                                    </div>
                                    <div class="de-flex-col">
                                        <a href="#" class="btn-main">Follow</a>
                                    </div>
                                </div>
                                -->

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="de_tab tab_simple">
    
                                <ul class="de_nav">
                                    <li class="active"><span>Fixed Price</span></li>
                                   <?php
								   /*
                                    <li><span>Auction</span></li>
                                    */
									?>
									
									<li><span>Liked</span></li>
                                   <!--  <li><span>Collection</span></li>-->
                                    <li class="collectible xhide"><span>Colection</span></li>
                                </ul>
                                
                                <div class="de_tab_content">
                                     <div class="tab-1  ">
                                         <div class="row">
                                                   <?php
												   	include __DIR__."/isi_auth/tab1.php"
												   ?>
                                        </div>            
                                    </div>  
                                   <?php
								   /*
                                    <div class=" tab-2  ">
                                         <div class="row">
                                                   <?php
												   	include __DIR__."/isi_auth/tab2.php"
												   ?>
                                        </div>            
                                    </div>
                                    */
									?>
									<div class=" tab-2">
                                         <div class="row">
                                                   <?php
												   	include __DIR__."/isi_auth/tab3.php"
												   ?>
                                        </div>            
                                    </div>  
                                    <div class=" tab-3">
                                         <div class="row tabcollection">
                                                    
                                        </div>            
                                    </div>  
									<?php
                                    /*
                                    <div class="tab-1">
                                        <div class="row">
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="de_countdown" data-year="2022" data-month="4" data-day="16" data-hour="8"></div>
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-1.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>Pinky Ocean</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.08 ETH<span>1/20</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>50</span>
                                                            </div>                            
                                                        </div> 
                                                    </div>
                                                </div>                 
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-2.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>The Animals</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.06 ETH<span>1/22</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>80</span>
                                                            </div>                                 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="de_countdown" data-year="2022" data-month="4" data-day="14" data-hour="8"></div>
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-3.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>Three Donuts</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.05 ETH<span>1/11</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>97</span>
                                                            </div>                                 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-4.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>Graffiti Colors</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.02 ETH<span>1/15</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>73</span>
                                                            </div>                                 
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                    <div class="tab-2">
                                        <div class="row">

                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="de_countdown" data-year="2022" data-month="4" data-day="14" data-hour="8"></div>
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-3.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>Three Donuts</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.05 ETH<span>1/11</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>97</span>
                                                            </div>                                 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="de_countdown" data-year="2022" data-month="4" data-day="16" data-hour="8"></div>
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-1.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>Pinky Ocean</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.08 ETH<span>1/20</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>50</span>
                                                            </div>                            
                                                        </div> 
                                                    </div>
                                                </div>                 
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-2.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>The Animals</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.06 ETH<span>1/22</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>80</span>
                                                            </div>                                 
                                                        </div> 
                                                    </div>
                                                </div>
                                                <!-- nft item begin -->
                                                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                                    <div class="nft__item">
                                                        <div class="author_list_pp">
                                                            <a href="author.php">                                    
                                                                <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_wrap">
                                                            <div class="nft__item_extra">
                                                                <div class="nft__item_buttons">
                                                                    <button onclick="location.href='item-details.php'">Buy Now</button>
                                                                    <div class="nft__item_share">
                                                                        <h4>Share</h4>
                                                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-facebook fa-lg"></i></a>
                                                                        <a href="https://twitter.com/intent/tweet?url=https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io" target="_blank"><i class="fa fa-twitter fa-lg"></i></a>
                                                                        <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site https://Velocita Technology Inc Ltd.  27 Old Gloucester Street, London, WC1N 3AX, UK.io"><i class="fa fa-envelope fa-lg"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <a href="item-details.php">
                                                                <img src="images/author_single/porto-4.jpg" class="lazy nft__item_preview" alt="">
                                                            </a>
                                                        </div>
                                                        <div class="nft__item_info">
                                                            <a href="item-details.php">
                                                                <h4>Graffiti Colors</h4>
                                                            </a>
                                                            <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                                0.02 ETH<span>1/15</span>
                                                            </div>
                                                            <div class="nft__item_action">
                                                                <a href="#">Place a bid</a>
                                                            </div>
                                                            <div class="nft__item_like">
                                                                <i class="fa fa-heart"></i><span>73</span>
                                                            </div>                                 
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="tab-3">
                                        <div class="row">
                                            <!-- nft item begin -->
                                            <div class="col-lg-3 col-md-6">
                                                <div class="nft__item">
                                                    <div class="author_list_pp">
                                                        <a href="author.php">                                    
                                                            <img class="lazy" src="images/author/author-1.jpg" alt="">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_wrap">
                                                        <a href="item-details.php">
                                                            <img src="images/items/anim-4.jpg" class="lazy nft__item_preview" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_info">
                                                        <a href="item-details.php">
                                                            <h4>The Truth</h4>
                                                        </a>
                                                        <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                            0.06 ETH<span>1/20</span>
                                                        </div>
                                                        <div class="nft__item_action">
                                                            <a href="#">Place a bid</a>
                                                        </div>
                                                        <div class="nft__item_like">
                                                            <i class="fa fa-heart"></i><span>26</span>
                                                        </div>                                 
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- nft item begin -->
                                            <div class="col-lg-3 col-md-6">
                                                <div class="nft__item">
                                                    <div class="de_countdown" data-year="2022" data-month="4" data-day="6" data-hour="8"></div>
                                                    <div class="author_list_pp">
                                                        <a href="author.php">                                    
                                                            <img class="lazy" src="images/author/author-2.jpg" alt="">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_wrap">
                                                        <a href="item-details.php">
                                                            <img src="images/items/anim-2.jpg" class="lazy nft__item_preview" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_info">
                                                        <a href="item-details.php">
                                                            <h4>Running Puppets</h4>
                                                        </a>
                                                        <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                            0.03 ETH<span>1/24</span>
                                                        </div>    
                                                        <div class="nft__item_action">
                                                            <a href="#">Place a bid</a>
                                                        </div>
                                                        <div class="nft__item_like">
                                                            <i class="fa fa-heart"></i><span>45</span>
                                                        </div>                                  
                                                    </div> 
                                                </div>
                                            </div>
                                            <!-- nft item begin -->
                                            <div class="col-lg-3 col-md-6">
                                                <div class="nft__item">
                                                    <div class="author_list_pp">
                                                        <a href="author.php">                                    
                                                            <img class="lazy" src="images/author/author-3.jpg" alt="">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_wrap">
                                                        <a href="item-details.php">
                                                            <img src="images/items/anim-1.jpg" class="lazy nft__item_preview" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_info">
                                                        <a href="item-details.php">
                                                            <h4>USA Wordmation</h4>
                                                        </a>
                                                        <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                            0.09 ETH<span>1/25</span>
                                                        </div>
                                                        <div class="nft__item_action">
                                                            <a href="#">Place a bid</a>
                                                        </div>
                                                        <div class="nft__item_like">
                                                            <i class="fa fa-heart"></i><span>76</span>
                                                        </div>                                 
                                                    </div> 
                                                </div>
                                            </div>
                                            <!-- nft item begin -->
                                            <div class="col-lg-3 col-md-6">
                                                <div class="nft__item">
                                                    <div class="de_countdown" data-year="2022" data-month="4" data-day="8" data-hour="8"></div>
                                                    <div class="author_list_pp">
                                                        <a href="author.php">                                    
                                                            <img class="lazy" src="images/author/author-4.jpg" alt="">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_wrap">
                                                        <a href="item-details.php">
                                                            <img src="images/items/anim-5.jpg" class="lazy nft__item_preview" alt="">
                                                        </a>
                                                    </div>
                                                    <div class="nft__item_info">
                                                        <a href="item-details.php">
                                                            <h4>Loop Donut</h4>
                                                        </a>
                                                        <div class="nft__item_click">
                                        <span></span>
                                    </div>
                                    <div class="nft__item_price">
                                                            0.09 ETH<span>1/14</span>
                                                        </div>
                                                        <div class="nft__item_action">
                                                            <a href="#">Place a bid</a>
                                                        </div>
                                                        <div class="nft__item_like">
                                                            <i class="fa fa-heart"></i><span>94</span>
                                                        </div>                                 
                                                    </div> 
                                                </div>
                                            </div>                                                
                                        </div>
                                    </div>
                                    
                                </div>
                                */
								?>
                            </div>
                        </div>
                    </div>
				</div>
            </section>
			
			
        </div>
        <!-- content close -->
        