<style>
    table{border-collapse: unset;}
</style>
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
                <tr>                  
                    <th>A/C Code</th>
                    <th>Ledger Name</th>
                    <th>Program Name</th>
                    <th>Fund Amt.</th>
                    <th>Expenditure till last report date</th>
                    <th>Added expenditure</th>
                    <th>Total Expenditure</th>
                    <th>Remaining Budget</th>
                    <th>Other Expenditure</th>
                    <th>Remarks</th>                           
                </tr>                      
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
                    
                     $program = $this->ledger_model->get_account_ledger_info_by_account_code($dEntries->ledger_code);
                                                                
                      ?>
                <tr style="page-break-after: always;">                     
                    <td><?php echo $dEntries->ledger_master_code; ?></td>
                    <td><?php echo $dEntries->ledger_master_name; ?></td>
                    <td><?php echo $program; ?></td>
                    <td><?php if(!empty($sumFund)) { echo "Rs. ".$sumFund;}else{} ?></td>
                    <td><?php if(!empty($sumExpn)) { echo "Rs. ".$sumExpn;}else{} ?></td>
                    <td><?php if(!empty($sumExpnNow)) { echo "Rs. ".$sumExpnNow;}else{} ?></td>
                    <td><?php echo "Rs. ".abs($totalExpn); ?></td>
                    <td><?php echo "Rs. ".$amtRemain; ?></td>
                    <td></td>
                    <td></td>                    
                </tr> 
                
                    <?php } ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><?php echo "Rs.".$sumFunds; ?></td>
                    <td><?php echo "Rs.".$sumExpnLast; ?></td>
                    <td><?php echo "Rs.".$sumExpnMore; ?></td>
                    <td><?php echo "Rs. ".(abs($sumExpnLast) + abs($sumExpnMore)); ?></td>
                    <td><?php echo "Rs. ".(abs($sumFunds) - abs($sumExpnMore) - abs($sumExpnLast)); ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php } else{ echo "<tr><td colspan='10'><strong>No entries are found</td></tr>";} ?>
            
 
            
        </table>