<?php if(!empty($singleGLDetails)){ 
     foreach($singleGLDetails as $glDetails){
      $gLDate = $glDetails->tran_date;
      $voucherNo = $glDetails->gl_no;
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
           <span class="text-right pull-right">
               <a href="<?php echo base_url() . 'preview/jounalView/12345-FY2016-00001';?>"><button id="btnDownload" class="btn btn-primary">Download</button></a>&nbsp;&nbsp;
        <a href="<?php echo base_url() . 'printview/printJoural/12345-FY2016-00001';?>"> <button id="print" class="btn btn-primary" >print</button></a>
         </span>

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
                                <center>
                                    <th>General Ledger Transaction Details</th>
                                    <th>Date</th>
                                    <th>Summary of Transaction</th>
                                    <th>Details of Transaction</th>
                                </center>
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
                                <center>
                                    <th>Account code</th>
                                    <th>Account head</th>
                                    <th>Sub-ledger </th>
                                    <th>Donar name</th>
                                    <th>Ledger type</th>
                                    <th>Description</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Cheque No.</th>
                                    
                                </center>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($singleGLDetails as $gLList){ ?>
                            <tr>
                                <th><?php echo $gLList->account_code; ?></th>
                                <th><?php echo $gLList->account_head; ?></th>                           
                                <th><?php echo $gLList->sub_ledger; ?></th>
                                <th><?php echo $gLList->donor_id; ?></th>
                                <th><?php echo $gLList->ledger_type; ?></th>
                                <th><?php echo $gLList->memo; ?></th>
                                <th><?php echo $gLList->amount; ?></th>
                                <th><?php echo $gLList->amount; ?></th>
                                <th><?php echo $gLList->cheque_no; ?></th>



                            </tr>
                            <?php } ?>
                           
                                
                                <tr>
                                    <th colspan="2">Total </th>

                                    <th>&nbsp</th>
                                    <th>500</th>
                                    <th>500</th>
                                    <th>&nbsp</th>


                                </tr>

                            </tbody>
                        
                    </table>
                </div>
                 
            </div>
                
        </div>
    </div>
</div>
<?php }else{
                    echo "Data not Found";
                } ?>
