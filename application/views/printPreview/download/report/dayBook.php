<div style="margin-bottom: 15px;float: left;width: 100%;">
        <?php if(!empty($committeeInfo)){ foreach ($committeeInfo as $cLists){ ?>
        <main class="flex-center" style="margin-top:22px;margin-bottom:10px;width: 100%;float: left;">
           <?php if(!empty($cLists->logo)){ ?>
            <div style="width:6.5%;float:left;">
      <img src="<?php echo $_SERVER["DOCUMENT_ROOT"].'/account_plus/contents/uploads/images/'.$cLists->logo; ?>" style="float: left;width: 100%;"/>
  </div>
    <?php } ?>
           <div style="float: left;width: 80%;">
    <h3><?php echo $cLists->committee_name; ?></h3>
                        <p><?php echo $cLists->address; ?></p>
                        <h5>Phone : <?php echo $cLists->phone; ?></h5>
                         
  </div>
     </main>
        <?php }} ?>
    </div>
<div class="clear"></div>
    
        
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
                
                    
                <?php 
                        $singleGLDetails = $this->transaction_model->get_single_transaction_details($lEntries->journal_voucher_no);
                   if(!empty($singleGLDetails)){ 
 foreach ($singleGLDetails as $glDets){   
                        ?>
          
                <tr>
                     
                    <td><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td><?php echo $glDets->ledger_master_code; ?></td>
                    <td><?php echo $glDets->ledger_master_description; ?></td>
                    <td><?php if($glDets->trans_type=='dr'){echo abs($glDets->amount);} ?></td>
                    <td><?php if($glDets->trans_type=='cr'){echo abs($glDets->amount);} ?></td>
                    <td><?php echo $glDets->cheque_no; ?></td>
                </tr> 
 <?php  }   } ?> 
                    
               
                    <?php } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No journal entries are found for ".$day ."</strong></td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            
