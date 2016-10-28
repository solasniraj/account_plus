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
        <td colspan="3"><h3>Donor Account Statement</h3> </td>
    </tr>
    <tr>
          <?php if(!empty($donarDetails)){ ?>

        <?php foreach($donarDetails as $dDets){ ?>
        <td>Donor Code : <?php echo $dDets->donar_code; ?></td>
        <td>Donor Name : <?php echo $dDets->donar_name; ?></td>
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
                    
                   
                    <th style="width: 10%;">A/C Code</th>
                    <th style="width: 10%;">Ledger Name</th>
                    <th style="width: 10%;">Program Name</th>
                    <th style="width: 10%;">Fund Amt.</th>
                    <th style="width: 10%;">Expenditure till last report date</th>
                    <th style="width: 10%;">Added expenditure</th>
                    <th style="width: 10%;">Total Expenditure</th>
                    <th style="width: 10%;">Remaining Budget</th>
                    <th style="width: 10%;">Other Expenditure</th>
                    <th style="width: 10%;">Remarks</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php
                $sumFunds = '0';
                $sumExpnLast = '0';
                $sumExpnMore = '0';
                if(!empty($donarLed)){
                    foreach($donarLed as $dEntries){
                      $chartId = $dEntries->account_code;
                      $sumFund = $this->report_model->get_sum_of_amount_for_donar_by_code($donorCode, $dEntries->ledger_master_code);
                     $sumExpn = $this->report_model->get_sum_of_expenditure_to_last_date($donorCode, $dEntries->ledger_master_code, $fromN, $fromE, $reportN, $reportE);
$sumFunds += abs($sumFund);
$sumExpnLast += abs($sumExpn);
  $sumExpnNow = $this->report_model->get_sum_of_expenditure_from_last_report_to_now($donorCode, $dEntries->ledger_master_code,$reportN, $reportE, $toN, $toE);
$sumExpnMore += abs($sumExpnNow);
 $totalExpn = abs($sumExpn) + abs($sumExpnNow);
                     $amtRemain = $sumFund - $totalExpn;
                    // $otherExpn = $this->report_model->get_sum_of_expenditure_of_internal_and_labour_from_last_report_to_now();
                     $program = $this->ledger_model->get_account_ledger_info_by_account_code($dEntries->ledger_code);
                      
                      
                      
                      ?>
                <tr>
                     
                    <td style="width: 10%;"><?php echo $dEntries->ledger_master_code; ?></td>
                    <td style="width: 10%;"><?php echo $dEntries->ledger_master_name; ?></td>
                    <td style="width: 10%;"><?php echo $program; ?></td>
                    <td style="width: 10%;"><?php if(!empty($sumFund)) { echo "Rs. ".$sumFund;}else{} ?></td>
                    <td style="width: 10%;"><?php if(!empty($sumExpn)) { echo "Rs. ".$sumExpn;}else{} ?></td>
                    <td style="width: 10%;"><?php if(!empty($sumExpnNow)) { echo "Rs. ".$sumExpnNow;}else{} ?></td>
                    <td style="width: 10%;"><?php echo "Rs. ".abs($totalExpn); ?></td>
                    <td style="width: 10%;"><?php echo "Rs. ".$amtRemain; ?></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    
                </tr> 
                
                    <?php } ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><?php echo "Rs.".$sumFunds; ?></td>
                    <td><?php echo "Rs.".$sumExpnLast; ?></td>
                    <td><?php echo "Rs.".$sumExpnMore; ?></td>
                    <td><?php echo "Rs. ".(abs($sumExpnLast) + abs($sumExpnMore)); ?></td>
                    <td><?php echo "Rs. ".(abs($sumFunds) - abs($sumExpnMore) - abs($sumExpnLast)); ?></td>
                </tr>
                <?php } else{ echo "<tr><td colspan='6'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>