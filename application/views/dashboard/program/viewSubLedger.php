				<div id="page-wrapper">
					<div class="graphs">
						<h3 class="blank1">SublegderList</h3>
						<div class="xs tabls">
							<div class="invalid">
							 <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {               
                 echo $flashMessage;
            }          
            if (isset($error)) {
                echo $error;
            }
            ?>
						</div>
							<div data-example-id="simple-responsive-table" class="bs-example4">

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												
												<th>S.N</th>
												<th>subledger name</th>
												<th>subledger code</th>
												<th>subledger status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<?php if(count($subLegderDetails))
											{
												$i=1;
												foreach($subLegderDetails as $list) 
													{ ?>		
												<tr>

													<td><?php echo $i++;?></td>
													<td><?php echo $list->subledger_name;?></td>
													<td><?php echo $list->subledger_code;?></td>
													<td><?php echo $list->subledger_status;?></td>
													<td>
													<button type="button" class="btn btn-success"> edit</button>
													<button type="button" class="btn btn-danger">delete</button>	

													</td>


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
