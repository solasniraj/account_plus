<div style="margin-bottom: 15px;">
        <?php if(!empty($committeeInfo)){ foreach ($committeeInfo as $cLists){ ?>
        <main class="flex-center" style="margin-top:22px;margin-bottom:10px;">
           <?php if(!empty($cLists->logo)){ ?>
  <div>
      <img src="<?php echo base_url().'contents/uploads/images/'.$cLists->logo; ?>" height="60"/>
  </div>
    <?php } ?>
           <h2><?php echo $cLists->committee_name; ?></h2>
           <h4 style="margin: 5px;"><?php echo $cLists->address; ?></h4>
           <h4 style="margin: 5px;"><?php echo $cLists->email_address ?></h4>
           <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
     </main>
        <?php }} ?>
    </div>
        
        
        
        <div class="text-center" style="padding: 5px 0px 5px 0px;border: 1px solid #999;margin-bottom: 15px;">
            <h3>Day Book </h3>
            <p><strong><?php echo "Date : ". $dayN. ' (' .$dayE. ') '; ?></strong></p>
                        <p><?php echo "Printed On : ". $todayN. ' (' .$todayE. ') '; ?></p>
        </div>
                       
                  
       
        <div>
            
           
                    
                    <table class="tables">
            <thead>
                <tr>
                    <th>Journal No</th>
                    <th>Ledger Code</th>
                    <th>A/C Particulars</th>
                    <th>Debit (Rs.)</th>
                    <th>Credit (Rs.)</th>
                    <th>Cheque No.</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($journalEntry)){
                    foreach($journalEntry as $lEntries){ ?>
                <tr>
                    <td>
                <?php 
                        $singleGLDetails = $this->transaction_model->get_single_transaction_details($lEntries->journal_voucher_no);
                   if(!empty($singleGLDetails)){ ?>
  <table>
 <?php foreach ($singleGLDetails as $glDets){   
      $sum = 0;
                        ?>
          
                <tr>
                     
                    <td><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td><?php echo $glDets->ledger_master_code; ?></td>
                    <td><?php echo $glDets->ledger_master_description; ?></td>
                    <td><?php if($glDets->trans_type=='dr'){echo abs($glDets->amount);} ?></td>
                    <td><?php if($glDets->trans_type=='cr'){echo abs($glDets->amount);} ?></td>
                    <td><?php echo $glDets->cheque_no; ?></td>
                </tr> 
 <?php $sum += abs($glDets->amount); } ?>                
            </table>                                  
                       <?php  } ?> 
                    </td>
                </tr> 
                    <?php } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No journal entries are found for ".$day ."</strong></td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            
