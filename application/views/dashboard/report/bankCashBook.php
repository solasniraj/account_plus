				<div id="page-wrapper">
					<div class="graphs">
						<br>
						<h3 class="blank1">Bank Cash Book</h3>
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
								<div class="container">

									<style>

										.lastButton {
											text-align: center;
											margin:0 auto;
										}
									</style>
									<p class="text-center">programm name | Account name | choose  year and month</p>
									<br>

									<div class="row">
										<div class="col-md-8 col-md-offset-2">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="control-label col-sm-3" for="email">programm | Account Name:</label>
													<div class="col-sm-9">
														<select class="form-control" id="sel1">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
														</select>

													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-sm-3" for="pwd">year :</label>
													<div class="col-sm-9">
														<div class="form-group">
															<label class="control-label col-sm-3" for="pwd">year :</label>
															<div class="col-sm-9">
															<input  class="form-control" type="date" id="datepicker">

															</div>
														</div>
													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-sm-3" for="pwd">month :</label>
													<div class="col-sm-9">
														<select class="form-control" id="sel1">
															<option>1</option>
															<option>2</option>
															<option>3</option>
															<option>4</option>
														</select>

													</div>
												</div>
												<div class="lastButton">
													<input type="submit" class="btn btn-default" value="submit">
													<input type="submit" class="btn btn-default" value="reset">

												</div>

											</form>
										</div>
									</div>




								</div>
							</div>
						</div>
					</div>
				</div>
