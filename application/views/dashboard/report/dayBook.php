<style>.table{margin-bottom:1px;}</style>
<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<div id="page-wrapper">
    <div class="graphs">
        
                        <?php if (!empty($committeeInfo)) {
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
        
        <div class="text-right">
            <a href="<?php echo base_url().'preview/dayBook/'.$dayE; ?>" target="_blank"><button id="btnDownload" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url().'printview/dayBook/'.$dayE; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url().'export/dayBook/'.$dayE; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:160px" >Export to Excel</button></a>
    </div>
        
        <div class="text-center" style="padding: 5px 0px 5px 0px;border: 1px solid #999;margin-bottom: 15px;">
            <h3>Day Book </h3>
            <p><strong><?php echo "Date : ". $dayN. ' (' .$dayE. ') '; ?></strong></p>
                        <p><?php echo "Printed On : ". $todayN. ' (' .$todayE. ') '; ?></p>
        </div>
                       
                   
       
        <div class="col-md-12" style="padding:0px;margin-bottom: 10px;">
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
                    <th style="width: 20%;">Ledger Code</th>
                    <th style="width: 30%;">A/C Particulars</th>
                    <th style="width: 15%;">Debit (Rs.)</th>
                    <th style="width: 15%;">Credit (Rs.)</th>
                    
                           
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
                    <td style="width: 20%;"><?php echo $glDets->ledger_master_code; ?></td>
                    <td style="width: 30%;"><?php echo $glDets->ledger_master_description; ?></td>
                    <td style="width: 15%;"><?php if($glDets->trans_type=='dr'){echo abs($glDets->amount);} ?></td>
                    <td style="width: 15%;"><?php if($glDets->trans_type=='cr'){echo abs($glDets->amount);} ?></td>
                    
                </tr> 
 <?php $sum += abs($glDets->amount); } ?>                
            </table>                                  
                       <?php  } ?> 
                    
                </tr> 
                    <?php } ?>
                <?php } else{ echo "<tr><td colspan='6'><strong>No journal entries are found for ".$day ."</strong></td></tr>";} ?>
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
