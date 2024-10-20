<script type="text/javascript">
 
var noprop = 0;
$(function()
{
	 $("#btn-proper").click(function()
	 {
		var cprops = ' <div class="row padding-6 c-removeprop'+ noprop +'"  >';
		
		cprops += ' <div class="col-md-10 ">';
		cprops += '<input type="text" name="sub[]" id="sub[]" class="form-control subprops" placeholder="name properties" />';
		cprops += '</div>';
		cprops += ' <div class="col-md-2 ">';
		cprops += ' <a href="javascript:void(0);"  onclick="javascript:removeprop('+ noprop +');"  class="pull-right btn btn-danger"><i class="fa fa-remove"></i></a>';
		
		cprops += '</div>';

		cprops += '</div>';
		$(".propertiesc").append(cprops);
		noprop +=1;
		checkstring_prop();  
	 });
	 $('#collection').select2({
	  tags: true 
	});
	 
});
function removeprop(nop)
{
	$(".c-removeprop"+nop).remove();
}
</script>
