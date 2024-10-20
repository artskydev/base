							<?php
								   if(isset($data['id']))
								   {
									   	$ima = $data['image'];
										$avatars = "front/images/author_single/author_banner.jpg";
										if(!empty($ima) && is_file(config_item('upload_path').$ima) && file_exists(config_item('upload_path').$ima))
										{
											$thumb = getThumb($ima,150,150);
											$avatars =  'cache/'.$thumb;
											 
										}
							  ?>
                            	<h6>Owner</h6>
                                        <div class="item_author">                                    
                                            <div class="author_list_pp">
                                                <a href="<?=site_url("author/view/".$data['uuid'])?>">
                                                    <img class="lazy" src="<?=$avatars?>" alt="">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </div>                                    
                                            <div class="author_list_info">
                                                <a href="<?=site_url("author/view/".$data['uuid'])?>"><?=$data['name']?></a>
                                            </div>
                                        </div>
                              <?php
								   }
							  ?>          