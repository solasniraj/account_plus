<script>

    // function changeFunc() {
    //     var selectBox = document.getElementById("programsList");
    //     var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    //     var dataString = 'pId=' + selectedValue;

    //     $.ajax({
    //         type: "POST",
    //         url: "<?php echo base_url() . 'transaction/get_subledgers'; ?>",
    //         data: dataString,
    //         success: function (msg)
    //         {

    //             $('#subLedgerList').html(msg);
    //         }
    //     });
    // }

    // *************sanoj code starts ******************************

    var debitCreditDifference="";
    var DebitTotal="";
    var creditTotal="";

 function  whenJournalTypeIsSelected(selectedType)
  {
      
     var index = selectedType.selectedIndex;      // get the index of the selected option  
     var typeValue= selectedType.options[index].value;  // get the value of the selected option 
        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'transaction/getProgrammListForCurrentChartName'; ?>",
            data: {charClassId:typeValue},
            success: function (msg)
            {

                $('#programsList').html(msg);
            },
             error: function()
            {

             console.log("error occur");

             }
        });


   

  }


   function  whenProgramIsSelected(selectedType)
  {
      
     var index = selectedType.selectedIndex;      // get the index of the selected option  
     var typeValue= selectedType.options[index].value;  // get the value of the selected option  

        $.ajax({
            type: "POST",
            url: "<?php echo base_url() . 'transaction/getProgrammcodeForCurrentId'; ?>",
            data: {programmId:typeValue},
            success: function (msg)
            {

                $('#programmCode').html(msg);
            },
             error: function()
            {

             console.log("error occur");

             }
        });

  }

  function validateDebit() 
  {
     var me=$("#debitAmount").val();
      if(!isNaN(me))
     {
      $('.debitError').css({"border":"1px solid #fff"});
      }
      else 
      {
        $('.debitError').css({"border":"1px solid red"});
      }
    
  } 

 function validateCrdit(evt) 
  {
       var me=$("#creditAmount").val();
      if(!isNaN(me))
     {
      $('.creditError').css({"border":"1px solid #fff"});
      }
      else 
      {
        $('.creditError').css({"border":"1px solid red"});
      }
    
}


