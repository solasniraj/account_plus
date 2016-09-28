<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Bank Balance Details</h3>
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

                                <th>Account Name</th>
                                <th>Name of Bank</th>
                                <th>Account Number</th>
                               
                                <th>Contact Number</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total = '0';
                            foreach ($bankAccount as $blist) {
                                $bankId = $blist->id;
                                $endingBalance = $blist->ending_reconcile_balance;
                                $transTotal = $this->bank_model->get_total_bank_balance_of_related_bank($bankId);
                                if (!empty($transTotal)) {
                                    $bankTotal = $endingBalance - $transTotal;
                                } else {
                                    $bankTotal = $endingBalance;
                                }
                                ?>		
                                <tr>

                                    <td><?php echo $blist->bank_account_name; ?></td>
                                    <td><?php echo $blist->bank_name; ?></td>
                                    <td><?php echo $blist->bank_account_number; ?></td>
                                  
                                    <td><?php echo $blist->bank_phone_no; ?></td>
                                    <td><?php $total += $bankTotal;
                            echo $bankTotal; ?></td>
                                </tr>
                            <?php } ?>
                            <tr><td colspan="4"><strong>Total</strong></td>
                                <td><strong style="color: red;"><?php echo "Rs. " . $total; ?></strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- /.table-responsive -->
            </div>
        </div>
    </div>
</div>
