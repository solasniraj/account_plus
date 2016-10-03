<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        
              <table width="100%">
        <tr>
            <td>
                <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>
                        <div class="top text-center" style="margin-top:2px;margin-bottom:5px;">
                            <img src="<?php echo base_url().'contents/uploads/images/'.$cLists->logo; ?>" img-align="top" alt="images" style= "width:100px;">
                        </div>
                <?php }
    }
    ?>
                    </td>
                    <td class="text-center">
                        <?php if (!empty($committeeInfo)) {
                    foreach ($committeeInfo as $cLists) {
                        ?>
                        <h2><?php echo $cLists->committee_name; ?></h2>
                        <h4><?php echo $cLists->address; ?></h4>
                        <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
                    <?php }
    }
    ?>
                    </td>


                    <td class="text-left width25per"><b>Date : <?php echo $day; ?></b>
                    </td>
                </tr>
                <tr>
                    <td>Ledger Code : </td>
                    <td>Ledger Description : </td>
                    <td>Ledger Balance</td>
                </tr>

            </table> 
        
        <h3 class="blank1">Day Book </h3><p></p>
                    <div class="col-md-12">
                <?php echo form_open_multipart('reports/dayBook'); ?>
                    <div class="input-group input-group-ind">
                        <input type="text" id="nepaliDate" class="form-control1 input-search form-control nepali-calendar" name="datepicker" value="" placeholder="YYYY-MM-DD"/>
        <input type="hidden" id="englishDate" name="englishDate"/>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success"><i class="fa fa-search icon-ser"></i></button>
                        </span>
                    </div><!-- Input Group -->
                   <?php echo form_close(); ?>
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
                <?php } else{ echo "<tr><td colspan='6'><strong>No journal entries are found for ".$day ."</strong><td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
