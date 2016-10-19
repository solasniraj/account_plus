<style>
  @media print{@page {size: landscape}
</style>
<?php
if (!empty($singleGLDetails)) {
    foreach ($singleGLDetails as $glDetails) {
        $gLDate = $glDetails->tran_date;
        $voucherNo = $glDetails->journal_voucher_no;
        $details = $glDetails->detailed_comment;
                    $value = str_replace('/', '&#47;', $voucherNo);
$NewNo = urlencode($value);
    }
    ?>               
    <table width="100%">
        <tr>
            <td>
                <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>
                        <div class="top text-center" style="margin-top:2px;margin-bottom:5px;">
                            <img src="<?php echo base_url().'contents/uploads/images/'.$cLists->logo; ?>" img-align="top" alt="images" style= "width:100px;">
                        </div>
                <?php }
    }
    ?>
                    </td>
                    <td class="text-center">
                        <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>
                        <h2><?php echo $cLists->committee_name; ?></h2>
                        <h4><?php echo $cLists->address; ?></h4>
                        <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
                    <?php }
    }
    ?>
                    </td>


                    <td class="text-left width25per"><b>Journal No : <?php echo $voucherNo; ?></b><br/><br/>
                    <b>Date : <?php echo $gLDate; ?></b>
                    </td>



                </tr>

            </table>                
        
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
            $sumD = 0;
             $sumC = 0;
            foreach ($singleGLDetails as $gLList) {
                $type = $gLList->trans_type;
                $donar = $this->transaction_model->get_donar_name_by_code($gLList->donor_code);
               
                ?>
                <tr>
                    <td><?php echo $gLList->ledger_master_code; ?></td>
                    <td><?php echo $gLList->ledger_master_name; ?></td>                           
                    <td><?php echo $donar; ?></td>
                    <td><?php echo $gLList->memo; ?></td>

                    <td><?php if ($type == 'dr') {
                         $sumD += abs($gLList->amount);  
                    echo abs($gLList->amount);
                } else {
                    echo '0';
                } ?></td>
                    <td><?php if ($type == 'cr') {
                 $sumC += abs($gLList->amount);        
            echo abs($gLList->amount);
        } else {
            echo '0';
        } ?></td>




                </tr>
    <?php } ?>



            <tr>
                <td colspan="4">Total</td>
                <td><Strong><?php echo 'Rs. '.$sumD; ?></strong></td>
                <td><Strong><?php echo 'Rs. '.$sumC; ?></strong></td>
            </tr>


            <tr>

                <td>Amount in words</td>
                <td colspan="5"><?php 
                $words = $this->numbertowords->convert_number($sumD);
                echo $words.' Rupees only.';
                ?></td>
            </tr>
        </tbody>
    </table>
<br/><br/>
<div style="border: 1px solid #ddd; width: 100%;padding: 15px;">
<p><strong>Narration : </strong><?php echo $details ?> </p>
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
