<?php
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="<?=config_item('site_name')?> Admin">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="<?=config_item('site_name')?>">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
         <base href="<?=base_url()?>">
  		<meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token">
        <!-- Title -->
        <title>Meong Token Customer</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,700,800&display=swap" rel="stylesheet">
        <link href="assets/_assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/_assets/plugins/font-awesome/css/all.min.css" rel="stylesheet">
        <link href="assets/_assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">

      
        <!-- Theme Styles -->
        <link href="assets/_assets/css/main.min.css" rel="stylesheet">
        <link href="assets/_assets/css/custom.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="login-page">
        <div class='loader'>
            <div class='spinner-grow text-primary' role='status'>
              <span class='sr-only'>Loading...</span>
            </div>
          </div>
        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-12 col-lg-4">
                    <div class="card login-box-container">
                        <div class="card-body">
                            <div class="authent-logo">
                                 
                            </div>
                            <div class="authent-text">
                                <p>Welcome to Meong Token!</p>
                                <p>Sign-up Your Account.</p>
                            </div>

                           <form action="javascript:void(0);" role="form" method="post" class="js-validation-login">
                               
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingInput">Name (*)</label>
                                        
                                        <input type="text" class="form-control required"  required  name="name" id="name"   placeholder="Enter name">
                                        
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingInput">Telegram ID (*)</label>
                                        <input type="text" class="form-control required" required   name="telp" id="telp"  placeholder="Telegram ID">
                                      </div>
                                </div>
                                 <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingInput">Refferal</label>
                                        <input type="text" class="form-control"    name="refferal" id="refferal"  placeholder="Enter Refferal ID" value="<?=isset($_GET['ref'])?$_GET['ref']:""?>">
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingInput">Email (*)</label>
                                        
                                        <input type="email" class="form-control required"  required  name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                                        
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingPassword">Password (*)</label>
                                        <input type="password" class="form-control required" required name="password"id="password" placeholder="Password">
                                        
                                      </div>
                                </div>
                                <div class="mb-3">
                                    <div class="form-group">
                                        <label for="floatingPassword">Confirm Password (*)</label>
                                        <input type="password" class="form-control required" id="confirmpassword" equalTo="#confirmpassword" placeholder="Confirm Password">
                                        
                                      </div>
                                </div>
                                <div class="mb-3 form-check">
                                   
                                </div>
                                 <div class="mb-3 pesans">
                                
                                </div>
                                <div class="d-grid">
                                <button type="submit" class="btn btn-info m-b-xs">Sign Up</button>
                                
                                
                                 
                            </div>
                              </form>
                              <div class="authent-reg">
                                 <a href="<?=site_url("plg/login")?>">if you have account, Sign in here</a>
                              </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         
        
        <!-- Javascripts -->
         <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>
		<script src="assets/_assets/plugins/jquery/jquery-3.4.1.min.js"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="assets/_assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="https://unpkg.com/feather-icons"></script>
        <script src="assets/_assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
        <script src="assets/_assets/js/main.min.js"></script>
         <script src="assets/plugins/jquery-validation/jquery.validate.js"></script>
     	<script src="assets/plugins/jquery-validation/additional-methods.js"></script>
         <script src="assets/smart.js"></script>
        <script>
		$(function()
		{
			$('.js-validation-login').submit(function(){
				      
						var data = new FormData($(".js-validation-login")[0]);
                        $.ajax({
                            url: "<?=site_url("api/register")?>",
                            type: 'POST',
                            data: data,
                            async: false,
                            cache: false,
                            contentType: false,
                            processData: false,
                            beforeSend: function(){
                                 
                            },
                            success: function(out)
                            {
                                if(out.error==false)
                                {
                                  $(".js-validation-login .pesans").html("<div class='alert alert-info hpesan'> <h5> Check your email inbox or spam, for confirmation email  </h5><br/> <a href='javascript:void(0);' class='resends btn btn-small btn-sm btn-xs' style='float:right;' onclick='javascript:resendclick();'>Resend</a><br/></div>"); 
									return;
                                }else
                                {
                                    smart_message(out.message);  
                                      	
                                }
                                 
                            },
                            error: function()
                            {
                                 smart_message("Signup Failed");  
                            },
                            complete:function(out){
                                
                            }
                        });
					/*
					var req = post('<?=site_url('api/register')?>',$(".js-validation-login").serialize());
					req.done(function(out){
						if(!out.error)
						{
							//smart_success_box(out.message,'.js-validation-login');
							 $(".js-validation-login").prepend("<div class='alert alert-info hpesan'> <h5> Check your email inbox or spam, for confirmation email  </h5><br/> <a href='javascript:void(0);' class='resends btn btn-small btn-sm btn-xs' style='float:right;' onclick='javascript:resendclick();'>Resend</a><br/></div>"); 
							 
							 						
							
						}
						else
						{
							//smart_error_box(out.message,'.js-validation-login');
							smart_message(out.message);
						}
					});
					*/
 
			});
		});
		function resendclick()
		{
			$.ajax({
                            url: "<?=site_url('api/resend')?>",
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
                                
                                 alert("Resend success");
                            },
                            error: function()
                            {
                                 alert("Resend Failed");
                            },
                            complete:function(out){
                                
                            }
                        });	
		}
		</script>
    </body>
</html>

 