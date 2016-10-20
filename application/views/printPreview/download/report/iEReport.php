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
        <td colspan="2"><h3>Income Expenditure Account Statement Report</h3> </td>
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
      
            
                    
                    <table class="tables">
            <thead>
                <tr>   
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
                    <td><?php echo $ledgers->ledger_master_name; ?></td>
                    <td><?php echo abs($drAmount);  ?></td>                  
                    <td><?php echo abs($crAmount); ?></td>
    
                </tr> 
                
                    <?php } ?>
                <tr>
                    <?php if(abs($sumCr) > abs($sumDr)){
                        $diffd = abs(abs($sumCr) - abs($sumDr));
                        $diffc = '0';
                        ?>
                       <td><strong>Surplus</strong></td>
                      <td><strong><?php echo $diffd; ?></strong></td>                  
                    <td><strong><?php echo $diffc; ?></strong></td>  
                   <?php }else{ 
                        $diffc = abs(abs($sumCr) - abs($sumDr));
                        $diffd = '0';
                       ?>
                       <td><strong>Defisit</strong></td>
                       <td><strong><?php echo $diffd; ?></strong></td>                  
                    <td><strong><?php echo $diffc; ?></strong></td>
                   
                 <?php   } ?>
                </tr>
                <tr>
                    <td><strong>Total</strong></td>
                   <td><strong><?php echo abs(abs($sumDr) + abs($diffd));  ?></strong></td>
                   <td><strong><?php echo abs(abs($sumCr) + abs($diffc));  ?></strong></td>
                </tr>
                <?php } else{ echo "<tr><td colspan='3'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>