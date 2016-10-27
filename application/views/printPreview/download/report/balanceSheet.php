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
   
                    
                    <table class="tables">
            <thead>
                <tr>  
                    <th>Capital &amp; Liabilities</th>
                    <th>Amount (Rs.)</th>
                  
                           
                </tr>
            </thead>
            
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
               
                    <?php if($gl == '02'){ ?>
             <tr>
                    <td><?php echo $ledgers->ledger_master_name; ?></td>
                    <td><?php echo abs($amount1);  ?></td> 
                     </tr> 
                    <?php } ?>
    
               
                
                    <?php } ?>
               
                    <?php if(abs($sum2) > abs($sum1)){
                        $diff = abs(abs($sum2) - abs($sum1));
                  
                        ?>
                 <tr>
                       <td><strong>Surplus</strong></td>
                      <td><strong><?php echo $diff; ?></strong></td>                  
                 </tr>
                 <?php   }else{
                     $diff ='0';
                 }  $total1= $sum1+$diff; ?>
                <tr>
                        <td>Total</td>
                       <td><?php echo $total1; ?></td>
                        
    
                </tr> 
                
                <?php } else{ $total1 ='0'; } ?>
           
 
            
        </table>
                    
                     <table class="tables">
            <thead>
                <tr>  
                    
                    <th>Assets &amp; Properties</th>
                    <th>Amount (Rs.)</th>
                           
                </tr>
            </thead>
          
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
                
                    <?php if($gl == '01'){ ?>
            <tr>
                    <td><?php echo $ledgers->ledger_master_name; ?></td>
                    <td><?php echo abs($amount2);  ?></td> 
                    </tr> 
                    <?php } ?>
    
                
                
                    <?php } ?>
                
                    <?php if(abs($sum1) > abs($sum2)){
                        $diff = abs(abs($sum2) - abs($sum1));
                        
                        ?>
                <tr>
                       <td><strong>Defisit</strong></td>
                                     
                    <td><strong><?php echo $diff; ?></strong></td>  
                 
                    </tr>
                 <?php   }else{
                     $diff= '0';
                 }  $total2= $sum2+$diff; ?>
               <tr>
                       
                        <td>Total</td>
                       <td><?php echo $total2; ?></td>
    
                </tr> 
               
                <?php } else{ $total2 ='0'; } ?>
           
 
            
        </table>
                     