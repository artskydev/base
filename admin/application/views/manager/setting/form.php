<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form Setting
            </div>
            <div class="card-body">
                
                                     
                                 
                                <div class="form-group">
                                    <label>Site Name</label>
                                    <input type="text" class="form-control required" id="website_title" name="website_title" placeholder="Site Name" value="<?=isset($data['website_title'])?$data['website_title']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Refferal</label>
                                    <input type="number" class="form-control required" id="refferal" name="refferal" placeholder="Refferal" value="<?=isset($data['refferal'])?$data['refferal']:''?>" />
                                </div>
                                <div class="form-group">
                                    <label>Total Wheel</label>
                                    <input type="number" class="form-control required" id="total_wheel" name="total_wheel" placeholder="Wheel For users" value="<?=isset($data['total_wheel'])?$data['total_wheel']:'5'?>" />
                                </div>
                                <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label>From Time</label>
                                                <input type="text" class="form-control required datetimepicker" name="starts" id="starts" placeholder="From Time" value="<?=isset($data['starts'])?date('H:i',strtotime($data['starts'])):''?>" />
                                            </div> 
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label>To Time</label>
                                                <input type="text" class="form-control required datetimepicker" name="ends" id="ends" placeholder="To Time" value="<?=isset($data['ends'])?date('H:i',strtotime($data['ends'])):''?>" />
                                            </div> 
                                        </div>
                                        
                                    </div>  
                                
                                  
                                 <div class="form-group">
                                        <label>Closed Wheel</label>
                                        <select id="closeds" name="closeds" class="form-control required" >
                                        	<option value=""  > -- choose --</option>
											<option value="0"  <?php if(isset($data['closeds'])){ if($data['closeds']==0){ ?> selected="selected"  <?php } }?>> No</option> 
											<option value="1"  <?php if(isset($data['closeds'])){ if($data['closeds']==1){ ?> selected="selected"  <?php } }?> > Yes</option> 
                                        </select>
                                    </div> 
                                <br/>
                                 <div class="form-group">
                                    <label>Fee Transaction %(NFT)</label>
                                    <input type="number" class="form-control required mask" id="nft_fee" name="nft_fee" placeholder="Fee Transaction(NFT)" value="<?=isset($data['nft_fee'])?$data['nft_fee']:'5'?>" />
                                </div>
                                 <br/>
                                <div class="form-group">
                                    <label>Wallet Fee Transaction (NFT)</label>
                                    <input type="text" class="form-control required" id="wallet_fee" name="wallet_fee" placeholder="Wallet Fee Transaction(NFT)" value="<?=isset($data['wallet_fee'])?$data['wallet_fee']:''?>" />
                                </div>
                                 <br/>
                                 <div class="form-group">
                                        <label>Type Price(NFT)</label>
                                        <select id="price_type" name="price_type" class="form-control required" >
                                        	<option value=""  > -- choose --</option>
											<option value="0"  <?php if(isset($data['price_type'])){ if($data['price_type']==0){ ?> selected="selected"  <?php } }?>> Statics</option> 
											<option value="1"  <?php if(isset($data['price_type'])){ if($data['price_type']==1){ ?> selected="selected"  <?php } }?> > Market</option> 
                                        </select>
                                    </div> 
                                <br/>
                               <div class="form-group <?php if(isset($data['price_type'])){ if($data['price_type']==1){ ?> hidden <?php } }?>" id="price_token">
                                    <label>(NFT) How Much Value <b> 1 <?=isset($data['token_name'])?$data['token_name']:''?></b> in <b><?=isset($data['token_transaksi'])?$data['token_transaksi']:''?></b></label>
                                    <input type="number" class="form-control required" id="price_token" name="price_token" placeholder="Wheel For users" value="<?=isset($data['price_token'])?$data['price_token']:'0'?>" />
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
			var req = postFile('<?=site_url("setting/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('setting')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
		}
	});
	$('#starts').datetimepicker({
		datepicker:false,
		format:'H:i',
		step:5
	});
	$('#ends').datetimepicker({
		datepicker:false,
		format:'H:i',
		step:5
	});   
	$("#price_type").change(function()
	{
		var csk = $(this).val();
		 
		$("#price_token").removeClass("hidden");	
		if(csk==1)
		{
			$("#price_token").addClass("hidden");			
		}
	});
	$("input.mask").each((i,ele)=>{
		let clone=$(ele).clone(false)
		clone.attr("type","text")
		let ele1=$(ele)
		clone.val(Number(ele1.val()).toLocaleString("en"))
		$(ele).after(clone)
		$(ele).hide()
		clone.mouseenter(()=>{
	
		  ele1.show()
		  clone.hide()
		})
		setInterval(()=>{
		  let newv=Number(ele1.val()).toLocaleString("en")
		  if(clone.val()!=newv){
			clone.val(newv)
		  }
		},10)
	
		$(ele).mouseleave(()=>{
		  $(clone).show()
		  $(ele1).hide()
		})
		
	
	  });
});
</script>          