<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        
              <?php $fiscal_year = $this->session->userdata('fiscal_year');
               $value = str_replace('/', '&#47;', $fiscal_year);
$fy = urlencode($value);
if (!empty($committeeInfo)) {
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
        
        <div class="text-right pull-right">
            <a href="<?php echo base_url().'preview/balanceSheet/'.$fy.'/'.$fromE.'/'.$todayE; ?>" target="_blank"><button id="btnDownload" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url().'printview/balanceSheet/'.$fy.'/'.$fromE.'/'.$todayE; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    </div>
                
           <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

<table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
    <tr>
        <td colspan="3"><h3>Balance Sheet</h3> 
        <h4>As on <?php echo $todayN. ' ('. $todayE .')'; ?></h4>
        </td>
    </tr>
    <tr>
        <td>From : <?php echo $fromN. ' (' .$fromE. ') '; ?></td>  
       <td>Printed on : <?php echo $todayN. ' (' .$todayE. ') '; ?></td>
    </tr>
    
   
</table>
        </div>  
                 
        
        
                    
        <div class="clearfix"></div>
        <div class="xs tabls">
            <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {
                ?>
                <div class="alert alert-success fade in">
                    <p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
                </div>
                <hr>
            <?php }
            ?>
            <div data-example-id="simple-responsive-table" class="bs-example4">

                <div class="table-responsive">
                    
                    <table class="table-striped table-bordered table-condensed" width="50%" cellspacing="0" style="float: left;">
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
                      $amount1 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $todayE, $todayN);
                    $sum1 += abs($amount1);
                      }elseif($gl == '01'){
                      $amount2 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $todayE, $todayN);
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
                
                
                <?php } else{ $total1 ='0'; } ?>
            </tbody>
 
            
        </table>
                    
                     <table class="table-striped table-bordered table-condensed" width="50%" cellspacing="0" style="float: left;">
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
                      $amount1 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $todayE, $todayN);
                    $sum1 += abs($amount1);
                      }elseif($gl == '01'){
                      $amount2 = $this->report_model->get_sum_of_amounts_for_ledger_master_from_journal_entry($code, $fromE, $fromN, $todayE, $todayN);
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
               
               
                <?php } else{ $total2 = '0';} ?>
            </tbody>
 
            
        </table>
                     <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0" style="float: left;">
            
                
                <tr>
                        <td style="width: 37.5%">Total</td>
                       <td style="width: 12.5%"><?php echo $total1; ?></td>
                        <td style="width: 37.5%">Total</td>
                       <td style="width: 12.5%"><?php echo $total2; ?></td>
    
                </tr> 
    
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
