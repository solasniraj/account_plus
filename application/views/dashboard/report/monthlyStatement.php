			<div id="page-wrapper">
				<div class="graphs">
					<h3 class="blank1">bank hisab milan faram</h3>
					<div class="xs tabls">
						<?php  $flashMessage=$this->session->flashdata('flashMessage'); 
						if(!empty($flashMessage))
							{  ?>
						<div class="alert alert-success fade in">
							<p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
						</div>
						<hr>
						<?php }
						?>
						<style>
							.table td, .table th{
								border: 1px solid black;
							}

							.table{
								border-color: 1px solid black;
							}
							.text-left {border-top-style: groove;}
																

						</style>
						<div data-example-id="simple-responsive-table" class="bs-example4">

							<div class="table-responsive">
								<table class="table">
								 <tbody>
									
										<tr class="text-left">
											

											<th colspan="5">Bank bibran anusar moojdad</th>
											<td>1000</td>
											<th>&nbsp;</th>
											
											</tr>
											
                                    
								
									

										<tr>
											

											<td>Bibaran</td>	
											<td>Vouchur number</td>
											<td>Cheque number</td>
											<td>Date</td>
											<td>Bausa no</td>
											<td>Rakam </td>
											<td> &nbsp;</td>
											

										</tr>


										<tr>
											

											<th>
												<select class="form-control" id="sel1">
													<option>Bank ma jamm huna napayeko rakam</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</th>	
											<td><input class="form-control"  type="text"></td>

											<td><input class="form-control"  type="text"></td>
											<td><input class="form-control"  type="text"></td>

											<th>
												<select class="form-control" id="sel1">
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</th>	
											<td><input class="form-control"  type="text"></td>
											<td rowspan="4">
												<button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Save</button></td>
											

										</tr>

										<tr>
											

											<th class="text-left" colspan="6">(+) Bank man jamma  huna napayeko num (A)</th>
											
											
											

										</tr>


										<tr>
											

											<th style="text-right">Jamm (A)</th>	
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>1000</td>
											<td>&nbsp;</td>
											

										</tr>


										<tr>
											

											<th class="text-left" colspan="6">(-)Bank bata bhuktani huna baki check (B)</th>
											
										</tr>

										<tr>
											

											<td style="text-right"></td>	
											<td>1000</td>
											<td>1000</td>
											<td>1000</td>
											<td>1000</td>
											<td>1000</td>
											<td rowspan="3"><div class="lastButton">
												<button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Delete</button></td>
											

										</tr>

										<tr>
											

											<th style="text-right">Jamm (A)</th>	
											<td>&nbspn;</td>
											<td>&nbspn;</td>
											<td>&nbspn;</td>
											<td>1000</td>
											<td>&nbsp;</td>
											

										</tr>

										<tr>
											

											<th style="text-right">Yetata bank moujdad</td>	
											<td>&nbspn;</td>
											<td>&nbspn;</td>
											<td>&nbspn;</td>
											<td>1000</td>
											<td>&nbsp;</td>
											

										</tr>


										<tr>
											

											<th class="text-left" colspan="5">sesta anusar bank moojdad</th>
											<td>10000</td>
											<td>&nbsp;</td>
											

										</tr>

										<tr>
											

											<th class="text-left" colspan="5">farak rakam</th>
											<td>10000</td>
											<td>&nbsp;</td>
											

										</tr>
										
                                      
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
