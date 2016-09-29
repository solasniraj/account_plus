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

	<script type="text/javascript" src="<?php echo base_url('contents/js/nepali.datepicker.v2.1.min.js'); ?>"></script>
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('contents/css/nepali.datepicker.v2.1.min.css'); ?>" />
<script type="text/javascript" src="<?php echo base_url('contents/js/function.js'); ?>"></script>
<style>
    .width25per{width: 25%;}
    .has-error{color: red;font-size: 0.85em;display: none;}
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
                    <p
                        style="text-align:center;font-size:18px;"><strong>!!&nbsp;<?php echo $flashMessage;
                ?> </strong></p>
                </div>
                <hr>
            <?php }
            ?>
            <?php
            echo
            form_open_multipart('transaction/glTransaction', array('id' =>'glTrans', 'class' => 'form-horizontal', 'novalidate' =>'novalidate')); ?>

            <div class="form-group" >
                <div class="row">
                    <div class="col-md-12 col-lg-12 sol-sm-12 ">
                        <table class="table">
                            <tr>
                                <td for="journalNo" class="text-right
                                    width25per"><b>Journal no</b>
                                    <input  type="text" id="journalNo"
                                            name="journalNo" class="form-control" value="<?php echo $journalNumber; ?>" readonly>
<?php echo form_error('journalNo');?>
                                    <label class="has-error" for="journalNo" id="journal_error">This field is required.</label></td>

                                <td class="text-right width25per"><b>Date</b>
                                    <input  class=""
                                            id="datepicker" type="text" >
                                    
                                    <input type="text" id="nepaliDate" class="form-control nepali-calendar" name="datepicker" value="" placeholder="Day/Month/Year"/>
                                    <input type="text" id="englishDate"/>
<?php echo form_error('datepicker'); ?>
                                    <label class="has-error" for="datepicker" id="date_error">This field is required.</label></td>

                                <td class="text-right
                                    width25per"><b>Journal Type</b>

                                    <select class="form-control" id="journalType" onchange="getAccountLedger(this)" name="journalType">
                                        <option value="0">Select Types</option>
                                    <?php foreach ($journalTypes as $value) { ?>
                                            <option value="<?php echo $value->chart_code; ?>"><?php echo $value->chart_class_name; ?></option>
                                            <?php } ?>
                                    </select>
                                            <?php echo form_error('journalType'); ?>
                                    <label class="has-error" for="journalType" id="journalType_error">This field is required.</label>
                                </td>


                                <td class="text-right width25per"><b>Bank Balance: </b><br/>
                                    <a href="<?php echo base_url() . 'bank/getBalance' ?>" onClick="return popup(this, 'stevie')"><strong style="color:red;"><?php
                                            if (!empty($bankBalance)) {
                                                echo "Rs. " . $bankBalance;
                                            }
                                            ?>    /-</strong></a></td>


                            </tr>



                        </table>
                    </div>




                    <div class="clearfix"></div>
                    <div id="errorMessages">

                    </div>


                    <!-- ************** our main form entry table
************************************************* -->

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
                                        <span class="btn btn-success" id="submitCurrentData" onClick="addData()" style="padding:5px;margin:5px;width:70px;font-size:18px;">Add</span></td>
                                </tr>
                                <tr>

                                    <td id="ledgerMasterCode">
                                        <input type="text" id="lMCode" value="" class="form-control" >
                                        <label class="has-error" for="journalType" id="accCode_error">This field is required.</label>
                                        <label class="has-error" for="journalType" id="accCodeMis_error">Account Code doesn't exist.</label>
                                    </td>

                                    <td> <select class="form-control" id="accountList" onchange="getSubLedger(this)">
                                            <option value="">Select Account</option>
                                        </select>
                                        <label class="has-error" for="journalType" id="acchead_error">This field is required.</label>
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

                                    <td>  <input  class="form-control" type="text" name="description" id="description">
                                        <label class="has-error" for="journalType" id="description_error">This field is required.</label>
                                    </td>

                                    <td>  <input  class="form-control formatComma" type="text"  id="debitAmount">
                                        <label class="has-error" for="debitAmount" id="debitAmount_error">Either Debit or Credit required</label>
                                    </td>
                                    <td>  <input  class="form-control formatComma" type="text"  id="creditAmount">
                                        <label class="has-error" for="creditAmount" id="creditAmount_error">Either Debit or Credit required</label>
                                    </td>
                                    <td> <input  class="form-control" type="text" name="chequeNo" id="chequeNo"></td>

                                </tr>
                            </tbody>
                        </table>
                    </div>



                    <!--********************************our main table
closed ************************************** -->

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
                                    <td  class="b" colspan="2"><b>Descrption</b></td>
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
                                <td colspan="7"><b>Difference in Debit
                                        and Credit Amount</b></td>
                                <td><input  id="debitGreater"
                                            class="form-control text-center" type="text" value="0.0"  readonly
                                            /></td>
                                <td><input  id="creditGreater"
                                            class="form-control text-center"  type="text" value="0.0"  readonly
                                            /></td>
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
                                <label for="comment"><b>Detailed
                                        Comment</b></label>
                                <textarea class="form-control"
                                          rows="5" style="resize:none" id="comment" name="comment"></textarea>
                                <label class="has-error" for="comment"
                                       id="comment_error">This field is required.</label>
                            </div>
                        </div>

                        <div class="col-md-5 col-md-offset-1" >
                            <div class="form-group">
                                <label for="summary"><b>Summary
                                        Comment</b></label>
                                <textarea class="form-control"
                                          rows="5" style="resize:none" id="summary"  name="summary"></textarea>
                                <label class="has-error" for="summary"
                                       id="summary_error">This field is required.</label>
                            </div>
                        </div>



                    </div>

                    <div class="row">

                        <div class="lastButton">
                            <button name="journalEntry"
                                    id="submitTheForm" onClick="sendAllJounalTransactionToServer()"
                                    class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;"
                                    value="Submit">Submit</button>

                            <span onclick="clearformTable()"
                                  class="btn btn-success btn-lg" style=" margin-left: 3px;
                                  width:100px;">Reset</span>

                            <button name="journalEntry"
                                    id="previewForm" class="btn btn-success btn-lg" style=" margin-left:
                                    3px; width:100px;" value="Preview">Preview</button>
                        </div>

                    </div>
                </div>
                <br>
                <br>
                <br>
            </div>
            </form>

            <style>
                #totalDebit, #totalCredit, #debitGreater,
                #creditGreater{color: red;}
            </style>
