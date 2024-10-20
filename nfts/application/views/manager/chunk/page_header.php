<?php
$ima = user_info('image');
$avatar = "front/images/author_single/author_banner.jpg";
if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
{
	$thumb = getThumb($ima,150,70);
	$avatar =  'cache/'.$thumb;
	 
} 
?>
	 <!-- header begin -->
        <header class="transparent  scroll-light border-bottom  ">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="de-flex sm-pt10">
                            <div class="de-flex-col">
                                <div class="de-flex-col">
                                    <!-- logo begin -->
                                    <div id="logo">
                                        <a href="<?=site_url("home")?>">
                                            <img alt="" class="logo" src="<?=$templates?>images/logo-3.png" />
                                            <img alt="" class="logo-2" src="<?=$templates?>images/logo-3.png" />
                                        </a>
                                    </div>
                                    <!-- logo close -->
                                </div>
                                <div class="de-flex-col">
                                    <form action="<?=site_url('explorer/view')?>"     method="get"  >
                                    <input id="quick_search" class="xs-hide" name="qq" placeholder="search item here..." type="text" />
                                    </form>
                                </div>
                            </div>
                            <div class="de-flex-col header-col-mid">
                                <!-- mainmenu begin -->
                                <ul id="mainmenu">
                                   <?php
								   	include __DIR__."/menu.php";
								   ?>
                                     
                                </ul>
                                <?php
								if(user_info('id'))
								{
									 //if(is_wallet())
									 //{
										
									 //}else
									 //{
									$class_single = "hide";
									$class_wallet = "";
									if(is_wallet())
									{
										$class_single = "";	
										$class_wallet = "hide";
									}
										  include __DIR__."/single.php";
								?>
                                <div class="menu_side_area connectwallet <?=$class_wallet?>" <?=($class!="nft")?'id="vm"':""?> >
                                    <a  href="javascript:void(0);"  v-on:click="connectWallet" class="btn-main btn-wallet"><i class="icon_wallet_alt"></i><span>Connect Wallet</span></a>
                                    <span id="menu-btn"></span>
                                </div>
                                 
                                <?php
									 //}
								}else
								{
								?>
                                <div class="menu_side_area"  >
                                    <a  href="<?=site_url("login")?>"  v-on:click="connectWallet" class="btn-main btn-wallet"><i class="icon_wallet_alt"></i><span>Connect Wallet</span></a>
                                    <span id="menu-btn"></span>
                                </div>
                                <?php
								}
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- header close -->

      