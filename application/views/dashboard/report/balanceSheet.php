<div id="page-wrapper">
	<div class="graphs">
		<br>
		<h3 class="blank1">Bajet hisab</h3>

		<div class="xs tabls">
			<?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
                <div class="alert alert-success fade in">
                    <p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
                </div>
                <hr>
            <?php
            }
          
            if (isset($error)) {
                echo $error;
            }
            ?>

			<style>

				.table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
					padding: 10px !important;

				}


				.width120 {
					width:120px;
				}
				.table td, .table th {
    border: 1px solid black;
}


				.table {
   border-color: 1px solid black;
}
         .text-left {border-top-style: groove;}


			</style>
			<div data-example-id="simple-responsive-table" class="bs-example4">
				<h3 class="text-center"><span class="label label-default"> January 2015-4-5</h3>
				
				<div class="table-responsive">
					<table class="table">
						<tbody>
					
							<tr class="text-left">
                              <th colspan="4" style="width:280px;">bajet rakam number</th>
								<td>21111</td>
								<td>21113</td>
								<td>2212</td>
								<td>2113</td>


							</tr>

							<tr>

								<th colspan="4" style="width:280px;">bajet rakam </th>
									<th>salary</th>
									<th>mahangi bhatta</th>
									<th>sanchalan sammvar karcha</th>
									<th>office karcha</th>

							</tr>
							
					

							<tr>

								<td colspan="3" style="width:280px;">&nbsp;</td>
								<th>Nepal sarkar</th>
								<td colspan="4">&nbsp;</td>


							</tr>


							<tr>

								<th colspan="3" style="width:280px;">barsik baget </th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>

							


							</tr>


							<tr>

							<th colspan="3" style="width:280px;">yo mahinako nikasa </th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>

							


							</tr>
							<tr>

								<th>Date </th>
								<th>Ga Va No</th>
								<th colspan="2">Descrption</th>
								<td colspan="4">&nbsp;</td>
								

							


							</tr>

							<tr>

								<td >2015/05/2</td>
								<td>2</td>
								<th colspan="2">Product buy and sell</th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
							
					
								

							


							</tr>

							<tr>

								<td >2015/05/2</td>
								<td>2</td>
								<th colspan="2">malsaman karib bikri</th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
		
					
								</tr>
							<tr>

								<td >2015/05/2</td>
								<td>2</td>
								<th colspan="2">malsaman karib bikri</th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
					
				
							</tr>


							<tr>

								<th colspan="4" style="width:280px;">Total of month </th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
							

							</tr>

							<tr>

								<th colspan="4" style="width:280px;">aaglo mahinako karcha </th>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
						


							</tr>
							<tr>

								<th colspan="4" style="width:280px;">yo mahilnako karcha </th>					
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
								<td>100000</td>
						
							

							</tr>



						</tbody>
					</table>
				</div><!-- /.table-responsive -->
			</div>
		</div>
	</div>
</div>
</div>
