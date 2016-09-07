<SCRIPT TYPE = "text/javascript">
function popup(mylink, windowname) {
if (!window.focus)return true;
var href;
if (typeof(mylink) == 'string') href = mylink;
else href = mylink.href;
window.open(href, windowname, 'width=700,height=600,scrollbars=yes');
return false;
}
</SCRIPT>   <!--  main script is loaded  -->
 <script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>

   

    <!-- main script is end -->

    <div id="page-wrapper">
        <div class="graphs">
            <h3 class="blank1">Journal Entry Form</h3>
            <div class="xs tabls">
                <?php
                $flashMessage = $this->session->flashdata('flashMessage');
                if (!empty($flashMessage)) {
                    ?>
                    <div class="alert alert-success fade in text-center">
                        <p style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage; ?> </strong></p>
                    </div>
                    <hr>
                    <?php }
                    ?>
                    <?php echo form_open_multipart('transaction/glTransaction', array('id' => 'glTrans', 'class' => 'form-horizontal', 'novalidate' => 'novalidate')); ?>
       
                    <div class="form-group" >
                        <div class="row">
                            <div class="col-md-4 ">
                                <table class="table">
                                    <tr>
                                        <td for="focusedInput"><b>Journal no</b></td>
                                        <td><input  type="text" id="journalNo" name="journalNo" class="form-control" value="<?php echo $journalNumber; ?>" readonly></td>

                                    </tr>

                                    
                                    <tr>

                                        <td class="text-right width100"><b>Date</b></td>
                                        <td><input  class="form-control" id="datepicker" name="datepicker" type="text" placeholder="Day/Month/Year"></td>


                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-4">
                                <table class="table">
                                    <tr>
                                        <td class="text-right width100"><b>Source </b></td>
                                        <td><input  class="form-control" type="text"></td>

                                    </tr>

                                </table>
                            </div>

                            <div class="col-md-4 ">
                                <table class="table">
                                    <tr>
                                        <td class="text-right width100 "><b>Journal Type</b></td>
                                        <td>
                                            <select class="form-control" id="journalType" onchange="whenJournalTypeIsSelected(this)" name="journalType">
                                                <option value=" ">Select Types</option>
                                                <?php foreach ($journalTypes as $value) { ?>
                                                    <option value="<?php echo $value->id;?>"><?php echo $value->chart_class_name;?></option>
                                                    <?php }  ?>
                                                </select>
                                                </td>

                                     </tr>
                                            <tr>
                                                <?php if(!empty($bankBalance)){ ?>
                                                <td class="text-right width100"><b>Bank Balance: </b></td>
                                                <td class="b"><a href="<?php echo base_url().'bank/getBalance' ?>" onClick="return popup(this, 'stevie')"><strong style="color:red;"><?php echo "Rs. ".$bankBalance; ?>/-</strong></a></td>
                                                <?php } ?>

                                            </tr>
                                        </table>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div id="errorMessages">

                                    </div>


                                    <!-- ************** our main form entry table *************************************************88 -->

                                    <div class="table-responsive">
                                        <table class="tablee">
                                            <tbody>

                                                <tr>

                                                    <td class="col-md-1"><b>Code#</b></td>
                                                    <td class="col-md-1"><b>A/C Head</b></td>
                                                    <td class="col-md-1"><b>Sub-Ledger</b></td>
                                                    <td class="col-md-1"><b>Donar-list</b></td>
                                                    <td class="col-md-1"><b>Ledger type</b></td>
                                                    <td><b>Description</b></td>
                                                    <td><b>Debit</b></td>
                                                    <td><b>Credit</b></td>
                                                    <td><b>Cheque number</b></td>
                                                    <td rowspan="2"  class="b" id="toggleButton">
                                                    <span class="btn btn-success " oncid="submitCurrentData" onClick="ProcessDataandInsertIntoArray()" style=" padding:5px;margin:5px;width:70px;font-size:18px;">Add</span></td>
                                                    </tr>



                                                    <tr>

                                                        <td id="programmCode">
                                                            <input type="text" id="pCode" class="form-control" >
                                                        </td>

                                                        <td>  <select class="form-control" id="programsList" onchange="whenProgramIsSelected(this)">
                                                            <option value="">Select Program</option>
                                                            </select>
                                                        </td>

                                                        <td> <select class="form-control" id="subLedgerList" >
                                                            <option value=""></option>
                                                        </select>
                                                    </td>

                                                    <td> <select class="form-control" id="donerList" >
                                                            <option value=""></option>
                                                        </select>
                                                    </td>


                                                    <td> <select class="form-control" id="ledgerType">
                                                        <option value=""></option>
                                                    </select>

                                                </td>

                                                <td>  <input  class="form-control " type="text" name="description" id="description"></td>
                                                <td>  <input  class="form-control formatComma" type="text"  id="debitAmount"></td>
                                                <td>  <input  class="form-control formatComma" type="text"  id="creditAmount"></td>
                                                <td> <input  class="form-control" type="text" name="chequeNo" id="chequeNo"></td>


                                            </tr>


                                        </tbody>
                                    </table>
                                </div>



                                <!--********************************our main table closed ************************************** -->

                            </div>
                            <br>
                            <div class="container">

        
                               <!--  working on the object starts -->


                                 <div class="table-responsive">
                                    <table class="tablee" width="100%">
                                        <thead>
                                            <tr>
                                                <td  class="b"><b>Code#</b></td>
                                                <td  class="b"><b>A/C Head</b></td>
                                                <td  class="b"><b>Sub-Ledger</b></td>
                                                <td  class="b"><b>Ledger type</b></td>
                                                <td  class="b"><b>Donar name</b></td>
                                                <td  class="b" colspan="2" s><b>Descrption</b></td>
                                                <td  class="b"><b>Debit</b></td>
                                                <td  class="b"><b>Credit</b></td>
                                                <td  class="b"><b>Cheque number</b></td>
                                                <td class="b" colspan="2"><b>Action</b></td>
                                            </tr>
                                        </thead>
                                        <tbody id="workingWithObjectData">
 
                                          
                                        </tbody>
                                         <tr>
                                                <td colspan="7"><b>Total Amount</b></td>
                                                <td id="totalDebit" class="b">0</td>
                                                <td id="totalCredit" class="b">0</td>

                                                <td colspan="2"></td>

                                            </tr>

                                            <tr>
                                                <td colspan="7"><b>Difference in Debit and Credit Amount</b></td>
                                                <td><input  id="debitGreater"  class="form-control text-center" type="text" value="0.0"  readonly /></td>
                                                <td><input  id="creditGreater" class="form-control text-center"  type="text" value="0.0"  readonly /></td>
                                                <td colspan="2"></td>

                                        </tr>
                                        <tr id="addArrayData">

                                        </tr>

                                        </table>
                                </div>
                              <br>
                              <br>
                              <br>

                                <!--   working on object is closed      -->

                                <div class="row">

                                    <div class="col-md-5 col-md-offset-1" >
                                        <div class="form-group">
                                            <label for="comment"><b>Detailed Comment</b></label>
                                            <textarea class="form-control" rows="5" style="resize:none" id="comment"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-5 col-md-offset-1" >
                                        <div class="form-group">
                                            <label for="summary"><b>Summary Comment</b></label>
                                            <textarea class="form-control" rows="5" style="resize:none" id="summary"></textarea>
                                        </div>
                                    </div>



                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 control-label" for="pwd"><b>Total Cheque Balance</b></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control1" id="pwd" style="margin-bottom:15px" >
                                            </div>
                                        </div>

                                    </div>



                                    <div class="lastButton">
                                        <button  onClick="sendAllJounalTransactionToServer()" class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Submit</button>

                                        <button class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Add</button>
                                    </div>

                                </div>
                            </div>
                            <br>
                            <br>
                            <br>
                        </div>
                </form>

                        <style>
                        #totalDebit, #totalCredit, #debitGreater, #creditGreater{color: red;}
                        </style>
