			<div id="page-wrapper">
				<div class="graphs">
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

						<!-- CSSS AND JS FOR JQUERY DATEPICKER IMPLEMENTATION  -->

						<link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
						<link rel="stylesheet" href="/resources/demos/style.css">
						<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
						<script>
							$( function() {
								$( ".datepicker" ).datepicker();
							} );
						</script>




						<!-- END OF LOADED CSSS AND JAVASCITP -->
						<br>
						<br>
						 	<h3 class="blank1 text-center"> Bank Hisab Milaan Prabistibist</h3>

						<div data-example-id="simple-responsive-table" class="bs-example4">

							<div class="table-responsive">
								<table class="table table-bordered table-condensed table-striped">
									<thead>
										<tr>
											

											<th>Date&nbsp;(From)</th>
											<th>Date&nbsp;(To)</th>
											<th>Bank  Account</th>
											<th> Bank Balance based on Statement</th>


										</tr>
									</thead>
									<tbody>
										<tr>
											<td><input class="form-control datepicker" type="text"></td>
											<td><input class="form-control datepicker" type="text"></td>

											<td>
												<select class="form-control" id="sel1">
													<option>1</option>
													<option>2</option>
													<option>3</option>
													<option>4</option>
												</select>
											</td>
											<td><input class="form-control" style="width:150px;display:inline;"  type="text"><button style=" margin-left: 3px;
												margin-top: -4px;" class="btn-success btn" >Submit</button></td>


											




											</tr>


										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
