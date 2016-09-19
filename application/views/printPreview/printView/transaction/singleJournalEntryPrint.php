<style>
    @media print{@page {size: landscape}}
    </style>
<?php if(!empty($singleGLDetails)){ 
     foreach($singleGLDetails as $glDetails){
      $gLDate = $glDetails->tran_date;
      $voucherNo = $glDetails->journal_voucher_no;
      $summary = $glDetails->summary_comment;
      $details = $glDetails->detailed_comment;
     }
        
    ?>
<div class="container">
        <?php if(!empty($committeeInfo)){ foreach ($committeeInfo as $cLists){ ?>
        <div class="top text-center" style="margin-top:22px;margin-bottom:10px;">
           <!--<img src="" img-align="top" alt="images" style= "">-->
           
           <h2><?php echo $cLists->committee_name; ?></h2>
           <h4><?php echo $cLists->address; ?></h4>
           <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
     </div>
        <?php }} ?>
    </div>
     <div id="page-wrapper">
        <div class="graphs">
            <div class="xs tabls">
                
                <div data-example-id="simple-responsive-table" class="bs-example4">
                      <!-- priview first table of singleJournla entry -->

                   <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                
                                    <th>General Ledger Transaction Details</th>
                                    <th>Date</th>
                                    <th>Summary of Transaction</th>
                                    <th>Details of Transaction</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Journal Entry : <?php echo $voucherNo; ?> </td>
                                <td><?php echo $gLDate; ?></td>
                                <td><?php echo $summary; ?></td>
                                <td><?php echo $details; ?></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- second table for singleJournalEntry  -->
                
                <div class="table-responsive">
                    <table class="table table-bordered">
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
                    <?php foreach ($singleGLDetails as $gLList){ $type= $gLList->trans_type; ?>
                            <tr>
                                <td><?php echo $gLList->ledger_master_code; ?></td>
                                <td><?php echo $gLList->ledger_master_name; ?></td>                           
                                <td><?php echo $gLList->donar_name; ?></td>
                                <td><?php echo $gLList->memo; ?></td>
                                
                                <td><?php if($type =='dr'){ echo abs($gLList->amount);}else{ NULL; } ?></td>
                                <td><?php if($type =='cr'){ echo abs($gLList->amount);}else{ NULL; } ?></td>
                            



                            </tr>
                            <?php } ?>



                    <tr>
                    <td colspan="4">Total</td>
                    <td></td>
                    <td></td>
                    </tr>
             </tbody>
                        
                    </table>
                </div>
                 
            </div>
                
                 <!--prepared and approverd by section-->


                    <div class="form-group" style="padding-top: 100px;">
                        <div class="row">
                            <div class="col-md-4">
                                <table class="table">
                                    <tr>
                                        <th>Prepared By:</th>
                                    </tr>
                                    <tr>
                                        <td>Name :-........................</td>
                                    </tr>
                                    <tr>
                                        <td>Designation :-........................</td>
                                    </tr>  
                                </table>
                            </div>
                            <div class="col-md-4 col-md-offset-2">
                                <table class="table">
                                    <tr>
                                        <th>Apporoved By:</th>
                                    </tr>
                                    
                                    <tr>
                                        <td>Name :-........................</td>
                                    </tr>
                                    <tr>
                                        <td>Ressignation :-.......................</td>
                                    </tr>  
                                </table>
                            </div>
                            
                        </div>
                    </div>
                
        </div>
    </div>
</div>
<?php }else{
                    echo "Data not Found";
                } ?>

