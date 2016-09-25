<?php
if (!empty($singleGLDetails)) {
    foreach ($singleGLDetails as $glDetails) {
        $gLDate = $glDetails->tran_date;
        $voucherNo = $glDetails->journal_voucher_no;
        $summary = $glDetails->summary_comment;
        $details = $glDetails->detailed_comment;
    }
    ?>               
    <table width="100%">
        <tr>
            <td>
                <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>
                        <div class="top text-center" style="margin-top:22px;margin-bottom:10px;">
                            <img src="http://localhost/account_plus/contents/images/watersplash.png" img-align="top" alt="images" style= "width:20px; height:20px">
                        </div>
                    </td>
                    <td class="text-center">
                        <h2><?php echo $cLists->committee_name; ?></h2>
                        <h4><?php echo $cLists->address; ?></h4>
                        <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
                    </td>


                    <td class="text-left width25per"><b>Journal No : <?php echo $voucherNo; ?></b><br/><br/>
                    <b>Date : <?php echo $gLDate; ?></b>
                    </td>



                </tr>

            </table>                
        <?php }
    }
    ?>
    <br/><br/>
    <div class="text-right pull-right">
        <a href="<?php echo base_url() . 'preview/jounalView/' . $voucherNo; ?>"><button id="btnDownload" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url() . 'printview/printJoural/' . $voucherNo; ?>"> <button id="print" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    </div>
    <br/><br/>


    <!-- second table for singleJournalEntry  -->


    <table class="tables ">
        <thead>
            <tr>

                <th> A/C Number </th>
                <th> A/C Description</th>
                <th> Donar's Name</th>
                <th>Description</th>
                <th>Debit Amount</th>
                <th>Credit Amount</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($singleGLDetails as $gLList) {
                $type = $gLList->trans_type;
                $donar = $this->transaction_model->get_donar_name_by_code($gLList->donor_code);
               $sum = 0;
                ?>
                <tr>
                    <td><?php echo $gLList->ledger_master_code; ?></td>
                    <td><?php echo $gLList->ledger_master_name; ?></td>                           
                    <td><?php echo $donar; ?></td>
                    <td><?php echo $gLList->memo; ?></td>

                    <td><?php if ($type == 'dr') {
                        
                    echo abs($gLList->amount);
                } else {
                    echo '0';
                } ?></td>
                    <td><?php if ($type == 'cr') {
                        
            echo abs($gLList->amount);
        } else {
            echo '0';
        } ?></td>




                </tr>
    <?php $sum += abs($gLList->amount); } ?>



            <tr>
                <td colspan="4">Total</td>
                <td><Strong><?php echo 'Rs. '.$sum; ?></strong></td>
                <td><Strong><?php echo 'Rs. '.$sum; ?></strong></td>
            </tr>


            <tr>

                <td>Amount in words</td>
                <td colspan="5"><?php 
                $words = $this->numbertowords->convert_number($sum);
                echo $words.' Rupees only.';
                ?></td>
            </tr>
        </tbody>
    </table>
<br/><br/>
<div style="border: 1px solid #ddd; width: 100%;padding: 15px;">
<p><strong>Narration : </strong><?php echo $summary ?> </p>
</div>

<br/><br/>
    <table width="100%">

        <tr>
            <td>
                <pre text-center>

    Prepared By:



    .................

    Date : <?php echo $gLDate; ?>
                </pre>
            </td>
            <td>
                <pre text-center>

    Approved By:



    .................
         
    Date:_________________
                </pre>
            </td>
        </tr>
    </table>
    <?php
} else {
    echo "Data not Found";
}
