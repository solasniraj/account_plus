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
                    <?php }
    }
    ?>
                    </td>


                    <td class="text-left width25per" style="text-align:right;"><b>Date : </b>
                    </td>
                </tr>
              </table>
                <?php if(!empty($donarDetails)){ ?>

                    <?php foreach($donarDetails as $dDets){ ?>
        <p>Donor Code : <?php echo $dDets->donar_code; ?></p>
        <p>Donor Name : <?php echo $dDets->donar_name; ?></p>
        
                    
                    <?php } ?>
               
                <?php } ?>
               <b> From <?php echo $fromN. ' (' .$fromE. ') '; ?></b><br/>
                        <b>To <?php echo $toN. ' ('. $toE .')'; ?></b>
                    
                        <P>Balance : <strong>Rs. </strong></p>
                        <p>Printed on : </p>
                 
        
        <h3 class="blank1">Donor Report Statement </h3><p></p>
                    
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
                    <th style="width: 15%;">Ledger Name</th>
                    <th style="width: 15%;">Program Name</th>
                    <th style="width: 10%;">Fund Amt.</th>
                    <th style="width: 10%;">Expenditure till last report date</th>
                    <th style="width: 10%;">Added expenditure</th>
                    <th style="width: 10%;">Total Expenditure</th>
                    <th style="width: 10%;">Remaining Budget</th>
                    <th style="width: 10%;">Remarks</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($donarLed)){
                    foreach($donarLed as $dEntries){
                      $chartId = $dEntries->account_code;
                      $sumFund = $this->report_model->get_sum_of_amount_for_donar_by_code($donorCode);
                     $sumExpn = $this->report_model->get_sum_of_expenditure_to_last_date($chartId, $donorCode);
                     $sumExpnNow = $this->report_model->get_sum_of_expenditure_from_last_report_to_now($chartId, $donorCode);
                     var_dump($sumFund);
                     var_dump($sumExpn);
                      var_dump($sumExpnNow);

// $totalExpn = $sumExpn + $sumExpnNow;
                    // $amtRemain = $sumFund - $totalExpn;
                     $otherExpn = $this->report_model->get_sum_of_expenditure_of_internal_and_labour_from_last_report_to_now($chartId, $donorCode);
                     $program = $this->ledger_model->get_account_ledger_info_by_account_code($dEntries->ledger_code);
                      
                      
                      
                      ?>
                <tr>
               
  <table class="table table-striped table-bordered table-responsive table-condensed" width="100%" cellspacing="0">
 
          
                <tr>
                     
                    <td style="width: 10%;"><?php echo $dEntries->ledger_master_code; ?></td>
                    <td style="width: 15%;"><?php echo $dEntries->ledger_master_name; ?></td>
                    <td style="width: 15%;"><?php echo $program; ?></td>
                    <td style="width: 10%;"><?php echo "Rs. "; var_dump($sumFund); ?></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    
                </tr> 
               
            </table>                                  
                      
                </tr> 
                    <?php } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No entries are found</td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
