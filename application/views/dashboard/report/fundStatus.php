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
        
        <div class="text-right pull-right">
            <a href="<?php echo base_url().'preview/fundStatus/'.$fy.'/'.$fromE.'/'.$todayE; ?>" target="_blank"><button id="btnDownload" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url().'printview/fundStatus/'.$fy.'/'.$fromE.'/'.$todayE; ?>" target="_blank"> <button id="print" class="btns-primary" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
    </div>
                
           <div class="text-center" style="padding: 5px 0px 5px 0px;margin-bottom: 15px;">

<table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
    <tr>
        <td colspan="3"><h3>Fund Status Statement</h3> 
        <h4>As on <?php echo $todayN. ' ('. $todayE .')'; ?></h4>
        </td>
    </tr>
    <tr>
        <td>From : <?php echo $fromN. ' (' .$fromE. ') '; ?></td>  
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
            <div data-example-id="simple-responsive-table">

                <div class="table-responsive">
                  <table class="table-striped table-bordered" width="100%" cellspacing="0">

                        <thead>
                            
                            <tr>
                                <th style="width: 10%;">S.N.</th>	
                                <th style="width: 50%;">Description</th>
                                <th style="width: 20%;">Amount Rs.</th>
                                <th style="width: 20%;">Amount Rs.</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4">
                        <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                            
                                <tr>
                                    <th style="width: 10%;">1.</th>
                                    <th style="width: 50%;">Carry fwd</th>
                                    <th style="width: 20%;"> </th>
                                    <th style="width: 20%;"> </th>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Bank</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Cash</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Prepaid Expenses</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Advance</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Accounts Payable</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                
                        </table>
                                </td>

                            </tr>
                            
                            <tr>
                                <td colspan="4">
                        <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                            
                                <tr>
                                    <th style="width: 10%;">2.</th>
                                    <th style="width: 50%;">Income</th>
                                    <th style="width: 20%;"> </th>
                                    <th style="width: 20%;"> </th>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Carry fwd Income</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">First Installment</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Interest</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Second Installment</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Third Installment</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                
                        </table>
                                </td>

                            </tr>
                            
                            <tr>
                                <td colspan="4">
                        <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                            
                                <tr>
                                    <th style="width: 10%;">3.</th>
                                    <th style="width: 50%;">Total Income</th>
                                    <th style="width: 20%;"> </th>
                                    <th style="width: 20%;"> </th>
                                </tr>
                                
                                
                        </table>
                                </td>

                            </tr>
                            
                            <tr>
                                <td colspan="4">
                        <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                            
                                <tr>
                                    <th style="width: 10%;">4.</th>
                                    <th style="width: 50%;">Deduct Expanses</th>
                                    <th style="width: 20%;"> </th>
                                    <th style="width: 20%;"> </th>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">First Quarterly Expanses Report</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Second Quarterly Expanses Report</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Third Quarterly Expanses Report</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Fourth Quarterly Expanses Report</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                
                        </table>
                                </td>

                            </tr>
                            
                            <tr>
                                <td colspan="4">
                        <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                            
                                <tr>
                                    <th style="width: 10%;"></th>
                                    <th style="width: 50%;">Saving (3-4)</th>
                                    <th style="width: 20%;"> </th>
                                    <th style="width: 20%;"> </th>
                                </tr>
                                
                                
                        </table>
                                </td>

                            </tr>
                            
                            <tr>
                                <td colspan="4">
                        <table class="table-striped table-bordered table-condensed" width="100%" cellspacing="0">
                            
                                <tr>
                                    <th style="width: 10%;"></th>
                                    <th style="width: 50%;">Saving Types</th>
                                    <th style="width: 20%;"> </th>
                                    <th style="width: 20%;"> </th>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Bank</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Cash</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Prepaid Expenses</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Advance</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                <tr>
                                    <td style="width: 10%;"></td>
                                    <td style="width: 50%;">Accounts Payable</td>
                                    <td style="width: 20%;"></td>
                                    <td style="width: 20%;"></td>
                                </tr>
                                
                        </table>
                                </td>

                            </tr>


                        </tbody>
                    </table>  
                    

                </div>
            </div>
        </div>
   </div>
</div>
