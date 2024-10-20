  <div class="row">
                   
                  <!-- -->
                  <div class="col-md-6 col-xl-12">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Link Refferal</h5>
                              <?php
							  /*
                              <h6><?="https://".$_SERVER['SERVER_NAME']."?ref=R-".user_front('id')?></h6>
                              */
							  ?>
                              <p>
                              Link referral  <strong><?=site_url("plg/register")."?ref=R-".user_front('id')?></strong><br/>
                              referral ID <strong><?="ref=R-".user_front('id')?></strong>
                              </p> 
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Order</h5>
                              <h2><?=$order?></h2>
                              
                        </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-xl-6">
                    <div class="card stat-widget">
                        <div class="card-body">
                            <h5 class="card-title">Refferal</h5>
                              <h2><?=$refferal?></h2>
                              
                        </div>
                    </div>
                  </div>
  
                  <div class="col-md-6 col-lg-12">
                      <div class="card table-widget">
                          <div class="card-body">
                              <h5 class="card-title">Recent 10 order</h5>
                              <div class="table-responsive">
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th scope="col">No Order</th>
                                   
                                    <th scope="col">Tier </th>
                                   <th scope="col">Status </th>  
                                  </tr>
                                </thead>
                                <tbody>
                                   <?php
								   	for($i=0;$i<count($arr);$i++)
									{
										
								   ?>
                                   
                                   		<tr>
                                        	<td><?=$arr[$i]['pid']?></td>
                                            
                                            <td><?=$arr[$i]['tiers']?></td>
                                            <td>
											<?php
												if($arr[$i]['status']==1)
												{
														echo "<i class='fa fa-check'></i>";
												}
												else
												{
													echo "<i class='fa fa-ban'></i>";
												}
											?>
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