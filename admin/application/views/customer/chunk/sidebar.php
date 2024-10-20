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
                  <li>
                    <a href="<?=site_url("plg")?>"><i data-feather="home"></i>Dashboard</a>
                  </li>
                   
                  <li>
                    <a href="<?=site_url("plg/users/profile")?>"><i data-feather="user"></i>Profile</a>
                  </li>
                  <li>
                    <a href="<?=site_url("plg/order")?>"><i data-feather="shopping-cart"></i>My Order</a>
                  </li>  
                   
                  <li>
                    <a href="<?=site_url("plg/stats/logout")?>"><i data-feather="log-out"></i>Sign out</a>
                  </li>
                  
                </ul>
               
            </div>
 
       