<?php
$now = date('Y-m-d h:i:s');
?>
 <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            

            <section aria-label="section" class="mt90 sm-mt-0">
                <div class="container">
					<div class="row">
					    <div class="col-md-6 text-center">
                            <img src="<?=$data['ipfs']?>" class="img-fluid img-rounded mb-sm-30" alt="">
                        </div>
                        <div class="col-md-6">
                            <div class="item_info">
                                 <?php
										if($items['tipe']==2)
										{
											if(strtotime($now) < strtotime($items['end_date']))
											{
											
									?>
                                    		<!--Auctions ends in <div class="de_countdown" data-year="<?=floatval($items['tahun_limit'])?>" data-month="<?=floatval($items['bulan_limit'])?>" data-day="<?=floatval($items['day_limit'])?>" data-hour="8"></div>
                                            -->
                                    
                                    
                                    <?php
											}
										}
									?>
                                <h2><?=$data['name']?> </h2>
                                <div class="item_info_counts">
                                    <div class="item_info_type"><i class="fa fa-image"></i><?=$data['cats']?></div>
                                     <div class="item_info_type"><i class="fa fa-building"></i><?=$data['collection']?></div>
                                   
                                    <div class="item_info_like"><i class="fa fa-heart"></i><?=$data['total_liked']?></div>
                                </div>
                                <p><?=$data['description']?></p>

                                <div class="d-flex flex-row">
                                   <?php
								   if(isset($customers['id']))
								   {
									   	$ima = $customers['image'];
										$avatars = "front/images/author_single/author_banner.jpg";
										if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
										{
											$thumb = getThumb($ima,150,150);
											$avatars =  'cache/'.$thumb;
											 
										}
								   ?>
                                    <div class="mr40">
                                        <h6>Creator</h6>
                                        <div class="item_author">                                    
                                            <div class="author_list_pp">
                                                <a href="<?=site_url("author/view/".$customers['uuid'])?>">
                                                    <img class="lazy" src="<?=$avatars?>" alt="">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>                                    
                                            <div class="author_list_info">
                                                <a href="<?=site_url("author/view/".$customers['uuid'])?>"><?=$customers['name']?></a>
                                            </div>
                                        </div>
                                    </div>
                                   <?php
								   }
								   ?> 
                                    <?php
									/*
                                    <div>
                                        <h6>Collection</h6>
                                        <div class="item_author">                                    
                                            <div class="author_list_pp">
                                                <a href="collection.php">
                                                    <img class="lazy" src="front/images/collections/coll-thumbnail-1.jpg" alt="">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>                                    
                                            <div class="author_list_info">
                                                <a href="collection.php">AnimeSailorClub</a>
                                            </div>
                                        </div>
                                    </div>
									*/
									?>
                                </div>

                                <div class="spacer-40"></div>

                                <div class="de_tab tab_simple">
    
                                <ul class="de_nav">
                                    <li class="active"><span>Details</span></li>
                                    <!--<li><span>Bids</span></li>-->
                                    <li><span>History</span></li>
                                </ul>
                                
                                <div class="de_tab_content">
                                    <div class="tab-1">
                                        <?php
										 
										?>
                                        <div class="ownered">
                                        
                                        </div>

                                        <?php
										 
										?>
                                        <div class="spacer-30"></div>
                                    </div>
									 <?php
									 /*		
                                    <div class="tab-2">
                                       
                                      
									    
										if(count($order_bid)>0)
										{
											for($x=0;$x<count($order_bid);$x++)
											{
										?>
                                        	
                                        <?php
											}
										}else
										{
										?>
                                        		<div class="p_list">
                                                    <div class="p_list_info">
                                                        Currently There no Bid For this item 
                                                    </div>
                                                </div>
                                        <?php
										}
										?>
                                    </div>*/
									?>
                                    
                                    <div class="tab-2">
                                        <?php
										 
										if(count($order_all)>0)
										{
											for($x=0;$x<count($order_all);$x++)
											{
												$ima = $order_all[$x]['image'];
												$avatars = "front/images/author_single/author_banner.jpg";
												if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
												{
													$thumb = getThumb($ima,150,150);
													$avatars =  'cache/'.$thumb;
													 
												}
												$newDateTime = date('m/d/Y, h:i A', strtotime($order_all[$x]['tgl']));
												//$fee = $order_all[$x]['fee_price']/setting("price_token");
										?>
                                        		
                                        		 <div class="p_list">
                                                    <div class="p_list_pp">
                                                        <a href="<?=site_url("author/view/".$order_all[$x]['uuid'])?>">
                                                            <img class="lazy" src="<?=$avatars?>" alt="">
                                                            <i class="fa fa-check"></i>
                                                        </a>
                                                    </div>                                    
                                                    <div class="p_list_info">
                                                        Fee <b><?=$order_all[$x]['fee_price']?> <?=setting("token_transaksi")?></b><br/>
														<?php
														$price = "Buy <b>".($order_all[$x]['price']);
														if($order_all[$x]['type']==1)
														{
															$price = "Bid <b>". $order_all[$x]['price'];
														}
														?>
                                                        <?=$price?> <?=setting("token_name")?></b>
                                                        <span>by <b><?=$order_all[$x]['name']?></b> at <?=$newDateTime?></span>
                                                    </div>
                                                </div>
                                        <?php
											}
										}else
										{
										?>
                                        		<div class="p_list">
                                                    <div class="p_list_info">
                                                        Currently There no History For this item 
                                                    </div>
                                                </div>
                                        <?php
										}
										?>
                                    </div>
                                    
                                </div>

                                <div class="spacer-10"></div>

                                <h6>Price</h6>
                                <!--
                                <div class="nft-item-price"><img src="front/images/misc/ethereum.svg" alt=""><span>0.059</span>($253.67)</div>
                                -->
                                <?php
                                $pricing = $data['price'];
								$text_price =  $data['price']." ".setting("token_name");
								if($data['tipe']==2)
								{
									$pricing = $data['minimum_bid'];
									$text_price = "Min :<span> ". $data['minimum_bid']." ".setting("token_name")."</span>"; 
								}
								?>
								  
                                <div class="nft-item-price"><img src="front/images/misc/usdt.svg" alt=""> <?=$text_price?></div>

                                <!-- Button trigger modal -->
                                <?php
								if(!empty(user_info('id')))
								{
									if(user_info('id')!=$data['id_nftcustomer'])
									{
								?>
                                   
                                    <div class="btn-buy-dialog hide">
                                        <?php
										if($data['tipe']==0)
										{
										?>
                                        <a href="#" class="btn-main btn-lg btn-primary btn-buy-dialog" data-bs-toggle="modal" data-bs-target="#buy_now">
                                          Buy Now
                                        </a>
                                        
                                       
                                        <?php
										}
										?>
                                        <?php
										if($data['tipe']==2)
										{
											/*
										?>
                                        &nbsp;
                                        
                                        <a href="#" class="btn-main btn-lg btn-light" data-bs-toggle="modal" data-bs-target="#place_a_bid">
                                          Place a Bid
                                        </a>
                                        <?php
										*/
										}
										?>
                                        
                                    </div>    
                                    <div class="btn-onlyowner  ">
                                         <a href="#" class="btn-main btn-lg btn-info btn-onlyowner" data-bs-toggle="modal" data-bs-target="#transfer_now"  style="background:#069;">Transfer</a>
                                    </div>
                                     <div class="btn-message-dialog hide">
                                        <strong style='color:green;'>  </strong>
                                     </div>
                                 <?php
									}else
									{
                                 ?>
                                 		<div class="">
                                            <strong style='color:red;'> You Cannot Buy This Item </strong>
                                         </div>
                                 <?php
									}
								 ?>
                                 
                                <?php
								}else
								{
								?>
                                 <a href="<?=site_url('login')?>" class='btn-main btn btn-info'> <span>You need Login to Buy</a>
                                <?php
								}
								?>
                            </div>
                                
                            </div>
                        </div>
                    </div>
				</div>
            </section>
			
			
        </div>
        <!-- content close -->

        <!-- buy now -->
        <div class="modal fade" id="buy_now" tabindex="-1" aria-labelledby="buy_now" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered de-modal">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="modal-body">
                <form id="form-buying" class="form-border" method="post" action="javascript:void(0);">
                <div class="p-3 form-border buy_div">
                    <div class="messages">
                    
                    </div>
                    <h3>Checkout</h3>
                    You are about to purchase a <b><?=$data['name']?> </b> from <b><?=$customers['name']?></b>
                    <div class="spacer-single"></div>
                    <h6>Enter price <?=setting("token_name")?>. </h6>
                    <input type="text" name="price" id="buy_now_qty" min="<?=$pricing?>" class="form-control" value="<?=$pricing?>" readonly/>
                    <div class="spacer-single"></div>
                    <h6>In (<?=setting("token_transaksi")?>)</h6>
                    <input type="text" name="buy_value" id="buy_value" class="form-control" placeholder="In <?=setting("token_transaksi")?>" readonly/>
                    <div class="de-flex">
                        <div>Your Price balance </div>
                        <div><b><span class='buy_balance'>0</span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="de-flex">
                        <div>Your balance</div>
                        <div><b><span class="token_balance"><?=number_format($balance,0)?></span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="de-flex">
                        <div>Service fee <?=setting("nft_fee")?>%</div>
                        <div><b><span class='fee_buy_balance'>0</span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="de-flex">
                        <div>You will pay</div>
                        <div><b><span class='total_buy_balance'>0</span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="spacer-single"></div>
                    <div class="alert alert-warning message-single xhide"></div>
                    <input type="hidden" name="id_nft_supply" id="id_nft_supply" value="<?=$data['id']?>"/>
                    <input type="hidden" name="tokenid" id="tokenid" value="<?=$data['tokenid']?>"/>
                    <input type="hidden" name="fee_hash" id="fee_hash" value=""/>
                    <input type="hidden" name="buy_hash" id="buy_hash" value=""/>
                    <input type="hidden" name="nft_hash" id="nft_hash" value=""/>
                    <input type="hidden" name="nft_hash" id="nft_hash" value=""/>
                    <input type="hidden" name="type" id="type" value="0"/> 
                    <input type="hidden" name="fee_price" id="fee_price" value="0"/> 
                    <input type="hidden" name="customer_from" id="customer_from" value="<?=$data['id_nftcustomer']?>"/> 
                    <input type="hidden" name="wallet_from" id="wallet_from" value=""/>
                    <input type="hidden" name="wallet_to" id="wallet_to" value=""/>
                      
                    <button type="submit" target="_blank" class="btn-main btn-fullwidth buybutton">Add funds</button>
                  
                </div>
                </form>   
              </div>
            </div>
          </div>
        </div>
		 <?php
         $balance = floatval(get_token_balance());
		 if($balance==0)
		 {
			 $balance = user_info("token_balance");														
		 }
		 ?>
        <!-- place a bid -->
        <div class="modal fade" id="place_a_bid" tabindex="-1" aria-labelledby="place_a_bid" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered de-modal">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              <div class="modal-body">
                <div class="p-3 form-border bid_div">
                    <h3>Place a Bid</h3>
                    You are about to place a bid for <b><?=$data['name']?> </b> from <b><?=$customers['name']?></b>
                    <div class="spacer-single"></div>
                    <h6>Enter price <?=setting("token_name")?></h6>
                    <input type="text" name="bid_qty" id="bid_qty" min="<?=$pricing?>" class="form-control" value="<?=$pricing?>" />
                    <div class="spacer-single"></div>
                    <h6>Your bid (<?=setting("token_transaksi")?>)</h6>
                    <input type="text" name="bid_value" id="bid_value" class="form-control" placeholder="In <?=setting("token_transaksi")?>" readonly/>
                    
                    <div class="spacer-single"></div>
                    <div class="de-flex">
                        <div>Your bidding balance</div>
                        <div><b><span class='bid_balance'>0</span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="de-flex">
                        <div>Your balance</div>
                        <div><b><span class="token_balance"><?=number_format($balance,0)?></span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="de-flex">
                        <div>Service fee <?=setting("nft_fee")?>%</div>
                        <div><b><span class='fee_bid_balance'>0</span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="de-flex">
                        <div>You will pay</div>
                        <div><b><span class='total_buy_balance'>0</span> <?=setting("token_transaksi")?></b></div>
                    </div>
                    <div class="spacer-single"></div>
                    <div class="alert alert-warning message-single xhide"></div>
                    <button href="" target="_blank" class="btn-main btn-fullwidth bidbutton">Place a bid</button>
                </div>
              </div>
            </div>
          </div>
        </div>
   <!-- modaled -->
   
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