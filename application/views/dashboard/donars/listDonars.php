<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Programs</h3>
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

                                <th>S.N.</th>
                                <th>Donar Code</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Contact Number</th>
                                <th>Email Id</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 1;
                            foreach ($donars as $donarList) {
                                ?>		
                                <tr>

                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $donarList->donar_code; ?></td>
                                    <td><?php echo $donarList->donar_name; ?></td>
                                    <td><?php echo $donarList->donar_address; ?></td>
                                    <td><?php echo $donarList->donar_contact_no; ?></td>
                                    <td><?php echo $donarList->donar_email; ?></td>
                                    <td><a href="<?php echo base_url() . 'donars/edit/' . $donarList->id; ?>">Edit</a> / <a href="<?php echo base_url() . 'donars/delete/' . $donarList->id; ?>">Delete</a></td>
                                </tr>
                            <?php } ?>

                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
</div>
