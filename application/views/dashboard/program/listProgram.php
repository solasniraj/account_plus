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
												<th>code</th>
												<th>program Name</th>
												<th>program Budget</th>
												<th>category</th>
											
											</tr>
										</thead>
										<tbody>
										<?php if(count($program_list))
										{
											$i=1;
										foreach($program_list as $list) 
										{ ?>		
											<tr>
												
												<td><?php echo $i++;?></td>
												<td><?php echo $list->code;?></td>
												<td><?php echo $list->programName;?></td>
												<td><?php echo $list->programBudget;?></td>
												<td><?php echo $list->category;?></td>
								
											</tr>
										<?php } } 	?>
											
										</tbody>
									</table>
								</div><!-- /.table-responsive -->
							</div>
						</div>
					</div>
				</div>
			</div>
