<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<?php
if (!empty($singleGLDetails)) {
    foreach ($singleGLDetails as $glDetails) {
        $gLDate = $glDetails->tran_date;
        $voucherNo = $glDetails->journal_voucher_no;
        $details = $glDetails->detailed_comment;
                    $value = str_replace('/', '&#47;', $voucherNo);
$NewNo = urlencode($value);
    }
    ?>  
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
        
      
            <div class="text-right pull-right">
                <a href="<?php echo base_url() . 'preview/jounalView/' . $NewNo; ?>" target="_blank"><button id="btnDownload" class="btns-primary" style="margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url() . 'printview/printJoural/' . $NewNo; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    </div>
   
                
           <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

 <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
        <thead>
            <tr>

                <th> A/C Number </th>
                <th> A/C Description</th>
                <th> Donar's Name</th>
                <th>Description</th>
                <th>Debit Amount</th>
                <th>Credit Amount</th>

            </tr>
        </thead>
        <tbody>
            <?php
             $sumD = 0;
             $sumC = 0;
            foreach ($singleGLDetails as $gLList) {
                $type = $gLList->trans_type;
                $donar = $this->transaction_model->get_donar_name_by_code($gLList->donor_code);
              
                ?>
                <tr>
                    <td><?php echo $gLList->ledger_master_code; ?></td>
                    <td><?php echo $gLList->ledger_master_name; ?></td>                           
                    <td><?php echo $donar; ?></td>
                    <td><?php echo $gLList->memo; ?></td>

                    <td><?php if ($type == 'dr') {
                      $sumD += abs($gLList->amount);  
                    echo abs($gLList->amount);
                } else {
                    echo '0';
                } ?></td>
                    <td><?php if ($type == 'cr') {
                    $sumC += abs($gLList->amount);    
            echo abs($gLList->amount);
        } else {
            echo '0';
        } ?></td>




                </tr>
    <?php  } ?>



            <tr>
                <td colspan="4">Total</td>
                <td><Strong><?php echo 'Rs. '.$sumD; ?></strong></td>
                <td><Strong><?php echo 'Rs. '.$sumC; ?></strong></td>
            </tr>


            <tr>

                <td>Amount in words</td>
                <td colspan="5"><?php 
                $words = $this->numbertowords->convert_number($sumD);
                echo $words.' Rupees only.';
                ?></td>
            </tr>
        </tbody>
    </table>
        </div>  
                 
        
        
                    
        <div class="clearfix"></div>
        <br/><br/>
<div style="border: 1px solid #ddd; width: 100%;padding: 15px;">
<p><strong>Narration : </strong><?php echo $details ?> </p>
</div>

<br/><br/>
<table style="width: 100%;">

        <tr>
            <td style="width: 50%;">
                <pre>

                           Prepared By:

                           .................
                     
                     Date : <?php echo $gLDate; ?>
                </pre>
            </td>
            <td style="width: 50%;">
                <pre>
                          
                           Approved By:

                           .................
         
                      Date: _________________
                </pre>
            </td>
        </tr>
    </table>
   </div>
</div>
<?php
} else {
    echo "Data not Found";
}
?>