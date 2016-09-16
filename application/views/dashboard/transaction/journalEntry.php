<SCRIPT TYPE = "text/javascript">
    function popup(mylink, windowname) {
        if (!window.focus)
            return true;
        var href;
        if (typeof (mylink) == 'string')
            href = mylink;
        else
            href = mylink.href;
        window.open(href, windowname, 'width=700,height=600,scrollbars=yes');
        return false;
    }
</SCRIPT>   <!--  main script is loaded  -->
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<style>
    .width25per{width: 25%;}
</style>


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
                    <div class="col-md-12 col-lg-12 sol-sm-12 ">
                        <table class="table">
                            <tr>
                                <td for="focusedInput" class="text-right width25per"><b>Journal no</b>
                                    <input  type="text" id="journalNo" name="journalNo" class="form-control" value="<?php echo $journalNumber; ?>" readonly>
                                    <?php echo form_error('journalNo'); ?></td>

                                <td class="text-right width25per"><b>Date</b>
                                    <input  class="form-control" id="datepicker" name="datepicker" type="text" placeholder="Day/Month/Year">
                                    <?php echo form_error('datepicker'); ?></td>

                                <td class="text-right width25per"><b>Journal Type</b>

                                    <select class="form-control" id="journalType" onchange="getAccountLedger(this)" name="journalType">
                                        <option value="0">Select Types</option>
                                        <?php foreach ($journalTypes as $value) { ?>
                                            <option value="<?php echo $value->chart_code; ?>"><?php echo $value->chart_class_name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php echo form_error('journalType'); ?>
                                </td>


                                <td class="text-right width25per"><b>Bank Balance: </b>
                                    <a href="<?php echo base_url() . 'bank/getBalance' ?>" onClick="return popup(this, 'stevie')"><strong style="color:red;"><?php if (!empty($bankBalance)) {
                                        echo "Rs. " . $bankBalance;
                                    } ?>    /-</strong></a></td>


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
                                    <td class="col-md-1"><b>Account Code</b></td>
                                    <td class="col-md-1"><b>A/C Head</b></td>
                                    <td class="col-md-1"><b>Sub-Ledger</b></td>
                                    <td class="col-md-1"><b>Donar-list</b></td>
                                    <td class="col-md-1"><b>Ledger type</b></td>
                                    <td><b>Description</b></td>
                                    <td><b>Debit</b></td>
                                    <td><b>Credit</b></td>
                                    <td><b>Cheque number</b></td>
                                    <td rowspan="2"  class="b" id="toggleButton">
                                        <span class="btn btn-success " id="submitCurrentData" onClick="addData()" style=" padding:5px;margin:5px;width:70px;font-size:18px;">Add</span></td>
                                </tr>
                                <tr>

                                    <td id="ledgerMasterCode">
                                        <input type="text" id="lMCode" value="" class="form-control" >
                                    </td>

                                    <td>  <select class="form-control" id="accountList" onchange="getSubLedger(this)">
                                            <option value="">Select Account</option>
                                        </select>
                                    </td>

                                    <td> <select class="form-control" id="subLedgerList" onchange="getDonor(this)">
                                            <option value=""></option>
                                        </select>
                                    </td>

                                    <td> <select class="form-control" id="donerList" onchange="getledgerType(this)">
                                            <option value=""></option>
                                        </select>
                                    </td>


                                    <td> <select class="form-control" id="ledgerType" onchange="updateCode(this)">
                                            <option value="00">Select Ledger Type</option>
                            <option value="01">Cash</option>
                            <option value="02">Internal Cash</option>
                            <option value="03">Labour Support</option>
                                            
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
                                    <td  class="b"><b>A/C Code</b></td>
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
                                <textarea class="form-control" rows="5" style="resize:none" id="comment" name="comment"></textarea>
                            </div>
                        </div>

                        <div class="col-md-5 col-md-offset-1" >
                            <div class="form-group">
                                <label for="summary"><b>Summary Comment</b></label>
                                <textarea class="form-control" rows="5" style="resize:none" id="summary"  name="summary"></textarea>
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
                            <button id="submitTheForm" onClick="sendAllJounalTransactionToServer()" class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Submit</button>

                            <span onclick="clearformTable()" class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Reset</span>
                            
                            <button id="previewForm" class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Preview</button>
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
