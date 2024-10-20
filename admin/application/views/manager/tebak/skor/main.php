<div class="content-wrapper">
   <div class="row">
            <div class="col-md-12">
                    <div class="card">
                    	<div class="card-header no-bg b-a-0">
                        List <?=$title?>
                         <span class="pull-right">
                              
                          	 <a   href="<?=site_url('tebak/skor/add')?>" class="btn btn-sm btn-mini btn-xs pull-right" type="button" data-toggle="tooltip" title="" data-original-title="add"><i class="fa fa-plus"></i></a>
                         </span>  
                      </div>
                      <div class="card-body">
                      	  <form action="javascript:void(0);" method="post" id="frm-mb">  
                          <div class="row">
                                        <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Tournament</label>
                                                <select id="id_tournament" name="id_tournament" class="form-control  " >
                                                    <option value=""  > -- choose --</option>
                                                   <?php
															for($i=0;$i<count($tournament);$i++)
															{
																$selected = "";
																 
														?>
																<option value="<?=$tournament[$i]['id']?>" <?=$selected?> ><?=$tournament[$i]['name']?></option>
														<?php
															}
														?>
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Team 1</label>
                                                <select id="id_team1" name="id_team1" class="form-control  " >
                                                    <option value=""  > -- choose --</option>
                                                    <?php
														if(isset($data['id_team1']))
														{
															for($i=0;$i<count($team);$i++)
															{
																$selected = "";
																if(isset($data['id_team1']))
																{
																	if($data['id_team1']==$team[$i]['id'])
																	{
																		$selected = "selected='selected'";
																	}
																}
													?>
															<option value="<?=$team[$i]['id']?>" <?=$selected?> ><?=$team[$i]['name']?></option>
													<?php
															}
														}
													?> 
                                                </select>
                                            </div> 
                                        </div>
                                        <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Team 2</label>
                                                
                                                    <select id="id_team2" name="id_team2" class="form-control  " >
                                                        <option value=""  > -- choose --</option>
                                                         <?php
                                                            if(isset($data['id_team2']))
                                                            {
                                                                for($i=0;$i<count($team);$i++)
                                                                {
                                                                    $selected = "";
                                                                    if(isset($data['id_team2']))
                                                                    {
                                                                        if($data['id_team2']==$team[$i]['id'])
                                                                        {
                                                                            $selected = "selected='selected'";
                                                                        }
                                                                    }
                                                        ?>
                                                                <option value="<?=$team[$i]['id']?>" <?=$selected?> ><?=$team[$i]['name']?></option>
                                                        <?php
                                                                }
                                                            }
                                                        ?> 
                                                    </select>
                                                  
                                                
                                            </div>
                                         </div>   
                                        <div class="col-md-3">
                                             <div class="form-group">
                                                <label>Winner</label>
                                                <div class="input-group">
                                                    <select id="winner" name="winner" class="form-control  " >
                                                        <option value="-1"  > -- choose --</option>
                                                        <option value="0"  > No</option>
                                                        <option value="1"  > Yes</option>
                                                          
                                                    </select>
                                                  <span class="input-group-btn">
                                                    <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                                                  </span>
                                                </div>
                                                
                                            </div> 
                                        </div>
                                         
                                        
                                    </div> 
                               </form>    
                          <br/>     
                          <div class="col-12 table-responsive">		
                           <table class="table table-bordered table-striped js-dataTable-full">
                            <thead>
                                <tr>
                                    <th class="text-center" align="center"><input type="checkbox" id="chk-items" /></th>
                                    <th>Match</th>
                                    <th>Customer</th>
                                    <th>Winner</th>
                                    <th>Paying <br/> Url</th>
                                     
                                    <th class="text-center" style="width: 15%;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                          </div>  
                      </div>
                    
                    
                    </div>
            </div>
   </div>
</div>                    
 
<script>
var table_ajax;
var curls = "<?=site_url('tebak/skor/getlist')?>?baru=1";
var BaseTableDatatables = function() {
    // Init full DataTable, for more examples you can check out https://www.datatables.net/
    var initDataTableFull = function() {
        table_ajax = $('.js-dataTable-full').dataTable({
			order:[],
			"processing": true, 
			"autoWidth": false,
			"serverSide": true, 
			"ajax": {
					url :curls,
					type : "GET",
					data : function(d){
						d.id_tournament = $("#frm-mb #id_tournament").val();
						d.id_team1 = $("#frm-mb #id_team1").val();
						d.id_team2 = $("#frm-mb #id_team2").val();
						d.winner = $("#frm-mb #winner").val();
					}
			 },
			columnDefs: [ 
			{ orderable: false, searchable:false,visible:false, targets: [ 0 ],className:'text-center',width:'50px' },
			
			{ orderable: false, searchable:false, targets: [ 1 ],className:'text-center' },
			{ width:'250px', targets:[3]},
			 
			],
			pagingType: "full_numbers",
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]]
        });
    };

     

    return {
        init: function() {
            // Init Datatables
            
            initDataTableFull();
        }
    };
}();

