				<div id="page-wrapper">
					<div class="graphs">
						<br>
						<h3 class="blank1">Budget sheet</h3>
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
										.form-control{
									       width:73%;
									     }

									     </style>


								</head>
								<body>
								<h3 class="text-center"><span class="label label-default"> Bajet Upsirak number | Choose  year and month</span></h3>

									<br>

									<div class="row">
										<div class="col-md-8 col-md-offset-2">
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="control-label col-sm-3" for="email"><h4>Bajet upsirak number </h4></label>
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
													<label class="control-label col-sm-3" for="pwd"><h4>Year </h4> </label>
													<div class="col-sm-9">
														<input  class="form-control" type="text" id="datepicker">

													</div>
												</div>

												<div class="form-group">
													<label class="control-label col-sm-3" for="pwd"><h4>Month </h4></label>
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
												<button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Submit</button>
												

												<button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Reset</button>
												</div>

												</div>

											</form>
										</div>
									</div>




								</div>
							</div>
						</div>
					</div>
				</div>
