<?php
$setting = settings(); 
?>
<!-- content begin -->

        <div class="no-bottom no-top" id="content">

            <div id="top"></div>

			

			<section class="full-height relative no-top no-bottom vertical-center" data-bgimage="url(<?=$templates?>images/background/6.jpg) top" data-stellar-background-ratio=".5">

                <div class="overlay-gradient t50">

					<div class="center-y relative">

						<div class="container">

							<div class="row align-items-center">

								

								<div class="col-lg-4 offset-lg-4 wow fadeIn bg-color" data-wow-delay=".5s">

									<div class="box-rounded padding40">

										<h3 class="mb10">Sign In</h3>

										<p>Login using an existing account or create a new account <a href="<?=site_url("register")?>">here<span></span></a>.</p>

										<form name="contactForm" id='frm-object' class="form-border" method="post" action='javascript:void(0);'>


                                            <div class="field-set">

                                                <input type='text' name='email' id='email' class="form-control required" placeholder="Email">

                                            </div>

											

											 <div class="field-set">

                                                <input type='password' name='password' id='password'  class="form-control required"  placeholder="password">

                                            </div>

											

											<div class="field-set">

												<input type='submit'  value='Submit' class="btn btn-main btn-fullwidth color-2">

											</div>

											

											<div class="clearfix"></div>

											

											<div class="spacer-single"></div>



                                        <!-- social icons -->

                                        <ul class="list s3">

                                            <!--
                                            <li>Login with:</li>

                                            <li><a href="#">Facebook</a></li>

                                            <li><a href="#">Google</a></li>
                                            -->

                                        </ul>

                                        <!-- social icons close -->

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