<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Account Headings</h3>
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
                                <th>Code</th>
                                <th>Account Heading</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (count($program_list)) {
                                $i = 1;
                                foreach ($program_list as $list) {
                                    ?>		
                                    <tr>

                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $list->program_code; ?></td>
                                        <td><?php echo $list->program_name; ?></td>

                                        <td><a href="<?php echo base_url() . 'programs/edit/' . $list->id; ?>">Edit</a> / <a href="<?php echo base_url() . 'programs/delete/' . $list->id; ?>">Delete</a> / <a href="<?php echo base_url() . 'programs/createSubLedger/' . $list->id; ?>">Create Sub Ledger</a> / <a href="<?php echo base_url() . 'programs/viewSubLedger/' . $list->id; ?>">View Ledger Details</a> / <a href="<?php echo base_url() . 'donars/assignDonars/' . $list->id; ?>">Assign Donars</a> / <a href="<?php echo base_url() . 'legder/addLedgerProgram/' . $list->id; ?>">Add Ledger</a></td>
                                    </tr>
    <?php }
} ?>

                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
</div>

