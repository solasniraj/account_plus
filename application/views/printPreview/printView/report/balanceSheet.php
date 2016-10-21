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
        <td colspan="2"><h3>Balance Sheet</h3> </td>
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
   
                    
                    <table class="tables" style="float: left;width: 50%;">
            <thead>
                <tr>  
                    <th style="width: 75%">Capital &amp; Liabilities</th>
                    <th style="width: 25%">Amount (Rs.)</th>
                  
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($allLedger)){
                    $sum1 = '0';
                    $sum2 = '0';
                    foreach($allLedger as $ledgers){
                      $code = $ledgers->ledger_master_code;
                      $gl = mb_substr($code, 0, 2);
                      if($gl == '02'){
                      $amount1 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN);
                    $sum1 += abs($amount1);
                      }elseif($gl == '01'){
                      $amount2 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN);
                    $sum2 += abs($amount2);
                      }
                     
                    
                      ?>
                <tr>
                    <?php if($gl == '02'){ ?>
                    <td style="width: 75%"><?php echo $ledgers->ledger_master_name; ?></td>
                    <td style="width: 25%"><?php echo abs($amount1);  ?></td> 
                    <?php } ?>
    
                </tr> 
                
                    <?php } ?>
               
                    <?php if(abs($sum2) > abs($sum1)){
                        $diff = abs(abs($sum2) - abs($sum1));
                  
                        ?>
                 <tr>
                       <td style="width: 75%"><strong>Surplus</strong></td>
                      <td style="width: 25%"><strong><?php echo $diff; ?></strong></td>                  
                 </tr>
                 <?php   }else{
                     $diff ='0';
                 }  $total1= $sum1+$diff; ?>
                
                
                <?php } else{ } ?>
            </tbody>
 
            
        </table>
                    
                     <table class="tables" style="float: left;width: 50%;">
            <thead>
                <tr>  
                    
                    <th style="width: 75%">Assets &amp; Properties</th>
                    <th style="width: 25%">Amount (Rs.)</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($allLedger)){
                    $sum1 = '0';
                    $sum2 = '0';
                    foreach($allLedger as $ledgers){
                      $code = $ledgers->ledger_master_code;
                      $gl = mb_substr($code, 0, 2);
                      if($gl == '02'){
                      $amount1 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN);
                    $sum1 += abs($amount1);
                      }elseif($gl == '01'){
                      $amount2 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $toE, $toN);
                    $sum2 += abs($amount2);
                      }
                     
                      ?>
                <tr>
                    <?php if($gl == '01'){ ?>
                    <td style="width: 75%"><?php echo $ledgers->ledger_master_name; ?></td>
                    <td style="width: 25%"><?php echo abs($amount2);  ?></td> 
                    <?php } ?>
    
                </tr> 
                
                    <?php } ?>
                
                    <?php if(abs($sum1) > abs($sum2)){
                        $diff = abs(abs($sum2) - abs($sum1));
                        
                        ?>
                <tr>
                       <td style="width: 75%"><strong>Defisit</strong></td>
                                     
                    <td style="width: 25%"><strong><?php echo $diff; ?></strong></td>  
                 
                    </tr>
                 <?php   }else{
                     $diff= '0';
                 }  $total2= $sum2+$diff; ?>
               
               
                <?php } else{ } ?>
            </tbody>
 
            
        </table>
                     <table class="tables" style="float: left;width: 100%;">
            
                
                <tr>
                        <td style="width: 37.5%">Total</td>
                       <td style="width: 12.5%"><?php echo $total1; ?></td>
                        <td style="width: 37.5%">Total</td>
                       <td style="width: 12.5%"><?php echo $total2; ?></td>
    
                </tr> 
    
        </table>

              
           
        
  

