<section class="features section-padding-100 ">



        <div class="container">

            <div class="section-heading text-center">

                

                <div class="dream-dots justify-content-center fadeInUp" data-wow-delay="0.2s">

                     <span>Connect Your Wallet directly into ARTS website</span>

                </div>

                <h2 class="fadeInUp" data-wow-delay="0.3s">Directly Connected</h2>

                <p class="fadeInUp" data-wow-delay="0.4s">Take full control of your crypto, digital art, and more by storing privately and securely on your own device.</p>

            </div>

            <div class="row align-items-center">



                <div class="service-img-wrapper col-lg-5 col-md-12 col-sm-12 no-padding-right">

                    <div class="features-list">

                        <div class="who-we-contant text-center">

                            <img src="depan/img/icons/wallet.png" class="mb-15" width="90" alt="">

                            <h4 class="w-text mb-30" data-wow-delay="0.3s">Connect your wallet to start Transfer, Withdraw, Buying and Selling.</h4>

                            <div class="pricing-item v2" id="cmeta">
                            	 <img src="depan/img/icons/w1.png" width="30" class="wal-icon" alt="">
								<?php
								if(!empty(user_wallet("wallet_address")))
								{
								?>

                                <small><?=user_wallet("wallet_address")?></small>
                                <?php
								}else
								{
								?>
                                 connect with MetaMask
                                <?php
								}
								?>

                            </div>

                            <!-- 
                            <div class="pricing-item v2">

                                <img src="depan/img/icons/w2.png" width="30" class="wal-icon" alt="">connect with WalletConnect

                            </div>

                            <div class="pricing-item v2 mb-0">

                                <img src="depan/img/icons/w3.png" width="30" class="wal-icon" alt="">connect with Ledger

                            </div>
                            -->

                        </div>

                    </div>

                </div>



                <div class="service-img-wrapper col-lg-7 col-md-12 col-sm-12 mt-s">

                    <div class="image-box">

                        <img src="depan/img/artsky/platform.gif" class="center-block img-responsive phone-img" alt="">

                        <img src="depan/img/artsky/rings.png" class="center-block img-responsive rings " alt="">

                    </div>

                </div> 

                

            </div>

        </div>

    </section>
    <form action="" method="post" style="display:none;" id="frm-wallet">
        <!-- Modal content-->
        
             
            <input type="hidden" id="wallet_address" name="wallet_address" value=""/>
            <button type="submit" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal" data-bs-dismiss="modal">Close</button>
           
     </form>
 <script>
let web3 = new web3js.myweb3(window.ethereum);

let addr;
const loadweb3 = async () => {
			  try {
					web3 = new web3js.myweb3(window.ethereum);
					 
				let a = await ethereum.enable();
				console.log(a);
				addr = web3.utils.toChecksumAddress(a[0]);
				console.log(addr);
				$("#wallet_address").val(addr);
				setTimeout(function()
				{
					 $("#walletadd").text("<?=user_wallet("wallet_address")?>");
					 $("#frm-wallet").trigger("submit");
				},500);
				return(addr);
			  } catch (error) {
				if (error.code === 4001) {
				  alert('Please connect to MetaMask / Trust Wallet');
				} else {
				  console.error(error);	
				  alert('Please connect to MetaMask / Trust Wallet');
				  //console.error(error);
				}
			  }
		
};
function getbalance_wallet()
{
	let tokenAddress = "0x6c684676cf81284176e2c8af3866dda074a4b97e";
	let walletAddress = "<?=user_wallet("wallet_address")?>";
	if(walletAddress == "")
	{
		smart_message("Wallet Address Not Found");
		return;	
	}
	// The minimum ABI to get ERC20 Token balance
	let minABI = [
	  // balanceOf
	  {
		"constant":true,
		"inputs":[{"name":"_owner","type":"address"}],
		"name":"balanceOf",
		"outputs":[{"name":"balance","type":"uint256"}],
		"type":"function"
	  },
	  // decimals
	  {
		"constant":true,
		"inputs":[],
		"name":"decimals",
		"outputs":[{"name":"","type":"uint8"}],
		"type":"function"
	  }
	];
	
	// Get ERC20 Token contract instance
	let contract = web3.eth.contract(minABI).at(tokenAddress);
	
	// Call balanceOf function
	contract.balanceOf(walletAddress, (error, balance) => {
	  // Get decimals
	  contract.decimals((error, decimals) => {
		// calculate a balance
		balance = balance.div(10**decimals);
		console.log(balance.toString());
	  });
	});
}
$(function()
{
	 
	$("#cmeta").on("click",function()
	{
		
		loadweb3();		
		
	});
	$("#frm-wallet").validate({
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
			var obj = new FormData($("#frm-wallet")[0]);
			var req = postFile('<?=site_url('wallet/save')?>',obj);
			req.done(function(out){
				if(!out.error)
				{
					document.location.href = window.location;
					
				}
				else
				{
					smart_error_box(out.message,'#frm-wallet');
				}
			});
			return false;
		}
	});
	
});
</script>      