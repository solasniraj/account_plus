				<div id="page-wrapper">
					<div class="graphs">
						<h3 class="blank1">Programs</h3>
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
							<div data-example-id="simple-responsive-table" class="bs-example4">

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												
												<th>S.N.</th>
												<th>Name of Bank</th>
												<th>Account Number</th>
												<th>Address</th>
												<th>Contact Number</th>
                                                                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										
											$i=1;
										foreach($bankAccount as $blist) 
										{ ?>		
											<tr>
												
												<td><?php echo $i++;?></td>
												<td><?php echo $blist->bank_name;?></td>
												<td><?php echo $blist->bank_account_number;?></td>
												<td><?php echo $blist->bank_address;?></td>
												<td><?php echo $blist->bank_phone_no;?></td>
                                                                                                <td><a href="<?php echo base_url().'programs/edit/'.$blist->id;?>">Edit</a> / <a href="<?php echo base_url().'programs/delete/'.$blist->id;?>">Delete</a></td>
											</tr>
										<?php }  	?>
											
										</tbody>
									</table>
								</div><!-- /.table-responsive -->
							</div>
						</div>
					</div>
				</div>
			</div>
