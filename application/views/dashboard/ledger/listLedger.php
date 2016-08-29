				<div id="page-wrapper">
					<div class="graphs">
						<h3 class="blank1">Ledger Details</h3>
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
												<th>Name</th>
												<th>Code</th>
                                                                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										
											$i=1;
										foreach($ledgerDetails as $llist) 
										{ ?>		
											<tr>
												
												<td><?php echo $i++;?></td>
												<td><?php echo $llist->ledger_name;?></td>
												<td><?php echo $llist->ledger_code;?></td>
                                                                                                <td><a href="<?php echo base_url().'ledger/editLedger/'.$llist->id;?>">Edit</a> / <a href="<?php echo base_url().'ledger/deleteLedger/'.$llist->id;?>">Delete</a></td>
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
