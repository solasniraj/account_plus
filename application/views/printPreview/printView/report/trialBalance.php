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
        <td colspan="3"><h3>Trial Balance</h3> </td>
    </tr>
    <tr>
        <td>From : <?php echo $fromN. ' (' .$fromE. ') '; ?></td>  
        <td><P>Balance : <strong>Rs. </strong></p></td>
    </tr>
    <tr>
        <td>To : <?php echo $toN. ' ('. $toE .')'; ?></td>
        <td>Printed on : <?php echo $todayN. ' (' .$todayE. ') '; ?></td>
    </tr>
   
</table>
        
                    
      
<div>
                    
                    <table class="tables">
            <thead>
                <tr>
                    
                   
                    <th>Account Code</th>
                    <th>Account Name / Particulars</th>
                    <th>Debit (Rs.)</th>
                    <th>Credit (Rs.)</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($allLedger)){
                    $sumDr = '0';
                    $sumCr = '0';
                    foreach($allLedger as $ledgers){
                      $code = $ledgers->ledger_master_code;
                      $drAmount = $this->report_model->get_sum_of_amounts_for_dr_of_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN);
                      $crAmount =  $this->report_model->get_sum_of_amounts_for_cr_of_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN);
                     $sumDr += abs($drAmount);
                     $sumCr += abs($crAmount)
                      ?>
                <tr>
                    <td><?php echo $ledgers->ledger_master_code; ?></td>
                    <td><?php echo $ledgers->ledger_master_name; ?></td>
                    <td><?php echo abs($drAmount);  ?></td>                  
                    <td><?php echo abs($crAmount); ?></td>
                    
                </tr> 
                
                    <?php } ?>
                <tr>
                    <td colspan="2"><strong>Total</strong></td>
                   <td><strong><?php echo abs($sumDr);  ?></strong></td>
                   <td><strong><?php echo abs($sumCr);  ?></strong></td>
                </tr>
                <?php } else{ echo "<tr><td colspan='6'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>

</div>
