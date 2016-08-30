<script>
function changeFunc() {
var selectBox = document.getElementById("programsList");
var selectedValue = selectBox.options[selectBox.selectedIndex].value;
var dataString = 'pId=' + selectedValue;

$.ajax({
type: "POST",
url: "<?php echo base_url() . 'transaction/get_subledgers'; ?>",
data: dataString,
success: function (msg)
{

$('#subLedgerList').html(msg);
}
});
}

$(document).ready(function () {
// iput is disable at first()

//$("#comment").css('display',"none");
$("#comment,#summery").attr("disabled", true); 
//$("#summery").css('display',"none");

$("#submitTheForm").prop('disabled', true);


// add the transaction begin

$("#addTransaction").click(function () {
var view;
var debit = document.getElementById("tranType").options[document.getElementById("tranType").selectedIndex].value;
var program = document.getElementById("programsList").options[document.getElementById("programsList").selectedIndex].text;
var subLedger = document.getElementById("subLedgerList").options[document.getElementById("subLedgerList").selectedIndex].value;
var ledgerType = document.getElementById("ledgerType").options[document.getElementById("ledgerType").selectedIndex].value;
var description = $('#description').val();
var amount = $('#amount').val();
var chequeNo = $('#chequeNo').val();


if (debit == 'Dr') {
view = '<tr><td>' + debit + '</td><td>' + program + '</td>' +
'<td>' + ledgerType + '</td><td>' + description + '</td>' +
'<td>' + subLedger + '</td><td>' + amount + '</td>' +
'<td>0.000</td>' +
'<td>' + chequeNo + '</td>' +
'<td><button type="text" class="btn btn-default">Add</button> / <button type="text" class="btn btn-default">Edit</button></td></tr>';
var a = parseInt($("#totalDebit").text());
var total = a + parseInt(amount);
$("#totalDebit").html(total); 
}
if (debit == 'Cr') {
view = '<tr><td>' + debit + '</td><td>' + program + '</td>' +
'<td>' + ledgerType + '</td><td>' + description + '</td>' +
'<td>' + subLedger + '</td><td>0.000</td>' +
'<td>' + amount + '</td>' +
'<td>' + chequeNo + '</td>' +
'<td><button type="text" class="btn btn-default">Add</button> / <button type="text" class="btn btn-default">Edit</button></td></tr>';
var a = parseInt($("#totalCredit").text());
var total = a + parseInt(amount);
$("#totalCredit").html(total); 
}

$("table tbody#lastId").prepend(view);
});

});
</script>








