<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form Profile
            </div>
            <div class="card-body">
                
                                     
                                 
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control required" id="email" name="email" placeholder="email" value="<?=isset($data['email'])?$data['email']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text"   class="form-control required " id="passwords" name="passwords" placeholder="password " value="<?=isset($data['passwords'])?'':''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="text"   class="form-control required " equalTo="#passwords"   placeholder="password " value="<?=isset($data['passwords'])?'':''?>" />
                                </div>
                                 <div class="form-group">
                                    <label>Wallet Address</label>
                                    <input type="text"  class="form-control required" id="wallet_address" name="wallet_address" placeholder="Wallet Address" value="<?=isset($data['wallet_address'])?$data['wallet_address']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Telegram id</label>
                                    <input type="text"  class="form-control required" id="telp" name="telp" placeholder="bonus" value="<?=isset($data['telp'])?$data['telp']:''?>" />
                                </div>
                                  
                                
                                <br/>
                                
                                  <div class="form-group">
                                    
                                    <input type="hidden" name="id" value="<?=isset($data['id'])?$data['id']:''?>" id="id" />
                                    <!-- 
                                    <input type="hidden" name="<?=$this->security->get_csrf_token_name()?>" value="<?=$this->security->get_csrf_hash();?>" class="smart-token">
                                    -->
                                    <button type="submit" class="btn btn-primary"><i class="si si-paper-plane "></i> Save</button>
                                    <button type="button" class="btn btn-reset"><i class="fa fa-refresh"></i> Refresh</button>
                                </div>       	
                 </div>
             
            </div>
         </div>
      </div>
                      
                         		   
                         
         
</div>
</form>                        
<script>
$(document).ready(function(){
	$("#frm-object").validate({
		ignore:[],
		onkeyup:false,
		errorClass: 'help-block text-right animated fadeInDown',
		errorElement: 'div',
		errorPlacement: function(error, e) {
			jQuery(e).parents('.form-group').append(error);
		},
		highlight: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error').addClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		success: function(e) {
			jQuery(e).closest('.form-group').removeClass('has-error');
			jQuery(e).closest('.help-block').remove();
		},
		submitHandler:function(){
			var data = new FormData($("#frm-object")[0]);
			var req = postFile('<?=site_url("plg/users/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('plg/users/profile')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
		}
	});
	  
	
});
</script>          