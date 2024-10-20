<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form Admin
            </div>
            <div class="card-body">
                
                                     
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?=isset($data['name'])?$data['name']:''?>" />
                                    </div>
                                
                                <div class="form-group">
                                    <label>Price /USDT</label>
                                    <input type="text" class="form-control required" id="usdt" name="usdt" placeholder="USDT" value="<?=isset($data['usdt'])?$data['usdt']:''?>" />
                                </div>
                                 
                                <div class="form-group">
                                    <label>Min USDT</label>
                                    <input type="text" class="form-control required" id="min_usdt" name="min_usdt" placeholder="Min USDT" value="<?=isset($data['min_usdt'])?$data['min_usdt']:'100'?>" />
                                </div>
                                <div class="form-group">
                                    <label>Max USDT</label>
                                    <input type="text" class="form-control required" id="max_usdt" name="max_usdt" placeholder="Max USDT" value="<?=isset($data['max_usdt'])?$data['max_usdt']:'1000'?>" />
                                </div>
                                <div class="form-group">
                                    <label>Bonus(%)</label>
                                    <input type="text"  class="form-control required" id="bonus" name="bonus" placeholder="bonus" value="<?=isset($data['bonus'])?$data['bonus']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Total Supply</label>
                                    <input type="text" class="form-control required" id="total_supply" name="total_supply" placeholder="Total Supply" value="<?=isset($data['total_supply'])?$data['total_supply']:'40000000'?>" />
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
			var req = postFile('<?=site_url("tier/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('tier')?>";
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