<?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>

<main class="flex-center">
    <?php if(!empty($cLists->logo)){ ?>
  <div>
      <img src="<?php echo base_url().'contents/uploads/images/'.$cLists->logo; ?>" height="60"/>
  </div>
    <?php } ?>
  <div>
    <h4><?php echo $cLists->committee_name; ?></h4>
                        <p><?php echo $cLists->address; ?></p>
                        <h5>Phone : <?php echo $cLists->phone; ?></h5>
                         
  </div>
</main>    
                    <?php }    }   ?>
        
        
        
        <div class="text-center" style="padding: 5px 0px 5px 0px;border: 1px solid #999;margin-bottom: 15px;">
            <h3>Day Book </h3>
            <p><strong><?php echo "Date : ". $dayN. ' (' .$dayE. ') '; ?></strong></p>
                        <p><?php echo "Printed On : ". $todayN. ' (' .$todayE. ') '; ?></p>
        </div>
                       
                  
       
        <div>
            
           
                    
                    <table class="tables">
            <thead>
                <tr>
                    <th style="width: 25%;">Journal No</th>
                    <th style="width: 15%;">Ledger Code</th>
                    <th style="width: 25%;">A/C Particulars</th>
                    <th style="width: 10%;">Debit (Rs.)</th>
                    <th style="width: 10%;">Credit (Rs.)</th>
                    <th style="width: 15%;">Cheque No.</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($journalEntry)){
                    foreach($journalEntry as $lEntries){ ?>
                <tr>
                    
                <?php 
                        $singleGLDetails = $this->transaction_model->get_single_transaction_details($lEntries->journal_voucher_no);
                   if(!empty($singleGLDetails)){ ?>
  <table class="tables">
 <?php foreach ($singleGLDetails as $glDets){   
      $sum = 0;
                        ?>
          
                <tr>
                     
                    <td style="width: 25%;"><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td style="width: 15%;"><?php echo $glDets->ledger_master_code; ?></td>
                    <td style="width: 25%;"><?php echo $glDets->ledger_master_description; ?></td>
                    <td style="width: 10%;"><?php if($glDets->trans_type=='dr'){echo abs($glDets->amount);} ?></td>
                    <td style="width: 10%;"><?php if($glDets->trans_type=='cr'){echo abs($glDets->amount);} ?></td>
                    <td style="width: 15%;"><?php echo $glDets->cheque_no; ?></td>
                </tr> 
 <?php $sum += abs($glDets->amount); } ?>                
            </table>                                  
                       <?php  } ?> 
                   
                </tr> 
                    <?php } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No journal entries are found for ".$day ."</strong></td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            