<div id="page-wrapper">

    <div class="graphs">
        <h3 class="blank1">Journal Entry Form</h3>
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

            <style>

                .width100 {
                    width:120px;
                }

                .table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
                    padding: 5px !important;
                   }
                    .tablee td, .tablee th {border:1px solid black;
                }

                .table th {

                    width:150px;
                }
                #page-wrapper {
                    background-color: #fff;
                }
                .table td {
                    text-align: center;
                }
                .lastButton {
                    text-align: center;
                    margin:0 auto;
                }
                 .col-md-4 {
                    width: 31.333%;
                 }
                 .b{
                    text-align: center;
                 }
                 .col-sm-8{
                    width: 21%;
                 }
            </style>
            <div class="form-group" >
                <div class="row">
                    <div class="col-md-4 ">
                        <table class="table">
                            <tr>
                             <td for="focusedInput"><b>Journal no</b></td>
                                <td><input class="form-control"id="focusedInput" type="text"></td>

                            </tr>
                            <tr>

                                <td class="text-right width100"><b>Date</b></td>
                                <td><input class="form-control" type="text" placeholder="Day/Month/Year"></td>


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
                                <td><input  class="form-control" type="text"></td>

                            </tr>
                            <tr>

                                <td class="text-right width100"><b>Bank Balance:-</b></td>
                                <td class="b"><strong style="color:red;">Rs. 0,00,000/-</strong></td>


                            </tr>
                        </table>
                    </div>

                </div>


                <div class="table-responsive">
                    <table class="tablee">
                    <tbody>
                       
                            <tr>
                                <td  class="b"><b>Dr.|Cr.</b></td>
                                <td  class="b"><b>A/C Head</b></td>
                                <td  class="b"><b>Sub-Ledger</b></td>
                                <td  class="b"><b>Ledger type</b></td>
                                <td  class="b"><b>Descrption</b></td>
                                <td  class="b"><b>Amount</b></td>
                                <td  class="b"><b>Cheque number</b></td>
                                 <td rowspan="2"  class="b"><div class="lastButton">
                                                <button class="btn btn-success btn-lg" style=" margin-left: 3px; margin-top: -4px; width:100px;">Add</button></td>
                                
                            </tr>
                       

                        
                            <tr>
                                <td >
                                    <select class="form-control" id="tranType">
                                        <option value="Dr">Debit</option>
                                        <option value="Cr">Credit</option>
                                    </select>
                                </td>

                                <td>
                                    <select class="form-control" id="programsList" onchange="changeFunc();">
                                        <option value="0">Select Program</option>
                                        <?php
                                        if (!empty($program_list)) {
                                            foreach ($program_list as $plists) {
                                                ?>

                                                <option value="<?php echo $plists->id; ?>"><?php echo $plists->program_name; ?></option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </td>
                                <td >
                                    <select class="form-control" id="subLedgerList">
                                        <option>Select Subledger</option> 
                                    </select>
                                </td>
                                <td>
                                    <select class="form-control" id="ledgerType">
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                    </select>
                                </td>
                                <td >
                                    <input  class="form-control" type="text" name="description" id="description">
                                </td>
                                <td >
                                    <input  class="form-control" type="text" name="amount" id="amount">
                                </td>
                                <td>
                                    <input  class="form-control" type="text" name="chequeNo" id="chequeNo">
                                </td>
                               

                            </tr>

                        </tbody>
                    </table>
                </div> 

            </div>
            <br>
            <div class="container">

                <div class="table-responsive">
                    <table class="tablee" width="100%">
                        <thead>
                            <tr>
                                <td class="b"><b>Dr.|Cr.</b></td>
                                <td class="b"><b>Account Head</b></td>
                                <td class="b"><b>Ledger type</b></td>
                                <td class="b"><b>Descrption</b></td>
                                <td class="b"><b>SubLedger</b></td>
                                <td class="b"><b>Debit Amt.</b></td>
                                <td class="b"><b>Credit Amt.</b></td>
                                <td class="b"><b>Cheque number</b></td>
                                <td class="b"><b>Action</b></td>
                            </tr>
                        </thead>
                        <tbody id="lastId">
                            
                           

                            <tr>
                                <td colspan="5"><b>Total Amount</b></td>
                                <td id="totalDebit" class="b">0</td>
                                <td id="totalCredit" class="b">0</td>
                                <td colspan="2"></td>

                            </tr>

                            <tr>
                                <td colspan="5"><b>Difference in Debit and Credit Amount</b></td>
                                <td id="debitGreater" class="b">0.00</td>
                                <td id="creditGreater" class="b">0.00</td>
                                <td colspan="2"></td>

                            </tr>
                        </tbody>
                    </table>
                </div> 
                <br>
                <br>

                <div class="row">

                    <div class="col-md-5 col-md-offset-1" >
                        <div class="form-group">
                            <label for="comment"><b>Detailed Comment</b></label>
                            <textarea class="form-control" rows="5" style="resize:none" id="comment"></textarea>
                        </div>
                    </div>

                    <div class="col-md-5 col-md-offset-1" >
                        <div class="form-group">
                            <label for="comment"><b>Summary Comment</b></label>
                            <textarea class="form-control" rows="5" style="resize:none" id="comment"></textarea>
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
                             <button class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Submit</button>
                      
                            <button class="btn btn-success btn-lg" style=" margin-left: 3px; width:100px;">Add</button>
                                                </div>

                    </div>
                 </div>
                 <br>
                 <br>
                 <br>  
            </div>

            <style>
                #totalDebit, #totalCredit, #debitGreater, #creditGreater{color: red;}
            </style>

