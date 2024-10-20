<?php
$setting = settings(); 
?>
<!-- content begin -->

        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

			

			<section class="full-height relative no-top no-bottom vertical-center" data-bgimage="url(<?=$templates?>images/background/6.jpg) top" data-stellar-background-ratio=".5">

                <div class="overlay-gradient ">

					<div class="center-y relative">

						<div class="container">

							<div class="row align-items-center">

								

								<div class="col-lg-8 offset-lg-2 wow fadeIn bg-color" data-wow-delay=".5s">

									<div class="box-rounded padding40">

										<h3 class="mb10">Register</h3>

										<p>Register To <?=isset($setting['website_title'])?$setting['website_title']:""?> After complete this form.<span></span></a>.</p>
                                        	<form name="contact" id='frm-object' class="form-border js-validation-login" method="post" action='javascript:void(0);'>
                                              <div class="message"></div>
                
                                                <div class="row">
                
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Brand Name:</label>
                                                            <input type='text' name='brand_name' id='brand_name' class="form-control required">
                                                        </div>
                                                    </div>
                                                      
                
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Website:</label>
                                                            <input type='text' name='website' id='website' class="form-control">
                                                        </div>
                                                    </div>
                                                    <?php
													/*
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Name:</label>
                                                            <input type='text' name='name' id='name' class="form-control required">
                                                        </div>
                                                    </div>
													*/
													?>
                
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Email Address:</label>
                                                            <input type='text' name='email' id='email' class="form-control required">
                                                        </div>
                                                    </div>
                
                                                     
                
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Phone:</label>
                                                            <input type='text' name='telp' id='telp' class="form-control required">
                                                        </div>
                                                    </div>
                
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Password:</label>
                                                            <input type='password' name='password' id='password' minlength="8" class="form-control required">
                                                        </div>
                                                    </div>
                
                                                    <div class="col-md-6">
                                                        <div class="field-set">
                                                            <label>Re-enter Password:</label>
                                                            <input type='password' equalTo='#password'  id='re-password' class="form-control required">
                                                        </div>
                                                    </div>
                
                
                                                    <div class="col-md-12">
                
                                                        <div id='submit' class="pull-left">
                                                            <input type='submit' id='' value='Register Now' class="btn btn-main color-2">
                                                        </div>
                
                                                        <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                                        <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>
                                                        <div class="clearfix"></div>
                
                                                    </div>
                
                                                </div>
                                            </form>
									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</section>		

            

            </div>

            <!-- content close -->

  
      <script>
		$(function()
		{
			$("#frm-object").validate({
				ignore:[],
				onkeyup:false,
				errorClass: 'help-block text-right animated fadeInDown errors',
				errorElement: 'div',
				errorPlacement: function(error, e) {
					jQuery(e).parents('.col-md-6 .field-set').append(error);
				},
				highlight: function(e) {
					jQuery(e).closest('.col-md-6 .field-set').removeClass('has-error').addClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				success: function(e) {
					jQuery(e).closest('.col-md-6 .field-set').removeClass('has-error');
					jQuery(e).closest('.help-block').remove();
				},
				submitHandler:function(){
					var req = post('<?=site_url('register/save')?>',$("#frm-object").serialize());
					req.done(function(out){
						if(out.error==false)
						{
							smart_success_box(out.message,'#frm-object .message');
							//document.location.href="<?=site_url('home')?>";
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
			 
		});
		function resendclick()
		{
			$.ajax({
                            url: "register/resend",
                            type: 'POST',
                            data: {id:1},
                            async: false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function(){
                                 
                            },
                            success: function(out)
                            {
                                
                                 smart_message("Resend success");
                            },
                            error: function()
                            {
                                 smart_message("Resend Failed");
                            },
                            complete:function(out){
                                
                            }
                        });	
		}
		</script> 