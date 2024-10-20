<?php
$directory = rtrim($this->router->directory,'/');
$class = $this->router->class;
$method = $this->router->method;
$params = $this->uri->segment('3');
$params1 = $this->uri->segment('4');
$ima = user_info('image');
$avatar = "";
if(!empty($ima))
$avatar = getThumb(user_info('image'),48,48);

 
?>
<div class="page-sidebar">
                <ul class="list-unstyled accordion-menu">
                  <li class="sidebar-title">
                    Main
                  </li>
                    <?php
				  	/*
					$active="";
					if($class=="home")
					{
						$active="open";	
					}
				  ?>
                  <li class="<?=$active?>">
                    <a href="javascript:void(0);" class="dash-btn"><i data-feather="home"></i>Dashboard
                    <span class="fa fa-caret-down second "></span>
                    </a>
                  	<ul class="subs">
                    	<li>
                        	 <a href="javascript:void(0);"></i>Store</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("home/games")?>"></i>Game</a>
                        </li>
                         <li>
                        	 <a href="<?=site_url("home/presale")?>"></i>Presale</a>
                        </li>
                    </ul>
                  </li>
				  <?php
				  */
				  ?>
                   
                  <li>
                    <a href="<?=site_url("home")?>"><i data-feather="home"></i>Dashboard</a>
                  </li>  
                  <?php
				  	/*<li>
                    <a href="<?=site_url("customer")?>"><i data-feather="user"></i>Users</a>
                  </li>
                  
                  <li>
                    <a href="<?=site_url("order-presale")?>"><i data-feather="shopping-cart"></i>Order Presale (<?=orderpersale_read()?>)</a>
                  </li>  
                  <li class="hide">
                    <a href="<?=site_url("sesi")?>"><i data-feather="book"></i>Session</a>
                  </li>
                  <li>
                    <a href="<?=site_url("tier")?>"><i data-feather="book"></i>Tier</a>
                  </li>
				  */
				  ?>
                   
                    	<li>
                        	 <a href="<?=site_url("nft/category")?>"><i data-feather="layers"></i>NFT Property</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("nft/customer")?>"><i data-feather="users"></i>NFT Author</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("nft/nft-supply")?>"><i data-feather="airplay"></i>NFT Item</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("nft/order")?>"><i data-feather="dollar-sign"></i>NFT Order</a>
                        </li>
                     
                  
                   
                  <!-- --> 
                  
                    
                  <?php
				  	/*
					$active="";
					if($directory=="wheel" && ($class=="wheel_number" || $class=="wheel"))
					{
						$active="open";	
					}
				  ?>
                  <li class="<?=$active?>">
                    <a href="<?=site_url("wheel")?>" class="serv-btn"><i data-feather="chrome"></i>Wheel
                    <span class="fa fa-caret-down second "></span>
                    </a>
                  	<ul class="subs">
                    	<li>
                        	 <a href="<?=site_url("wheel/wheel_number")?>"></i>Customer Wheel</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("wheel/wheel")?>"></i>Wheel</a>
                        </li>
                    </ul>
                  </li>
                  <?php
				  	$active="";
					if($directory=="tebak" && ($class=="skor" || $class=="match" || $class=="tournament" || $class=="event" || $class=="team"))
					{
						$active="open";	
					}
				  ?>
                  <li class="<?=$active?>">
                    <a href="<?=site_url("score")?>" class="serv-btn"><i data-feather="dribbble"></i>
                    	Tebak Skor
                    <span class="fa fa-caret-down second "></span>
                    </a>
                    <ul class="subs">
                    	<li>
                        	 <a href="<?=site_url("tebak/skor")?>"></i>Tebak Skor</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("tebak/match")?>"></i>Match</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("tebak/tournament")?>"></i>Tournament</a>
                        </li>
                        <!--
                         <li>
                        	 <a href="<?=site_url("tebak/event")?>"></i>Event</a>
                        </li>
                        -->
                         <li>
                        	 <a href="<?=site_url("tebak/team")?>"></i>Team</a>
                        </li>
                    </ul>
                  </li>
                  */
				  ?>
                  <li>
                    <a href="<?=site_url("users")?>"><i data-feather="user"></i>Admin</a>
                  </li>
                  <?php
				  	$active="";
					if($class=="currency" || $class=="setting")
					{
						$active="open";	
					}
				  ?>
                  <li class="<?=$active?>">
                  <a href="javascript:void(0);" class="serv-btn"><i data-feather="chrome"></i>Setting
                    <span class="fa fa-caret-down second "></span>
                    </a>
                  	<ul class="subs">
                    	<li>
                        	 <a href="<?=site_url("setting")?>"></i>Setting</a>
                        </li>
                        <li>
                        	 <a href="<?=site_url("currency")?>"></i>Currency</a>
                        </li>

                    </ul>
                  </li>
                  
                  <!--
                  <li>
                    <a href="<?=site_url("setting")?>"><i data-feather="settings"></i>Setting</a>
                  </li>
                  -->
                   <li>
                    <a href="<?=site_url("logout")?>"><i data-feather="log-out"></i>Sign out</a>
                  </li>
                   
                </ul>
            </div>
 
      <script>
     
      $('.serv-btn').click(function(){
        $('nav ul .subs').toggleClass("show1");
        $('nav ul .second').toggleClass("rotate");
      });
	  $('.dash-btn').click(function(){
        $('nav ul .subs').toggleClass("show1");
        $('nav ul .second').toggleClass("rotate");
      });
      
    </script>  
    <style type="text/css">
	.accordion-menu li ul.subs
	{
		margin:2px;
	}
	.page-sidebar .accordion-menu li ul li
	{
		border-top:1px solid #ccc;
		border-bottom:1px solid #ccc;
	}
	.page-sidebar .accordion-menu li ul li a
	{
		color:#030;
	}
	</style>	