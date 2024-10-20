<script type="text/javascript">
var token_price_usdt = <?=setting("price_token")?>;
var nft_fee = <?=setting("nft_fee")?>;

$(function()
{
	$("#buy_now_qty").keyup(function()
	{
		 $(".buybutton").addClass("xhide");
		 $(".buy_div .message-single").text("");	
		 $(".buy_div .message-single").addClass("xhide");  
		 var xcs = $(this).val();
		 if(xcs>0)
		 {
			 var ctotalv = xcs * token_price_usdt;
			 totalbuyed = ctotalv;
			 
			 var total_conv = ctotalv;
			 $("#buy_value").val(total_conv); 	
			 $(".buy_balance").text(total_conv);
			 //fee 
			 var fees = nft_fee/100;
			 var fee_total = ctotalv*fees;
			 
			 totalfeebuy = fee_total;
			 
			 var total_buy_balance = ctotalv + fee_total;
			 var check_totals = 0;
			 if(total_buy_balance>0)
			 {
				 check_totals = total_buy_balance;
			 }
			 $("#fee_price").val(totalfeebuy);
			 //totalbuyed = total_buy_balance;
			 $(".fee_buy_balance").text(fee_total);
			 
			 $(".total_buy_balance").text(total_buy_balance);
			 $(".buybutton").removeClass("xhide");  
		 }else
		 {
			$(".buy_div .message-single").removeClass("xhide");  
			$(".buy_div .message-single").text("Cannot be Process");	 
		 }
		 
		 //end fee 
	});
	$("#bid_qty").keyup(function()
	{
		$(".bidbutton").addClass("xhide");
		$(".bid_div .message-single").text("");	 
	     $(".bid_div .message-single").addClass("xhide");	
		 var xcs = $(this).val();
		  if(xcs>0)
		 {
			 var ctotalv = xcs * token_price_usdt;
			 var total_conv = ctotalv;
			 $("#bid_value").val(total_conv); 	
			 $(".bid_balance").text(total_conv);
			 //fee 
			 var fees = nft_fee/100;
			 var fee_total = ctotalv*fees;
			 var total_buy_balance = ctotalv + fee_total;
			 var check_totals = 0;
			 if(total_buy_balance>0)
			 {
				 check_totals = total_buy_balance;
			 }
			 $(".fee_bid_balance").text(fee_total);
			 
			 $(".total_buy_balance").text(total_buy_balance);
			 $(".bidbutton").removeClass("xhide");  
		 }else
		 {
			$(".bid_div .message-single").removeClass("xhide");   
			$(".bid_div .message-single").text("Cannot be Process");	 
			
		 }
		 
		 //end fee 
	});
	$("#buy_now_qty").trigger("keyup");
	$("#bid_qty").trigger("keyup");
	
	//buy
	$("#form-buying").validate({
				ignore:[],
				onkeyup:false,
				errorClass: 'help-block text-right animated fadeInDown errors',
				errorElement: 'div',
				submitHandler:function(){
					 
					window.vm.connectWallet();
					// window.vm.owneroF(<?=$data['tokenid']?>);
					window.vm.owneroF(<?=$data['tokenid']?>);
					setTimeout(function()
					{
						console.log(tokenowners);
						window.vm.buying(tokenowners,<?=$data['tokenid']?>,totalbuyed);
					},500);
					
					 
				}
				
			});
		
	//end bu
	window.vm.connectWallet();
	 
	tokenid_ps = <?=$data['tokenid']?>;
	setTimeout(function()
	{
		window.vm.owneroF(<?=$data['tokenid']?>); 
		 setTimeout(function()
		 {
			 console.log(tokenowners);
			 window.vm.setbutton();	
			 setTimeout(function()
		 	{
				//window.vm.approved(<?=$data['tokenid']?>);	 
			},500);
		 },500);
	},1500);
	 
});
</script>