function checkDiffernceBetDebitAndCredit($debitAmount,$creditAmount)
{
 if($debitAmount == $creditAmount)
  {
   debitCreditDifference=0.0;
  }
  else  if($debitAmount >$creditAmount)
 {

    debitCreditDifference=$debitAmount -$creditAmount;
    $("#debitGreater").val(debitCreditDifference);
    $("#creditGreater").val(0.0);
    console.log("debit is greater");

 }
 else
 {
        debitCreditDifference=$creditAmount -$debitAmount;
       $("#debitGreater").val(0.0);
       $("#creditGreater").val(debitCreditDifference);
       console.log("crdit is greatrer");
 }

}




 // ************jquery code goes here function goes here*****************8

 $(document).ready(function ()  {

// comment and summery fild is disabled first()

$("#comment,#summery").attr("disabled", true); 
$("#submitTheForm").prop('disabled', true);

// ******* sanoj code inside jquery function ***************

$("#submitCurrentData").click(function(event)
{

    

    var view;
    var program = document.getElementById("programsList").options[document.getElementById("programsList").selectedIndex].value;
    var subLedger = document.getElementById("subLedgerList").options[document.getElementById("subLedgerList").selectedIndex].value;
    var ledgerType = document.getElementById("ledgerType").options[document.getElementById("ledgerType").selectedIndex].value;
    var description = $('#description').val();
    var debitAmount = $('#debitAmount').val();
    var creditAmount = $('#creditAmount').val();
    var chequeNo = $('#chequeNo').val();
    var pCode= $("#pCode").val();


 console.log("programm" + program + "subLedger" + subLedger + "ledgerType" + ledgerType +  "description" + description +  "chckno" + chequeNo + "pCode" +  pCode);


 if( (program == null || program == "") || (ledgerType == null || ledgerType == "")  || (description == null || description == "") ||  (chequeNo == null || chequeNo == "") || (pCode == null || pCode == ""))
 {

   var  msg= '<div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>plese enter all field</div>';
       $('#errorMessages').html(msg);
    return false;
       
 }
 else
 {
      var  msg='';
       $('#errorMessages').html(msg);
    

 }


    if(debitAmount && creditAmount)
    {
    
       var  msg= '<div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Either debit and crdit is required</div>';
       $('#errorMessages').html(msg);
      return false;
    }
    else if((debitAmount && (creditAmount == null || creditAmount == ""))) 
    {
       msg='';
      $('#errorMessages').html(msg);
      view='<tr>' +
        '<td>' + pCode + '</td>' +
        '<td>' + program + '</td>' +
        '<td>' + subLedger + '</td>' +
        '<td>' + ledgerType + '</td>' +
        '<td>' + description + '</td>' +
        '<td>' + debitAmount + '</td>' +
        '<td>' + 0.00 + '</td>' +
        '<td>' + chequeNo + '</td>' +
         '<td><button type="text" class="btn btn-default">Add</button> / <button type="text" class="btn btn-default">Edit</button></td></tr>';
         var a = parseInt($("#totalCredit").text());
         DebitTotal = a + parseInt(debitAmount);
         $("#totalDebit").html(DebitTotal); 
         $("table tbody#lastId").prepend(view);
           $('#programsList').html('<option value="">Select Program</option>');
     $('#subLedgerList').html('<option value="">select Ledger</option>');
 
   
     description = $('#description').val("");
     debitAmount = $('#debitAmount').val("");
     creditAmount = $('#creditAmount').val("");
     chequeNo = $('#chequeNo').val("");
     pCode= $("#pCode").val("");
    checkDiffernceBetDebitAndCredit(DebitTotal,creditTotal)

    }

    else if((creditAmount && (debitAmount == null || debitAmount == ""))) 
    {
       msg='';
      $('#errorMessages').html(msg);
      view='<tr>' +
        '<td>' + pCode + '</td>' +
        '<td>' + program + '</td>' +
        '<td>' + subLedger + '</td>' +
        '<td>' + ledgerType + '</td>' +
        '<td>' + description + '</td>' +
        '<td>' + 0.00 + '</td>' +
        '<td>' + creditAmount + '</td>' +
        '<td>' + chequeNo + '</td>' +
         '<td><button type="text" class="btn btn-default">Add</button> / <button type="text" class="btn btn-default">Edit</button></td></tr>';
         var a = parseInt($("#totalCredit").text());
         creditTotal = a + parseInt(creditAmount);
         $("#totalCredit").html(creditTotal); 
         $("table tbody#lastId").prepend(view);
     $('#programsList').html('<option value="">Select Program</option>');
     $('#subLedgerList').html('<option value="">select Ledger</option>');
    description = $('#description').val("");
    debitAmount = $('#debitAmount').val("");
     creditAmount = $('#creditAmount').val("");
     chequeNo = $('#chequeNo').val("");
     pCode= $("#pCode").val("");
    checkDiffernceBetDebitAndCredit(DebitTotal,creditTotal)

    }
    else 
    {     

        var  msg= '<div class="alert alert-warning fade in"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Either debit and crdit is required</div>';
        $('#errorMessages').html(msg);
        return false;
    }



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
                                    <td><input  type="text" class="form-control" value="<?php echo $journalNumber; ?>" readonly></td>

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
                                    <td>
                                    <select class="form-control" id="journalType" onchange="whenJournalTypeIsSelected(this)" >
                                    <option value=" ">Select Types</option>
                                    <?php foreach ($journalTypes as $value) { ?>
                                <option value="<?php echo $value->id; ?>"><?php echo $value->chart_class_name; ?></option> 
                                   <?php }  ?>
                                  </td>

                                </tr>
                                <tr>

                                    <td class="text-right width100"><b>Bank Balance: </b></td>
                                    <td class="b"><strong style="color:red;">Rs. 0,00,000/-</strong></td>


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

        <td  class="b"><b>Code#</b></td>
        <td  class="b"><b>A/C Head</b></td>
        <td  class="b"><b>Sub-Ledger</b></td>
        <td  class="b"><b>Ledger type</b></td>
        <td  class="b"><b>Descrption</b></td>
        <td  class="b"><b>Debit</b></td>
        <td  class="b"><b>Credit</b></td>
        <td  class="b"><b>Cheque number</b></td>
        <td rowspan="2"  class="b"><div class="lastButton">
        <button class="btn btn-success " id="submitCurrentData" style=" padding:5px;margin:5px;width:70px;font-size:18px;">Add</button></td>

</tr>


                                    
<tr>

       <td id="programmCode">
            <input type="text" id="pCode" class="form-control" >
       </td>
                                  
       <td>  <select class="form-control" id="programsList" onchange="whenProgramIsSelected(this)">
            <option value="">Select Program</option>
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
                        
        <td> <select class="form-control" id="subLedgerList" >
                <option value="">Select Subledger</option> 
            </select>
        </td>

        <td> <select class="form-control" id="ledgerType">
                <option>1</option>
                <option>2</option>
                <option>3</option>
            </select>

        </td>

        <td>  <input  class="form-control " type="text" name="description" id="description"></td>
        <td>  <input  class="form-control debitError" type="text" onkeypress='validateDebit(event)' id="debitAmount"></td>
        <td>  <input  class="form-control creditError" type="text" onkeypress='validateCrdit(event)'  id="creditAmount"></td>
        <td> <input  class="form-control" type="text" name="chequeNo" id="chequeNo"></td>


</tr>


</tbody>
</table>
</div> 



<!-- ********************************our main table closed ************************************** -->

                        </div>
                        <br>
                        <div class="container">

                            <div class="table-responsive">
                                <table class="tablee" width="100%">
                                    <thead>
                                        <tr>
                                             <td  class="b"><b>Code#</b></td>
                                            <td  class="b"><b>A/C Head</b></td>
                                            <td  class="b"><b>Sub-Ledger</b></td>
                                            <td  class="b"><b>Ledger type</b></td>
                                            <td  class="b"><b>Descrption</b></td>
                                            <td  class="b"><b>Debit</b></td>
                                            <td  class="b"><b>Credit</b></td>
                                            <td  class="b"><b>Cheque number</b></td>
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

