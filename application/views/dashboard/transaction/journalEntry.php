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
           <div class="invalid">
							 <?php
            $flashMessage = $this->session->flashdata('flashMessage');
            if (!empty($flashMessage)) {               
                 echo $flashMessage;
            }          
            if (isset($error)) {
                echo $error;
            }
            ?>
						</div>
            <?php echo form_open_multipart('transaction/glTransaction', array('id' =>'glTrans', 'class' => 'form-horizontal', 'novalidate' =>'novalidate')); ?>
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
                                    <input type="text" id="nepaliDate" class="form-control nepali-calendar" name="datepicker" value="" placeholder="YYYY-MM-DD"/>
                                    <input type="hidden" id="englishDate" name="englishDate"/>
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
                                <tr style="background:#ebebe0;">
                                    <td class="col-md-1"><b>Account Code</b></td>
                                    <td class="col-md-1"><b>A/C Head</b></td>
                                    <td class="col-md-1"><b>Sub-Ledger</b></td>
                                    <td class="col-md-1"><b>Donar-list</b></td>
                                    <td class="col-md-1"><b>Ledger type</b></td>
                                    <td class="col-md-1"><b>Description</b></td>
                                    <td class="col-md-1"><b>Debit</b></td>
                                    <td class="col-md-1"><b>Credit</b></td>
                                    <td class="col-md-1"><b>Cheque number</b></td>
                                    <td class="col-md-1"><b>Action</b></td>
                                    
                                </tr>
                                 <!--  working on the object starts -->

                                
                            
                                <!--   working on object is closed      -->
                            
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

                                    <td rowspan="1"  class="b" id="toggleButton">
                                        <span class="btn btn-success" id="submitCurrentData" onClick="addData()" style="padding:5px;margin:5px;width:70px;font-size:18px;">Add</span></td>

                                </tr>


                              <tbody id="workingWithObjectData">

                            <tr id="addArrayData">

                            </tr>
                            </tbody>




                                <tr>
                                <td colspan="6"><b>Total Amount</b></td>
                                <td id="totalDebit" class="b">0</td>
                                <td id="totalCredit" class="b">0</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>

                                

                            </tr>

                            <tr>
                                <td colspan="6"><b>Difference in Debit
                                        and Credit Amount</b></td>
                                <td><input  id="debitGreater"
                                            class="form-control text-center" type="text" value="0.0"  readonly
                                            /></td>
                                <td><input  id="creditGreater"
                                            class="form-control text-center"  type="text" value="0.0"  readonly
                                            /></td>
                               
                               <td>&nbsp;</td>
                                <td>&nbsp;</td>

                            </tr>

                                </tbody>

                                
                                
                                </table>


                                <br/>
                                <br/>

                                <div class="table-responsive">
                        <table class="tablee" width="100%">
                        
                             
                            <tr id="addArrayData">

                            </tr>

                        </table>
                    
                       
                    </div>



                    <!--********************************our main table
closed ************************************** -->

                </div>
                
                <div class="container">


                    <!--  working on the object starts -->
                    

                    <!--   working on object is closed      -->

                    <div class="row">

                        <div class="col-md-12" >
                            <div class="form-group">
                                <label for="comment"><b>Detailed Comment (Narration)</b></label>
                                <textarea class="form-control" rows="2" style="resize:none" id="comment" name="comment"><?php echo set_value('comment'); ?></textarea>
                                <label class="has-error" for="comment" id="comment_error">This field is required.</label>
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
        </div>
         </div>
     </div>

<!--<script>
    (function($) {
    $.postconfirm = {};
    $.postconfirm.locales = {};
    $.postconfirm.locales.ptBR = {
        title: 'Esta certo disto?',
        text: 'Esta certo que quer realmente ?',
        button: ['Cancela', 'Confirma'],
        closeText: 'fecha'
    };
    $.fn.postconfirm = function(options) {
        var options = jQuery.extend({
            eventType: 'click',
            icon: 'help'
        }, options);
        var locale = jQuery.extend({}, $.postconfirm.locales.ptBR, options.locale);
        var type = options.eventType;
        return this.each(function() {
            var target = this;
            var $target = jQuery(target);
            var getDlgDv = function() {
                var dlger = (options.dialog === undefined || typeof(options.dialog) != 'object');
                var dlgdv = $('<div class="dialog confirm">' + locale.text + '</div>');         
                return dlger ? dlgdv : options.dialog;          
            }           
            var dialog = getDlgDv();
            var handler = function(event) {
                    $(dialog).dialog('open');
                    event.stopImmediatePropagation();
                    event.preventDefault();
                    return false;
            };
            var init = function() 
            {
                $target.bind(type, handler); 
            };
            var buttons = {};
            buttons[locale.button[0]] = function() { $(dialog).dialog("close"); };
            buttons[locale.button[1]] = function() {
                $(dialog).dialog("close");
                alert('1');
                $target.unbind(type, handler);
                $target.click();
                $target.attr("disabled", true);
            };            
            $(dialog).dialog({
                autoOpen: false,
                resizable: false,
                draggable: true,
                closeOnEscape: true,
                width: 'auto',
                minHeight: 120,
                maxHeight: 200,
                buttons: buttons,
                title: locale.title,
                closeText: locale.closeText,
                modal: true
            });
            init();
        });
        var _attr = $.fn.attr;
        $.fn.attr = function(attr, value) {
            var returned = _attr.apply(this, arguments);
            if (attr == 'title' && returned === undefined) 
            {
                returned = '';
            }
            return returned;
        };
    };
})(jQuery);
    </script>-->
    
<!--    <script type="text/javascript">     
        $(document).ready(function () {
            $("#previewForm").postconfirm({ locale: {
                        title: 'Critical Action',
                        text: 'Are you sure to submit and publish journal entry',
                        button: ['Cancel', 'Confirm'],
                        closeText: 'X'
                    }
                });
        });
    </script>-->