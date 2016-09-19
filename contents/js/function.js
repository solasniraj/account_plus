
var debitCreditDifference = "";
var debitTotal = 0;
var creditTotal = 0;
var dateToday = new Date();
var output = "";
var allInsertItemsinVouture = [];
var objectToStroCurrentData;
var incrementCounterForItem = 0;
var viewToDisplayInTable = '';
var myCustomViewToEnter = '';
var AddToJournalList = true;
var edittheJournalItems = false;
var reqiureTotriggerwhenUpdateisDone = '';

function  getAccountLedger(selectedType)
{
    reqiureTotriggerwhenUpdateisDone = selectedType;
    var index = selectedType.selectedIndex;
    var typeValue = selectedType.options[index].value;
    $.ajax({
        type: "POST",
        url: baseUrl + "transaction/getAssociatedLedger",
        data: {charClassId: typeValue},
        success: function (msg)
        {
            var msg = $.parseJSON(msg);
            if (msg.ledger) {
                $('#accountList').html(msg.ledger);
            }
            if (msg.subLedger) {
                $('#subLedgerList').html(msg.subLedger);
            }
            if (msg.donor) {
                $('#donerList').html(msg.donor);
            }
            if (msg.ledgerType) {
                $('#ledgerType').html(msg.ledgerType);
            }
        },
        error: function ()
        { }
    });

}

function  getSubLedger(selectedType)
{


    var cId = $('#journalType').val();
    var account = $('#accountList').val();

    $.ajax({
        type: "POST",
        url: baseUrl + "transaction/getAssociatedSubLedger",
        data: {chartId: cId, programmId: account},
        success: function (msg)
        {
            var msg = $.parseJSON(msg);
            if (msg.subLedger) {
                $('#subLedgerList').html(msg.subLedger);
            }
            if (msg.donor) {
                $('#donerList').html(msg.donor);
            }
            if (msg.ledgerType) {
                $('#ledgerType').html(msg.ledgerType);
            }
            $('#lMCode').val(cId + account + '000000');

        },
        error: function ()
        { }
    });

}

function getDonor()
{
    var cId = $('#journalType').val();
    var account = $('#accountList').val();
    var subLedger = $('#subLedgerList').val();

    $.ajax({
        type: "POST",
        url: baseUrl + "transaction/getAssociatedDonor",
        data: {chartId: cId, programmId: account, subLedger: subLedger},
        success: function (msg)
        {
            var msg = $.parseJSON(msg);
            if (msg.donor) {
                $('#donerList').html(msg.donor);
            }
            if (msg.ledgerType) {
                $('#ledgerType').html(msg.ledgerType);
            }
            $('#lMCode').val(cId + account + subLedger + '0000');

        },
        error: function ()
        { }
    });
}

function getledgerType()
{
    var cId = $('#journalType').val();
    var account = $('#accountList').val();
    var subLedger = $('#subLedgerList').val();
    var donar = $('#donerList').val();

    $.ajax({
        type: "POST",
        url: baseUrl + "transaction/getAssociatedLedgerType",
        data: {chartId: cId, programmId: account, subLedger: subLedger, donar: donar},
        success: function (msg)
        {
            var msg = $.parseJSON(msg);
            if (msg.ledgerType) {
                $('#ledgerType').html(msg.ledgerType);
            }
            $('#lMCode').val(cId + account + subLedger + donar + '00');

        },
        error: function ()
        { }
    });
}

function updateCode()
{
    var cId = $('#journalType').val();
    var account = $('#accountList').val();
    var subLedger = $('#subLedgerList').val();
    var donar = $('#donerList').val();
    var ledgerType = $('#ledgerType').val();
    $('#lMCode').val(cId + account + subLedger + donar + ledgerType);
}



