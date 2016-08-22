			<div id="page-wrapper">
				<div class="graphs">
					<h3 class="blank1">BankMiscellenous</h3>
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
											

											<th>date(from)</th>
											<th>date(to)</th>
											<th>Bank  Account</th>
											<th> bank balance based on statement</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>
											<th>&nbsp;</th>

										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input class="form-control"  type="text"></td>
											<td><input class="form-control"  type="text"></td>

											<td>
												<select class="form-control" id="sel1">
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</td>
											<td><input class="form-control" style="width:150px;display:inline;"  type="text"><button style=" margin-left: 3px;
												margin-top: -4px;" class="btn btn-default">submit</button></td>
													<td>&nbsp; </td>
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
