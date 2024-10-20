<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                     
                                     <div class="form-group">
                                        <label>CUSTOMER</label>
                                        <p>
                                        	<i>
                                            <?=$data['address_wallet']?><br/>
                                            </i>
                                        </p>
                                    </div>
                                     <div class="form-group">
                                        <label>Number Wheel FROM CUSTOMER</label>
                                        <p>
                                        	<i>
											<?=$data['numbers']?> 
                                            </i>
                                        </p>
                                    </div>
                                     <div class="form-group">
                                        <label>Winner Wheel FROM CUSTOMER</label>
                                        <p>
                                        	<i>
											<?php
                                            if($data['winner']==1)
											{
												echo '<i class="fa fa-check"></i>';
											}?> 
                                            </i>
                                        </p>
                                    </div>
                                    <div class="form-group">
                                        <label>Paying URL</label>
                                        <input type="url" class="form-control" name="paying_url" id="paying_url" placeholder="paying url" value="<?=isset($data['paying_url'])?$data['paying_url']:''?>" />
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
			var req = postFile('<?=site_url("wheel/wheel_number/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('wheel/wheel_number')?>";
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