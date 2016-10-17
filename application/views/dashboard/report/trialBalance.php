<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        
              <table width="100%">
        <tr>
                    <td class="text-center">
                        <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>
                         <div class="top text-center" style="margin-top:2px;margin-bottom:5px;">
                            <img src="<?php echo base_url().'contents/uploads/images/'.$cLists->logo; ?>" img-align="top" alt="images" style= "width:100px; float: left;">
                        </div>
                        <h3><?php echo $cLists->committee_name; ?></h3>
                        <h5><?php echo $cLists->address; ?></h5>
                        <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
                        <h3>Trial Balance </h3>
                        <p><?php echo $toN. ' ('. $toE .')'; ?></p>
                    <?php }
    }
    ?>
                    </td>


                    <td class="text-left width25per" style="text-align:right;"><b>Date : </b>
                    </td>
                </tr>
              </table>
                <?php if(!empty($subLedgerDetails)){ ?>

                    <?php foreach($subLedgerDetails as $slDets){ ?>
        <p>Sub Ledger Code : <?php echo $slDets->subledger_code; ?></p>
        <p>Sub Ledger Description : <?php echo $slDets->subledger_name; ?></p>
                    
                    <?php } ?>
               
                <?php } ?>
               <b> From <?php echo $fromN. ' (' .$fromE. ') '; ?></b><br/>
                        <b>To <?php echo $toN. ' ('. $toE .')'; ?></b>
                    
                        <P>Balance : <strong>Rs. </strong></p>
                        <p>Printed on : <?php echo $todayN. ' (' .$todayE. ') '; ?></p>
                 
        
        
                    
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
                    
                   
                    <th>Account Code</th>
                    <th>Account Name / Particulars</th>
                    <th>Debit (Rs.)</th>
                    <th>Credit (Rs.)</th>
                    <th>Balance</th>
                           
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
                    <td></td>
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
            </div>
        </div>
   </div>
</div>
