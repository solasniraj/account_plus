<style>
  @media print{@page {size: landscape}
</style>



 <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>

<main class="flex-center">
  <div>
      <img src="<?php echo base_url().'contents/uploads/images/'.$cLists->logo; ?>" height="60"/>
  </div>
  <div>
    <h4><?php echo $cLists->committee_name; ?></h4>
                        <p><?php echo $cLists->address; ?></p>
                        <h5>Phone : <?php echo $cLists->phone; ?></h5>
                         
  </div>
</main>    
                    <?php }    }   ?>

 

<table class="tables">
    <tr>
        <td colspan="3"><h3>Account Ledger Report </h3> </td>
    </tr>
    <tr>
         <?php if(!empty($ledgerDetails)){ ?>
                    <?php foreach($ledgerDetails as $lDets){ ?>
        <td>Ledger Code : <?php echo $lDets->ledger_master_code; ?></td>
        <td>Ledger Description : <?php echo $lDets->ledger_master_name; ?></td>
        <?php } }?>
        <td><P>Balance : <strong>Rs. </strong></p></td>
    </tr>
    <tr>
        <td>From : <?php echo $fromN. ' (' .$fromE. ') '; ?></td>      
        <td>To : <?php echo $toN. ' ('. $toE .')'; ?></td>
        <td>Printed on : <?php echo $todayN. ' (' .$todayE. ') '; ?></td>
    </tr>
   
</table>

                    
                    <table class="tables">
            <thead>
                <tr>
                    
                   
                    <th style="width: 20%;">Date</th>
                    <th style="width: 15%;">Journal No.</th>
                    <th style="width: 20%;">A/C Particulars</th>
                    <th style="width: 15%;">Debit (Rs.)</th>
                    <th style="width: 15%;">Credit (Rs.)</th>
                    <th style="width: 15%;">Balance</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($ledgerRep)){
                    $sum ='0';
                    foreach($ledgerRep as $lEntries){
                       
                        ?>
                <tr>
               
  <table class="tables">
 
          
                <tr>
                     
                    <td style="width: 20%;"><?php echo $lEntries->tran_date; ?></td>
                    <td style="width: 15%;"><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td style="width: 20%;"><?php echo $lEntries->memo; ?></td>
                     <td style="width: 15%;"><?php if($lEntries->trans_type=='dr'){echo abs($lEntries->amount); $sum += abs($lEntries->amount);} ?></td>
                    <td style="width: 15%;"><?php if($lEntries->trans_type=='cr'){echo abs($lEntries->amount); $sum -= abs($lEntries->amount);} ?></td>
                    <td style="width: 15%;"><?php echo $sum; ?></td>
                </tr> 
               
            </table>                                  
                      
                </tr> 
                    <?php  } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No journal entries are found for </strong><td></tr>";} ?>
            </tbody>
 
            
        </table>

               
