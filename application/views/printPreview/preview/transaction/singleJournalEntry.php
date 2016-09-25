

<?php
if (!empty($singleGLDetails)) {
    foreach ($singleGLDetails as $glDetails) {
        $gLDate = $glDetails->tran_date;
        $voucherNo = $glDetails->journal_voucher_no;
        $summary = $glDetails->summary_comment;
        $details = $glDetails->detailed_comment;
    }
    ?>
    <div class="form-group" >
        <div class="row">
            <div class="container">
               <table class="table">

                <tr>
                   <td>
                    <?php if (!empty($committeeInfo)) {
                        foreach ($committeeInfo as $cLists) { ?>
                            <div class="top text-center" style="margin-top:22px;margin-bottom:10px;">
                               <img src="http://localhost/account_plus/contents/images/watersplash.png" img-align="top" alt="images" style= "width:20px; height:20px">
                           </div>
                       </td>

                       <td>
                           <h2><?php echo $cLists->committee_name; ?></h2>
                           <h4><?php echo $cLists->address; ?></h4>
                           <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>
                       </td>


                       <td class="text-right width25per"><b>Journal No:

                                                                       </b></td>



                   </tr>

               </table>
           </div>
       </div>
   </div>
             <?php }
         } ?>
         <span class="text-right pull-right">
            <a href="<?php echo base_url() . 'preview/jounalView/'.$voucherNo; ?>"><button id="btnDownload" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -73px; width:100px">Download</button></a>&nbsp;&nbsp;
            <a href="<?php echo base_url() . 'printview/printJoural/'.$voucherNo; ?>"> <button id="print" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -73px; width:100px" >Print</button></a>
        </span>

    </div>
    <div id="page-wrapper">
        <div class="graphs">
            <div class="xs tabls">

                <div data-example-id="simple-responsive-table" class="bs-example4">
                   
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
                            <?php foreach ($singleGLDetails as $gLList){ $type= $gLList->trans_type;
                           $donar = $this->transaction_model->get_donar_name_by_code($gLList->donor_code);
                            
                            ?>
                                <tr>
                                    <td><?php echo $gLList->ledger_master_code; ?></td>
                                    <td><?php echo $gLList->ledger_master_name; ?></td>                           
                                    <td><?php echo $donar; ?></td>
                                    <td><?php echo $gLList->memo; ?></td>

                                    <td><?php if($type =='dr'){ echo abs($gLList->amount);}else{ echo '0'; } ?></td>
                                    <td><?php if($type =='cr'){ echo abs($gLList->amount);}else{ echo '0'; } ?></td>




                                </tr>
                                <?php } ?>



                                <tr>
                                    <td colspan="4">Total</td>
                                    <td></td>
                                    <td></td>
                                </tr>


                                <tr>

                                <td clospan="6">Amount in words</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                                   <h4>Narration:</h4>


                    <div class="table-responsive">
                       <table class="table table-bordered">

                        <tr>

                         <td>
                            <pre text-center>

Prepared By:

     .................

date:_________________
                            </pre>



                        </td>




                        <td>
                            <pre text-center>

Prepared By:

     .................
     
date:_________________
                            </pre>



                        </td>


                    </tr>

                </table>
            </div>




            <?php
        } else {
            echo "Data not Found";
        }
        ?>



    </div>
</div>
</div>
</div>
</div>















