<form action="javascript:void(0);" method="post" id="frm-object">
<div class="row">
	<div class="col-md-12">
  
   	   <div class="card">
       		<div class="card-header">
                   Form <?=$title?>
            </div>
            <div class="card-body">
                
                                    <div class="form-group">
                                        <label>Tournament</label>
                                        <select id="id_tournament" name="id_tournament" class="form-control required" >
                                        	<option value=""  > -- choose --</option>
											<?php
												for($i=0;$i<count($tournament);$i++)
												{
													$selected = "";
													if(isset($data['id_tournament']))
													{
														if($data['id_tournament']==$tournament[$i]['id'])
														{
															$selected = "selected='selected'";
														}
													}
											?>
                                            		<option value="<?=$tournament[$i]['id']?>" <?=$selected?> ><?=$tournament[$i]['name']?></option>
                                            <?php
												}
											?>
                                        </select>
                                    </div> 
                                    <div class="form-group">
                                        <label>Event</label>
                                        <select id="id_event" name="id_event" class="form-control required" >
                                        	<option value=""  > -- choose --</option>
											<?php
												if(isset($data['id_event']))
												{
													for($i=0;$i<count($event);$i++)
													{
														$selected = "";
														if(isset($data['id_event']))
														{
															if($data['id_event']==$event[$i]['id'])
															{
																$selected = "selected='selected'";
															}
														}
											?>
                                            		<option value="<?=$event[$i]['id']?>" <?=$selected?> ><?=$event[$i]['name']?></option>
                                            <?php
													}
												}
											?>
                                        </select>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Team 1</label>
                                                <select id="id_team1" name="id_team1" class="form-control required" >
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
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Score</label>
                                                 <input type="text" class="form-control required" name="skor_team1" id="skor_team1" placeholder="score team 2" value="<?=isset($data['skor_team1'])?$data['skor_team1']:''?>" />
                                            </div> 
                                        </div>
                                        
                                    </div> 
                                     <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Team 2</label>
                                                <select id="id_team2" name="id_team2" class="form-control required" >
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
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Score</label>
                                                 <input type="text" class="form-control required" name="skor_team2" id="skor_team2" placeholder="score team 2" value="<?=isset($data['skor_team2'])?$data['skor_team2']:''?>" />
                                            </div> 
                                        </div>
                                        
                                    </div>  
                                    
                                     <div class="row">
                                        <div class="col-md-6">
                                             <div class="form-group">
                                                <label>Start Date</label>
                                                <input type="text" class="form-control required datetimepicker" name="start_date" id="start_date" placeholder="start date" value="<?=isset($data['start_date'])?$data['start_date']:''?>" />
                                            </div> 
                                        </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                <label>End Date</label>
                                                <input type="text" class="form-control required datetimepicker" name="end_date" id="end_date" placeholder="end date" value="<?=isset($data['end_date'])?$data['end_date']:''?>" />
                                            </div> 
                                        </div>
                                        
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
			var req = postFile('<?=site_url("tebak/match/save")?>',data);
			req.done(function(out){
				if(!out.error)
				{
					smart_success_box(out.message,'#frm-object .block-content');
					document.location.href="<?=site_url('tebak/match')?>";
				}
				else
				{
					smart_error_box(out.message,'#frm-object .block-content');
				}
			});
			return false;
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
					var chmtl = "<option value=''>-- choose --</option>";
					$.each(out.data,function(key,val)
					{
						chmtl += "<option value='"+ val.id +"'>"+ val.name +"</option>";
					});
					$("#id_event").html(chmtl);
					
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
	$('#start_date').datetimepicker({
		timepicker:true,
		format:'Y-m-d H:i',
		formatDate:'Y-m-d',
		mask:'9999-19-39 29:59'
	});
	$('#end_date').datetimepicker({
		timepicker:true,
		format:'Y-m-d H:i',
		formatDate:'Y-m-d',
		mask:'9999-19-39 29:59'
	});
	  
	
});
</script>          