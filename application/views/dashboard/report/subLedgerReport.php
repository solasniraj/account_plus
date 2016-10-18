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
        <td colspan="3"><h3>Sub-ledger Account Statement</h3> </td>
    </tr>
    <tr>
         <?php if(!empty($subLedgerDetails)){ ?>

                    <?php foreach($subLedgerDetails as $slDets){ ?>
        <td>Sub Ledger Code : <?php echo $slDets->subledger_code; ?></td>
        <td>Sub Ledger Description : <?php echo $slDets->subledger_name; ?></td>
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
                    
                   
                    <th style="width: 20%;">Date</th>
                    <th style="width: 15%;">Journal No.</th>
                    <th style="width: 20%;">A/C Particulars</th>
                    <th style="width: 15%;">Debit (Rs.)</th>
                    <th style="width: 15%;">Credit (Rs.)</th>
                    <th style="width: 15%;">Balance</th>
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($ledgerRep)){
                    foreach($ledgerRep as $lEntries){
                       
                        ?>
                <tr>
               
  <table class="table table-striped table-bordered table-responsive table-condensed" width="100%" cellspacing="0">
 
          
                <tr>
                     
                    <td style="width: 20%;"><?php echo $lEntries->tran_date; ?></td>
                    <td style="width: 15%;"><?php echo $lEntries->journal_voucher_no; ?></td>
                    <td style="width: 20%;"><?php echo $lEntries->memo; ?></td>
                     <td style="width: 15%;"><?php if($lEntries->trans_type=='dr'){echo abs($lEntries->amount);} ?></td>
                    <td style="width: 15%;"><?php if($lEntries->trans_type=='cr'){echo abs($lEntries->amount);} ?></td>
                    <td style="width: 15%;"><?php ?></td>
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
