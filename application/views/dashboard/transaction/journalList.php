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
                            <th>Date</th>
                            <th>Amount(Rs)</th>
                            <th>Status</th>
                            <th>Action</th>
                            
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                        <?php
                        foreach ($transactionDetails as $tGLList) { 
                            $sum = $this->transaction_model->get_debit_credit_amount($tGLList->journal_voucher_no); ?>  
                            <td><?php echo $tGLList->journal_voucher_no; ?> </td>
                            <td><?php echo $tGLList->summary_comment; ?> </td>
                            <td><?php echo $tGLList->tran_date; ?> </td>
                            <td><?php echo $sum['0']->sum/'2'; ?> </td>
                            <td><?php $stat = $tGLList->gl_trans_status; if($stat=='1'){echo "Published";}elseif($stat=='2'){ echo "Draft";}elseif($stat=='3'){"Voided";}else{ echo "Unknown"; } ?></td>
                            <td><a href="<?php echo base_url() . 'transaction/journalPreview/'.$tGLList->journal_voucher_no; ?>">Preview</a></td>
                        </tr>
                        <?php } ?>
                         

                            
                        </tbody>
                        </table>

                </div>
            </div>
        </div>
   </div>
</div>