// Initialize when page loads
$(document).ready(function(){
	BaseTableDatatables.init();
	$('body').tooltip({selector: '[data-toggle="tooltip"]'});
	
	$(".js-dataTable-full").on('click','.btn-delete-sites',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			bootbox.confirm({
				title: "Delete this user?",
				message: "Do you want to delete this user.",
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancel'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> ok'
					}
				},
				callback: function (result) {
					if(result)
					{
						var req = post('<?=site_url('tebak/skor/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
							}
							else
							{
								smart_error_box(out.message,'#tbl-uses');
							}
						});		
					}
				}
			});
		}
	});
	$("#btn-delete-all").on('click',function(){
		var ids = new Array();
		$(".js-dataTable-full").find(".chk-item").each(function(key,val){
			if($(this).is(":checked"))
			ids.push($(this).val());
		});
		if(ids.length>0)
		{
			bootbox.confirm({
				title: "Delete sites?",
				message: "Do you want to delete this sites.",
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancel'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					if(result)
					{
						var req = post('<?=site_url('tebak/skor/delete')?>',{id:ids,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
							}
							else
							{
								smart_error_box(out.message,'#tbl-uses');
							}
						});		
					}
				}
			});
		}else
		{
			bootbox.confirm({
				title: "Message",
				message: "Checklist Your Data!",
				buttons: {
					 
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					return;
				}
			});	
		}
	});
	$("#chk-items").on('click',function(){
		var chk = $(this).is(':checked');
		$(".js-dataTable-full").find(".chk-item").each(function(){
			$(this).prop('checked',chk);
		});
	});
	$("#frm-reset").validate({
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
			var req = post('<?=site_url('tebak/skor/reset-password')?>',$("#frm-reset").serialize());
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-reset .modal-body');
					$("#resetmodal").modal('hide');
				}
				else
				{
					smart_error_box(out.message,'#frm-reset .modal-body');
				}
			});
			return false;
		}
	})
	$(".js-dataTable-full").on('click','.btn-reset-users',function(){
		var ids = $(this).data('ref');
		if(ids!="")
		{
			$("#resetmodal").find("#id").val(ids);
			$("#resetmodal").modal('show');
		}
	});
	$("#resetmodal").on('hide.bs.modal',function(){
		$("#frm-reset")[0].reset();
		$("#resetmodal").find("#id").val('');
		reloadToken();
	});
	/*=========== edited users ========== */
	$("#status").select2({
		allowClear:true,
		placeholder:"Select Sorting Date"
	}); 
	$("#frm-status").validate({
		ignore:[],
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
			id_search = $("#status").val();
			curls = "<?=site_url('tebak/skor/getlist')?>?baru="+ id_search;
			table_ajax.api().ajax.url(curls).load()
			return false;
		}
	}); 
	$(".js-dataTable-full").on('click','.btn-check',function(){
		var ids = $(this).data('ref');
		var stores = $(this).data('store');
		var checks = $(this).data('check');
		if(ids!="" && stores!="")
		{
			bootbox.confirm({
				title: "default user?",
				message: "Do you want to default this user.",
				buttons: {
					cancel: {
						label: '<i class="fa fa-times"></i> Cancel'
					},
					confirm: {
						label: '<i class="fa fa-check"></i> Confirm'
					}
				},
				callback: function (result) {
					if(result)
					{
						var req = post('<?=site_url('tebak/skor/defaultuser')?>',{id:ids,"id_sites":stores,"default_store":checks,'<?=$this->security->get_csrf_token_name()?>':smart_token_hash});
						req.done(function(out){
							if(!out.error)
							{
								table_ajax.api().ajax.reload();
								smart_success_box(out.message,'#tbl-uses');
							}
							else
							{
								smart_error_box(out.message,'#tbl-uses');
							}
						});		
					}
				}
			});
		}
	});
	$("#id_tournament").change(function()
	{
		$("#id_event").html("");
		var ids = $(this).val();
		var req = post('<?=site_url("tebak/event/gettour")?>',{id:ids});
			req.done(function(out){
				if(!out.error)
				{
					 
					//
					var chmtteam = "<option value=''>-- choose --</option>";
					$.each(out.team,function(key,val)
					{
						chmtteam += "<option value='"+ val.id +"'>"+ val.name +"</option>";
					});
					$("#id_team1").html(chmtteam);
					$("#id_team2").html(chmtteam);
					
				}
				else
				{
					
				}
			});
		return false;
	});
	$("#frm-mb").validate({
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
			table_ajax.api().ajax.reload(); 
			return false;
		}
	});
});
</script>