function numberWithCommas(x)
{

    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function numberWithOutCommas(x)
{
    if (x.toString().length <= 3)
    {

        return  parseInt(x);
    } else
    {
        var withoutComma = x.replace(/[^0-9]/g, '');
        return parseInt(withoutComma);
    }
}

function checkDiffernceBetDebitAndCredit()
{

    var d = numberWithOutCommas(debitTotal);
    var b = numberWithOutCommas(creditTotal);
    if (d == b)
    {
        debitCreditDifference = 0;
        activateCommentAndSummerField("activate");
        $("#creditGreater").val(0);
        $("#debitGreater").val(0);

    } else if (d > b)
    {

        debitCreditDifference = numberWithCommas(d - b);
        $("#debitGreater").val(debitCreditDifference);
        $("#creditGreater").val(0);
        activateCommentAndSummerField("notActivate");
    } else
    {
        debitCreditDifference = numberWithCommas(b - d);
        $("#debitGreater").val(0.0);
        $("#creditGreater").val(debitCreditDifference);
        activateCommentAndSummerField("adctivate");

    }

}

function activateCommentAndSummerField(type)
{

    if (type == "activate")
    {

        $("#comment,#summary").attr("disabled", false);
        $("#submitTheForm").prop('disabled', false);
        $("#previewForm").prop('disabled', false);
    } else
    {
        $("#comment,#summary").attr("disabled", true);
        $("#submitTheForm").prop('disabled', true);
        $("#previewForm").prop('disabled', true);
    }
}

// from here code has been updated

function journal()
{
    var chartId = $('#journalType').val();
    var f = chartId.length;
    if (f < 1 || chartId == '' || chartId == null || chartId == '0') {
        $("#journalType").focus();
        $("label#journalType_error").show();
        $("#journalType").css("border", "1px solid red");
        return false;
    } else {
        $("label#journalType_error").hide();
        $("#journalType").css("border", "1px solid green");
        return true;
    }

}


function account()
{
    var accountId = $('#accountList').val();
    var e = accountId.length;
    if (e < 1 || accountId == '' || accountId == null || accountId == '00')
    {
        $("#accountList").focus();
        $("label#acchead_error").show();
        $("#accountList").css("border", "1px solid red");
        return false;
    } else {
        $("label#acchead_error").hide();
        $("#accountList").css("border", "1px solid green");
        return true;
    }
}


function subLedgerf()
{
    var subLedger = $('#subLedgerList').val();
    var p = subLedger.length;
    if (p == 00 || subLedger == '')
    {
        $("#subLedgerList").focus();
        return false;
    } else {
        $("#subLedgerList").css("border", "1px solid green");
        return true;
    }
}
function donorListf()
{
    var donar = $('#donerList').val();
    var m = donar.length;
    if (m == 00 || donar == '')
    {
        $("#donerList").focus();
        return false;
    } else {
        $("#donerList").css("border", "1px solid green");
        return true;
    }
}

function ledgerTypef()
{
    var ledgerType = $('#ledgerType').val();
    var lt = ledgerType.length;
    if (lt == 00 || ledgerType == '')
    {
        $("#ledgerType").focus();
        return false;
    } else {
        $("#ledgerType").css("border", "1px solid green");
        return true;
    }
}

function Desc()
{
    var description = $('#description').val();
    var dsc = description.length;
    if (dsc == 00 || description == '')
    {
        $("#description").focus();
        $("label#description_error").show();
        $("#description").css("border", "1px solid red");
        return false;
    } else {
        $("label#description_error").hide();
        $("#description").css("border", "1px solid green");
        return true;
    }
}

function ledMCode()
{
    var lMCode = $("#lMCode").val();
    var lMlen = lMCode.length;
if(lMlen < 10 || lMCode == '' ){
     $("#lMCode").focus();
                $("label#accCode_error").show();
                $('#lMCode').css("border", "1px solid red");
                return false;
} else{
    $.ajax({
        type: "POST",
        url: baseUrl + "transaction/checkLedgerMasterCode",
        data: {lmCode: lMCode},
        success: function (msg)
        {
            var msg = $.parseJSON(msg);
            if (msg.code == 'false') {
                $("#lMCode").focus();
                $("label#accCode_error").hide();
                $("label#accCodeMis_error").show();
                $('#lMCode').css("border", "1px solid red");
                return false;
            } else {
                $("label#accCode_error").hide();
                $("#lMCode").css("border", "1px solid green");
                return true;
            }
        },
        error: function ()
        { }
    });
    }
}

function clearformTable()
{
    viewToDisplayInTable = "";
    myCustomViewToEnter = "";
    $("#workingWithObjectData").html("");
    $("#glTrans")[0].reset();
    $("#totalDebit").html("0.0");
    $("#totalCredit").html("0.0");
    debitCreditDifference = 0;
    activateCommentAndSummerField("deactivate");
    $("#creditGreater").val(0);
    $("#debitGreater").val(0);
    objectToStroCurrentData = [];
}

function drcr()
{
   var debitAmount = $('#debitAmount').val();
    var creditAmount = $('#creditAmount').val();
    if (debitAmount && creditAmount)
    {
        $("#donerList").focus();
        return false;
    } else {
        $("#donerList").css("border", "1px solid green");
        return true;
    }
}


// till here goes the updated code for program


function  addData()
{
    var chartId = $('#journalType').val();
    var lMCode = $("#lMCode").val();
    var accountId = $('#accountList').val();
    var subLedger = $('#subLedgerList').val();
    var donar = $('#donerList').val();
    var ledgerType = $('#ledgerType').val();
    var description = $('#description').val();
    var debitAmount = $('#debitAmount').val();
    var creditAmount = $('#creditAmount').val();
    var chequeNo = $('#chequeNo').val();
    //$("#glTrans")[0].reset();
    
    if (journal() == false)
    {
        $("#journalType").focus();
    } else if (ledMCode() == false)
    {
        $("#lMCode").focus();
    } else if (account() == false)
    {
        $("#accountList").focus();
    } else if (subLedgerf() == false)
    {
        $("#subLedgerList").focus();
    } else if (donorListf() == false)
    {
        $("#donerList").focus();
    } else if (ledgerTypef() == false)
    {
        $("#ledgerType").focus();
    } else if (Desc() == false)
    {
        $("#description").focus();
    }else if (drcr() == false)
    {
        $("#debitAmount").focus();
    }else if ((debitAmount && (creditAmount == null || creditAmount == "")))
    {
        var debitInsertValue = debitAmount;
        creditInsertValue = 0;
        objectToStroCurrentData =
                {
                    indexNumber: incrementCounterForItem,
                    chartCode: chartId,
                    lMCode: lMCode,
                    accCode: accountId,
                    type: 'dr',
                    subLedger_id: subLedger,
                    donar_id: donar,
                    ledgerType: ledgerType,
                    description: description,
                    debitAmount: debitInsertValue,
                    creditAmount: creditInsertValue,
                    chequeNo: chequeNo
                };
        incrementCounterForItem++;
        if (typeof (index) == 'undefined' || index === null){
            allInsertItemsinVouture.push(objectToStroCurrentData);
            viewTheItemsInArray();
            var msg = '<div class="alert alert-success fade in text-center text-justified"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction Added succesfully</div>';
            $('#errorMessages').html(msg);
            hideMessages();
        } else
        {
            allInsertItemsinVouture.splice(index, 1, objectToStroCurrentData);
            viewTheItemsInArray();
        }

        $("#glTrans")[0].reset();
        objectToStroCurrentData = {};

    } else if ((creditAmount && (debitAmount == null || debitAmount == "")))
    {
        var creditInsertValue = creditAmount;
        debitInsertValue = 0;
        objectToStroCurrentData =
                {
                    indexNumber: incrementCounterForItem,
                    chartCode: chartId,
                    lMCode: lMCode,
                    accCode: accountId,
                    type: 'dr',
                    subLedger_id: subLedger,
                    donar_id: donar,
                    ledgerType: ledgerType,
                    description: description,
                    debitAmount: debitInsertValue,
                    creditAmount: creditInsertValue,
                    chequeNo: chequeNo
                };

        incrementCounterForItem++;
        if (typeof (index) == 'undefined' || index === null){
            allInsertItemsinVouture.push(objectToStroCurrentData);
            viewTheItemsInArray();
            var msg = '<div class="alert alert-success fade in text-center text-justified"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>Transaction Added succesfully</div>';
            $('#errorMessages').html(msg);
            hideMessages();
        } else
        {
            allInsertItemsinVouture.splice(index, 1, objectToStroCurrentData);
            viewTheItemsInArray();
        }
       $("#glTrans")[0].reset();
        objectToStroCurrentData = {};
    } else
    {
        var msg = '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Plese Enter Either Debit Amount OR Credit Amount</div>';
        $('#errorMessages').html(msg);
        hideMessages();
    }
}


function viewTheItemsInArray()
{
    if (allInsertItemsinVouture.length > 0)
    {
        viewToDisplayInTable = "";
        myCustomViewToEnter = "";
        for (var i = 0; i < allInsertItemsinVouture.length; i++)
        {

            var objestToLoop = allInsertItemsinVouture[i];
            var lMCode = objestToLoop.lMCode;
            var program = objestToLoop.programName;
            var accCode = objestToLoop.accCode;
            var subLedger_id = objestToLoop.subLedger_id;
            if (subLedger_id)
            {
            } else
            {

                subLedger_id = '';
            }

            var donar = objestToLoop.donarName;
            var donar_id = objestToLoop.donar_id;

            if (donar_id)
            {
            } else
            {
                donar_id = '';
            }


            var ledgerType = objestToLoop.ledgerType;

            if (ledgerType)
            {
            } else
            {
                ledgerType = '';
            }
            var description = objestToLoop.description;
            var chequeNo = objestToLoop.chequeNo;

            if (chequeNo)
            {
            } else
            {
                chequeNo = '';

            }
            var debitAmount = objestToLoop.debitAmount;
            if (debitAmount)
            {
            } else
            {
                debitAmount = 0;
            }

            var creditAmount = objestToLoop.creditAmount;
            if (creditAmount)
            {
            } else
            {
                creditAmount = 0;

            }

            myCustomViewToEnter = '<tr>' +
                    '<td>' + lMCode + '</td>' +
                    '<td>' + accCode + '</td>' +
                    '<td>' + subLedger_id + '</td>' +
                    '<td>' + donar_id + '</td>' +
                    '<td>' + ledgerType + '</td>' +
                    '<td colspan="2">' + description + '</td>' +
                    '<td>' + debitAmount + '</td>' +
                    '<td>' + creditAmount + '</td>' +
                    '<td>' + chequeNo + '</td>' +
                    '<td colspan="2" style="width:200px" ><span type="text" onClick="editItmInTheArray(' + i + ')' + '"' + 'class="btn btn-success btn-sm" style="">Edit</span> / <span type="text" onClick="delteItemFromArray(' + i + ')' + '"' + 'class="btn btn-danger btn-sm">Delete</span></td></tr>';

            viewToDisplayInTable = viewToDisplayInTable + myCustomViewToEnter;
            debitTotal = numberWithCommas(numberWithOutCommas(debitTotal) + numberWithOutCommas(debitAmount));
            creditTotal = numberWithCommas(numberWithOutCommas(creditTotal) + numberWithOutCommas(creditAmount));
        }


        $("#workingWithObjectData").html(viewToDisplayInTable);
        $("#totalDebit").html(debitTotal);
        $("#totalCredit").html(creditTotal);
        checkDiffernceBetDebitAndCredit();
        viewToDisplayInTable = "";
        myCustomViewToEnter = "";
        debitTotal = 0;
        creditTotal = 0;


    } else
    {
        viewToDisplayInTable = "";
        myCustomViewToEnter = "";
        $("#workingWithObjectData").html("");
        debitTotal = 0;
        creditTotal = 0;
        $("#totalDebit").html(debitTotal);
        $("#totalCredit").html(creditTotal);
        debitCreditDifference = 0;
        activateCommentAndSummerField("activate");
        $("#creditGreater").val(0);
        $("#debitGreater").val(0);
    }

}

function delteItemFromArray(index)
{
    var confirmUser = confirm("!!Are you sure to Delete this transaction");
    if (confirmUser)
    {
        allInsertItemsinVouture.splice(index, 1);
        viewToDisplayInTable = "";
        myCustomViewToEnter = "";
        $("#workingWithObjectData").html("");
        viewTheItemsInArray();
    }

}



function editItmInTheArray(index)
{

    var objectAtPaticularIndex = allInsertItemsinVouture[index];
    pCode = objectAtPaticularIndex.pCode;
    $('#programmCode').html('<input type="text" id="pCode" class="form-control" value="' + pCode + '"' + 'readonly />');
    program = objectAtPaticularIndex.programName;
    program_id = objectAtPaticularIndex.program_id;
    $('#programsList').html('<option  value="' + program_id + '">' + program + '</option>');
    subLedger = objectAtPaticularIndex.subLedgerName;
    subLedger_id = objectAtPaticularIndex.subLedger_id;
    if (subLedger && subLedger_id)
    {
        $('#subLedgerList').html('<option  value="' + subLedger_id + '">' + subLedger + '</option>');
    } else
    {
        $('#subLedgerList').html('<option  value=""></option>');
    }


    donar = objectAtPaticularIndex.donarName;
    donar_id = objectAtPaticularIndex.donar_id;

    if (donar && donar_id)
    {

        $('#donerList').html('<option  value="' + donar_id + '">' + donar + '</option>');

    } else
    {
        $('#donerList').html('<option  value=""></option>');
    }

    ledgerType = objectAtPaticularIndex.ledgerType;

    if (ledgerType)
    {
        $('#ledgerType').html('<option  value="' + ledgerType + '">' + ledgerType + '</option>');
    } else
    {
        $('#ledgerType').html('<option  value=""></option>');
    }
    description = objectAtPaticularIndex.description;
    $('#description').val(description);
    chequeNo = objectAtPaticularIndex.chequeNo;
    if (chequeNo)
    {

        $('#chequeNo').val(chequeNo);

    } else
    {
        chequeNo = '';

    }
    var debitAmount = objectAtPaticularIndex.debitAmount;
    if (debitAmount)
    {
        $('#debitAmount').val(debitAmount);
        $('#creditAmount').val('');
    } else
    {
        debitAmount = '';
    }

    var creditAmount = objectAtPaticularIndex.creditAmount;
    if (creditAmount)
    {

        $('#creditAmount').val(creditAmount);
        $('#debitAmount').val('');

    } else
    {
        creditAmount = '';

    }

    $("#toggleButton").html('<span   onClick="updateTheItemInTheArray(' + index + ')' + '"' + 'class="btn btn-success "   style=" padding:5px;margin:5px;width:70px;font-size:18px;">Update</span></td>');
}

function updateTheItemInTheArray(index)
{

    ProcessDataandInsertIntoArray(index);
    $("#toggleButton").html('<span   onClick=" ProcessDataandInsertIntoArray()" class="btn btn-success "   style=" padding:5px;margin:5px;width:70px;font-size:18px;">Add</span></td>');
    whenJournalTypeIsSelected(reqiureTotriggerwhenUpdateisDone);

}

function hideMessages() {

}

$(document).ready(function ()
{
    $('#glTrans').submit(function () {

        if ($.trim($("#journalNo").val()) === "" || $.trim($("#datepicker").val()) === "" || $.trim($("#journalType").val()) === "" || $.trim($("#comment").val()) === "" || $.trim($("#summary").val()) === "") {
            var msg = '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error !</strong> Plese fill all fields properly</div>';
            $('#errorMessages').html(msg);
            hideMessages();

        } else {

            var JSONObject = JSON.stringify(allInsertItemsinVouture);
            var input = $("<input>")
                    .attr("type", "hidden")
                    .attr("name", "mydata").attr("id", "myDataInp").val(JSONObject);
            $('#glTrans').append($(input));
            $('#glTrans').submit();
        }
    });


    activateCommentAndSummerField("deactivate");
    $('input.formatComma').keyup(function (e) {
        var price = $(this).val();
        var regex = /^[0-9.,]+$/;
        if (this.value != '-')
            while (isNaN(this.value))
                this.value = this.value.split('').reverse().join('').replace(/[\D]/i, '')
                        .split('').reverse().join('');

        if (regex.test(price))
        {
            $(this).val(function (index, value)
            {
                value = value.replace(/,/g, '');
                return numberWithCommas(value);
            });
        }
    })
            .on("cut copy paste", function (e) {
                e.preventDefault();
            });

});

$(function () {
    $("#datepicker").datepicker({
        maxDate: dateToday,
        dateFormat: 'mm/dd/yy',
        timeFormat: 'hh:mm tt',
        dateonly: true

    });
});