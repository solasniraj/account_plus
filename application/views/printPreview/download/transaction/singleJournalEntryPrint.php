<?php if(!empty($singleGLDetails)){ 
     foreach($singleGLDetails as $glDetails){
      $gLDate = $glDetails->tran_date;
      $voucherNo = $glDetails->journal_voucher_no;
      $details = $glDetails->detailed_comment;
     }
        
    ?>
<div style="margin-bottom: 15px;">
        <?php if(!empty($committeeInfo)){ foreach ($committeeInfo as $cLists){ ?>
        <div class="top text-center" style="margin-top:22px;margin-bottom:10px;">
           
           <h2><?php echo $cLists->committee_name; ?></h2>
           <h4 style="margin: 5px;"><?php echo $cLists->address; ?></h4>
           <h4 style="margin: 5px;"><?php echo $cLists->email_address ?></h4>
           <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
     </div>
        <?php }} ?>
    </div>
    
                  
                <!-- second table for singleJournalEntry  -->
                
                <div>
                    <table class="tables">
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
             foreach ($singleGLDetails as $gLList){ $type= $gLList->trans_type;
                    $donar = $this->transaction_model->get_donar_name_by_code($gLList->donor_code);
                    
                    ?>
                            <tr>
                                <td><?php echo $gLList->ledger_master_code; ?></td>
                                <td><?php echo $gLList->ledger_master_name; ?></td>                           
                                <td><?php echo $donar; ?></td>
                                <td><?php echo $gLList->memo; ?></td>                                
                                <td><?php if($type =='dr'){ $sumD += abs($gLList->amount);   echo abs($gLList->amount);}else{ NULL; } ?></td>
                                <td><?php if($type =='cr'){ $sumC += abs($gLList->amount);    echo abs($gLList->amount);}else{ NULL; } ?></td>
                            </tr>
                            <?php } ?>
                    <tr>
                    <td colspan="4">Total</td>
                    <td><?php echo 'Rs. '.$sumD; ?></td>
                    <td><?php echo 'Rs. '.$sumC; ?></td>
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
                    
                    
                   <table class="tables" width="100%" >

        <tr style="padding-top: 50px;">
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
                </div>
                 
            
<?php }else{
                    echo "Data not Found";
                } ?>

