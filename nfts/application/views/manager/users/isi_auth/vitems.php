<?php
								if(isset($items['id']))
								{
									$image = "uploads/default.png";
									 
									if(!empty($data['image']) && is_file(config_item('upload_path').$data['image']) && file_exists(config_item('upload_path').$data['image']))
									{
										$thumb = getThumb($data['image'],200,200);
										$image =  'cache/'.$thumb;
										 
									}	
									$now = date('Y-m-d h:i:s');
								?>
                               
                                <div class="nft__item">
                                    
                                    <?php
										if($items['tipe']==2)
										{
											if(strtotime($now) < strtotime($items['end_date']))
											{
											/*
									?>
                                    		<div class="de_countdown" data-year="<?=floatval($items['tahun_limit'])?>" data-month="<?=floatval($items['bulan_limit'])?>" data-day="<?=floatval($items['day_limit'])?>" data-hour="8"></div>
                                    
                                    
                                    <?php
												*/
											}
										}
									?>
                                    <?php
									if(!isset($dont_show))
									{
									?>
                                    <div class="author_list_pp">
                                        <a href="<?=site_url('author/view/'.user_info('uuid'))?>">                                    
                                            <img class="lazy" src="<?=$image?>" alt="">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>
                                    <?php
									}
									?>
                                    <div class="nft__item_wrap">
                                        <div class="nft__item_extra ">
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
                                        <center><h6 style="color:#0F0;"><?=$items['collection']?></h6></center>
                                        <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                            <h4> <?=$items['name']?></h4>
                                        </a>
                                        
                                        <div class="nft__item_click nft__item_click_tos">
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
                                            <!-- 
                                            <span>1/20</span>
                                            -->
                                        </div>
                                        
                                        <div class="nft__item_action">
                                            <a href="<?=site_url('items/view/'.$items['tokenid'])?>">Buy</a>
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
                                <?php
								}
								?>