<?php
$templates = config_item("templates")."front/";
$setting = settings(); 
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title><?=isset($setting['website_title'])?$setting['website_title']:""?></title>
    
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="Vellocity" name="description" />
    <meta content="" name="keywords" />
    <meta content="" name="author" />
    <base href="<?=base_url()?>">
    <meta name="<?=$this->security->get_csrf_token_name()?>" class="smart-token" content="<?=$this->security->get_csrf_hash();?>" id="nd-meta-token">
    <!-- CSS Files
    ================================================== -->
    <link id="bootstrap" href="<?=$templates?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link id="bootstrap-grid" href="<?=$templates?>css/bootstrap-grid.min.css" rel="stylesheet" type="text/css" />
    <link id="bootstrap-reboot" href="<?=$templates?>css/bootstrap-reboot.min.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/animate.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/owl.carousel.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/owl.theme.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/owl.transitions.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/magnific-popup.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/jquery.countdown.css" rel="stylesheet" type="text/css" />
    <link href="<?=$templates?>css/style.css" rel="stylesheet" type="text/css" />
    <!-- color scheme -->
    <!--
    <link id="colors" href="<?=$templates?>css/colors/scheme-01.css" rel="stylesheet" type="text/css" />
    -->
     <link href="<?=$templates?>css/de-grey.css" rel="stylesheet" type="text/css" />
    <link id="colors" href="<?=$templates?>css/colors/scheme-04.css" rel="stylesheet" type="text/css" />
   
    
    <link href="<?=$templates?>css/coloring.css" rel="stylesheet" type="text/css" />
    <link rel="icon" href="<?=$templates?>images/favicon.png" type="image/gif" sizes="16x16">
    <script src="<?=$templates?>js/jquery.min.js"></script>
    
	<script src="<?=$templates?>js/bootstrap.min.js"></script>
    <script src="<?=$templates?>js/bootstrap.bundle.min.js"></script>
    <script src="<?=$templates?>js/wow.min.js"></script>
    <script src="<?=$templates?>js/jquery.isotope.min.js"></script>
    <script src="<?=$templates?>js/easing.js"></script>
    <script src="<?=$templates?>js/owl.carousel.js"></script>
    <script src="<?=$templates?>js/validation.js"></script>
    <script src="<?=$templates?>js/jquery.magnific-popup.min.js"></script>
    <script src="<?=$templates?>js/enquire.min.js"></script>
    <script src="<?=$templates?>js/jquery.plugin.js"></script>
   
    <!-- edited -->
     <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>  
    <script src="<?=$templates?>web3.min.js"></script>
	<script src="<?=$templates?>vue.js"></script>
    <script src="<?=$templates?>ipfs-http-client-lite.js"></script>
    <!-- <script src="<?=$templates?>ethers-5.0.17.umd.min.js"></script> -->
     <script src="<?=$templates?>ethers.umd.min.js"></script>
    <script src="<?=$templates?>plugin/jquery-validation/jquery.validate.js"></script>
  	<script src="<?=$templates?>plugin/jquery-validation/additional-methods.js"></script>
    <script src="<?=$templates?>smart.js"></script> 
    <style type="text/css">
	.copy {
	  font-size: 14px;
	}
	.errors
	{
		color:red;	
	}
	#smart-loader .card
	{
		background:#000;
	}
	#btn_change, #btn_copyed {
	  position: relative;
	  font-size: 12px;
	  padding: 4px 10px;
	  line-height: 1em;
	  border: solid 1px #dddddd;
	  display: inline-block;
	  border-radius: 3px;
	  -moz-border-radius: 3px;
	  -webkit-border-radius: 3px;
	  outline: none;
	}
	.dark-scheme #btn_change, .dark-scheme #btn_copyed {
	  color: #ffffff;
	  background:rgba(255, 255, 255, .3);
	  border: none;
	  padding: 6px 12px;
	}
	.nhs
	{
		padding:8%;	
	}
	.vh-80 {
	  height:inherit;
	}
	.xhide{
		display:none !important;
	}
	@media screen and (max-width: 600px) {
		.nhs
		{
			padding:inherit;	
		}
		 .vnone
		 {
			min-height:inherit; 
		 }
		.vh-80 {
		  height: 48vh  !important;
		}
	}
	</style>
    <!-- edited -->
    <script type="text/javascript">
    var totalbuyed = 0;
	var totalfeebuy = 0;
	</script>
	<?php
    if(user_info('id'))
	{
	?>
    <script type="text/javascript">
       
		const decimalPrecision = 18; 
        window.CONTRACT_ABI = <?=get_network("abi_code_nft","bsc_testnet")?>;
		window.TOPIC_TRANSFER = '<?=get_network("contract_address","bsc_testnet")?>'; //'0x297313fcba79a7eb3ef9a5f80673a05176a5199c';
		//'0x8e7660d19b74abe3981a81b091354ccff4524ea4';//'0xB93A7E1BA50FB92ddC9a79b1124998C953C2cD6f';
        // ganti contract address:
        window.CHAINS = {
           // '1': ['Ethereum', 'https://etherscan.io', '0x0000000000000000000000000000000000000000'],
            //'4': ['Rinkeby Testnet', 'https://rinkeby.etherscan.io', '0x0000000000000000000000000000000000000000']
			//'97': ['Testnet', 'https://data-seed-prebsc-1-s1.binance.org:8545', '0x297313fcba79a7eb3ef9a5f80673a05176a5199c','https://testnet.bscscan.com/']
			'97': ['<?=get_network("network","bsc_testnet")?>', 'https://data-seed-prebsc-1-s1.binance.org:8545', '<?=get_network("contract_address","bsc_testnet")?>','<?=get_network("network_url","bsc_testnet")?>']
        };
		//token
		var abitoken = <?=get_network("abi_code_token","bsc_testnet")?>;
		let tokencontract = new ethers.Contract('<?=get_network("contract_token","bsc_testnet")?>', abitoken, window.getWeb3Provider().getSigner());
		console.log(ethers);
		var tokenowners = ''; 
		//end token
		function base64ToBuffer(base64) {
            let
                binary_string = window.atob(base64),
                len = binary_string.length,
                bytes = new Uint8Array(len);
            for (let i = 0; i < len; i++) {
                bytes[i] = binary_string.charCodeAt(i);
            }
            return bytes;
        }

        function getWeb3Provider() {
            if (!window.web3Provider) {
                if (!window.ethereum) {
                    console.error("there is no web3 provider.");
                    return null;
                }
                window.web3Provider = new ethers.providers.Web3Provider(window.ethereum, "any");
            }
            return window.web3Provider;
        }

        function showAlert(title, message) {
            let m = $('#alertModal');
            m.find('.x-title').text(title);
            if (message.startsWith('<')) {
                m.find('.x-message').html(message);
            } else {
                m.find('.x-message').text(message);
            }
            let myModal = new bootstrap.Modal(m.get(0), { backdrop: 'static', keyboard: false });
            myModal.show();
        }

        function showInfo(title, message) {
            let m = $('#infoModal');
            m.find('.x-title').text(title);
            if (message.startsWith('<')) {
                m.find('.x-message').html(message);
            } else {
                m.find('.x-message').text(message);
            }
            let myModal = new bootstrap.Modal(m.get(0), { backdrop: 'static', keyboard: false });
            myModal.show();
        }
		let finishModal;
		function finishInfo(title, message) {
            let m = $('#FinishModal');
            m.find('.x-title').text(title);
            if (message.startsWith('<')) {
                m.find('.x-message').html(message);
            } else {
                m.find('.x-message').text(message);
            }
            finishModal = new bootstrap.Modal(m.get(0), { backdrop: 'static', keyboard: false });
            finishModal.show();
        }
        function showLoading(title, message) {
            let m = $('#loadingModal');
            let myModal = new bootstrap.Modal(m.get(0), { backdrop: 'static', keyboard: false });
            let obj = {
                setTitle: (t) => {
                    m.find('.x-title').text(t);
                },
                setMessage: (t) => {
                    m.find('.x-message').text(t);
                },
                close: () => {
                    setTimeout(function () {
                        myModal.hide();
                    }, 500);
                }
            }
            obj.setTitle(title);
            obj.setMessage(message);
            myModal.show();
            return obj;
        }

        function translateError(err) {
            window.err = err;
            if (typeof (err) === 'string') {
                return err;
            }
            if (err.error && err.error.code && err.error.message) {
                return `Error (${err.error.code}): ${err.error.message}`;
            }
            if (err.code && err.message) {
                return `Error (${err.code}): ${err.message}`;
            }
            return err.message || err.toString();
        }
		var textwallet = "Connect Wallet";
        function init() {
            console.log('init vue...');
            window.vm = new Vue({
                el: '#vm',
                data: {
                    account: null,
                    chainId: 0,
					tokenbalance:0,
					owners:'',
                    // nft data:
                    imageData: '', // base64 data
                    imageFileName: '',
                    name: '',
                    description: '',
                    amount: 1,
                    link: 'https://',
                    properties: [
                        { trait_type: '', value: '' }
                    ]
                },
                computed: {
                    ready: function () {
                        return this.account && this.chainId > 0;
                    },
                    networkName: function () {
                        if (this.account) {
                            let cs = window.CHAINS[this.chainId];
                            if (cs) {
                                return cs[0];
                            }
							alert("Network RPC unsupported");
                            return 'Unsupported Chain (0x' + this.chainId.toString(16) + ')';
                        }
                        return 'Not connected';
                    },
                    wrongNetwork: function () {
                        
						return this.account && !window.CHAINS[this.chainId];
                    }
                },
                methods: {
                    abbrAddress: function (addr) {
                        if (!addr) {
                            return '';
                        }
                        let s = addr.toString();
                        if (s.indexOf('0x') === 0 && s.length === 42) {
                            let addr = ethers.utils.getAddress(s.substring(0));
                            return addr.substring(0, 6) + '...' + addr.substring(38);
                        }
                        return s;
                    },
                    gotoScanUrlForAddress: function (addr) {
                        let cs = window.CHAINS[this.chainId];
                        if (cs) {
                            window.open(cs[3] + '/address/' + (addr || this.account));
                        } else {
                            console.error('Invalid chain id: ', this.chainId);
                        }
                    },
                    getScanUrlForToken: function (tokenId) {
                        let cs = window.CHAINS[this.chainId];
                        if (cs) {
                            //return cs[1] + '/token/' + cs[2] + '?a=' + tokenId;
							return cs[3] + '/token/' + cs[2] + '?a=' + tokenId;
                        } else {
                            return 'about:blank';
                        }
                    },
                    getContractAddress: function () {
                        let cs = window.CHAINS[this.chainId];
                        if (cs) {
                            return cs[2];
                        } else {
                            return '0x0000000000000000000000000000000000000000';
                        }
                    },
					
                    imageChanged: function (imagess) {
                        let
                            that = this,
                            fpath = $('#'+ imagess).val(),
                            pos = fpath.lastIndexOf('.');
                        if (pos === -1) {
                            that.imageData = '';
                            that.imageFileName = '';
                            $('#imagePreview').css('background-image', 'none');
                            return;
                        }
                        let
                            fname = 'file' + fpath.substring(pos),
                            reader = new FileReader();
                        try {
                            let file = $('#'+ imagess).get(0).files[0];
                            reader.onloadend = function (e) {
                                let
                                    data = e.target.result,
                                    index = data.indexOf(';base64,');
                                if ((index >= 0) && (index < 100)) {
                                    that.imageData = data.substring(index + 8);
                                    that.imageFileName = fname;
                                    $('#imagePreview').css('background-image', 'url(' + data + ')');
                                } else {
                                    that.imageData = '';
                                    that.imageFileName = '';
                                    $('#imagePreview').css('background-image', 'none');
                                    showAlert('Browser does not support data URL!');
                                }
                            };
                            reader.readAsDataURL(file);
                        } catch (e) {
                            showAlert('Error when process file: ' + e);
                        }
                    },
                    addProperty: function () {
                        this.properties.push({ trait_type: '', value: '' });
                    },
                    removeProperty: function (prop) {
                        let index = this.properties.indexOf(prop);
                        this.properties.splice(index, 1);
                    },
                    mint: async function () {
                        var nftcat = $("#form-create-item #id_nftcategory").val();
						if(nftcat=="")
						{
							return showAlert('Error', ' Choose collection Empty');	
						}
						if (!this.ready) {
                             <?php
								if(user_info('id'))
								{
									 if(is_wallet())
									{ 
							
							?>
									this.ready = true;
									mintnfts();
									return;
							<?php
									}
								}
							?>
							return showAlert('Error', 'Please connect MetaMask/Trustwallet wallet first.');
                        }
                        if (this.wrongNetwork) {
                            return showAlert('Error', 'Please switch to supported network in MetaMask/Trustwallet wallet.');
                        }
                        // validate:
                        if (this.imageData === '') {
                            return showAlert('Error', 'Please select image.');
                        }
                        if (this.name.trim() === '') {
                            return showAlert('Error', 'NFT name is empty.');
                        }
						this.amount = parseFloat($(".prices_tran #price").val());
						var min_bid = parseFloat($(".prices_tran #minimum_bid").val());
						
						if(min_bid >0 )
						{
							this.amount = parseFloat(min_bid);
						}
                          //parseInt(this.amount);
						console.log("amount= "+this.amount.toString());
                        if (isNaN(this.amount)   || this.amount < 1 || this.amount > 100000) {
                            return showAlert('Error', 'NFT amount is invalid.');
                        }
                        if (!this.link.trim().startsWith('https://') && !this.link.trim().startsWith('http://')) {
                            return showAlert('Error', 'NFT link is invalid.');
                        }
                        // check metadata:
                        let props = [];
                        for (let i = 0; i < this.properties.length; i++) {
                            let
                                p = this.properties[i],
                                k = p.trait_type.trim(),
                                v = p.value.trim();
                            if (k === '' && v === '') {
                                continue;
                            }
                            if (k === '' && v !== '') {
                                return showAlert('Error', 'Missing property name for value: ' + v);
                            }
                            props.push({
                                'trait_type': k,
                                'value': v
                            });
                        }
                        let metadata = {
                            name: this.name.trim(),
                            description: this.description.trim(),
                            external_url: this.link.trim(),
                            image: '',
                            attributes: props
                        };
                        let loading = showLoading('Mint NFT', 'Upload image to IPFS...');
                        try {
                            // upload image:
                            let
                                ipfs = window.IpfsHttpClientLite('https://ipfs.infura.io:5001'),
                                data = base64ToBuffer(this.imageData);
                            let
                                resp = await ipfs.add(data),
                                hash = resp[0] && resp[0].hash;
                            console.log(resp);
                            if (!hash) {
                                throw 'Invalid IPFS result when upload image!';
                            }
                            metadata.image = 'https://ipfs.infura.io/ipfs/' + hash + '?filename=' + this.imageFileName;
                            console.log(metadata.image);
                            let jsonFile = JSON.stringify(metadata, null, '  ');
                            // upload metadata:
                            loading.setMessage('Upload metadata to IPFS...');
                            resp = await ipfs.add(jsonFile);
                            hash = resp[0] && resp[0].hash;
                            if (!hash) {
                                throw 'Invalid IPFS result when upload metadata!';
                            }
							var mets = 'https://ipfs.infura.io/ipfs/' + hash + '?filename=metadata.json';
                            console.log('https://ipfs.infura.io/ipfs/' + hash + '?filename=metadata.json');

                            loading.setMessage('Prepare NFT mint transaction...');
                            if (!this.ready || this.wrongNetwork) {
                                throw 'Wallet not ready!';
                            }
                            let contract = new ethers.Contract(this.getContractAddress(), window.CONTRACT_ABI, window.getWeb3Provider().getSigner());
							
                            loading.setMessage('Please confirm transaction in wallet...');
                            
							//let tx = await contract.mint(this.amount, hash);
							//let tx = await contract.mint(hash,this.account,this.amount); 
							//let tx = await contract.mint(metadata.image,this.account,this.amount); 
							console.log("amount= "+this.amount.toString());
							let tx = await contract.mint(mets,this.account,ethers.FixedNumber.fromString(this.amount.toString(),decimalPrecision));
							//await contract.mint("<?=user_info('uuid')?>",this.account,this.amount);
                            
							loading.setMessage('Please wait for block confirms...');
                            
							await tx.wait(1);
                            
							//const checkapprove_nft = await contract.setApprovalForAll(this.account,true);
							//checkapprove_nft.wait(1);
							loading.setMessage('wait approval...');
                            
							loading.setMessage('Parse transaction receipt...');
                            
							let txReceipt = await window.getWeb3Provider().getTransactionReceipt(tx.hash);
                            console.log(txReceipt);
                            let tokenId = null, amount = 0;
                            var splitid;
							//for (let i = 0; i < txReceipt.logs.length; i++) {
							for (let i = 0; i < 1; i++) {	
                                let log = txReceipt.logs[i];
                                console.log('log:');
								let text = log.topics[3];
                                console.log(log.topics);
								
								splitid = parseInt(text, 16);
								 
								console.log("real_number="+ splitid);
								 
								 
								tokenId = text;
								console.log("tokenid="+ tokenId);
								var chs = log.data;
								console.log("string="+ chs.toString(16).toUpperCase());
								console.log(log);
                                /*if (log.topics[0] === window.TOPIC_TRANSFER) {
                                    tokenId = parseInt(log.data.substring(2, 64 + 2));
                                    amount = parseInt(log.data.substring(64 + 2, 128 + 2));
                                    console.log('Found log: token id = ' + tokenId + ', amount = ' + amount);
                                    break;
                                }*/
                            }
							
                            if (tokenId === null) {
                                throw 'Token ID not found in transaction receipt.';
                            }
							
                            //let url = this.getScanUrlForToken(tokenId);
							let url = this.getScanUrlForToken(tx.hash);
                            loading.close();
							//submit nft
							$("#form-create-item #ipfs").val(metadata.image);
							$("#form-create-item #txhash").val(tx.hash);
							$("#form-create-item #tokenid").val(splitid);
							submitnft(url);
							// end subtmit
                            
                        } catch (e) {
                            console.error(e);
                            loading.close();
                            showAlert('Error', translateError(e));
                        }
                    },
                    accountChanged: function (accounts) {
                        console.log('wallet account changed:', accounts.length === 0 ? null : accounts[0]);
						
						let cs = window.CHAINS[this.chainId];
						$(".btn-wallet").text("");
                        if (accounts.length === 0) {
                            this.disconnected();
                        } else {
                            this.account = accounts[0];
                            document.cookie = '__account__=' + this.account + ';max-age=1296000';
							
							if (cs) {
								//connectwalleted(accounts[0]);
								connectwalleted(accounts[0],this.tokenbalance);
							}
							$(".btn-wallet").text(accounts[0]);
							this.gettokenbalance();
							//
						 	<?php
							if(isset($transaksi))
							{
							?>	
								 window.vm.owneroF(<?=$data['tokenid']?>); 
								 setTimeout(function()
								 {
									 console.log(tokenowners);
									 window.vm.setbutton();	
									 
								 },500);
							<?php
							}
							?> 
							
							//
                        }
					
                    },
                    disconnected: async function () {
                        console.warn('wallet disconnected.');
                        this.account = null;
						$(".btn-wallet").text("");
                    },
                    chainChanged: function (chainId) {
                        console.log('wallet chainId changed: ' + chainId + ' = ' + parseInt(chainId, 16));
                        this.chainId = parseInt(chainId, 16);
						let cs = window.CHAINS[this.chainId];
						
						
						if (!cs) {
                          window.ethereum.on('disconnect', this.disconnected);
						  alert("Network RPC unsupported");
						  $(".btn-wallet").text(textwallet);
                        }else
						{
							connectwalleted(this.account,this.tokenbalance);
							this.gettokenbalance();
						}
						
                    },
                    connectWallet: async function () {
                        console.log('try connect wallet...');
						
                        if (window.getWeb3Provider() === null) {
                            console.error('there is no web3 provider.');
                            return false;
                        }
                        try {
                             
							this.accountChanged(await window.ethereum.request({
                                method: 'eth_requestAccounts',
                            }));
                            this.chainChanged(await window.ethereum.request({
                                method: 'eth_chainId'
                            }));
                            window.ethereum.on('disconnect', this.disconnected);
                            window.ethereum.on('accountsChanged', this.accountChanged);
                            window.ethereum.on('chainChanged', this.chainChanged);
                        } catch (e) {
                            console.error('could not get a wallet connection.', e);
                            return false;
                        }
                        console.log('wallet connected.');
						
                        return true;
                    },
					gettokenbalance: async function () {
                       
						 
						const Web3Client = new Web3(window.getWeb3Provider());
						const balance = (await tokencontract.balanceOf(this.account)).toString();
						console.log(window.getWeb3Provider());
						const format = Web3Client.utils.fromWei(balance);
						
						 
						
						this.tokenbalance = format;
						var tokened = parseFloat(this.tokenbalance);
						$(".tokenbalance").text(numberWithCommas(tokened));
						$.each($(".token_balance"),function()
						{
							 
							$(this).text(numberWithCommas(tokened));
						});
						connectwalleted(this.account,this.tokenbalance);
						 
						/*
						alert(this.account);
						alert(format);
						*/

                    },
				    setbutton: function () {
                        
						
						
						if((this.account.toLowerCase() != tokenowners.toLowerCase()) && tokenowners!="")
						{
							$(".btn-message-dialog").addClass("hide");
							$(".btn-buy-dialog").removeClass("hide");
						}else
						{
							$(".btn-message-dialog").removeClass("hide");
							$(".btn-buy-dialog").addClass("hide");	
						}
						console.log(this.account);
						console.log(tokenowners);
                    },
					owneroF: async function (tokenids) {
                       
						//nft
						let contractnft = new ethers.Contract(this.getContractAddress(), window.CONTRACT_ABI, window.getWeb3Provider().getSigner());
						 
						 //end nft
						const Web3Client = new Web3(window.getWeb3Provider());
						 
						//
						//const vaddressowner = await contractnft.ownerOf(tokenids);
						//const vaddressowner =   contractnft.ownerOf(tokenids)
						 
						const vaddressowner =  await contractnft.ownerOf(tokenids);
						//vaddressowner.wait(1);
						 
						tokenowners = vaddressowner;
						getowner_temp();
						//console.log(tokenowners);
						// return vaddressowner;
						//this.owners  = vaddressowner; 

                    },
					approved: async function (tokenids) {
						 
						let contractnft = new ethers.Contract(this.getContractAddress(), window.CONTRACT_ABI, window.getWeb3Provider().getSigner());
					 
						 
						
						

						
						const getprice =  await contractnft.price(tokenids);
						const formatprice = ethers.utils.formatEther( getprice,1 ) ;
						console.log(formatprice);
						//const transfernft = await contractnft.transferFrom(tokenowners,this.account,tokenids);
						//const buyed = await contractnft.safeTransferFrom(tokenowners,this.account,tokenids);
						//await contractnft.buy(ethers.utils.parseUnits(formatprice, decimalPrecision))
						//contractnft.buy = ethers.utils.parseUnits(formatprice, decimalPrecision);
						/*const buyed = await contractnft.updatePrice(tokenids,ethers.utils.parseUnits(formatprice, decimalPrecision));
						*/
					 
						///const buying = await contractnft.buy(tokenids);
						//contractnft.buy(tokenids).buy  = ethers.utils.parseUnits(formatprice, decimalPrecision);
						//console.log(buying);
						 // await contractnft.isApprovedForAll(tokenowners,this.account);
						 const transfernft = await contractnft.transferFrom(tokenowners,this.account,tokenids);
								transfernft.wait(2);
					},
					buying: async function (owners,tokenids,totalbuyings) {
                      let loading = showLoading('Buying Process', 'Processing ...');
					 
					  
 
					  try {
						  	console.log(String.valueOf(totalbuyings));
						  	const bignumber_buyings = ethers.utils.parseUnits(totalbuyings.toString(), decimalPrecision) ;
							  
					  		const bignumber_fees = ethers.utils.parseUnits(totalfeebuy.toString(), decimalPrecision) ;
							
							const alls = ethers.utils.parseUnits((totalbuyings+totalfeebuy).toString(), decimalPrecision) ;
							 
							let contractnft = new ethers.Contract(this.getContractAddress(), window.CONTRACT_ABI, window.getWeb3Provider().getSigner());
							 
							const Web3Client = new Web3(window.getWeb3Provider());
							const balance = (await tokencontract.balanceOf(this.account)).toString();
							
							const format = Web3Client.utils.fromWei(balance);
							 
							//
							const checkapprove_token =  await tokencontract.approve(this.account,alls);
							checkapprove_token.wait(1);
							if (typeof checkapprove_token.hash !== "undefined") {
								const approveResult = await contractnft.approve(this.account,tokenids);
								approveResult.wait(1);
   						 		 
								
								
								
								//console.log(checkapprove_token);
								//
								
								//fee
								const transferfee = await tokencontract.transferFrom(this.account,'<?=setting("wallet_fee")?>',bignumber_fees);
								transferfee.wait(2);
								  
								//const buyed  = await contractnft.buy(totalbuyings,tokenids);
								const transfer = await tokencontract.transferFrom(this.account,owners,bignumber_buyings);
								loading.setMessage('Parse transaction receipt...');
								transfer.wait(2);
								//
								
								//transaction NFT
								loading.setMessage('Parse transaction NFT...');
								const transfernft = await contractnft.transferFrom(owners,this.account,tokenids);
								transfernft.wait(2);
								//
								let url = this.getScanUrlForToken(transfernft.hash);
                            	loading.close();
								url_finish = window.location.href;
								//submit buying
								$("#form-buying #fee_hash").val(transferfee.hash);
								$("#form-buying #buy_hash").val(transfer.hash);
								$("#form-buying #nft_hash").val(transfernft.hash);
								$("#form-buying #wallet_from").val(owners);
								$("#form-buying #wallet_to").val(this.account);
								submitbuying(url);
								// end buying
							} 
						 } catch (e) {
                            console.error(e);
                            loading.close();
                            showAlert('Error', translateError(e));
                        }	
                    },
					collectible: async function () {
						let contractnft = new ethers.Contract(this.getContractAddress(), window.CONTRACT_ABI, window.getWeb3Provider().getSigner());
						console.log(contractnft); 
						const Web3Client = new Web3(window.getWeb3Provider());
						 
						const balance = (await contractnft.balanceOf(this.account)).toString();
						const formats = Web3Client.utils.fromWei(balance); 
						var tokenidc = new Array();
						for(var i=0;i<balance;i++)
						{
							var tokenarray = (await contractnft.tokenOfOwnerByIndex(this.account,i)).toString();;
							tokenidc.push(tokenarray);
						}
						<?php
						if(isset($author_data))
						{
							if($author_data['id']==user_info("id"))
							{
						?>
							 
							getcollection(tokenidc,this.account);
							
						<?php
							}
						}
						?>
						 
					}
                }
            });
        }
		function numberWithCommas(x) {
			return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
		}



        function toUTF8Array(str) {
			var utf8 = [];
			for (var i=0; i < str.length; i++) {
				var charcode = str.charCodeAt(i);
				if (charcode < 0x80) utf8.push(charcode);
				else if (charcode < 0x800) {
					utf8.push(0xc0 | (charcode >> 6), 
							  0x80 | (charcode & 0x3f));
				}
				else if (charcode < 0xd800 || charcode >= 0xe000) {
					utf8.push(0xe0 | (charcode >> 12), 
							  0x80 | ((charcode>>6) & 0x3f), 
							  0x80 | (charcode & 0x3f));
				}
				// surrogate pair
				else {
					i++;
					// UTF-16 encodes 0x10000-0x10FFFF by
					// subtracting 0x10000 and splitting the
					// 20 bits of 0x0-0xFFFFF into two halves
					charcode = 0x10000 + (((charcode & 0x3ff)<<10)
							  | (str.charCodeAt(i) & 0x3ff))
					utf8.push(0xf0 | (charcode >>18), 
							  0x80 | ((charcode>>12) & 0x3f), 
							  0x80 | ((charcode>>6) & 0x3f), 
							  0x80 | (charcode & 0x3f));
				}
			}
			return utf8;
		}
		var url_finish = "<?=site_url("author/view/".user_info('uuid'))?>";  
		$(function () {
            init();
			//console.log("tokenid=" + parseInt("0x000000000000000000000000000000000000000000000000000000000000000b", 16));
			 
			$('#FinishModal').on('hidden.bs.modal', function () {
			   document.location.href = url_finish;
			})
		});
		
			
			
		
		function  hex_to_ascii(str1)
		 {
			var hex  = str1.toString();
			var str = '';
			for (var n = 0; n < hex.length; n += 2) {
				str += String.fromCharCode(parseInt(hex.substr(n, 2), 16));
			}
			return str;
		 }
		  
		function changeimages(idfile,idpreview)
		 {
								let
									that = this,
									fpath = $('#'+ idfile).val(),
									pos = fpath.lastIndexOf('.');
								if (pos === -1) {
									that.imageData = '';
									that.imageFileName = '';
									$('#'+ idpreview).attr('src','');
									return;
								}
								let
									fname = 'file' + fpath.substring(pos),
									reader = new FileReader();
								try {
									let file = $('#'+ idfile).get(0).files[0];
									reader.onloadend = function (e) {
										let
											data = e.target.result,
											index = data.indexOf(';base64,');
										if ((index >= 0) && (index < 100)) {
											that.imageData = data.substring(index + 8);
											that.imageFileName = fname;
											$('#'+ idpreview).attr('src', data);
										} else {
											that.imageData = '';
											that.imageFileName = '';
											$('#'+ idpreview).attr('src', '');
											smart_message('Browser does not support data URL!');
										}
									};
									reader.readAsDataURL(file);
								} catch (e) {
									showAlert('Error when process file: ' + e);
								}	 
		 }
		 var clicknfts = false;
		function connectwalleted(wallets,token_balance)
		{
			 
			var req = post('<?=site_url('wallet/save')?>',{wallet_address:wallets,"token_balance":token_balance});
			console.log(req);
			req.always(function()
			{
				setTimeout(function()
				{
					
					$(".topmenuwallet").removeClass("hide");
					$(".connectwallet").removeAttr("id");
					$(".connectwallet").addClass("hide");
					$(".btn-wallet").text( wallets);
					
					var ids_profile = $("#ids_users").val();
					var ids_user_now = "<?=user_info('id')?>";
					
					if(ids_profile==ids_user_now)
					{
						$(".profile_wallet").text(wallets);
					}
					//$("#smart-loader").modal("show");	
					if(!clicknfts)
					{
						
						//document.location.href = window.location;
					}
				},800);
			});
			
			 
			return false;	
		}
		function copyTexted(elemes,element) {
		  var $copyText = jQuery(element).text();
		  var button = jQuery('#'+ elemes);
		  navigator.clipboard.writeText($copyText).then(function() {
			var originalText = button.text();
			button.html('Copied!');        
			button.addClass('clicked');
			setTimeout(function(){
			  button.html(originalText);
			  button.removeClass('clicked');
			  }, 750);
		  }, function() {
			button.html('Error');
		  });
		} 
		function mintnfts()
		{
			clicknfts = true;
			window.vm.connectWallet();
			setTimeout(function()
			{
				 
				window.vm.mint();
			});
		}
		function submitnft(url_o)
		{
			var data = new FormData($("#form-create-item")[0]);
			var req = postFile('<?=site_url('nft/save')?>',data);
			req.done(function(out){
				if(!out.error)
				{
					finishInfo('Success', '<p>NFT have been minted successfully!</p><p>Visit <a href="' + url_o + '" target="_blank">transaction</a> for details.</p>');
				}
				else
				{
					 
				}
			});
			
			
			return false;	
		}
		function submitbuying(url_o)
		{
			var data = new FormData($("#form-buying")[0]);
			var req = postFile('<?=site_url('order/save')?>',data);
			req.done(function(out){
				if(!out.error)
				{
					finishInfo('Success', '<p>NFT have been transfer successfully!</p><p>Visit <a href="' + url_o + '" target="_blank">transaction</a> for details.</p>');
				}
				else
				{
					 
				}
			});
			
			
			return false;	
		}
		function getowner_temp()
		{
			 
			var req = post('<?=site_url('items/getowner')?>',{wallet_address:tokenowners});
			req.done(function(out){
				if(!out.error)
				{
					 $(".ownered").html(out.temp);
				}
				else
				{
					 
				}
			});
			
			
			return false;	
		}
		function getcollection(tokenidv,cwallet)
		{
		     $(".collectible").removeClass("xhide");	 
			var req = post('<?=site_url('author/gettemp')?>',{tokenid:tokenidv,'wallet_address':cwallet});
			req.done(function(out){
				if(!out.error)
				{
					 $(".tabcollection").html(out.temp);
				}
				else
				{
					 var no_items = item_auth_no_items();
					 $(".tabcollection").html(no_items);
				}
			});
			
			
			return false;	
		}
		function item_auth_no_items()
		{
			var cht = '<div class="col-lg-12">';
			cht += '<div class="nft__item">';
			cht += '<div class="nft__item_wrap">';	
        	cht += '<h4>No Items Yet</h4>';
			cht += '</div></div> </div>';
			return cht;
		}
    </script>
    <script>
	$(function()
	{
		$("#btn_change").click(function()
		{
			clicknfts = false;
			window.vm.connectWallet();
		});
		<?php
		$wallet = get_wallet();
		if(!empty($wallet))
		{
		?>
			window.vm.connectWallet();
		<?php
		}
		?>
		
	});
	</script>  
     <?php
            $banner = "front/images/author_single/author_banner.jpg";
			$bannerfull = "front/images/author_single/author_banner.jpg";
			if(!empty(user_info('banner')) && is_file(config_item('upload_path').user_info('banner')) && file_exists(config_item('upload_path').user_info('banner')))
			{
				$thumb = getThumb(user_info('banner'),200,200);
				$banner =  'cache/'.$thumb;
				$bannerfull =  config_item('main_site').'uploads/'.user_info('banner');
			}
			?>
    <style type="text/css">
		 .urlsnft
		 {
			background-image:url('<?=$bannerfull?>')  !important;
			 
			 
		 }
		 .createnft select option {
		  color: black;
		}
		.createnft .dropdowns {
			display: inline-block;
			padding: 7px 12px 7px 12px;
			min-width: 140px;
			border: solid 1px rgba(0, 0, 0, .2);
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			font-weight: bold;
		}
		
		.dark-scheme .createnft .dropdowns  {
			border: solid 1px rgba(255, 255, 255, .2);
		}
		
		.createnft .dropdowns :after {
			font-family: "FontAwesome";
			font-size: 16px;
			content: "\f107";
			position: relative;
			float: right;
			margin-left: 10px;
		}
		
		.rtl .createnft .dropdowns :after {
			float: left;
		}
		
		.createnft .dropdowns ul,
		.createnft .dropdowns option {
			list-style: none;
			display: block;
			padding: 0;
			margin: 0;
		}
		
		.createnft .dropdowns ul {
			z-index: 10;
			position: absolute;
			min-width: 140px;
			display: none;
			height: 0;
			cursor: pointer;
		}
		
		.createnft .dropdowns option {
			background: #ffffff;
			display: block;
			padding: 5px 10px 5px 10px;
			border: solid 1px rgba(0, 0, 0, .2);
			border-top: none;
			width: 100%;
			font-weight: 400;
		}
		
		.dark-scheme .createnft .dropdowns option {
			background: #21273e;
			border: solid 1px rgba(255, 255, 255, .1);
		}
		
		.dark-scheme .createnft .dropdowns option:hover {
			background: #161D30;
			color: #fff;
		}
		
		.createnft .dropdowns option:hover {
			background: #eeeeee;
		}
		
		.createnft .dropdowns option.active {
			display: none;
		}
		.hide, .hidden
		{
			display: none;
		}
		a.btn-main.btn-lg.btn-primary {
			background: var(--bs-green);
		}
	</style>  		
    <?php
	}
	?>
</head>
<body class="dark-scheme de-grey">

 