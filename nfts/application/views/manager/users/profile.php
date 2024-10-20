 <!-- content begin -->
 
 
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            <?php
            $banner = "front/images/author_single/author_banner.jpg";
			$bannerfull = "front/images/author_single/author_banner.jpg";
			if(!empty($data['banner']) && is_file(config_item('upload_path').$data['banner']) && file_exists(config_item('upload_path').$data['banner']))
			{
				$thumb = getThumb($data['banner'],200,200);
				$banner =  'cache/'.$thumb;
				$bannerfull =  config_item('main_site').'uploads/'.$data['banner'];
			}
			?>
       <style type="text/css">
		 .urls
		 {
			background-image:url('<?=$bannerfull?>')  !important;
			 
			 
		 }
		 </style>     
            <!-- section begin -->
            <section   class="text-light urls" >
                    <div class="center-y relative text-center">
                        <div class="container">
                            <div class="row">                                
                                <div class="col-md-12 text-center">
									<h1>Edit Profile</h1>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- section close -->
            

            <!-- section begin -->
            <section id="section-main" aria-label="section">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <form id="frm-object" class="form-border" method="post" action="javascript:void(0);">
                            <div class="message"></div>
                            <div class="de_tab tab_simple">
                            
                                <ul class="de_nav">
                                    <li class="active"><span><i class="fa fa-user"></i>Profile</span></li>
                                    <li><span><i class="fa fa-building"></i>Brand</span></li> 
                                    <li><span><i class="fa fa-exclamation-circle"></i>Notifications</span></li>
                                    <!--
                                    <li><span><i class="fa fa-exclamation-circle"></i>Notifications</span></li>
                                    <li><span><i class="fa fa-paint-brush"></i>Appearance</span></li>
                                    -->
                                </ul>
                                
                                <div class="de_tab_content">                            
                                    <div class="tab-1">
                                        <div class="row wow fadeIn">
                                            <div class="col-lg-8 mb-sm-20">
                                                    <div class="field-set">
                                                        <h5> Profile ID</h5>
                                                        <p><b><?=isset($data['uuid'])?$data['uuid']:""?></b></p>
                                                        
                                                        <h5>Username</h5>
                                                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter username" value="<?=isset($data['name'])?$data['name']:""?>"/>                                    

                                                        <div class="spacer-20"></div>

                                                        <!--
                                                        <h5>Custom URL</h5>
                                                        <input type="text" name="custom_url" id="custom_url" class="form-control" placeholder="Enter your custom URL" />
                                                        

                                                        <div class="spacer-20"></div>
                                                        -->

                                                        <h5>Bio</h5>
                                                        <textarea name="bio" id="bio" class="form-control" placeholder="Tell the world who you are!" ><?=isset($data['bio'])?$data['bio']:""?></textarea>

                                                        <div class="spacer-20"></div>

                                                        <h5>Email Address*</h5>
                                                        <input type="text" name="email" id="email" class="form-control" placeholder="Enter email" value="<?=isset($data['email'])?$data['email']:""?>" />

                                                        <div class="spacer-20"></div>

                                                        <h5><i class="fa fa-link"></i> Your site</h5>
                                                        <input type="text" name="website" id="website" class="form-control" placeholder="Enter Website URL" value="<?=isset($data['website'])?$data['website']:""?>" />

                                                        <div class="spacer-20"></div>

                                                        <h5><i class="fa fa-twitter"></i> Twitter username</h5>
                                                        <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Enter Twitter username" value="<?=isset($data['twitter'])?$data['twitter']:""?>"/>

                                                        <div class="spacer-20"></div>

                                                        <h5><i class="fa fa-instagram"></i> Instagram username</h5>
                                                        <input type="text" name="instagram" id="instagram" class="form-control" placeholder="Enter Instagram username" value="<?=isset($data['instagram'])?$data['instagram']:""?>" />

                                                    </div>
                                            </div>

                                            <div id="sidebar" class="col-lg-4">
                                                <h5>Profile image <i class="fa fa-info-circle id-color-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Recommend 400 x 400. Max size: 50MB. Click the image to upload."></i></h5>

                                                <?php
												$avatar = "uploads/default.png";
												if(!empty($data['image']) && is_file(config_item('upload_path').$data['image']) && file_exists(config_item('upload_path').$data['image']))
												{
													$thumb = getThumb($data['image'],200,200);
													$avatar =  'cache/'.$thumb;
												}
												?>
                                                <img src="<?=$avatar?>" id="click_profile_img" class="d-profile-img-edit img-fluid" alt="">
                                                <input type="file" name="image" id="upload_profile_img"> 

                                                <div class="spacer-30"></div>

                                                <h5>Profile banner <i class="fa fa-info-circle id-color-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Recommend 1500 x 500. Max size: 50MB. Click the image to upload."></i></h5>
                                                 
                                                <img src="<?=$banner?>" id="click_banner_img" class="d-banner-img-edit img-fluid" alt="">
                                                <input type="file" name="banner" id="upload_banner_img"> 

                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="tab-2">
                                        <div class="row ">
                                            <div class="col-lg-8 mb-sm-20">
                                                    <div class="field-set">
                                                       
                                                        <h5>Brand Name</h5>
                                                        <input type="text" name="brand[name]" id="brand[name]" class="form-control" placeholder="Enter Brand Name" value="<?=isset($brand['name'])?$brand['name']:""?>"/>                                    

                                                        <div class="spacer-20"></div>

                                                       

                                                        <h5>Description</h5>
                                                        <textarea name="brand[description]" id="brand[description]" class="form-control" placeholder="description your brand" ><?=isset($brand['description'])?$brand['description']:""?></textarea>

                                                        <div class="spacer-20"></div>

                                                        <h5>Email Address*</h5>
                                                        <input type="email" name="brand[email]" id="brand[email]" class="form-control" placeholder="Enter email" value="<?=isset($brand['email'])?$brand['email']:""?>" />

                                                        <div class="spacer-20"></div>

                                                        <h5><i class="fa fa-link"></i> Website</h5>
                                                        <input type="text" name="brand[website]" id="brand[website]" class="form-control" placeholder="Enter Website URL" value="<?=isset($brand['website'])?$brand['website']:""?>" />

                                                        <div class="spacer-20"></div>

                                                        <h5><i class="fa fa-phone"></i> Telp</h5>
                                                        <input type="text" name="brand[telp]" id="brand[telp]" class="form-control" placeholder="Enter telp" value="<?=isset($brand['telp'])?$brand['telp']:""?>"/>

                                                        <div class="spacer-20"></div>

                                                        <h5><i class="fa fa-fax"></i> Fax</h5>
                                                        <input type="text" name="brand[fax]" id="brand[fax]" class="form-control" placeholder="Enter fax" value="<?=isset($brand['fax'])?$brand['fax']:""?>" />

                                                    </div>
                                            </div>

                                            <div   class="col-lg-4">
                                                <h5>Brand Image <i class="fa fa-info-circle id-color-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Recommend 400 x 400. Max size: 50MB. Click the image to upload."></i></h5>

                                                <?php
												$avatar = "uploads/default.png";
												if(!empty($brand['image']) && is_file(config_item('upload_path').$brand['image']) && file_exists(config_item('upload_path').$brand['image']))
												{
													$thumb = getThumb($brand['image'],200,200);
													$avatar =  'cache/'.$thumb;
												}
												?>
                                                <img src="<?=$avatar?>" id="click_brand_img" class="d-profile-img-edit img-fluid" alt="">
                                                <input type="file" name="brand_image" class="xhide" id="upload_brand_img"> 

                                               

                                                

                                            </div>                                         
                                        </div>
                                    </div>
                                    <div class="tab-3">
                                        <div class="row wow fadeIn">
                                            <div class="col-md-6 mb-sm-20">
                                                <div class="switch-with-title s2">
                                                    <h5>Item Sold</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif_item_sold" name="notif_item_sold" <?php if(isset($data['notif_item_sold'])){ if($data['notif_item_sold']==1){?> checked="checked"  <?php }}?> value="1" class="checkbox">
                                                      <label for="notif_item_sold"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When someone purhased your item.</p><br/>
                                                </div>

                                                <!--<div class="spacer-20"></div>

                                                <div class="switch-with-title s2">
                                                    <h5>Bid Activity</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif-bid-activity" class="checkbox">
                                                      <label for="notif-bid-activity"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When someone purhased your item.</p>
                                                </div>
                                               

                                                <div class="spacer-20"></div>

                                                <div class="switch-with-title s2">
                                                    <h5>Price Change</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif_price_change" name="notif_price_change" value="1" <?php if(isset($data['notif_price_change'])){ if($data['notif_price_change']==1){?> checked="checked"  <?php }}?> class="checkbox">
                                                      <label for="notif-price-change"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When an item you made an offer on changes in price.</p>
                                                </div>
                                                 -->
                                            </div>

                                            <div class="col-md-6">
                                                <div class="switch-with-title s2">
                                                    <h5>Follow</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif_follow" name="notif_follow" value="1" <?php if(isset($data['notif_follow'])){ if($data['notif_follow']==1){?> checked="checked"  <?php }}?> class="checkbox">
                                                      <label for="notif_follow"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When someone follow you </p><br/> 
                                                </div>
                                            </div>
                                            <div class="col-md-12">  
                                                <div class="spacer-20"></div>
                                                <div class="switch-with-title s2">
                                                    <h5>Auction Expiration</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif_auction" name="notif_auction" value="1" <?php if(isset($data['notif_auction'])){ if($data['notif_auction']==1){?> checked="checked"  <?php }}?> class="checkbox">
                                                      <label for="notif_auction"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When an auction you created ends.</p>
                                                </div>

                                                <!-- 
                                                <div class="spacer-20"></div>

                                                <div class="switch-with-title s2">
                                                    <h5>Outbid</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif-outbid" class="checkbox">
                                                      <label for="notif-outbid"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When an offer you placed is exceeded by another user.</p>
                                                </div>

                                                <div class="spacer-20"></div>

                                                <div class="switch-with-title s2">
                                                    <h5>Successful Purchase</h5>
                                                    <div class="de-switch">
                                                      <input type="checkbox" id="notif-successful-purchase" class="checkbox">
                                                      <label for="notif-successful-purchase"></label>
                                                    </div>
                                                    <div class="clearfix"></div>
                                                    <p class="p-info">When you successfully buy an item.</p>
                                                </div>
                                                -->

                                            </div>
                                        </div>
                                    </div>

                                     
                                </div>
                            </div>

                            <div class="spacer-30"></div>
                            	 <input type='submit' id='' value='Update' class="btn btn-main color-2">
                                
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        </div>
        <!-- content close -->
 <script>
 
