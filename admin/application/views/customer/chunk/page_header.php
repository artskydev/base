<div class="page-container">
          <div class="page-header">
            <nav class="navbar navbar-expand-lg d-flex justify-content-between">
              <div class="" id="navbarNav">
                 <ul class="navbar-nav" id="leftNav">
                      <li class="nav-item">
                        <a class="nav-link" id="sidebar-toggle" href="javascript:void(0);"><i data-feather="arrow-left"></i></a>
                      </li>
                      <li class="nav-item">
                       
                    	 <strong class="nav-link">My Token <span style='background:blue; padding:5px; color:white; border-radius:10px; font-size:12px;'><?=number_format(doubleval(get_customer("tokens")),0)?></span> </strong>
                     </li>
                  </ul>
                </div>
                <div class="logo">
                  <a class="navbar-brand" href="<?=site_url("plg")?>"></a>
                </div>
                <div class="" id="headerNav">
                  <ul class="navbar-nav">
                     
                    <li class="nav-item dropdown">
                      <a class="nav-link profile-dropdown" href="javascript:void(0);" id="profileDropDown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><img src="assets/images/avatar13.png" alt=""></a>
                      <div class="dropdown-menu dropdown-menu-end profile-drop-menu" aria-labelledby="profileDropDown">
                        
                        <a class="dropdown-item" href="<?=site_url("logout")?>"><i data-feather="log-out"></i>Logout</a>
                      </div>
                    </li>
                  </ul>
              </div>
            </nav>
        </div>
        
 
         
 