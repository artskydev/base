<?php
$setting = settings(); 
?>

 <!-- content begin -->
        <div class="no-bottom no-top" id="content">
            <div id="top"></div>
            
            <!-- section begin -->
            <section id="subheader" class="text-light" data-bgimage="url(<?=$templates?>images/background/subheader.jpg) top">
                    <div class="center-y relative text-center">
                        <div class="container">
                            <div class="row">
                                
                                <div class="col-md-12 text-center">
									<h1>User Login</h1>
									<p><?=isset($setting['website_title'])?$setting['website_title']:""?></p>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
            </section>
            <!-- section close -->
            

            <section aria-label="section">
                <div class="container">
					<div class="row">
						<div class="col-md-6 offset-md-3">
							<form name="contactForm" id='frm-object' class="form-border" method="post" action='javascript:void(0);'>
                                    <h3>Login to your account</h3>

                                            <div class="field-set">
                                                <label>Email</label>
                                                <input type='text' name='email' id='email' class="form-control required" placeholder="" />
                                            </div>


                                            <div class="field-set">
                                                <label>Password</label>
                                                <input type='password' name='password' id='password' class="form-control required" placeholder="" />
                                            </div>
                                             
                                             <a href="<?=site_url("forgot")?>" >Forgot Password</a>
                                             <hr/>
                                             

                                    <div id='submit'>
                                       
                                        
                                        <input type='submit'   value='Login' class="btn btn-main color-2">
                                        
                                        <a href="<?=site_url("register")?>" class="btn btn-main color-2" style="float:right; background-color:#096;" >Sign up</a>

                                        <div id='mail_success' class='success'>Your message has been sent successfully.</div>
                                        <div id='mail_fail' class='error'>Sorry, error occured this time sending your message.</div>

                                        <div class="clearfix"></div>

                                        <div class="spacer-single"></div>

                                        <!-- social icons -->
                                        <!--
                                        <ul class="list s3">
                                            <li>Or login with:</li>
                                            <li><a href="#">Facebook</a></li>
                                            <li><a href="#">Google</a></li>
                                            <li><a href="#">Instagram</a></li>
                                        </ul>
                                        -->
                                        <!-- social icons close -->

                                    </div>
									
                                </form>
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
					var req = post('<?=site_url('login/check')?>',$("#frm-object").serialize());
					req.done(function(out){
						if(out.error==false)
						{
							smart_success_box(out.message,'#frm-object .message');
							//document.location.href="<?=site_url('home')?>";
							document.location.href= out.links;
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
	</script>	   