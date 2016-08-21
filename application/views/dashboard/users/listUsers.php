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
												
												<th>S.N</th>
												<th>User Name</th>
												<th>Status</th>
												<th>Role</th>
												
                                                                                                <th>Action</th>
											</tr>
										</thead>
										<tbody>
										<?php 
										
											$i=1;
										foreach($users as $userData) 
										{ ?>		
											<tr>
												
												<td><?php echo $i++;?></td>
												<td><?php echo $userData->user_name;?></td>
												<td><?php echo $userData->status;?></td>
												<td><?php echo $userData->user_type;?></td>
												
                                                                                                <td><a href="<?php echo base_url().'user/edit/'.$userData->id;?>">Edit</a> / <a href="<?php echo base_url().'user/delete/'.$userData->id;?>">Delete</a></td>
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