$(document).ready(function(){
	$("#frm-object").validate({
				ignore:[],
				onkeyup:false,
				errorClass: 'help-block text-right animated fadeInDown errors',
				errorElement: 'div',
				errorPlacement: function(error, e) {
					jQuery(e).parents('.field-set').append(error);
				},
				highlight: function(e) {
					jQuery(e).closest('.field-set').removeClass('has-error').addClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				success: function(e) {
					jQuery(e).closest('.field-set').removeClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				submitHandler:function(){
					var data = new FormData($("#frm-object")[0]);
					var req = postFile('<?=site_url("profile/save")?>',data);
					req.done(function(out){
						if(out.error==false)
						{
							smart_success_box(out.message,'#frm-object .message');
							 document.location.href="<?=site_url('profile')?>";
						}
						else
						{
							smart_message(out.message,'#frm-object .message');
						}
					});
					req.fail(function()
					{
						smart_message("failed, check your connection then refresh page");
					});
					return false;
				}
				
			});
		$("#upload_profile_img").change(function()
		{
			//click_profile_img
			changeimages("upload_profile_img","click_profile_img");
			//readURL($(this),"click_profile_img");
		});
		$("#upload_banner_img").change(function()
		{
			//click_profile_img
			changeimages("upload_banner_img","click_banner_img");
			//readURL($(this),"click_profile_img");
		});
		$("#click_brand_img").click(function()
		{
			$("#upload_brand_img").trigger("click");
		});
		$("#upload_brand_img").change(function()
		{
			//click_profile_img
			changeimages("upload_brand_img","click_brand_img");
			//readURL($(this),"click_profile_img");
		});
	 
});
</script>         