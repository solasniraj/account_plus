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
     <?php if(!empty($donarDetails)){   
 foreach($donarDetails as $dDets){ 
       $donorCode = $dDets->donar_code; ?> 
        <div class="text-right pull-right">
            <a href="<?php echo base_url().'preview/donorReport/'.$donorCode.'/'.$fromE.'/'.$reportE.'/'.$toE; ?>" target="_blank"><button id="btnDownload" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url().'printview/donorReport/'.$donorCode.'/'.$fromE.'/'.$reportE.'/'.$toE; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    <a href="<?php echo base_url().'export/donorReport/'.$donorCode.'/'.$fromE.'/'.$reportE.'/'.$toE; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:160px" >Export to Excel</button></a>
        </div>
     <?php } } ?>
        
            <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

<table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
    <tr>
        <td colspan="3"><h3>Advance Statement</h3> 
        <h4>As on <?php echo $todayN. ' ('. $todayE .')'; ?></h4>
        </td>
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
                    
                    <th style="width: 10%;">Date</th>
                    <th style="width: 20%;">A/C Head</th>
                    <th style="width: 10%;">Voucher No.</th>
                    <th style="width: 10%;">Cheque No.</th>
                    <th style="width: 10%;">Total Amount</th>
                    <th style="width: 10%;">Setteled Amount</th>
                    <th style="width: 10%;">Remaining Amount</th>
                    <th style="width: 10%;">Purpose</th>
                    <th style="width: 10%;">Remarks</th>
                    
                           
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($advanse)){  foreach($advanse as $aaccounts){       
                      ?>
                <tr>
                    <td style="width: 10%;"><?php echo $aaccounts->tran_date; ?></td>
                    <td style="width: 20%;"><?php echo $aaccounts->ledger_master_description; ?></td>
                    <td style="width: 10%;"><?php echo $aaccounts->journal_voucher_no; ?></td>
                    <td style="width: 10%;"><?php echo $aaccounts->cheque_no; ?></td>
                    <td style="width: 10%;"><?php echo abs($aaccounts->amount); ?></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"></td>
                    <td style="width: 10%;"><?php echo $aaccounts->memo; ?></td>
                    <td style="width: 10%;"></td>
                                        
                </tr> 
                <?php } } else {
    echo "<tr><td colspan='9'><strong>Journal etries are not found for provided date range.</td></tr>";
} ?>
                   
                
            </tbody>
 
            
        </table>

                </div>
            </div>
        </div>
   </div>
</div>
