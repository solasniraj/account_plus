<div id="page-wrapper">
    <div class="graphs">
        <h3 class="blank1">Day Book </h3><p><?php echo $day; ?></p>
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
                    
                   
                    <th style="width: 20%;">Journal No</th>
                    <th style="width: 15%;">Ledger Code</th>
                    <th style="width: 20%;">A/C Particulars</th>
                    <th style="width: 15%;">Debit (Rs.)</th>
                    <th style="width: 15%;">Credit (Rs.)</th>
                    <th style="width: 15%;">Cheque No.</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($journalEntry)){
                    foreach($journalEntry as $lEntries){ ?>
                <tr>
                <?php 
                        $singleGLDetails = $this->transaction_model->get_single_transaction_details($lEntries->journal_voucher_no);
                   if(!empty($singleGLDetails)){ ?>
  <table class="table table-striped table-bordered table-responsive table-condensed" width="100%" cellspacing="0">
 <?php foreach ($singleGLDetails as $glDets){   
      $sum = 0;
                        ?>
          
                <tr>
                     
                    <td style="width: 20%;"><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td style="width: 15%;"><?php echo $glDets->ledger_master_code; ?></td>
                    <td style="width: 20%;"><?php echo $glDets->ledger_master_description; ?></td>
                    <td style="width: 15%;"><?php if($glDets->trans_type=='dr'){echo abs($glDets->amount);} ?></td>
                    <td style="width: 15%;"><?php if($glDets->trans_type=='cr'){echo abs($glDets->amount);} ?></td>
                    <td style="width: 15%;"><?php echo $glDets->cheque_no; ?></td>
                </tr> 
 <?php $sum += abs($glDets->amount); } ?>                
            </table>                                  
                       <?php  } ?> 
                </tr> 
                    <?php } ?>
                <?php } else{ echo "no journal entries are found for".$day ;} ?>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
