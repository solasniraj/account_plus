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
        
        
        <a href="#">Print</a> <a href="#">Preview</a>
        
    </div>
</div>

<div class="top text-center" style="margin-top:22px;">
 <img src="http://localhost/account_plus/image/watersplash.png" img-align="top" alt="images" style= "width:40px; height:40px;">
   <h2 style="display:inline;"> GDB Nepal government Ltd </h2>
   <span class="text-right">
   <button class="btn btn-default">Download</button>
   <button class="btn btn-default"></button>

   </span>

</div>
<div id="page-wrapper">
    <div class="graphs">
        <div class="xs tabls">
            <div data-example-id="simple-responsive-table" class="bs-example4">

             <!-- priview first table of singleJournla entry -->

             <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <center>
                                <th>General Ledger Transaction Details</th>
                                <th>Reference</th>
                                <th>Date </th>
                                <th>Person/item </th>
                            </center>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Journal Entry #14 </th>
                            <th>13</th>
                            <th><input id="datepicker" class="form-control" type="text" placeholder="Day/Month/Year" name="datepicker"></th>
                            <th>&nbsp</th>

                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- second table for singleJournalEntry  -->

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <center>
                                <th>Account code</th>
                                <th>Account name</th>
                                <th>DEmension </th>
                                <th>Debit </th>
                                <th>Credit</th>
                                <th>Memo</th>
                            </center>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>1200 </th>
                            <th>Account Receivables</th>                           
                            <th>&nbsp</th>
                            <th>500.oo</th>
                            <th>&nbsp</th>
                            <th>&nbsp</th>


                        </tr>
                        <tbody>
                            <tr>
                                <th>1060 </th>
                                <th>Checking Account</th>                           
                                <th>&nbsp</th>
                                <th>&nbsp</th>
                                <th>500</th>
                                <th>&nbsp</th>


                            </tr>
                            <tr>
                                <th colspan="2">Total </th>

                                <th>&nbsp</th>
                                <th>500</th>
                                <th>500</th>
                                <th>&nbsp</th>


                            </tr>

<td class="text-right width100">
<b>Bank Balance: </b>
</td>
<tr>
<td class="b">
<a onclick="return popup(this, 'stevie')" href="http://localhost/account_plus/bank/getBalance"></a>
</td>

</tr>


                        </tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>