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
                            <th>Bhoucher No </th>
                            <th>Discription</th>
                            <th>date</th>
                            <th>Amount(Rs)</th>
                            <th>Action</th>
                            
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        <?php
                        foreach ($transactionDetails as $tGLList) {   ?>  
                            <td><?php echo $tGLList->gl_no; ?> </td>
                            <td><?php echo $tGLList->memo; ?> </td>
                            <td><?php echo $tGLList->tran_date; ?> </td>
                            <td><?php echo $tGLList->amount; ?> </td>
                            <td><a href="<?php echo base_url() . 'transaction/preview/1' ?>">Preview</a></td>
                        </tr>
                        <?php } ?>
                         

                            
                        </tbody>
                        </table>

                </div>
            </div>
        </div>
   </div>
</div>
