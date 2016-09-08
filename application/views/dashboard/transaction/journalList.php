<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Journal Entries</h3>
        <div class="xs tabls">
            <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
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

                               
                                <th>Entry No.</th>
                                <th>Summary</th>
                                <th>Amount</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($transactionDetails as $tGLList) {
                                    ?>		
                                    <tr>

                                        <td><?php echo $tGLList->gl_no; ?></td>
                                        <td><?php echo $tGLList->summary_comment; ?></td>
                                        <td><?php echo $tGLList->amount; ?></td>

                                        <td><a href="<?php echo base_url() . 'transaction/preview/' . $tGLList->gl_no; ?>">Preview</a></td>
                                    </tr>
    <?php }
 ?>

                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
</div>
