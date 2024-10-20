 <li>
                                        <a href="<?=site_url("home")?>">Home<span></span></a>
                                         
                                    </li>
                                    <?php
									/*
                                    <li><a href="<?=site_url('explorer/live-action')?>">Live Auction</a></li>
                                    */
									?>
									<li>
                                        <a href="javascript:void(0);">Explore<span></span></a>
                                         <ul>
                                             
                                            <?php
											$vcats = get_property();
											for($i=0;$i<count($vcats);$i++)
											{
											?>
                                            <li><a href="<?=site_url("explorer/view/".$vcats[$i]['id'])?>"><?=$vcats[$i]['name']?></a></li>
                                            <?php
											}
											?>
                                            
                                            
                                            
                                        </ul>
                                    </li>
                                    <li>
                                        <a href="https://news.app.velocita.club/" target="_blank">News<span></span></a>
                                         
                                    </li> 
                                    <!--<li>
                                        <a href="news.php">News<span></span></a>
                                         
                                    </li>                                    
                                    
                                   
                                    <li>
                                        <a href="javascript:void(0);">Stats<span></span></a>
                                        <ul>
                                            <li><a href="activity.php">Activity</a></li>
                                            <li><a href="rankings.php">Rankings</a></li>
                                        </ul>
                                    </li>
                                    -->  
									<?php
									/*if(user_info("id"))
									{
									?>
                                    <li>
                                        <a href="javascript:void(0);">Profile<span></span></a>
                                        <ul>
                                            <li><a href="<?=site_url("profile")?>">Profile</a></li>
                                            
                                            <li><a href="<?=site_url("logout")?>">Logout</a></li> 
                                        </ul>
                                    </li>
                                    <?php
									}*/
									?>