				<div id="page-wrapper">
					<div class="graphs">
						<h3 class="blank1 text-center">Journal Entry form</h3>
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

								.width100 {
									width:120px;
								}

								.table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
									padding: 5px !important;
								}

								.table th {

									width:150px;
								}
								#page-wrapper {
									background-color: #fff;
								}
								table td {
									text-align: center;
								}
								.lastButton {
									text-align: center;
									margin:0 auto;
								}
							</style>
							<div class="container-fluid " >
								<div class="row">
									<div class="col-md-4 ">
										<table class="table">
											<tr>
												<td  class="text-right width100">journal no:</td>
												<td><input class="form-control" type="text"></td>

											</tr>
											<tr>

												<td class="text-right width100">Date:</td>
												<td><input class="form-control" type="text"></td>

												
											</tr>
										</table>
									</div>

									<div class="col-md-4">
										<table class="table">
											<tr>
												<td class="text-right width100">Source :</td>
												<td><input  class="form-control" type="text"></td>

											</tr>
											<tr>

												<td class="text-right width100">Method If Foreign:</td>
												<td><input class="form-control" type="text"></td>

												
											</tr>
										</table>
									</div>

									<div class="col-md-4 ">
										<table class="table">
											<tr>
												<td class="text-right width100">Journal Type:</td>
												<td><input  class="form-control" type="text"></td>

											</tr>
											<tr>

												<td class="text-right width100">Type If Foreign:</td>
												<td><input class="form-control"  type="text"></td>

												
											</tr>
										</table>
									</div>

								</div>

								<div class="table-responsive">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>debit | credit</th>
												<th>Account type</th>
												<th>descrption</th>
												<th>subLedger</th>
												<th>helper Accout</th>
												<th>peski person</th>
												<th>programm</th>
												<th>amount</th>
												<th>receive person</th>
												<th>check number</th>
												<th> </th>

											</tr>
										</thead>
										<tbody>
											<tr>
												<td>
													<select class="form-control" id="sel1">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
													</select>
												</td>

												<td>
													<select class="form-control" id="sel1">
														<option>1</option>
														<option>2</option>
														<option>3</option>
														<option>4</option>
													</select>

													<td>
														<select class="form-control" id="sel1">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
														</select>

														<td>
															<select class="form-control" id="sel1">
																<option>1</option>
																<option>2</option>
																<option>3</option>
																<option>4</option>
															</select>

															<td>
																<select class="form-control" id="sel1">
																	<option>1</option>
																	<option>2</option>
																	<option>3</option>
																	<option>4</option>
																</select>

																<td>
																	<select class="form-control" id="sel1">
																		<option>1</option>
																		<option>2</option>
																		<option>3</option>
																		<option>4</option>
																	</select>

																	<td>
																		<select class="form-control" id="sel1">
																			<option>1</option>
																			<option>2</option>
																			<option>3</option>
																			<option>4</option>
																		</select>

																		<td><input class="form-control"  type="text"></td>
																		<td><input class="form-control"  type="text"></td>
																		<td><input class="form-control"  type="text"></td>
																		<td><button type="text" class="btn btn-default">Add</button></td>

																	</tr>

																</tbody>
															</table>
														</div> 

													</div>
													<div class="container " style="max-width:1000px;">

														<div class="table-responsive">
															<table class="table table-bordered">
																<thead>
																	<tr>
																		<th>debit | credit</th>
																		<th>Account type</th>
																		<th>descrption</th>
																		<th>subLedger</th>
																		<th>helper Accout</th>

																		<th>programm</th>
																		<th>debit</th>
																		<th>credit</th>
																		<th>payee</th>
																		<th>amount</th>

																		<th>check number</th>
																		<th> </th>
																		<th> </th>

																	</tr>
																</thead>
																<tbody>
																	<tr>
																		<td>1</td>
																		<td>Anna</td>
																		<td>Pitt</td>
																		<td>35</td>
																		<td>New York</td>
																		<td>USA</td>
																		<td>1</td>
																		<td>Anna</td>
																		<td>Pitt</td>
																		<td>35</td>
																		<td>35</td>

																		<td><button type="text" class="btn btn-default">Add</button></td>
																		<td><button type="text" class="btn btn-default">Edit</button></td>
																	</tr>
																	<tr>
																		<td>1</td>
																		<td>Anna</td>
																		<td>Pitt</td>
																		<td>35</td>
																		<td>New York</td>
																		<td>USA</td>
																		<td>1</td>
																		<td>Anna</td>
																		<td>Pitt</td>
																		<td>35</td>
																		<td>35</td>

																		<td><button type="text" class="btn btn-default">Add</button></td>
																		<td><button type="text" class="btn btn-default">Edit</button></td>
																	</tr>

																	<tr>
																		<td colspan="7">total</td>
																		<td>35</td>
																		<td>New York</td>
																		<td colspan="2"></td>
																		
																	</tr>

																	<tr>
																		<td colspan="7">debit and credit diffence</td>
																		<td>35</td>
																		<td>New York</td>
																		<td colspan="2"></td>
																		
																	</tr>
																</tbody>
															</table>
														</div> 

														<div class="row">

															<div class="col-md-4 col-md-offset-1" >
																<div class="form-group">
																	<label for="comment">Comment:</label>
																	<textarea class="form-control" rows="5" id="comment"></textarea>
																</div>
															</div>

															<div class="col-md-4 col-md-offset-1" >
																<div class="form-group">
																	<label for="comment">Comment:</label>
																	<textarea class="form-control" rows="5" id="comment"></textarea>
																</div>
															</div>



														</div>

														<div class="row">
															<div class="col-md-6">
																<div class="form-group">
																	<label class="control-label col-sm-5" for="pwd">total check blance</label>
																	<div class="col-sm-7">
																		<input style="width:60%;" type="password" class="form-control" id="pwd">
																	</div>
																</div>

															</div>

															<div class="clearfix">
															</div>
															<div class="lastButton">
															<input type="button" class="btn btn-default" value="submit">
																<input type="submit" class="btn btn-default" value="reset">

															</div>
															<br>
															<br>
															<br>

														</div>
													</div>
												</div>
