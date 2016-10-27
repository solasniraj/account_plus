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
        <a href="<?php echo base_url().'preview/donorReport/'.$fy.'/'.$fromE.'/'.$toE; ?>"><button id="btnDownload" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url().'printview/donorReport/'.$fy.'/'.$fromE.'/'.$toE; ?>"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    </div>
        
            <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

<table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
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
                    
                    <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
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
                     $sumExpn = $this->report_model->get_sum_of_expenditure_to_last_date($donorCode, $dEntries->ledger_master_code, $fromN, $fromE);
$sumFunds += abs($sumFund);
$sumExpnLast += abs($sumExpn);
  $sumExpnNow = $this->report_model->get_sum_of_expenditure_from_last_report_to_now($donorCode, $dEntries->ledger_master_code,$fromN, $fromE, $toN, $toE);

 $totalExpn = abs($sumExpn) + abs($sumExpnNow);
                     $amtRemain = $sumFund - $totalExpn;
                     $otherExpn = $this->report_model->get_sum_of_expenditure_of_internal_and_labour_from_last_report_to_now($chartId, $donorCode);
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
                    <td style="width: 10%;"><?php echo "Rs. ".abs($amtRemain); ?></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    
                </tr> 
                
                    <?php } ?>
                <tr>
                    <td colspan="3"><strong>Total</strong></td>
                    <td><?php echo "Rs.".$sumFunds; ?></td>
                    <td><?php echo "Rs.".$sumExpnLast; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php } else{ echo "<tr><td colspan='6'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
