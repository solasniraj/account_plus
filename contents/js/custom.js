
      var debitCreditDifference="";
      var DebitTotal="";
      var creditTotal="";
      var dateToday = new Date(); 
      var baseUrl='http://localhost/account_plus/';

      function  whenJournalTypeIsSelected(selectedType)
      {

       var index = selectedType.selectedIndex;      
       var typeValue= selectedType.options[index].value;  
       $.ajax({
        type: "POST",
        url: baseUrl +"transaction/getProgrammListForCurrentChartName",
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

       var index = selectedType.selectedIndex;      
       var cId= selectedType.options[index].value; 
       var pId=selectedType.options[index].getAttribute("programmId");

       $.ajax({
        type: "POST",
        url: baseUrl +"transaction/getProgrammcodeForCurrentId",
        data: {chartId:cId},
        success: function (msg)
        {

          $('#programmCode').html(msg);

        },
        error: function()
        {

         console.log("error occur");

       }
     });

        $.ajax({
        type: "POST",
        url: baseUrl +"transaction/getSubledgerForCurrentProgramId",
        data: {programmId:pId},
        success: function (msg)
        {

          $('#subLedgerList').html(msg);
        },
        error: function()
        {

        console.log("error occur");

       }
     });


        $.ajax({
        type: "POST",
        url: baseUrl +"transaction/getDonarListForCurrentProgramId",
        data: {programmId:pId},
        success: function (msg)
        {

          $('#donerList').html(msg);
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
      // var x=$('#creditAmount').val();
      // var parts = x.toString().split(".");
      // parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
      // var output=parts.join(".");
      // $('#creditAmount').val(output);
    }

  }


  function checkDiffernceBetDebitAndCredit($debitAmount,$creditAmount)
  {
   if($debitAmount == $creditAmount)
   {
     debitCreditDifference=0.0;
      activateCommentAndSummerField("activate");
       $("#creditGreater").val(0.0);
        $("#debitGreater").val(0.0);
   }
   else  if($debitAmount >$creditAmount)
   {

    debitCreditDifference=$debitAmount -$creditAmount;
    $("#debitGreater").val(debitCreditDifference);
    $("#creditGreater").val(0.0);
    activateCommentAndSummerField("adctivate");

  }
  else
  {
    debitCreditDifference=$creditAmount -$debitAmount;
    $("#debitGreater").val(0.0);
    $("#creditGreater").val(debitCreditDifference);
    activateCommentAndSummerField("adctivate");
  }

  }

  function activateCommentAndSummerField(type)
  {

    if(type=="activate")
    {

      $("#comment,#summery").attr("disabled", true); 
      $("#submitTheForm").prop('disabled', true);
    }
    else
    {
       $("#comment,#summery").attr("disabled", false); 
       $("#submitTheForm").prop('disabled', false);

    }
  }



  $(document).ready(function ()  
  {
     activateCommentAndSummerField("activate");
    $("#submitCurrentData").click(function(event)
    {

      var view;
      var program = document.getElementById("programsList").options[document.getElementById("programsList").selectedIndex].text;
      var subLedger = document.getElementById("subLedgerList").options[document.getElementById("subLedgerList").selectedIndex].text;
      var ledgerType = document.getElementById("ledgerType").options[document.getElementById("ledgerType").selectedIndex].value;
      var donar = document.getElementById("donerList").options[document.getElementById("donerList").selectedIndex].text;
      var description = $('#description').val();
      var debitAmount = $('#debitAmount').val();
      var creditAmount = $('#creditAmount').val();
      var chequeNo = $('#chequeNo').val();
      var pCode= $("#pCode").val();


      


      if( (program == null || program == "") || (ledgerType == null || ledgerType == "")  || (description == null || description == "") || (pCode == null || pCode == ""))
      {

       var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Plese Enter Necessary Fields</div>';
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

     var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Either Debit Amount OR Credit Amount is required</div>';
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
     '<td>' + donar + '</td>' +
     '<td colspan="2">' + description + '</td>' +
     '<td>' + debitAmount + '</td>' +
     '<td>' + 0.00 + '</td>' +
     '<td>' + chequeNo + '</td>' +
     '<td colspan="2" style="width:200px" ><button type="text" class="btn btn-default btn-sm">Add</button> / <button type="text" class="btn btn-default btn-sm">Edit</button></td></tr>';
     var a = parseInt($("#totalCredit").text());
     DebitTotal = a + parseInt(debitAmount);
     $("#totalDebit").html(DebitTotal); 
     $("table tbody#lastId").prepend(view);
     // $('#programsList').html('<option value="">Select Program</option>');
     $('#subLedgerList').html('<option value="">select subLedger</option>');

     
     description = $('#description').val("");
     debitAmount = $('#debitAmount').val("");
     creditAmount = $('#creditAmount').val("");
     chequeNo = $('#chequeNo').val("");
     // pCode= $("#pCode").val("");
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
      '<td>' + donar + '</td>' +
     '<td colspan="2">' + description + '</td>' +
     '<td>' + 0.00 + '</td>' +
     '<td>' + creditAmount + '</td>' +
     '<td>' + chequeNo + '</td>' +
     '<td colspan="2" style="width:200px"><button type="text" class="btn btn-default btn-sm">Add</button> / <button type="text" class="btn btn-default btn-sm">Edit</button></td></tr>';
     var a = parseInt($("#totalCredit").text());
     creditTotal = a + parseInt(creditAmount);
     $("#totalCredit").html(creditTotal); 
     $("table tbody#lastId").prepend(view);
     // $('#programsList').html('<option value="">Select Program</option>');
     $('#subLedgerList').html('<option value="">select Ledger</option>');
     description = $('#description').val("");
     debitAmount = $('#debitAmount').val("");
     creditAmount = $('#creditAmount').val("");
     chequeNo = $('#chequeNo').val("");
     // pCode= $("#pCode").val("");
     checkDiffernceBetDebitAndCredit(DebitTotal,creditTotal)

   }
   else 
   {     

    var  msg= '<div class="alert alert-warning fade in text-center"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a><strong>Error!</strong>Either debit and crdit is required</div>';
    $('#errorMessages').html(msg);
    return false;
  }



  });


    $( function() {
      $( "#datepicker" ).datepicker({
           minDate: dateToday

        });
    } );

  });



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
