  
 
  
 		
        <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            
            <!-- section begin -->
            <section id="subheader" class="text-light urlsnft" >
                    <div class="center-y relative text-center">
                        <div class="container">
                            <div class="row">
                                
                                <div class="col-md-12 text-center">
									<h1>Create Your NFT</h1>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- section close -->
            

            <!-- section begin -->
            <section aria-label="section">
                <div class="container">
                    <div class="row wow fadeIn">
                        <div class="col-lg-7 offset-lg-1">
                            <form id="form-create-item" class="form-border createnft" method="post" action="javascript:void(0);">
                                <div class="field-set">
                                    <h5>Upload file</h5>

                                    <div class="d-create-file">
                                        <!--
                                        <p id="file_name">PNG, JPG, GIF, jpg or MP4. Max 200mb.</p>
                                        -->
                                        <!--
                                        <p id="imagePreview" >PNG, JPG, GIF, jpg or MP4. Max 200mb.</p>
                                        -->
                                        <p id="file_name">PNG, JPG, GIF, jpg or MP4. Max 200mb.</p>
                                        <input type="button"    id="get_file" class="btn-main" value="Browse">
                                        <input type="file" v-on:change="imageChanged('upload_file')" name="image"  id="upload_file">
                                    </div>

                                    <div class="spacer-40"></div>

                                    <h5>Select method</h5>
                                    <div class="de_tab tab_methods">
                                        <ul class="de_nav">
                                            <li class="active"><span><i class="fa fa-tag"></i>Fixed price</span>
                                            </li>
                                            <?php
											/*
                                            <li>
                                            <span><i class="fa fa-hourglass-1"></i>Timed auction</span>
                                            </li>
                                            */
											?>
											<!--
                                            <li>
                                            	<span><i class="fa fa-users"></i>Open for bids</span>
                                            </li>
                                            -->
                                        </ul>

                                        <div class="de_tab_content prices_tran">

                                            <div id="tab_opt_1">
                                                <h5>Price</h5>
                                                <input type="text" name="price" id="price" class="form-control" placeholder="enter price for one item (<?=setting("token_name")?>)" />
                                            </div>

                                            <div id="tab_opt_2">
                                                <h5>Minimum bid</h5>
                                                <input type="text" name="minimum_bid" id="minimum_bid" class="form-control" placeholder="enter minimum bid" />

                                                <div class="spacer-20"></div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5>Starting date</h5>
                                                        <input type="date" name="start_date" id="start_date" class="form-control" min="1997-01-01" />
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h5>Expiration date</h5>
                                                        <input type="date" name="end_date" id="end_date" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="tab_opt_3">
                                            </div>

                                        </div>

                                    </div>

                                    <div class="spacer-20"></div>

                                    <?php
									/*
                                    <div class="switch-with-title">
                                        <h5><i class="fa fa- fa-unlock-alt id-color-2 icon_padlock"></i>Unlock once purchased</h5>
                                        <div class="de-switch">
                                          <input type="checkbox" id="switch-unlock" class="checkbox">
                                          <label for="switch-unlock"></label>
                                        </div>
                                        <div class="clearfix"></div>
                                        <p class="p-info">Unlock content after successful transaction.</p>

                                        <div class="hide-content">
                                            <input type="text" name="item_unlock" id="item_unlock" class="form-control" placeholder="Access key, code to redeem or link to a file..." />             
                                        </div>
                                    </div>
									*/
									?>

                                   <div class="spacer-20"></div>
                                   <div v-for="prop in properties"  >  
                                        <h5>Choose collection</h5>
                                        <p class="p-info">This is the collection where your item will appear.</p>
    
                                         
                                        <select name="id_nftcategory"   id="id_nftcategory"    class="form-control   fullwidth mb20" >
                                             <?php
                                                $vcats = get_property();
                                                for($i=0;$i<count($vcats);$i++)
                                                {
                                                ?>
                                                    <option value="<?=$vcats[$i]['id']?>"><?=$vcats[$i]['name']?></option>
                                                <?php
                                                }
                                                ?>
                                        </select>
                                    
                                    </div>
                                    
                                    

                                    <div class="spacer-20"></div>

                                    <h5>You Brand</h5>
                                    <p><?=user_brand("name")?></p>
                                    
                                    <div class="spacer-20"></div>
                                    <div>  
                                        <h5>Properties <a href="javascript:void(0);" id="btn-proper" class="pull-right btn btn-warning"><i class="fa fa-plus"></i></a></h5>
                                        <p class="p-info">This is the properties where your item will appear.</p>
                                    	<div class="propertiesc p-info ">
                                        	<!-- 
                                            <div class="row padding-6"  >
                                            	 
                                                <div class="col-md-10 bordereds">
                                                	Ya name
                                                </div>
                                                <div class="col-md-2 bordereds">
                                                	
                                                </div>
                                                
                                            </div>
                                            -->
                                            
                                        </div>
                                    </div>

                                    <div class="spacer-20"></div>

                                    <h5>Title</h5>
                                    <input type="text" name="name" id="name" v-model="name" class="form-control" placeholder="e.g. 'NFT" />
                                    

                                    <div class="spacer-20"></div>

                                    <h5>Description </h5>
                                    <textarea data-autoresize name="description"  v-model="description" id="item_desc" class="form-control" placeholder="e.g. 'This is very limited item'"></textarea>

                                    

                                    <div class="spacer-single"></div>
                                    <input type="hidden" name="txhash" id="txhash" value="" />
                                    <input type="hidden" name="tokenid" id="tokenid" value="" />
                                    
                                    <input type="hidden" name="ipfs" id="ipfs" value="" />
                                    <input type="hidden" name="id_brand" id="id_brand" value="<?=user_brand('id')?>" />
                                    

                                    <input type="button" id="submit" onclick="javascript:mintnfts();" class="btn-main" value="Create Item">
                                    <div class="spacer-single"></div>
                                </div>
                            </form>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-xs-12">
                                <?php
								if(isset($items['id']))
								{
									/*$image = "uploads/default.png";
									 
									if(!empty(user_info('image')) && is_file(config_item('upload_path').user_info('image')) && file_exists(config_item('upload_path').user_info('image')))
									{
										$thumb = getThumb(user_info('image'),200,200);
										$image =  'cache/'.$thumb;
										 
									}	
									$now = date('Y-m-d h:i:s');
								?>
                                <h5>Preview item</h5>
                                <div class="nft__item">
                                    
                                    <?php
										if($items['tipe']==2)
										{
											if(strtotime($now) < strtotime($items['end_date']))
											{
											
									?>
                                    		<div class="de_countdown" data-year="<?=floatval($items['tahun_limit'])?>" data-month="<?=floatval($items['bulan_limit'])?>" data-day="<?=floatval($items['day_limit'])?>" data-hour="8"></div>
                                    
                                    
                                    <?php
											}
										}
									?>
                                    <div class="author_list_pp">
                                        <a href="<?=site_url('author/view/'.user_info('uuid'))?>">                                    
                                            <img class="lazy" src="<?=$image?>" alt="">
                                            <i class="fa fa-check"></i>
                                        </a>
                                    </div>
                                    <div class="nft__item_wrap">
                                        <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                            <img src="<?=$items['ipfs']?>" id="get_file_2" class="lazy nft__item_preview" alt="">
                                        </a>
                                    </div>
                                    <div class="nft__item_info">
                                        <a href="<?=site_url('items/view/'.$items['tokenid'])?>">
                                            <h4> <?=$items['name']?></h4>
                                        </a>
                                        <!--
                                        <div class="nft__item_click">
                                        <span></span>
                                   		</div>
                                    	-->
                                        <div class="nft__item_price">
                                            <?=$items['price']?> <?=setting("token_name")?> 
                                            <!-- 
                                            <span>1/20</span>
                                            -->
                                        </div>
                                        <?php
											if($items['tipe']==2)
											{
												if(strtotime($now) < strtotime($items['end_date']))
												{
												
										?>
                                        <div class="nft__item_action">
                                            <a href="<?=site_url('items/view/'.$items['tokenid'])?>">Place a bid</a>
                                        </div>
                                        <?php
												}
											}
										?>
                                        <div class="nft__item_like " data-id="<?=$items['id']?>">
                                            <i class="fa fa-heart <?=($items['hearts']>0)?'active':''?>"></i><span><?=$hearts?></span>
                                        </div>                            
                                    </div> 
                                </div>
                                <?php
									*/
									include VIEWPATH."manager//users/isi_auth/items.php";
								}
								?>
                            </div>                                         
                    </div>
                </div>
            </section>

        </div>
        <!-- content close -->       
        
 <!-- modal -->
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
    
       