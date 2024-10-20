  <div class="row">
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Users</h5>
                              <h2><?=$users?></h2>
                              
                        </div>
                    </div>
                  </div>
                  <!-- -->
                   <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Order NFT <sup class="text-info">(in Total)</sup></h5>
                              <h2><?=$order?></h2>
                              
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Benefit System<sup class="text-info">(in Token)</sup></h5>
                              <h2><?=number_format($fee_price['total'])?> <?=$setting['token_transaksi']?> <sub class="text-warning">$<?=number_format(($fee_price['total']/$setting['price_token']),2)?></sub></h2>
                               
                        </div>
                    </div>
                  </div>
                   <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Order NFT<sup class="text-primary">(in USDT)</sup></h5>
                              <h2>$<?=number_format($pricesx['total'])?></h2>
                              
                        </div>
                    </div>
                  </div>
                  
  </div> 
  			<div class="row">
                  <div class="col-md-12 col-lg-12">
                      <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Recent 10 order</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">NFT ID</th>
                                    <th scope="col">Customer </th>
                                    <th scope="col">NFT Name </th>
                                    <th scope="col">Price </th>
                                    <th scope="col">Info </th> 
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
								   	for($i=0;$i<count($arr);$i++)
									{
										
								   ?>
                                   
                                   		<tr>
                                        	<td><?=$arr[$i]['tokenid']?></td>
                                            <td><?=$arr[$i]['customer']?></td>
                                            <td><?=$arr[$i]['nftname']?></td>
                                            <td>$<?=number_format($arr[$i]['price'],4)?></td>
                                             
                                            <td>
                                            	<a href="<?=$arr[$i]['network_url']?>tx/<?=$arr[$i]['nft_hash']?>" target="_blank">
											 		Detail
                                            	</a>
                                            </td>
                                        </tr>
                                   <?php
									}
								   ?>
                                </tbody>
                              </table>
                            </div>
                          </div>
                      </div>
                  </div>               