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
                <?php if(!empty($subLedgerDetails)){ ?>

                    <?php foreach($subLedgerDetails as $slDets){ ?>
        <p>Sub Ledger Code : <?php echo $slDets->subledger_code; ?></p>
        <p>Sub Ledger Description : <?php echo $slDets->subledger_name; ?></p>
                    
                    <?php } ?>
               
                <?php } ?>
               <b> From <?php echo $fromN. ' (' .$fromE. ') '; ?></b><br/>
                        <b>To <?php echo $toN. ' ('. $toE .')'; ?></b>
                    
                        <P>Balance : <strong>Rs. </strong></p>
                        <p>Printed on : </p>
                 
        
        <h3 class="blank1">Sub-ledger Account Statement </h3><p></p>
                    
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
