<?php
$ima = user_balance('image');//user_info('image');
$avatar = "front/images/author_single/author_banner.jpg";
if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
{
	$thumb = getThumb($ima,50,50);
	$avatar =  'cache/'.$thumb;
	 
} 
?>
							<div class="menu_side_area topmenuwallet <?=$class_single?>">
                                    <div class="de-login-menu">
                                        <a href="<?=site_url("nft/create")?>" class="btn-main"><i class="fa fa-plus"></i><span>Create</span></a>

                                        <span id="de-click-menu-notification" class="de-menu-notification">
                                            <span class="d-count">0</span>
                                            <i class="fa fa-bell"></i>
                                        </span>

                                        <span id="de-click-menu-profile" class="de-menu-profile">                           
                                            <img src="<?=$avatar?>" class="img-fluid" alt="">
                                        </span>

                                        <div id="de-submenu-notification" class="de-submenu">
                                            <div class="de-flex">
                                                <div><h4>Notifications</h4></div>
                                                <a href="#">Show all</a>
                                            </div>

                                            <ul>
                                                <!--
                                                <li>
                                                    <a href="#">
                                                        <img class="lazy" src="images/author/author-2.jpg" alt="">
                                                        <div class="d-desc">
                                                            <span class="d-name"><b>Mamie Barnett</b> started following you</span>
                                                            <span class="d-time">1 hour ago</span>
                                                        </div>
                                                    </a>  
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="lazy" src="images/author/author-3.jpg" alt="">
                                                        <div class="d-desc">
                                                            <span class="d-name"><b>Nicholas Daniels</b> liked your item</span>
                                                            <span class="d-time">2 hours ago</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="lazy" src="images/author/author-4.jpg" alt="">
                                                        <div class="d-desc">
                                                            <span class="d-name"><b>Lori Hart</b> started following you</span>
                                                            <span class="d-time">18 hours ago</span>
                                                        </div>
                                                    </a>    
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="lazy" src="images/author/author-5.jpg" alt="">
                                                        <div class="d-desc">
                                                            <span class="d-name"><b>Jimmy Wright</b> liked your item</span>
                                                            <span class="d-time">1 day ago</span>
                                                        </div>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#">
                                                        <img class="lazy" src="images/author/author-6.jpg" alt="">
                                                        <div class="d-desc">
                                                            <span class="d-name"><b>Karla Sharp</b> started following you</span>
                                                            <span class="d-time">3 days ago</span>
                                                        </div>
                                                    </a>    
                                                </li>
                                                -->
                                            </ul>
                                        </div>

                                        <div id="de-submenu-profile" class="de-submenu">
                                            <div class="d-name">
                                                <h4><?=user_info('name')?></h4>
                                                <a href="<?=site_url("profile")?>">Set display name</a>
                                            </div>
                                            <div class="spacer-10"></div>
                                            <div class="d-balance">
                                                <h4>Balance</h4>
                                                <?php
													$balance = floatval(get_token_balance());
													if($balance==0)
													{
														$balance = user_info("token_balance");														
													}
												?>
                                                 <span class="tokenbalance"><?=number_format($balance,0)?></span> <?=setting("token_transaksi")?> 
                                            </div>
                                            <div class="spacer-10"></div>
                                            <div class="d-wallet" <?=($class!="nft" && is_wallet())?'id="vm"':""?>>
                                                <h4>My Wallet</h4>
                                                <span id="wallet" class="d-wallet-address btn-wallet" ><?=get_wallet()?></span>
                                                <button id="btn_copy" title="Copy Text">Copy</button>
                                                <button id="btn_change" class="btn btn-warning " title="Change">Change</button>
                                            </div>

                                            <div class="d-line"></div>

                                            <ul class="de-submenu-profile">
                                                 
                                                <li><a href="<?=site_url("profile/author")?>"><i class="fa fa-user"></i> My profile</a>
                                                <li><a href="<?=site_url("profile")?>"><i class="fa fa-pencil"></i> Edit profile</a>
                                                 
                                                <li><a href="<?=site_url("logout")?>"><i class="fa fa-sign-out"></i> Sign out</a>
                                            </ul>
                                        </div>
                                        <span id="menu-btn"></span>
                                    </div>
                                </div>
                                <!-- -->
                              