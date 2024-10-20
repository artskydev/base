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
    <script src="<?=$templates?>js/jquery.countTo.js"></script>
    <script src="<?=$templates?>js/jquery.countdown.js"></script>
    <script src="<?=$templates?>js/jquery.lazy.min.js"></script>
    <script src="<?=$templates?>js/jquery.lazy.plugins.min.js"></script>
    <!-- edited -->
     <script>
		var smart_token_hash = '<?=$this->security->get_csrf_hash();?>';
		var smart_token_name = '<?=$this->security->get_csrf_token_name()?>';
	 	 
   		 </script>  
    <script src="<?=$templates?>vue.js"></script>
    <script src="<?=$templates?>ipfs-http-client-lite.js"></script>
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
    
    <?php
    if(user_info('id'))
	{
	?>
    <script>
        window.CONTRACT_ABI = '[{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"account","type":"address"},{"indexed":true,"internalType":"address","name":"operator","type":"address"},{"indexed":false,"internalType":"bool","name":"approved","type":"bool"}],"name":"ApprovalForAll","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"operator","type":"address"},{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256[]","name":"ids","type":"uint256[]"},{"indexed":false,"internalType":"uint256[]","name":"values","type":"uint256[]"}],"name":"TransferBatch","type":"event"},{"anonymous":false,"inputs":[{"indexed":true,"internalType":"address","name":"operator","type":"address"},{"indexed":true,"internalType":"address","name":"from","type":"address"},{"indexed":true,"internalType":"address","name":"to","type":"address"},{"indexed":false,"internalType":"uint256","name":"id","type":"uint256"},{"indexed":false,"internalType":"uint256","name":"value","type":"uint256"}],"name":"TransferSingle","type":"event"},{"anonymous":false,"inputs":[{"indexed":false,"internalType":"string","name":"value","type":"string"},{"indexed":true,"internalType":"uint256","name":"id","type":"uint256"}],"name":"URI","type":"event"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"uint256","name":"id","type":"uint256"}],"name":"balanceOf","outputs":[{"internalType":"uint256","name":"","type":"uint256"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address[]","name":"accounts","type":"address[]"},{"internalType":"uint256[]","name":"ids","type":"uint256[]"}],"name":"balanceOfBatch","outputs":[{"internalType":"uint256[]","name":"","type":"uint256[]"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"address","name":"account","type":"address"},{"internalType":"address","name":"operator","type":"address"}],"name":"isApprovedForAll","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"amount","type":"uint256"},{"internalType":"string","name":"metadataHash","type":"string"}],"name":"mint","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256[]","name":"ids","type":"uint256[]"},{"internalType":"uint256[]","name":"amounts","type":"uint256[]"},{"internalType":"bytes","name":"data","type":"bytes"}],"name":"safeBatchTransferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"from","type":"address"},{"internalType":"address","name":"to","type":"address"},{"internalType":"uint256","name":"id","type":"uint256"},{"internalType":"uint256","name":"amount","type":"uint256"},{"internalType":"bytes","name":"data","type":"bytes"}],"name":"safeTransferFrom","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"address","name":"operator","type":"address"},{"internalType":"bool","name":"approved","type":"bool"}],"name":"setApprovalForAll","outputs":[],"stateMutability":"nonpayable","type":"function"},{"inputs":[{"internalType":"bytes4","name":"interfaceId","type":"bytes4"}],"name":"supportsInterface","outputs":[{"internalType":"bool","name":"","type":"bool"}],"stateMutability":"view","type":"function"},{"inputs":[{"internalType":"uint256","name":"id","type":"uint256"}],"name":"uri","outputs":[{"internalType":"string","name":"","type":"string"}],"stateMutability":"view","type":"function"}]';
        window.TOPIC_TRANSFER = '0x297313fcba79a7eb3ef9a5f80673a05176a5199c';
		//'0x8e7660d19b74abe3981a81b091354ccff4524ea4';//'0xB93A7E1BA50FB92ddC9a79b1124998C953C2cD6f';
        // ganti contract address:
        window.CHAINS = {
           // '1': ['Ethereum', 'https://etherscan.io', '0x0000000000000000000000000000000000000000'],
            //'4': ['Rinkeby Testnet', 'https://rinkeby.etherscan.io', '0x0000000000000000000000000000000000000000']
			'97': ['Testnet', 'https://data-seed-prebsc-1-s1.binance.org:8545', '0x297313fcba79a7eb3ef9a5f80673a05176a5199c']
        };
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
                            window.open(cs[1] + '/address/' + (addr || this.account));
                        } else {
                            console.error('Invalid chain id: ', this.chainId);
                        }
                    },
                    getScanUrlForToken: function (tokenId) {
                        let cs = window.CHAINS[this.chainId];
                        if (cs) {
                            return cs[1] + '/token/' + cs[2] + '?a=' + tokenId;
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
                        if (!this.ready) {
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
                        this.amount = parseInt(this.amount);
                        if (isNaN(this.amount) || !Number.isInteger(this.amount) || this.amount < 1 || this.amount > 100000) {
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
                            console.log('https://ipfs.infura.io/ipfs/' + hash + '?filename=metadata.json');

                            loading.setMessage('Prepare NFT mint transaction...');
                            if (!this.ready || this.wrongNetwork) {
                                throw 'Wallet not ready!';
                            }
                            let contract = new ethers.Contract(this.getContractAddress(), window.CONTRACT_ABI, window.getWeb3Provider().getSigner());
                            loading.setMessage('Please confirm transaction in wallet...');
                            let tx = await contract.mint(this.amount, hash);
                            loading.setMessage('Please wait for block confirms...');
                            await tx.wait(1);
                            loading.setMessage('Parse transaction receipt...');
                            let txReceipt = await window.getWeb3Provider().getTransactionReceipt(tx.hash);
                            console.log(txReceipt);
                            let tokenId = null, amount = 0;
                            for (let i = 0; i < txReceipt.logs.length; i++) {
                                let log = txReceipt.logs[i];
                                console.log('log:');
                                console.log(log);
                                if (log.topics[0] === window.TOPIC_TRANSFER) {
                                    tokenId = parseInt(log.data.substring(2, 64 + 2));
                                    amount = parseInt(log.data.substring(64 + 2, 128 + 2));
                                    console.log('Found log: token id = ' + tokenId + ', amount = ' + amount);
                                    break;
                                }
                            }
                            if (tokenId === null) {
                                throw 'Token ID not found in transaction receipt.';
                            }
                            let url = this.getScanUrlForToken(tokenId);
                            loading.close();
                            showInfo('Success', '<p>NFT have been minted successfully!</p><p>Visit <a href="' + url + '" target="_blank">transaction</a> for details.</p>');
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
								connectwalleted(accounts[0]);
							}
							$(".btn-wallet").text(accounts[0]);
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
							connectwalleted(this.account);
							
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
                    }
                }
            });
        }

        $(function () {
            init();
        });
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
		function connectwalleted(wallets)
		{
			 
			var req = post('<?=site_url('wallet/save')?>',{wallet_address:wallets});
			console.log(req);
			req.always(function()
			{
				setTimeout(function()
				{
					
					$(".btn-wallet").text( wallets);
					//$("#smart-loader").modal("show");	
					if(!clicknfts)
					document.location.href = window.location;
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
			window.vm.mint();
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
	});
	</script>  
     <?php
            $banner = "front/images/author_single/author_banner.jpg";
			$bannerfull = "front/images/author_single/author_banner.jpg";
			if(!empty($data['banner']) && is_file(config_item('upload_path').$data['banner']) && file_exists(config_item('upload_path').$data['banner']))
			{
				$thumb = getThumb($data['banner'],200,200);
				$banner =  'cache/'.$thumb;
				$bannerfull =  config_item('main_site').'uploads/'.$data['banner'];
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
	</style>  		
    <?php
	}
	?>
</head>
<body class="dark-scheme de-grey">

 