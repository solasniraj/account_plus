<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        
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


    <div class="text-right pull-right">
        <a href="#"><button id="btnDownload" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="#"> <button id="print" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    </div>
        
        
           <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

<table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
    <tr>
        <td colspan="3"><h3>Income Expenditure Account Statement Report</h3> </td>
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
                <?php } else{ echo "<tr><td colspan='6'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
