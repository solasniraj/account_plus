

<?php
if (!empty($singleGLDetails)) {
    foreach ($singleGLDetails as $glDetails) {
        $gLDate = $glDetails->tran_date;
        $voucherNo = $glDetails->journal_voucher_no;
        $summary = $glDetails->summary_comment;
        $details = $glDetails->detailed_comment;
    }
    ?>
    <div class="container">


        <?php if (!empty($committeeInfo)) {
            foreach ($committeeInfo as $cLists) { ?>
                <div class="top text-center" style="margin-top:22px;margin-bottom:10px;">
                   <!--<img src="" img-align="top" alt="images" style= "">-->

                    <h2><?php echo $cLists->committee_name; ?></h2>
                    <h4><?php echo $cLists->address; ?></h4>
                    <p><strong>Ph : <?php echo $cLists->phone; ?></strong></p>

                </div>
        <?php }
    } ?>
        <span class="text-right pull-right">
            <a href="<?php echo base_url() . 'preview/jounalView/12345-FY2016-00001'; ?>"><button id="btnDownload" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px">Download</button></a>&nbsp;&nbsp;
            <a href="<?php echo base_url() . 'printview/printJoural/12345-FY2016-00001'; ?>"> <button id="print" class="btn btn-primary btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px" >Print</button></a>
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

                    <th> A/C Name </th>
                    <th> A/C Description</th>
                    <th> Donar's Name</th>
                    <th>Description</th>
                    <th>Debits</th>
                    <th>Credits</th>

                   </tr>
             </thead>
             <tbody>
                    <tr>
                    <td>0101001010010</td>
                    <td>WWF</td>
                    <td>WWF/Taal</td>
                    <td>1st grant</td>
                    <td>400</td>
                    <td>0101001010010</td>
                    </tr>



                    <tr>
                    <td colspan="4">Total</td>
                    <td></td>
                    <td></td>
                    </tr>
             </tbody>
</table>
                    
                     <div class="form-group">
                        <div class="row">
                            
                                <table class="table">
                                    <tr>
                                        <pre>
  
                    Designation :-                                                           Designation :-
    

                  Name : _____________________                                               Name : ______________________


                  Sign : .....................                                               Sign : ......................
                                               
                                        
                                      </pre>
                                      </tr>
                                
                          
                           
<?php
} else {
    echo "Data not Found";
}
?>

                   
                            
                        </div>
                    </div>
                 
                  </tbody>
                  </table>
                  </div>
                  </div>
                  </div>
                  </div>
                  </div>
                  





              





   
